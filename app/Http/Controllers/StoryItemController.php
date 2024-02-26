<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StoryItem;

class StoryItemController extends Controller
{

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $storyItem = new StoryItem();
        $storyItem->swipeText = $request->swipeText;
        if($request->hasFile('story_image')){
            $file = $request->file('story_image');
            $path = public_path(). '/story_item/' ;
            $fileName = time() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $fileUri = '/story_item/'. $fileName;
            $storyItem->story_image = $fileUri;
        }
        $storyItem->position = $request->position;
        $storyItem->link = $request->link;
        $storyItem->linkText = $request->linkText;
        $storyItem->story_id = $request->story_id;
        $storyItem->save();

        return redirect()->back()->with('message', 'Item creado de forma exitosa!');
    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        $storyItem = StoryItem::find($id);
        $storyItem->swipeText = $request->swipeText;
        if($request->hasFile('story_image')){
            $file = $request->file('story_image');
            $path = public_path(). '/story_item/' ;
            $fileName = time() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $fileUri = '/story_item/'. $fileName;
            $storyItem->story_image = $fileUri;
        }
        $storyItem->position = $request->position;
        $storyItem->link = $request->link;
        $storyItem->linkText = $request->linkText;

        $storyItem->save();

        return redirect()->back()->with('message', 'Item modificado de forma exitosa!');

    }


    public function destroy($id)
    {
        $storyitem = StoryItem::find($id);

        $storyitem->delete();

        return redirect()->back()->with('message', 'Item eliminada con éxito!');

    }
}
