<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use App\Models\Video;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;

class CoachController extends Controller
{
    /**
     * Instructor dashboard page witch show all the metrics of the current instructor
     */
    public function index()
    {
        return view('dashboard', ['msg' => 'instructor dashboard']);
    }



    /**
     * Instructor created courses
     */
    public  function mycourses()
    {
        $user_id = Auth::user()->id;
        $mycourses = Course::with('user')->where('user_id', $user_id)->latest()->get();
        return view('dashboard', ['mycourses' => $mycourses]);
    }

    /**
     * render all  playlists of the current instructor
     */
    public function myplaylists()
    {
        $user_id = Auth::user()->id;
        $myplaylists = Playlist::with('videos')->where('user_id', $user_id)->get();
        return view('dashboard', ['msg' => 'instructor playlists page', 'myplaylists' => $myplaylists]);
    }

    /**
     * render all videos of the current instructor
     */
    public function myvideos()
    {
        $myVideos = Video::where('user_id', Auth::id())->latest()->simplepaginate(8);
        $playlists = Playlist::where('user_id', Auth::id())->latest()->get();
        return view('dashboard', ['myVideos' => $myVideos, 'playlists' => $playlists]);
    }
}
