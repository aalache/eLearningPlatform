<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\User;


class JobController extends Controller
{
    // ? Index
    public function index()
    {
        $jobs = Job::with('employer')->latest()->simplePaginate(6);
        return view('jobs.index', [
            'jobs' => $jobs
        ]);
    }

    // ?  Create
    public function create()
    {
        return view('jobs.create');
    }

    // ? Show
    public function show(Job $job)
    {
        return view("jobs.show", ['job' => $job]);
    }

    // ?  Store
    public function store()
    {
        request()->validate([
            'title' => ['required', 'min:3'],
            'salary' => ['required'],
        ]);


        Job::create([
            "title" => request('title'),
            "salary" => request('salary'),
            "employer_id" => 1,
        ]);

        return redirect('/jobs');
    }

    // ? Edit
    public function edit(Job $job)
    {

        Gate::authorize('edit-job', $job);
        return view("jobs.edit", ['job' => $job]);
    }

    // ? Update
    public function update(Job $job)
    {
        // validate "always validate never trust the user"
        // authorize
        // update
        // persist
        // redirect to job page

        //validation
        request()->validate([
            'title' => ['required', 'min:3'],
            'salary' => ['required'],
        ]);

        //updating && persisting 
        // $job = Job::findOrFail($id); //null

        $job->update([
            'title' => request('title'),
            'salary' => request('salary'),
        ]);

        //redirection to job page
        return redirect('/jobs');
    }

    // ? Destro
    public function destroy(Job $job)
    {
        // Authorize
        // Delete 
        // Redirect

        $job->delete();
        return redirect('/jobs');
    }
}
