<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Commerce;

class CommentsController extends Controller
{
    public function index($id){
        $commerce = Commerce::find($id);
        $comments = Comment::where('commerce_id', $id)->paginate(15);

        return view('public.commerces.comments', [
            'comments' => $comments,
            'commerce' => $commerce
        ]);
    }

    public function store(Request $request){
        
        $comment = new Comment();
        $comment->comment = $request->comment;
        $comment->rating = $request->rating;
        $comment->user_id = $request->user_id;
        $comment->commerce_id = $request->commerce_id;
        $comment->save();

        $commerce = Commerce::find($request->commerce_id);

        $totalRating = 0;
        foreach($commerce->comments as $c){
            $totalRating = $totalRating + $c->rating;
        }

        if($commerce->comments->count() > 0){
            $totalRating = $totalRating / $commerce->comments->count();
            $commerce->rating = $totalRating;
        }
        $commerce->save();

        return redirect()->back()->with('message', 'Reseña creada con éxito!');
    }
}
