<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductsController extends Controller
{
    public function show($id){
        $product = Product::find($id);
        if($product){
            return redirect('slug-productos/' . $product->slug);
        }else{
            return view('errors.404');
        }
    }

    public function showSlug($slug){
        $product = Product::where('slug', $slug)->first();
        if($product){
            $commerce = $product->commerce;
            $tags = $commerce->tags->pluck('name')->unique()->toArray();
            $categories = $commerce->categories->pluck('name')->unique()->toArray();
            $keywords = implode(', ', $categories) . ', ' . $commerce->name . ', ' . implode(', ', $tags);
            $meta_description = $product->name . ' en catálogo de Productos de ' . $commerce->name .' en CiudadGPS';

            return view('public.products.show', [
                'product' => $product,
                'commerce' => $commerce,
                'keywords' => $keywords,
                'meta_description' => $meta_description
            ]);
        }else{
            return view('errors.404');
        }
    }
}
