<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pcategory;
use App\Models\Product;
use App\Models\Commerce;

class PcategoryController extends Controller
{
    public function index(Request $request){
        try{
            $pcategories = Pcategory::where('commerce_id', $request->commerce_id)->get();
    
            return response()->json([
                'pcategories' => $pcategories
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request){
        try{
            $pcategory = new Pcategory();
            $pcategory->commerce_id = $request->commerceId;
            $pcategory->name = $request->name;
            $pcategory->save();

            return response()->json([
                'message' => 'Categoria creada con exito!',
            ]);
        }catch(\Exception $e){
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }


    public function update($pcategoryId, Request $request){
        $pcategory = Pcategory::find($pcategoryId);
        $pcategory->name = $request->name;
        $pcategory->save();

        return response()->json([
            'message' => 'Categoria actualizada con exito'
        ]);
    }

    public function destroy(Request $request){
        $pcategory = Pcategory::find($request->pcategoryId);
        $products = $pcategory->products;

        foreach($products as $p){
            $p->pcategory_id = NULL;
            $p->save();
        }

        $pcategory->delete();

        return response()->json([
            'message' => 'Categoria eliminada con exito'
        ]);
    }
}
