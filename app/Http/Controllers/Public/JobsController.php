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

        return view('public.jobs.show', [
            'job' => $job
        ]);
    }

    public function redirect(){
        $job = Job::find($id);

        return view('public.jobs.redirect', [
            'job' => $job
        ]);
    }
}
