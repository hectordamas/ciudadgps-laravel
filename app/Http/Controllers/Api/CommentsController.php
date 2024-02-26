<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Commerce;

class CommentsController extends Controller
{

    public function index(Request $request)
    {
        $commerce_id = $request->commerce_id;
        $comments = Comment::where('commerce_id', $commerce_id)
        ->with(['user'])
        ->orderBy('id', 'desc')
        ->paginate(10);

        return response()->json([
            'comments' => $comments
        ]);

    }



    public function store(Request $request)
    {
        $comment = new Comment();
        $comment->comment = $request->comment;
        $comment->rating = $request->rating;
        $comment->commerce_id = $request->commerce_id;
        $comment->user_id = $request->user()->id;
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

        $comments = Comment::where('commerce_id', $commerce->id)
        ->with(['user', 'commerce'])
        ->orderBy('id', 'desc')
        ->get()
        ->take(3);

        return response()->json([
            'message' => 'Reseña creada con éxito!',
            'comments' => $comments
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
