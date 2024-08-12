<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;

class StudentController extends Controller
{
    public function index()
    {
        return view('dashboard', ['msg' => 'student dashboard']);
    }

    public function enrollement()
    {
        return view('dashboard', ['msg' => 'student enrollement page']);
    }

    public function courses(Request $request)
    {

        if ($request->session()->get('courses')) {
            $courses = $request->session()->get('courses');
        } else {
            $courses = Course::with('user')->get() ?? collect();
        }
        return view('dashboard', ['courses' => $courses]);
    }

    // search feature allow users to search courses by name, category, author, level,
    public function search(Request $request)
    {

        $query = $request->input('query');
        $courses = Course::where('name', 'like', '%' . $query . '%')
            ->orWhere('description', 'like', '%' . $query . '%')
            ->orWhere('level', 'like', '%' . $query . '%')
            ->orwhereHas('user', function ($q) use ($query) {
                $q->where('name', 'like', '%' . $query . '%');
            })
            ->with('user')
            ->get();

        // dd($courses);

        return redirect()->route('user.courses')->with('courses', $courses);
    }
}
