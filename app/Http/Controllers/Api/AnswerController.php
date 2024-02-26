<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Answer;
use App\Models\Commerce;
use App\Models\Question;
use App\Models\User;

class AnswerController extends Controller
{
    private function sendNotification($data){
        $commerce = Commerce::find($data['commerceId']);

        if($commerce){
            $recipients = $data['recipients'];
    
            $response = Http::post("https://exp.host/--/api/v2/push/send", [
                "to" => $recipients,
                "title"=> $data['title'],
                "body"=> $data['body']
            ])->json();
    
            return ['response' => $response, 'recipients' => $recipients];
        }
    }

    public function store(Request $request){
        $answer = new Answer();
        $answer->message = $request->message;
        $answer->question_id = $request->questionId;
        $answer->commerce_id = $request->commerceId;
        $answer->user_id = $request->userId;
        $answer->save();

        $user = User::find($request->userId);

        $question = Question::find($request->questionId);
        $recipients = [];

        if($question->user->id == $request->userId){
            $commerce = Commerce::find($request->commerceId);
            foreach($commerce->users as $u){
                array_push($recipients, $u->token);
            }
        }else{
            array_push($recipients, $question->user->token);
        }

        $this->sendNotification([
            'commerceId' => $request->commerceId,
            'title' => $user->name . ' respondió hilo de ' . $commerce->name,
            'body' => $request->message,
            'recipients' => $recipients
        ]);

        if($request->type == 'questionOnCommerce'){
            $questions = Question::with(['user'])
            ->where('commerce_id', $request->commerceId)
            ->orderBy('id', 'desc')
            ->get()
            ->take(3)
            ->each(function($q) {
                $q->load('answers.user')->take(1);
            });

            return response()->json([
                'message' => 'respuesta registrada con exito',
                'questions' => $questions
            ]);
        }

        return response()->json([
            'answers' => $question->answers->load(['user'])
        ]);
    }

    public function edit(Request $request){
        $answer = Answer::find($request->answerId);

        return response()->json([
            'answer' => $answer
        ]);
    }

    public function destroy(Request $request){
        $answer = Answer::find($request->answerId);

        if($request->type == 'questionOnCommerce'){
            $answer->delete();

            $questions = Question::with(['user'])
            ->where('commerce_id', $answer->commerce_id)
            ->orderBy('id', 'desc')
            ->get()
            ->take(3)
            ->each(function($q) {
                $q->load('answers.user')->take(1);
            });

            return response()->json([
                'message' => 'Respuesta eliminada con exito',
                'questions' => $questions
            ]);
        }

        $question = $answer->question;
        $answer->delete();
        $answers = $question->answers;
        $answers->load('user');

        return response()->json([
            'message' => 'Respuesta eliminada con exito',
            'answers' => $answers
        ]);
    }
}
