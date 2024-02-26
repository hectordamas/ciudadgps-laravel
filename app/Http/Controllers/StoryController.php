<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Story;
use App\Models\StoryItem;

class StoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stories = Story::orderBy('position')->get();

        return view('story.index', [
            'stories' => $stories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('story.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $story = new Story();
        $story->user_name = $request->user_name;
        $story->position = $request->position_story;
        if($request->hasFile('user_image')){
            $file = $request->file('user_image');
            $path = public_path(). '/storiesImages/' ;
            $fileName = time() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $fileUri = '/storiesImages/'. $fileName;
            $story->user_image = $fileUri;
        }
        $story->save();

        $story->user_id = $story->id;
        $story->save();

        if(isset($request->swipeText)){

            for($i = 0; $i < count($request->swipeText); $i++){
                $storyItem = new StoryItem();
                $storyItem->swipeText = $request->swipeText[$i];
                if($request->hasFile('story_image')){
                    $file = $request->file('story_image')[$i];
                    $path = public_path(). '/story_item/' ;
                    $fileName = time() . $file->getClientOriginalName();
                    $file->move($path, $fileName);
                    $fileUri = '/story_item/'. $fileName;
                    $storyItem->story_image = $fileUri;
                }
                $storyItem->position = $request->position[$i];
                $storyItem->link = $request->link[$i];
                $storyItem->linkText = $request->linkText[$i];
                $storyItem->story_id = $story->id;
                $storyItem->save();
            }
    
        }

        return redirect('/stories')->with('message', 'Historia creada de forma exitosa!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $story = Story::find($id);
        $storyItems = StoryItem::where('story_id', $story->id)->orderBy('position', 'asc')->get();

        return view('story.show', [
            'story' => $story,
            'storyItems' => $storyItems
        ]);
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
        $story = Story::find($id);
        $story->user_name = $request->user_name;
        $story->position = $request->position;
        if($request->hasFile('user_image')){
            $file = $request->file('user_image');
            $path = public_path(). '/storiesImages/' ;
            $fileName = time() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $fileUri = '/storiesImages/'. $fileName;
            $story->user_image = $fileUri;
        }
        $story->save();

        return redirect('/stories')->with('message', 'Historia guardada de forma exitosa!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $story = Story::find($id);

        $story->stories()->delete();
        $story->delete();

        return redirect()->back()->with('message', 'Historia eliminada con éxito!');
    }
}
