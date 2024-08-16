<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Enrollement;
use App\Models\Playlist;
use App\Models\Video;
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
        return view('dashboard', ['courses' => $courses]);
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



    // return the course view wich render all the course data ( palaylists & videos)
    public function watch(Course $course, Video $video)
    {
        $course = Course::with('playlists')->find($course->id);
        $item = $course->playlists->first()->videos()->firstOr();



        if ($video) {
            foreach ($course->playlists as $playlist) {
                // dd($playlist);
                $playlist = Playlist::with('videos')->find($playlist->id);
                if ($playlist->videos->contains($video)) {
                    $item = $video;
                }
            }
        }

        return view('courses.course', ['course' => $course])->with('item', $item);
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

    public function courseCompleted() {}
}
