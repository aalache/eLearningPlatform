<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Playlist;
use App\Models\Course;
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

        Playlist::create([
            'name' => request()->name,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('coach.myplaylists')->with('success', 'Playlist created successfuly');
    }

    /**
     * Display the specified resource.
     */
    public function show(Playlist $playlist)
    {
        return view('playlists.show', ['playlist' => $playlist]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Playlist $playlist)
    {
        return view('playlists.edit', ['playlist' => $playlist]);
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

        return redirect()
            ->route('coach.viewplaylist', ['playlist' => $playlist])
            ->with('success', 'Playlist Name changed successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Playlist $playlist)
    {
        $validator = $request->validate([
            'confirm-delete' => ['required', 'string', 'max:60']
        ]);

        // if ($validator->fails()) {
        //     return redirect()
        //         ->route('coach.viewplaylist', ['playlist' => $playlist])
        //         ->withErrors('error');
        // }

        $deleteConfirmationInput = $request->input('confirm-delete');

        if ($deleteConfirmationInput == $playlist->name) {
            $playlist->delete();
            return redirect()
                ->route('coach.myplaylists')
                ->with('success', 'Playlist deleted successfully');
        }

        return redirect()
            ->route('coach.viewplaylist', ['playlist' => $playlist])
            ->with('error', 'Playlist Name does not match');
    }


    /**
     * add a playlist to specified course
     * @param $course  specified course where the action will take place
     */
    public function addToCourse(Request $request, Course $course)
    {
        $playlist_id = $request->input('playlist');
        if (!$course->playlists->find($playlist_id)) {
            $course->playlists()->attach($playlist_id);
        }
        return redirect()->route('courses.show', $course->id);
    }


    /**
     * remove a playlist from  a specified course
     * @param $course  specified course where the action will take place
     * @param $playlist    the playlist that will be removed from the specified course
     */
    public function removeFromCourse(Course $course, Playlist $playlist)
    {
        $course->playlists()->detach($playlist->id);
        return redirect()->route('courses.show', $course->id);
    }
}
