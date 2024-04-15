<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\BaseController;
use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Commerce;
use DB;
use Illuminate\Support\Str;

class JobsController extends BaseController
{
    private function formatPhoneNumber($country_code, $phone_number) {
        $phone_number = preg_replace('/[^0-9]/', '', $phone_number); // Remover cualquier caracter que no sea número
        $phone_number = ltrim($phone_number, '0'); // Remover el cero inicial si lo hay
      
        if (substr($phone_number, 0, strlen($country_code)) != $country_code) {
          $phone_number = $country_code . $phone_number; // Agregar el código del país si no está presente
        }
      
        return $phone_number;
    }

    public function index(Request $request){
        if($request->search){
            $jobs = Job::where('title', 'LIKE', "%$request->search%")
            ->orWhere('description', 'LIKE', "%$request->search%")
            ->orderBy('id', 'desc');
        }else{
            $jobs = Job::orderBy('id', 'desc');
        }

        return response()->json([
            'jobs' => $jobs->paginate(15)
        ]);
    }

    public function searchJobs(Request $request){
        $jobs = Job::where('title', 'LIKE', "%$request->search%")
        ->orWhere('description', 'LIKE', "%$request->search%")
        ->distinct('title')
        ->orderByRaw("CASE 
            WHEN title LIKE '{$request->search}%' THEN 0
            WHEN title LIKE '%{$request->search}' THEN 2
            ELSE 1 
        END, 
        SUBSTRING(title, LOCATE('{$request->search}', title)) COLLATE utf8mb4_general_ci")
        ->take(9)
        ->get();

        return response()->json([
            'jobs' => $jobs
        ]);
    }

    public function getJobs(Request $request){
        try{
            if (!$this->checkIfCommerceHasUser($request->commerce_id, $request->user()->id)) {
                return response()->json([
                    'error' => 'Tu usuario no está asociado a este comercio.'
                ]);
            }
            
            $jobs = Job::where('commerce_id', $request->commerce_id)
            ->orderBy('id', 'desc')
            ->get();
    
            return response()->json([
                'jobs' => $jobs
            ]);
        }catch(\Exception $e){
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function getCommerceJobsData(Request $request){
        $jobs = Job::where('commerce_id', $request->commerce_id)->get();
        $commerce = Commerce::find($request->commerce_id);

        return response()->json([
            'jobs' => $jobs,
            'commerce' => $commerce
        ]);
    }

    public function store(Request $request){
        if (!$this->checkIfCommerceHasUser($request->commerce_id, $request->user()->id)) {
            return response()->json([
                'error' => 'Tu usuario no está asociado a este comercio.'
            ]);
        }

        $job = new Job();
        $job->title = $request->job;
        $job->description = $request->description;
        $job->whatsapp_code = $request->whatsapp_code;
        $job->whatsapp_number_code = $request->whatsapp_number_code;
        if($request->whatsapp_number){
            $job->whatsapp_number = ltrim($request->whatsapp_number, '0');
            $job->whatsapp = $this->formatPhoneNumber(str_replace('+', '', $request->whatsapp_number_code), $request->whatsapp_number);
        }else{
            $job->whatsapp_number = NULL;
            $job->whatsapp = NULL;
        }
        $job->commerce_id = $request->commerce_id;
        $job->email = $request->email;

        $slug = Str::slug($request->job);
        $count = DB::table('jobs')->where('slug', $slug)->count();
        $suffix = '';
        if ($count > 0) {
            $suffix = '-' . $count;
        }
        $job->slug = $slug . $suffix;
        $job->save();


        return response()->json([
            'response' => 'Empleo publicado con éxito!'
        ]);
    }

    public function edit($id){
        $job = Job::find($id);

        return response()->json([
            'job' => $job
        ]);
    }

    public function update(Request $request){
        $job = Job::find($request->job_id);
        if (!$this->checkIfCommerceHasUser($job->commerce->id, $request->user()->id)) {
            return response()->json([
                'error' => 'Tu usuario no está asociado a este comercio.'
            ]);
        }
        $slug = Str::slug($request->job);
        $count = DB::table('jobs')->where('slug', $slug)->where('id', '!=', $job->id)->count();
        $suffix = '';

        if ($count > 0) {
            $suffix = '-' . $count;
        }
        
        $job->title = $request->job;
        $job->slug = $slug . $suffix;
        $job->description = $request->description;
        $job->whatsapp_code = $request->whatsapp_code;
        $job->whatsapp_number_code = $request->whatsapp_number_code;
        if($request->whatsapp_number){
            $job->whatsapp_number = ltrim($request->whatsapp_number, '0');
            $job->whatsapp = $this->formatPhoneNumber(str_replace('+', '', $request->whatsapp_number_code), $request->whatsapp_number);
        }else{
            $job->whatsapp_number = NULL;
            $job->whatsapp = NULL;
        }
        $job->email = $request->email;
        $job->save();

        return response()->json([
            'response' => 'Empleo modificado con éxito!'
        ]);
    }

    public function destroy(Request $request){
        if (!$this->checkIfCommerceHasUser($request->commerce_id, $request->user()->id)) {
            return response()->json([
                'error' => 'Tu usuario no está asociado a este comercio.'
            ]);
        }
        
        $job = Job::find($request->job_id);
        $job->delete();

        return response()->json([
            'message' => 'Anuncio de empleo eliminado de forma existosa!'
        ]);   
    }
}
