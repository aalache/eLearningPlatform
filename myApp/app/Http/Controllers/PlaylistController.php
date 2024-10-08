<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Playlist;
use App\Models\Course;
use App\Services\ActivityLogger;
use Illuminate\Support\Facades\Auth;

class PlaylistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $playlists = Playlist::all();
        return view('playlists.index', ['playlists' => $playlists]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('playlists.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:60'],
        ]);

        $playlist = Playlist::create([
            'name' => request()->name,
            'user_id' => Auth::id(),
        ]);

        ActivityLogger::log('New Playlist Added', 'you added ' . $playlist->name . ' playlist to your workspace');

        return redirect()->route('coach.playlists.index')->with('success', 'Playlist created successfuly');
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Playlist $playlist)
    {
        $attributes = $request->validate([
            'name' => ['required', 'string', 'max:60'],

        ]);

        $playlist->update($attributes);
        ActivityLogger::log('Playlist Updated', 'you updated ' . $playlist->name . ' playlist in your workspace');

        return redirect()
            ->route('coach.playlists.show', ['playlist' => $playlist])
            ->with('success', 'Playlist Name changed successfully');
    }

    /**
     * Delete the specified playlist from storage.
     */
    public function destroy(Request $request, Playlist $playlist)
    {
        $validator = $request->validate([
            'confirm-delete' => ['required', 'string', 'max:60']
        ]);

        if ($validator['confirm-delete'] == $playlist->name) {
            $playlist->delete();
            ActivityLogger::log('Playlist Deleted', 'you deleted ' . $playlist->name . ' playlist from your workspace');
            return redirect()
                ->route('coach.playlists.index', ['playlist' => $playlist])
                ->with('success', 'Playlist deleted successfully');
        }

        return redirect()
            ->route('coach.playlists.show', ['playlist' => $playlist])
            ->with('error', 'Playlist Name does not match');
    }


    /**
     * add a playlist to specified course
     * 
     */
    public function addToCourse(Request $request, Playlist $playlist)
    {
        $course_id = $request->input('course_id');
        $course = Course::find($course_id);

        if (Auth::user()->playlists->find($playlist->id) && !$course->playlists->contains($playlist)) {

            $course->playlists()->attach($playlist);

            ActivityLogger::log('Playlist Added to Course', 'you added ' . $playlist->name
                . ' playlist to ' . $course->name . ' course');

            return redirect()
                ->route('coach.playlists.show', ['playlist' => $playlist->id])
                ->with('success', 'Playlist added to course successfully');
        } else {
            return redirect()
                ->route('coach.playlists.show', ['playlist' => $playlist->id])
                ->with('error', 'Playlist allready added !!!');
        }

        return redirect()
            ->route('coach.playlists.show', ['playlist' => $playlist->id])
            ->with('error', 'Something went wrong !!!');
    }


    /**
     * remove a playlist from  a specified course
     * 
     * @param $playlist    the playlist that will be removed from the specified course
     */
    public function removeFromCourse(Request $request, Playlist $playlist)
    {
        $course_id = $request->input('course_id');

        if (Auth::user()->playlists->find($playlist->id)) {

            $course = Course::find($course_id);
            $course->playlists()->detach($playlist);

            ActivityLogger::log('Playlist Removed from Course', 'you removed ' . $playlist->name
                . ' playlist from ' . $course->name . ' course');

            return redirect()
                ->route('coach.playlists.show', ['playlist' => $playlist->id])
                ->with('success', 'Playlist removed from course successfully');
        }

        return redirect()
            ->route('coach.playlist.show', ['playlist' => $playlist->id])
            ->with('error', 'Something went wrong !!!');
    }
}
