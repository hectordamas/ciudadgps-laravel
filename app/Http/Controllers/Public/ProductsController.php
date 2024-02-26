<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductsController extends Controller
{
    public function show($id){
        $product = Product::find($id);

        return view('public.products.show', [
            'product' => $product
        ]);
    }
}
