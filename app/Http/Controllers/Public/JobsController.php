<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Job;

class JobsController extends Controller
{
    public function index(Request $request){
        $jobs = Job::where('title', 'LIKE', "%$request->search%")
        ->orWhere('description', 'LIKE', "%$request->search%")
        ->orderBy('id', 'desc')
        ->paginate(15);

        return view('public.jobs.index', [
            'jobs' => $jobs
        ]);
    }

    public function show($id){
        $job = Job::find($id);
        if($job){
            return redirect('/empleo/' . $job->slug);
        }else{
            return view('errors.404');
        }
    }

    public function showSlug($slug){
        $job = Job::where('slug', $slug)->first();
        $commerce = $job->commerce;
        $tags = $commerce->tags->pluck('name')->unique()->toArray();
        $categories = $commerce->categories->pluck('name')->unique()->toArray();
        $keywords = $job->title .', bolsa de empleo, talento, personal, captacion, trabajo, '. implode(', ', $categories) . ', ' . $commerce->name . ', ' . implode(', ', $tags);
        $meta_description = $job->title . ' en Bolsa de Empleo de CiudadGPS: bolsa de empleo, talento, personal, captacion, trabajo';

        return view('public.jobs.show', [
            'job' => $job,
            'keywords' => $keywords,
            'meta_description' => $meta_description
        ]);
    }

    public function redirect(){
        $job = Job::find($id);

        return view('public.jobs.redirect', [
            'job' => $job
        ]);
    }
}
