<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoriesController extends Controller
{
    public function index(){
        $categories = Category::whereNull('hidden')->orderBy('position')->get();

        return view('public.categories.index', [
            'categories' => $categories
        ]);
    }
}
