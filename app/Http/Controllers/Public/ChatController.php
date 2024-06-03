<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use OpenAI\Laravel\Facades\OpenAI;
use App\Models\Conversation;
use App\Models\Message;
use App\Models\Commerce;
use Gemini\Laravel\Facades\Gemini;
use DB;

use App\Models\Product;
use App\Models\Job;
use App\Models\Category;
use Auth;

class ChatController extends Controller
{
    public function show($id){
        $conversation = Conversation::with('messages')->find($id);
        $conversations = Conversation::where('user_id', Auth::id())->orderBy('id', 'desc')->get();

        return view('public.chat.index', [
            'conversation' => $conversation,
            'conversations' => $conversations
        ]);
    }

    public function chat(){
        $conversations = Conversation::where('user_id', Auth::id())->orderBy('id', 'desc')->get();

        return view('public.chat.index', [
            'conversations' => $conversations
        ]);
    }

    public function handleChatRequest(Request $request)
    {
        $messageContent = $request->input('message');
        $conversationId = $request->input('conversation_id');
        $latitude = session('latitude');
        $longitude = session('longitude');

        // If no conversation ID is provided, create a new conversation
        if (!$conversationId) {
            $conversation = Conversation::create();
            $conversationId = $conversation->id;

            $conversation->title = Gemini::geminiPro()
            ->generateContent("Genera un titulo de pocos caracteres para este mensaje: " . $messageContent)
            ->text();
            
            $conversation->user_id = Auth::id();
            $conversation->save();
        } else {
            $conversation = Conversation::findOrFail($conversationId);
        }

        // Save the user's message
        $userMessage = new Message([
            'conversation_id' => $conversationId,
            'content' => $messageContent,
            'is_user' => true,
        ]);
        $userMessage->save();

        // Fetch commerce data from the database
        $commerceData = $this->getCommerces($messageContent, $latitude, $longitude);
        $productsData = $this->getProducts($messageContent);
        $jobsData = $this->getJobs($messageContent);
        $categoriesData = $this->getCategories($messageContent);

        // Create the prompt for OpenAI
        $prompt = $this->createPrompt($messageContent, $commerceData, $conversation, $latitude, $longitude, $productsData, $jobsData, $categoriesData);

        $result = Gemini::geminiPro()->generateContent($prompt);

        $botMessageContent = $result->text();

        // Save the bot's response
        $botMessage = new Message([
            'conversation_id' => $conversationId,
            'content' => $botMessageContent,
            'is_user' => false,
        ]);
        $botMessage->save();

        $conversations = Conversation::where('user_id', Auth::id())->orderBy('id', 'desc')->get();

        return response()->json([
            'response' => $botMessageContent, 
            'conversation_id' => $conversationId,
            'prompt' => $prompt,
            'conversation' => $conversation,
            'conversations' => $conversations
        ]);
    }


    private function getCommerces($messageContent, $latitude = null, $longitude = null)
    {
        $keywords = array_diff(explode(' ', $messageContent), $this->stopWords);
    
        $query = Commerce::join('categories', 'categories.id', '=', 'commerces.category_id')
            ->distinct('commerces.id')
            ->leftJoin('tags', 'tags.commerce_id', '=', 'commerces.id')
            ->leftJoin('products', 'products.commerce_id', '=', 'commerces.id')
            ->leftJoin('jobs', 'jobs.commerce_id', '=', 'commerces.id');
    
        if ($latitude && $longitude) {
            $distance = DB::raw('(111.045 * acos( cos( radians(' . $latitude . ') ) 
                * cos( radians( commerces.lat ) ) 
                * cos( radians( commerces.lon ) - radians(' . $longitude . ') ) 
                + sin( radians(' . $latitude . ') ) 
                * sin( radians(commerces.lat) ) ) ) * 100 AS distance');
            
                $query->select('commerces.*')->addSelect($distance);        
        } else {
                $query->select('commerces.*');        
        }
    
        $query->where(function ($query) use ($keywords) {
            foreach ($keywords as $keyword) {
                $query->orWhere(function ($query) use ($keyword) {
                    $query->where('commerces.name', 'LIKE', "%$keyword%")
                          ->orWhere('commerces.info', 'LIKE', "%$keyword%")
                          ->orWhere('commerces.address', 'LIKE', "%$keyword%")
                          ->orWhere('tags.name', 'LIKE', "%$keyword%")
                          ->orWhere('categories.name', 'LIKE', "%$keyword%")
                          ->orWhere('products.name', 'LIKE', "%$keyword%")
                          ->orWhere('jobs.title', 'LIKE', "%$keyword%");
                });
            }
        });
    
