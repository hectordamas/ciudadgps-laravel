<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\BaseController;
use Illuminate\Http\Request;
use App\Models\Category;
use DB;
use App\Models\Commerce;
use App\Models\Product;
use App\Models\Visit;
use App\Models\User;
use Response;


class ProductsController extends BaseController
{
    public function getProducts(Request $request){
        $products = Product::orderBy('id', 'desc')
        ->whereNull('hidden')
        ->where('commerce_id', $request->commerce_id)
        ->get();

        $commerce = Commerce::with(['pcategories'])
        ->find($request->commerce_id);

        $visit = new Visit();
        $visit->ip = $request->ip();
        $visit->commerce_id = $commerce->id;
        $visit->save();

        return response()->json([
            'products' => $products,
            'commerce' => $commerce,
        ]);    
    }

    public function index(Request $request){    
        if (!$this->checkIfCommerceHasUser($request->commerce_id, $request->user()->id)) {
            return response()->json([
                'error' => 'Tu usuario no está asociado a este comercio.'
            ]);
        }
    
        $products = Product::orderBy('id', 'desc')
        ->where('commerce_id', $request->commerce_id)
        ->get();
        
        $commerce = Commerce::find($request->commerce_id);

        return response()->json([
            'products' => $products,
            'commerce' => $commerce,
        ]);
    }

    public function create(Request $request){
        $commerce = Commerce::find($request->commerce_id);
        $pcategories = $commerce->pcategories;

        return response()->json([
            'pcategories' => $pcategories 
        ]);
    }

    public function store(Request $request){
        if (!$this->checkIfCommerceHasUser($request->commerce_id, $request->user()->id)) {
            return response()->json([
                'error' => 'Tu usuario no está asociado a este comercio.'
            ]);
        }

        $product = new Product();
        $product->name = $request->name;
        $product->price = $request->price;   
        $product->description = $request->description;           
        if($request->hasFile('image')){
            $file = $request->file('image');
            $path = public_path(). '/products/' ;
            $fileName = time() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $fileUri = '/products/'. $fileName;
            $product->image = $fileUri;
        }
        $product->commerce_id = $request->commerce_id;
        $product->pcategory_id = $request->pcategory_id;
        $product->save();

        return response()->json([
            'message' => 'Producto creado de forma existosa!'
        ]);        
    }

    public function edit($product_id){
        $product = Product::with(['pcategory'])->find($product_id);
        $pcategories = $product->commerce->pcategories;

        return response()->json([
            'product' => $product,
            'pcategories' => $pcategories
        ]);
    }

    public function update(Request $request){

        if (!$this->checkIfCommerceHasUser($request->commerce_id, $request->user()->id)) {
            return response()->json([
                'error' => 'Tu usuario no está asociado a este comercio.'
            ]);
        }

        $product = Product::find($request->product_id);
        $product->name = $request->name;
        $product->price = $request->price;    
        $product->description = $request->description;           
        if($request->hasFile('image')){
            $file = $request->file('image');
            $path = public_path() . '/products/';
            $fileName = time() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $fileUri = '/products/'. $fileName;
            $product->image = $fileUri;
        }
        $product->pcategory_id = $request->pcategory_id;
        $product->save();

        return response()->json([
            'message' => 'Producto modificado de forma existosa!'
        ]);    
    }

    public function setIsEnabled(Request $request){

        if (!$this->checkIfCommerceHasUser($request->commerce_id, $request->user()->id)) {
            return response()->json([
                'error' => 'Tu usuario no está asociado a este comercio.'
            ]);
        }

        $commerce = Commerce::find($request->commerce_id);
        $commerce->enable = $request->enable == 'active' ? 'active' : NULL;
        $commerce->save();

        return response()->json([
            'message' => 'Catalogo activado de forma existosa!'
        ]);   
    }

    public function destroy(Request $request){
        if (!$this->checkIfCommerceHasUser($request->commerce_id, $request->user()->id)) {
            return response()->json([
                'error' => 'Tu usuario no está asociado a este comercio.'
            ]);
        }
        
        $product = Product::find($request->productId);
        $product->delete();

        return response()->json([
            'message' => 'Producto eliminado de forma existosa!'
        ]);   
    }

    public function show($id){
        $product = Product::find($id);
        $commerce = $product->commerce;

        return response()->json([
            'product' => $product,
            'commerce' => $commerce
        ]);
    }

    public function hideProduct(Request $request){
        if (!$this->checkIfCommerceHasUser($request->commerce_id, $request->user()->id)) {
            return response()->json([
                'error' => 'Tu usuario no está asociado a este comercio.'
            ]);
        }

        $product = Product::find($request->product_id);
        $product->hidden = $request->hidden == 'hidden' ? 'hidden' : NULL;
        $product->save();

        $products = Product::orderBy('id', 'desc')->where('commerce_id', $request->commerce_id)->get();

        return response()->json([
            'products' => $products
        ]);  
    }
}
