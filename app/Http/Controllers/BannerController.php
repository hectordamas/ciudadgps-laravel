<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;

class BannerController extends Controller
{
    public function index(Request $request)
    {
        $banners = Banner::all();
        return view('banners.index', [
            'banners' => $banners
        ]);
    }


    public function create()
    {
        $banners = Banner::all();

        return view('banners.create', [
            'banners' => $banners
        ]);
    }


    public function store(Request $request)
    {
        $banner = new Banner();
        $banner->commerce_id = $request->commerce_id;
        $banner->url = $request->url; 
        if($request->hasFile('banner')){
            $file = $request->file('banner');
            $path = public_path(). '/bannersDirectory/' ;
            $fileName = time() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $fileUri = '/bannersDirectory/'. $fileName;
            $banner->banner = $fileUri;
        }
        $banner->section = $request->section;
        $banner->position = $request->position;
        $banner->hide = $request->hide;
        $banner->save();

        return redirect('/banners')->with('message', 'Anuncio creado con éxito!');
    }


    public function edit($id)
    {
        $banner = Banner::find($id);

        return view('banners.edit', [
            'banner' => $banner
        ]);
    }


    public function update(Request $request, $id)
    {
        $banner = Banner::find($id);
        $banner->commerce_id = $request->commerce_id;
        $banner->url = $request->url; 
        if($request->hasFile('banner')){
            $file = $request->file('banner');
            $path = public_path(). '/bannersDirectory/' ;
            $fileName = time() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $fileUri = '/bannersDirectory/'. $fileName;
            $banner->banner = $fileUri;
        }
        $banner->section = $request->section;
        $banner->position = $request->position;
        $banner->hide = $request->hide;
        $banner->save();

        return redirect('/banners')->with('message', 'Anuncio modificado con éxito!');

    }

    public function destroy($id)
    {
        //
    }
}