        $query->whereNotNull('commerces.paid')
              ->where('commerces.expiration_date', '>=', date('Y-m-d'));
    
        if ($latitude && $longitude) {
            $query->orderBy('distance')
                  ->orderBy('commerces.rating', 'DESC');
        } else {
            $query->orderBy('commerces.rating', 'DESC');
        }
    
        return $query->limit(30)->get();
    }
    

    private function getProducts($messageContent)
    {
        $keywords = array_diff(explode(' ', $messageContent), $this->stopWords);
        $query = Product::query();
    
        foreach ($keywords as $keyword) {
            $query->orWhere('name', 'LIKE', "%$keyword%")
                  ->orWhere('description', 'LIKE', "%$keyword%");
        }
    
        return $query->limit(10)->get();
    }
    
    private function getJobs($messageContent){
        $keywords = array_diff(explode(' ', $messageContent), $this->stopWords);
        $query = Job::query();
    
        foreach ($keywords as $keyword) {
            $query->orWhere('title', 'LIKE', "%$keyword%")
                  ->orWhere('description', 'LIKE', "%$keyword%");
        }
    
        return $query->limit(10)->get();
    }

    private function getCategories($messageContent){
        $keywords = array_diff(explode(' ', $messageContent), $this->stopWords);
        $query = Category::query();
    
        foreach ($keywords as $keyword) {
            $query->orWhere('name', 'LIKE', "%$keyword%");
        }
    
        return $query->limit(10)->get();
    }
    

    private function createPrompt($userMessage, $commerceData, $conversation, $latitude, $longitude, $productsData, $jobsData, $categoriesData)
    {
        $commerceInfo = "";
        foreach ($commerceData as $commerce) {
            $tags = implode(',' , $commerce->tags->pluck('name')->unique()->toArray());
            $categories = implode(',' , $commerce->categories->pluck('name')->unique()->toArray());
            $jobs = implode(',' , $commerce->jobs->pluck('title')->unique()->toArray());
            $products = implode(',' , $commerce->products->pluck('name')->unique()->toArray());
            
            $commerceInfo = "";
            foreach ($commerceData as $commerce) {
                $tags = implode(', ', $commerce->tags->pluck('name')->unique()->toArray());
                $categories = implode(', ', $commerce->categories->pluck('name')->unique()->toArray());
                $jobs = implode(', ', $commerce->jobs->pluck('title')->unique()->toArray());
                $products = implode(', ', $commerce->products->pluck('name')->unique()->toArray());
            
                $commerceInfo .= 
                    $commerce->name . ": " . $commerce->description . 
                    ". Distancia: " . (isset($commerce->distance) ? $this->formatDistance($commerce->distance) : 'Desconocida') .
                    ". Valoración: " . number_format($commerce->rating, 2) .
                    ". Dirección: " . $commerce->address .
                    ". Categorías: " . $categories .
                    ". Etiquetas: " . $tags . 
                    ". Empleos: " . $jobs . 
                    ". Productos: " . $products . 
                    ". Enlace a página de CiudadGPS: https://ciudadgps.com/slug-comercios/" . $commerce->slug .  
                    ". Enlace a Instagram: " . $commerce->instagram .  
                    ". Teléfonos: " . $commerce->telephone .  
                    ". Ubicación del comercio: latitud " . $commerce->lat . " longitud " . $commerce->lon.
                    "\n";
            }            
        }

        $productsInfo = "";
        foreach ($productsData as $product) {
            $productsInfo .= 
                $product->name . ": " . $product->description . 
                ". Empresa: ". $product->commerce->name .
                '. Enlace a página de empresa: https://ciudadgps.com/slug-comercios/' . $commerce->slug.
                '. Enlace a página de producto: https://ciudadgps.com/slug-productos/' . $product->slug.
                '. Precio: ' . $product->price;
        }

        $jobsInfo = "";
        foreach ($jobsData as $job) {
            $jobsInfo .= 
                $job->title . ": " . $job->description . 
                ". Empresa: ". $job->commerce->name .
                '. Enlace a página de empresa: https://ciudadgps.com/slug-comercios/' . $job->commerce->slug.
                '. Enlace a página de empleo: https://ciudadgps.com/empleo/' . $job->slug;     
        }

        $categoriesInfo = "";
        foreach($categoriesData as $category){
            $categoriesInfo .= 
                $category->name .
                '. Enlace a página de categoria: https://ciudadgps.com/comercios/slug-categorias/' . $category->slug;   
        }

        $conversationHistory = Message::where('conversation_id', $conversation->id)
                                     ->orderBy('created_at', 'desc')
                                     ->take(3)
                                     ->get()
                                     ->reverse()
                                     ->map(function ($message) {
                                         return $message->is_user ? "Usuario: " . $message->content : "Sofia: " . $message->content;
                                     })
                                     ->implode("\n");

        $context = "Eres SofIA, una asistente IA de CiudadGPS. Ayudas a los usuarios a encontrar negocios y servicios cercanos a su ubicación, empleos y productos. Proporciona información relevante para el usuario como productos en caso de que lo necesite o puestos de trabajo en caso de que lo requiera, es buena práctica darles el enlace al comercio que le estás sugiriendo, indicar la dirección, la distancia. Aquí hay algunos negocios cercanos:\n" 
        . $commerceInfo . 
        "\n\nHistorial de la conversación:\n" . $conversationHistory . 
        "\n\nPrompt del Usuario: " . $userMessage . 
        "\n\nLa Ubicación del usuario: latitud: " . $latitude . " y longitud " . $longitude .
        "\n\nProductos Relacionados a la búsqueda: " . $productsInfo.
        "\n\nEmpleos Relacionados a la búsqueda: " . $jobsInfo.
        "\n\categorias Relacionadas a la búsqueda: " . $categoriesInfo.
        "\n\nRecuerda ser cortés y tener buena atención con mi usuario final, cada vez que el use algún tipo de convencionalismo debes responder a él con educación. Si alguna información no está en CiudadGPS, es decir, en la información proporcionada anteriormente siéntete libre de usar google search/google maps para buscarla, siempre tomando en cuenta la data y ubicación del usuario. No incluyas enlaces entre paréntesis";

        return $context;
    }

    private function formatDistance($distance) {
        if ($distance < 1) {
            return number_format($distance * 1000, 2) . ' metros';
        } else {
            return number_format($distance, 2) . ' kilometros';
        }
    }

    private $stopWords = [
        'a', 'al', 'algo', 'algunas', 'algunos', 'ante', 'antes', 
        'como', 'con', 'contra', 'cual', 'cuando', 'de', 'del', 'desde', 
        'donde', 'durante', 'e', 'el', 'ella', 'ellas', 'ellos', 'en', 'entre', 
        'era', 'erais', 'eran', 'eras', 'eres', 'es', 'esa', 'esas', 'ese', 'eso', 'esos', 
        'esta', 'estaba', 'estaban', 'estado', 'estais', 'estamos', 'estan', 'estar', 'estas', 
        'este', 'esto', 'estos', 'estoy', 'fin', 'fue', 'fueron', 'fui', 'fuimos', 'ha', 'hace', 
        'haces', 'haciendo', 'hacer', 'hago', 'han', 'hasta', 'hay', 'incluso', 'intenta', 'intentais', 
        'intentamos', 'intentan', 'intentar', 'intentas', 'intento', 'ir', 'la', 'largo', 'las', 'lo', 'los', 'mientras', 
        'mio', 'modo', 'muchos', 'muy', 'nos', 'nosotros', 'nuestra', 'nuestras', 'nuestro', 'nuestros', 'nunca', 'os', 
        'otra', 'otras', 'otro', 'otros', 'para', 'pero', 'podeis', 'podemos', 'poder', 'podria', 'podriais', 'podriamos', 
        'podrian', 'podrias', 'por', 'porque', 'primero', 'puede', 'pueden', 'puedo', 'que', 'quien', 'sabe', 'sabeis', 
        'sabemos', 'saben', 'saber', 'sabes', 'ser', 'si', 'siendo', 'sin', 'sobre', 'sois', 'solamente', 'solo', 'somos', 
        'soy', 'su', 'sus', 'tambien', 'teneis', 'tenemos', 'tener', 'tengo', 'tiempo', 'tiene', 'tienen', 'todo', 'trabaja', 
        'trabajais', 'trabajamos', 'trabajan', 'trabajar', 'trabajas', 'trabajo', 'tras', 'tuyo', 'ultimo', 'un', 'una', 
        'unas', 'uno', 'unos', 'usa', 'usais', 'usamos', 'usan', 'usar', 'usas', 'uso', 'va', 'vais', 'valor', 'vamos', 
        'van', 'vaya', 'verdad', 'verdadera', 'vosotras', 'vosotros', 'voy', 'yo', 'el', 'la', 'los', 'las', 'un', 'una', 
        'unos', 'unas', 'de', 'del', 'a', 'con', 'y', 'en', 'por', 'para', 'que', 'es', 'son'
    ];
    
}
