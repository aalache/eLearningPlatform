<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $courses = Course::all();
        return view('courses.index', ['courses' => $courses]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('courses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'duration' => 'required|numeric',
            'level' => 'required',
            'category' => 'required',
            'price' => 'required|numeric',
            'image' => 'required|mimes:png,jpg',
        ]);

        $file = $request->file('image');
        $file->move('upload/courses', $file->getClientOriginalName());
        $image = $file->getClientOriginalName();

        Course::create([
            'name' => $request->name,
            'description' => $request->description,
            'duration' => $request->duration,
            'level' => $request->level,
            'category' => $request->category,
            'price' => $request->price,
            'image' => $image,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('courses.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        $auth_user_playlists = Auth::user()->playlists ?? collect();
        return view('courses.show', ['course' => $course, 'playlists' => $auth_user_playlists]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        return view('courses.edit', ['course' => $course]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'duration' => 'required|numeric',
            'level' => 'required',
            'category' => 'required',
            'price' => 'required|numeric',
            'image' => 'mimes:png,jpg',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $image = $file->getClientOriginalName();
            $file->move('upload/courses', $image);
        } else {
            $image = $course->image;
        }

        $course->update([
            'name' => $request->name,
            'description' => $request->description,
            'duration' => $request->duration,
            'level' => $request->level,
            'category' => $request->category,
            'price' => $request->price,
            'image' => $image,
        ]);

        return redirect()->route('courses.index')->with('success', 'Course updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('courses.index');
    }

    public function enroll(Course $course)
    {
        $status = '';
        if (Auth::check()) {
            $course->users_enrolled()->attach(Auth::id());
            $status = "you are successfully enrolled ";
        } else {
            $status = "you have to login to enroll ";
        }
        $auth_user_playlists = Auth::user()->playlists ?? collect();

        return view('courses.show', ['course' => $course, 'playlists' => $auth_user_playlists, 'status' => $status]);
    }
}
