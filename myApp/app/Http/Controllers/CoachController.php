<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use App\Models\Video;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use App\Models\Enrollement;
use App\Models\User;

class CoachController extends Controller
{
    /**
     * Instructor dashboard page witch show all the metrics of the current instructor
     */
    public function index()
    {
        $activities = $this->getAtivities();
        return view('dashboard', ['activities' => $activities]);
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


    /**
     * render the playlist with videos in it and display the video selected
     */
    public function viewplaylist(Playlist $playlist, Video $video)
    {
        $videoToDisplay = $playlist->videos()->first();

        if ($video) {

            $playlist = Playlist::with('videos')->find($playlist->id);
            if ($playlist->videos->contains($video)) {
                $videoToDisplay = $video;
            }
        }
        return view('playlists.show', ['playlist' => $playlist])->with('videoToDisplay', $videoToDisplay);
    }

    /**
     * User activities
     */
    public function getAtivities()
    {
        $user = User::find(Auth::id());
        if ($user->hasRole('coach')) {
            $activities = Activity::where('coach_id', $user->id)->latest()->get();
        }
        if (Auth::check()) {
            $reccentEnrollements = $user->enrollements()->with('course')->take(5)->latest()->get();

            return $reccentEnrollements;
        }
    }

    /**
     * Metric functions
     */
    public static function metrics(String $metric)
    {
        $user_id = Auth::user()->id;
        $metrics = [
            'total_users' => User::students()->count(),
            'total_courses' => Course::where('user_id', $user_id)->count(),
            'total_enrollements' => Enrollement::count(),
            'total_videos' => Video::where('user_id', $user_id)->count(),
            'total_playlists' => Playlist::where('user_id', $user_id)->count(),
        ];
        return $metrics[$metric];
    }
}
