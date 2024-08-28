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
        $inProgressCourses = Auth::user()->inProgressCourses()->take(4)->latest()->get();

        foreach ($inProgressCourses as $enrollment) {
            $enrollment->progress =  CourseController::progress($enrollment->course);
        }
        return view('dashboard', ['inProgressCourses' => $inProgressCourses]);
    }

    public function courses() {}

    public function enrollement()
    {
        $user = Auth::user();
        $enrollments = $user->enrollements()->with('course')->latest()->get();

        foreach ($enrollments as $enrollment) {
            $enrollment->progress = CourseController::progress($enrollment->course);
        }
        return view('dashboard', ['enrollments' => $enrollments]);
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
