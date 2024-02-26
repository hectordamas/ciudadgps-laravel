<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Commerce;

class IndexController extends Controller
{
    public function index(){
        
        $categories = Category::all();
        $commerces = Commerce::from('commerces as c')
        ->select('id','name', 'rating', 'logo')
        ->whereNotNull('destacar')
        ->orderBy('id', 'desc')
        ->get()
        ->take(4);
        $catHeader = $categories;


        return view('welcome', [
            'categories' => $categories,
            'commerces' => $commerces,
            'catHeader' => $catHeader
        ]);
    }
}
