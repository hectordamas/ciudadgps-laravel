<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{

    public function index()
    {
        $categories = Category::all();

        return view('categories.index', [
            'categories' => $categories
        ]);
    }


    public function create()
    {
        return view('categories.create');
    }


    public function store(Request $request)
    {
        $slug = Str::slug($request->input('name'));
        $count = DB::table('categories')->where('slug', $slug)->count();
        $suffix = '';

        if ($count > 0) {
            $suffix = '-' . Str::random(6);
        }

        $category = new Category();
        $category->slug = $slug . $suffix;
        $category->name = $request->input('name');
        $category->position = $request->input('position');
        $category->hidden = $request->input('hidden');
        if($request->hasFile('image')){
            $file = $request->file('image');
            $filename = time() . $file->getClientOriginalName();
            $path = public_path() . '/categories/';
            $file->move($path, $filename);
            $fileUri = '/categories/' . $filename;

            $category->image_url = $fileUri;
        }
        $category->save();

        return redirect()->back()->with('message', 'Categoría Creada con éxito!');
    }

    public function edit($id)
    {
        $category = Category::find($id);

        return view('categories.edit', [
            'category' => $category
        ]);

    }

    public function update(Request $request, $id)
    {
        $slug = Str::slug($request->input('name'));
        $count = DB::table('categories')->where('slug', $slug)->count();
        $suffix = '';

        if ($count > 0) {
            $suffix = '-' . Str::random(6);
        }

        $category = Category::find($id);
        $category->name = $request->input('name');
        $category->slug = $slug . $suffix;
        $category->position = $request->input('position');
        $category->hidden = $request->input('hidden');
        if($request->hasFile('image')){
            $file = $request->file('image');
            $filename = time() . $file->getClientOriginalName();
            $path = public_path() . '/categories/';
            $file->move($path, $filename);
            $fileUri = '/categories/' . $filename;

            $category->image_url = $fileUri;
        }
        $category->save();

        return redirect('/category')->with('message', 'Categoría Modificada con éxito!');
    }

    public function destroy($id)
    {
        //
    }
}
