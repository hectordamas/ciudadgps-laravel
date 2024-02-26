<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ticket;
use Mail;

class TicketController extends Controller
{
    public function store(Request $request){
        $ticket = new Ticket();
        $ticket->name = $request->name;
        $ticket->email = $request->email;
        $ticket->subject = $request->subject;
        $ticket->message = $request->description;
        $ticket->save();

        $data = ['ticket' => $ticket];

        Mail::send('mail.ticket', $data , function($message) use ($ticket, $request){
            $message->from('no-responder@ciudadgps.com', 'CiudadGPS');
            $message->to(['soporte@ciudadgps.com', 'hectorgabrieldm@hotmail.com'])->subject($ticket->subject);
            if($request->hasFile('image')){
                $file = $request->file('image');
                $path = public_path(). '/ticket/' ;
                $fileName = time() . $file->getClientOriginalName();
                $file->move($path, $fileName);
                $fileUri = '/ticket/'. $fileName;

                $message->attach(public_path(). $fileUri);
            }
        });

        return response()->json([
            'success' => 'success'
        ]);
    }
}
