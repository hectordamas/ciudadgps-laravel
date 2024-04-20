<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PushNotification;
use App\Models\PushToken;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class PushNotificationsController extends Controller
{
    private function sendNotification($data) {
        $uniqueTokens = User::whereNotNull('token')
            ->pluck('token')
            ->unique()
            ->toArray();
    
        $pushTokens = PushToken::whereNotNull('token')
            ->pluck('token')
            ->unique()
            ->toArray();
    
        // Fusionar y hacer que los valores sean únicos e irrepetibles
        $mergedTokens = array_unique(array_merge($uniqueTokens, $pushTokens));
        
        $chunks = array_chunk($mergedTokens, 100); // Divide los tokens únicos en lotes de 100
        $responses = [];

        $data = [
            [
                "commerceId" => $data['commerceId'],
                "screen" => $data['screen'] == 'Comercio' ? 'Commerce' : '',
            ]
        ];
        
        // Convertir la data en JSON
        $dataJson = json_encode($data);
        
        foreach ($chunks as $chunk) {
            $response = Http::post("https://exp.host/--/api/v2/push/send", [
                "to" => $chunk,
                "title" => $data['title'],
                "body" => $data['message'],
                "data" => $dataJson
            ])->json();
        
            $responses[] = $response;
        }
        
        return ['responses' => $responses, 'total_unique_tokens' => count($mergedTokens)];
    }
    
    public function index(){
        $pushnotifications = PushNotification::orderBy('id', 'desc')->get();

        return view('pushnotifications.index', [
            'pushnotifications' => $pushnotifications
        ]);
    }

    public function create(){
        return view('pushnotifications.create');
    }

    public function store(Request $request){
        $pushnotification = new PushNotification();
        $pushnotification->title = $request->title;
        $pushnotification->message = $request->message;
        $pushnotification->commerceId = $request->commerceId;
        $pushnotification->screen = $request->screen;
        $pushnotification->save();

        $data = [
            'title' => $pushnotification->title, 
            'message' => $pushnotification->message,
            'commerceId' => $pushnotification->commerceId,
            'screen' => $pushnotification->screen
        ];

        $this->sendNotification($data);

        return redirect()->back()->with('message', 'Notificacion enviada con éxito!');
    }

    public function show(Request $request){
        $pushnotification = PushNotification::find($request->id);

        return response()->json([
            'pushnotification' => $pushnotification
        ]);
    }
}
