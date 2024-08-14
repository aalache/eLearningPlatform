<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class StudentController extends Controller
{

    public function index()
    {
        $activities = $this->getAtivities();
        return view('dashboard', ['msg' => 'student dashboard', 'activities' => $activities]);
    }

    public function enrollement()
    {
        return view('dashboard', ['msg' => 'student enrollement page']);
    }


    public function getAtivities()
    {

        $user = User::find(Auth::id());
        if (Auth::check()) {
            $reccentEnrollements = $user->enrollements()->with('course')->take(5)->latest()->get();

            return $reccentEnrollements;
        }
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
            ->latest()
            ->get();

        // dd($courses);

        return redirect()->route('user.courses')->with('courses', $courses);
    }
}
