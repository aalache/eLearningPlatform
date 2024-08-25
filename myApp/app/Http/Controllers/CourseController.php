<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Enrollement;
use App\Models\Playlist;
use App\Models\Video;
use App\Services\ActivityLogger;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{


    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->session()->get('courses')) {
            $courses = $request->session()->get('courses');
        } else {
            $courses = Course::with('user')->latest()->get() ?? collect();
        }


        if ($request->routeIs('user.courses')) {
            return view('dashboard', ['courses' => $courses]);
        }

        if ($request->routeIs('coach.courses')) {
            return view('dashboard', ['courses' => $courses]);
        }
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:60',
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

        $course = Course::create([
            'name' => $request->name,
            'description' => $request->description,
            'duration' => $request->duration,
            'level' => $request->level,
            'category' => $request->category,
            'price' => $request->price,
            'image' => $image,
            'user_id' => Auth::id(),
        ]);
        ActivityLogger::log('Course Added', 'you added ' . $course->name . ' course to your workspace');
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
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        $request->validate([
            'name' => 'required|max:60',
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
        ActivityLogger::log('Course Updated', 'you have updated ' . $course->name . ' course ');

        return redirect()->route('courses.index')->with('success', 'Course updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        $course->delete();
        ActivityLogger::log('Course Deleted', 'you have deleted ' . $course->name . ' course ');
        return redirect()->route('courses.index');
    }

    /**
     * search feature allow users to search courses by name, category, author, level,
     */
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

        if ($request->routeIs('user.courses.search')) {
            // dd($courses);
            return redirect()->route('user.courses')->with('courses', $courses);
        }

        if ($request->routeIs('coach.courses.search')) {
            // dd($courses);
            return redirect()->route('coach.courses')->with('courses', $courses);
        }
    }


    // return the course view wich render all the course data ( palaylists & videos)
    public function watch(Course $course, Video $video)
    {
        $course = Course::with('playlists.videos')->findOrFail($course->id);

        $item = null;

        // Check if the course has any playlists and videos
        if ($course->playlists->isNotEmpty()) {
            $item = $course->playlists->first()->videos->first();
        }


        // If a specific video is provided, find and set it
        if ($video) {
            foreach ($course->playlists as $playlist) {
                if ($playlist->videos->contains($video)) {
                    $item = $video;
                    break;
                }
            }
        }

        // return view('courses.course', [
        //     'course' => $course,
        //     'item' => $item,
        // ]);

        return view('courses.watch', ['course' => $course])->with('item', $item);
    }

    // enroll feature allow users to enroll a specific course
    public function enroll(Course $course)
    {
        $status = '';
        if (Auth::check()) {
            $enrollement = new Enrollement();
            $enrollement->user_id = Auth::user()->id;
            $enrollement->course_id = $course->id;
            $enrollement->save();
            ActivityLogger::log('Enrolled', 'you enrolled to ' . $course->name . ' course');
            $status = "you are successfully enrolled ";
        } else {
            $status = "you have to login to enroll ";
        }
        $auth_user_playlists = Auth::user()->playlists ?? collect();

        return view('courses.show', ['course' => $course, 'playlists' => $auth_user_playlists, 'status' => $status]);
    }

    // course progress
    public static function progress(Course $course)
    {
        // Get the authenticated user
        $user = Auth::user();

        // Get the enrollment of the user in the specific course
        $enrollment = $user->enrollements()->with('course')->where('course_id', $course->id)->first();

        // Initialization
        $total_course_videos = 0;
        $completed_videos = 0;

        if ($enrollment) {
            // Get the course playlists with videos
            $playlists = $enrollment->course->playlists()->with('videos')->get();

            // Iterate over each playlist and sum up the total videos and completed videos
            foreach ($playlists as $playlist) {
                $total_course_videos += $playlist->videos->count();

                // For each video, check if it's completed by the user
                foreach ($playlist->videos as $video) {
                    if ($user->completedLessons()->where('video_id', $video->id)->where('completed', true)->exists()) {
                        $completed_videos++;
                    }
                }
            }
        }

        // Calculate the progress percentage
        $progress = $total_course_videos > 0 ? ($completed_videos / $total_course_videos) * 100 : 0;

        if ($progress == 100 && $enrollment->status != 'completed') {
            $enrollment->status = 'completed';
            $enrollment->save();
        }

        return round($progress, 2); // Return the progress as a percentage rounded to 2 decimal places
    }
}
