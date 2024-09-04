<?php

namespace App\Http\Middleware;

use App\Models\Course;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckCoursePaymentMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $course_id = $request->route('course');
        $course = Course::find($course_id)->first();
        if (!$course) {
            abort(404, 'Course Not Found!');
        }

        $user = Auth::user();
        if (!$user->hasPaidCourse($course)) {
            return redirect()->route('user.courses.show', $course)->with('error', 'Please complete your payment to access this course.');
        }
        return $next($request);
    }
}
