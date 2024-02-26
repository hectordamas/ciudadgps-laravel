<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Commerce;
use App\Models\Img;

class ImagesController extends BaseController
{
    public function update($id, Request $request) {
        if (!$this->checkIfCommerceHasUser($id, $request->user()->id)) {
            return response()->json([
                'error' => 'Tu usuario no está asociado a este comercio.'
            ]);
        }

        $commerce = Commerce::find($id);
        for($i = 0; $i < $request->photosCount; $i++){
            if($request->hasFile('photos' . $i)){
                $file = $request->file('photos' . $i);
                $path = public_path(). '/photos/' ;
                $fileName = time() . $file->getClientOriginalName();
                $file->move($path, $fileName);
                $fileUri = '/photos/'. $fileName;

                $image = new Img();
                $image->uri = $fileUri;
                $image->commerce_id = $commerce->id;
                $image->save();
            }
        }

        $commerce = Commerce::find($id);
        return response()->json([
            'imgs' => $commerce->imgs
        ]);
    }

    public function destroy($id, Request $request){
        try{
            $img = Img::find($id);
            $commerce_id = Commerce::find($img->commerce->id)->id;
    
            if (!$this->checkIfCommerceHasUser($commerce_id, $request->user()->id)) {
                return response()->json([
                    'error' => 'Tu usuario no está asociado a este comercio.'
                ]);
            }
    
            $img->delete();
            $commerce = Commerce::find($commerce_id);
            return response()->json([
                'imgs' => $commerce->imgs
            ]);
        }catch(\Exception $e){
            return response()->json($e->getMessage());
        }
    }

    public function updateLogo ($id, Request $request) {
        try{
            $commerce = Commerce::find($id);
            if (!$this->checkIfCommerceHasUser($commerce->id, $request->user()->id)) {
                return response()->json([
                    'error' => 'Tu usuario no está asociado a este comercio.'
                ]);
            }
            if($request->hasFile('logo')){
                $file = $request->file('logo');
                $path = public_path(). '/logos/' ;
                $fileName = time() . $file->getClientOriginalName();
                $file->move($path, $fileName);
                $fileUri = '/logos/'. $fileName;
                $commerce->logo = $fileUri;
            }
            $commerce->save();
    
            return response()->json([
                'commerce' => $commerce,
                'logo' => $commerce->logo
            ]);
        }catch(\Exception $e){
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }
    
}
