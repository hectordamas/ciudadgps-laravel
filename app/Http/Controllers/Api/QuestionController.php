<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Question;
use App\Models\Commerce;
use App\Models\User;
use App\Models\Answer;

class QuestionController extends Controller
{
    private function sendNotification($data){
        $commerce = Commerce::find($data['commerceId']);
        if($commerce){
            $commerce->load('users');
            $users = $commerce->users;
            $recipients = $users
            ->whereNotNull('token')
            ->pluck('token')
            ->toArray();
    
            $response = Http::post("https://exp.host/--/api/v2/push/send", [
                "to" => $recipients,
                "title"=> $data['title'],
                "body"=> $data['body']
            ])->json();
    
            return ['response' => $response, 'recipients' => $recipients];
        }

        return ['response' => 'No se pudo enviar'];
    }

    public function store(Request $request){
        $question = new Question();
        $question->message = $request->message;
        $question->user_id = $request->userId;
        $question->commerce_id = $request->commerceId;
        $question->save();

        $commerce = Commerce::find($request->commerceId);
        $user = User::find($request->userId);

        $this->sendNotification([
            'commerceId' => $request->commerceId,
            'title' => $user->name . ' preguntó a ' . $commerce->name,
            'body' => $request->message
         ]);

        if($request->type == 'questionOnCommerce'){
            $questions = Question::with(['user'])
            ->where('commerce_id', $commerce->id)
            ->orderBy('id', 'desc')
            ->get()
            ->take(3)
            ->each(function($q) {
                $q->load('answers.user')->take(1);
            });

            return response()->json([
                'message' => 'Pregunta registrada con exito',
                'questions' => $questions
            ]);
        }

        $questions = Question::with(['user'])
        ->where('commerce_id', $commerce->id)
        ->orderBy('id', 'desc')
        ->get();

        return response()->json([
            'message' => 'Pregunta registrada con exito',
            'questions' => $questions
        ]);
    }

    public function show($questionId){
        $question = Question::with(['user'])->find($questionId);
        $answers = Answer::with(['user'])->where('question_id', $questionId)->get();
        $users = $question->commerce->users;
        $commerce = $question->commerce;
        $usersId = []; 

        foreach($users as $user){
            array_push($usersId, $user->id);
        }   

        return response()->json([
            'question' => $question,
            'answers' => $answers,
            'users' => $usersId,
            'commerce' => $commerce
        ]);
    }

    public function getQuestionsCommerce($commerceId){
        $questions = Question::with(['user'])
        ->where('commerce_id', $commerceId)
        ->orderBy('id', 'desc')
        ->get();

        return response()->json([
            'questions' => $questions
        ]);
    }

    public function edit(Request $request){
        $question = Question::find($request->questionId);

        return response()->json([
            'question' => $question
        ]);
    }

    public function destroy(Request $request){
        $question = Question::find($request->questionId);
        $question->answers()->delete();
        $question->delete();

        $commerce = $question->commerce;

        if($request->type == 'questionOnCommerce'){
            $questions = Question::with(['user'])
            ->where('commerce_id', $commerce->id)
            ->orderBy('id', 'desc')
            ->get()
            ->take(3)
            ->each(function($q) {
                $q->load('answers.user')->take(1);
            });
            
            return response()->json([
                'message' => 'Pregunta Eliminada con exito',
                'questions' => $questions
            ]);
        }

        $questions = Question::with(['user'])
        ->where('commerce_id', $commerce->id)
        ->orderBy('id', 'desc')
        ->get();

        return response()->json([
            'message' => 'Pregunta Eliminada con exito',
            'questions' => $questions
        ]);
    }
}
