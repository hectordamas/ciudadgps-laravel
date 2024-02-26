<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StoryItem;

class DestroyStoryItemsController extends Controller
{
    //
    public function destroy(Request $request){
        $items = $request->items;

        if(isset($items)){
            for($i = 0; $i < count($items); $i++){
                $storyItem = StoryItem::find($items[$i]);
                $storyItem->delete();
            }
        }

        return redirect()->back()->with('message', 'Items Eliminados de forma exitosa!');
    }
}
