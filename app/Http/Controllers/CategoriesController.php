<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();

        return view('categories.index', [
            'categories' => $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category = new Category();
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);

        return view('categories.edit', [
            'category' => $category
        ]);

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
        $category = Category::find($id);
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

        return redirect('/category')->with('message', 'Categoría Modificada con éxito!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
