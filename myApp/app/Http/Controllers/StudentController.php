<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Enrollement;


class StudentController extends Controller
{

    public function index()
    {
        $activities = $this->getAtivities();
        return view('dashboard', ['msg' => 'student dashboard', 'activities' => $activities]);
    }

    public function enrollement()

    {

        $user = Auth::user();
        $enrollments = $user->enrollements()->with('course')->get();

        // if ($enrollments)

        foreach ($enrollments as $enrollment) {
            $enrollment->progress = CourseController::progress($enrollment->course);
        }

        // }
        return view('dashboard', ['enrollments' => $enrollments]);

        // return view('dashboard', ['msg' => 'student enrollement page', 'enrollments' => $enrollments]);
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


    // ? Helper functions 

    // return number of enrollement for a specific user;
    public static function enrollements(): int
    {
        return Enrollement::count();
    }

    // return number of course in progress for a specific user;
    public static function inProgress(): int
    {
        $course_inProgress = Enrollement::where(
            'user_id',
            Auth::user()->id
        )->where('status', 'in_progress')->count();
        return $course_inProgress;
    }

    // return number of completed course for a specific user;
    public static function completed(): int
    {
        $course_completed = Enrollement::where(
            'user_id',
            Auth::user()->id
        )->where('status', 'completed')->count();
        return $course_completed;
    }
}
