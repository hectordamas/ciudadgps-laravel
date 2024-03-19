<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PushNotification;
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
    
        $chunks = array_chunk($uniqueTokens, 100); // Divide los tokens únicos en lotes de 100
        $responses = [];
    
        foreach ($chunks as $chunk) {
            $response = Http::post("https://exp.host/--/api/v2/push/send", [
                "to" => $chunk,
                "title" => $data['title'],
                "body" => $data['message']
            ])->json();
    
            $responses[] = $response;
        }
    
        return ['responses' => $responses, 'total_unique_tokens' => count($uniqueTokens)];
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
        $pushnotification->save();

        $data = [
            'title' => $pushnotification->title, 
            'message' => $pushnotification->message
        ];
        $this->sendNotification($data);

        return redirect()->back()->with('message', 'Notificacion enviada con éxito!');
    }
}
