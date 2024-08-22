<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\VideoProgress;


class VideoController extends Controller
{

    //


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $videos = Video::all();
        return view('videos.index', ['videos' => $videos]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('videos.create');
    }


    public static function upload(Request $request)
    {

        $request->validate(
            [
                'title' => ['required', 'max:256'],
                'duration' => 'required|numeric',
                'video' => ['required', 'mimes:mp4,ogx,oga,ogv,ogg,webm'],
            ]
        );

        $file = $request->file('video');

        $file->move('upload/videos', $file->getClientOriginalName());

        $file_name = $file->getClientOriginalName();

        $video = Video::create([
            'title' => $request->title,
            'duration' => $request->duration,
            'video' => $file_name,
            'user_id' => Auth::id(),
        ]);

        return $video;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Playlist $playlist)
    {
        $video = $this->upload($request);

        return redirect()->route('coach.myvideos')->with('success', 'Video uploded successfuly');
    }

    /**
     * Display the specified resource.
     */
    public function show(Video $video)
    {
        return view('videos.show', ['video' => $video]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Video $video)
    {
        return view('videos.edit', ['video' => $video]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Video $video)
    {
        $attributes = $request->validate(
            [
                'title' => ['required', 'max:256'],
                'duration' => ['required']
            ]
        );

        $video->update($attributes);

        return redirect()->route('coach.myvideos')->with('success', 'Video updated successfuly');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Video $video)
    {
        $video->delete();
        return redirect()->route('coach.myvideos')->with('success', 'Video deleted successfuly');
    }


    /**
     * add & upload video to specified playlist
     * @param $playlist  specified playlist where the video will be added
     */

    public function addToPlaylist(Request $request, Playlist $playlist)
    {
        $video = $this->upload($request);

        $playlist->videos()->attach($video);

        return redirect()->route('playlists.show', $playlist->id);
    }

    /**
     * remove a video from  a specified playlist
     * @param $playlist  specified playlist where the action will take place
     * @param $video    the video that will be removed from specified playlist
     */
    public function removeFromPlaylist(Playlist $playlist, Video $video)
    {
        $video = Video::findorfail($video->id);
        $playlist->videos()->detach($video->id);

        return redirect()->route('playlists.show', $playlist->id);
    }




    public function markAsCompleted(Request $request)
    {
        $videoId = $request->input('video_id');
        $userId = $request->input('user_id');


        // Update or create a record in the database
        $progress = VideoProgress::Create(
            [
                'video_id' => $videoId,
                'user_id' => $userId,
                'completed' => true,
            ],
        );

        return response()->json(['success' => true]);
    }

    public function test(Request $request)
    {
        $data = $request->all();

        // Return a JSON response with a success message and the data received
        return response()->json([
            'success' => true,
            'message' => 'POST request was successful!',
            'data' => $data,
        ]);
    }

    public static function isMarkedAsCompleted(Video $video): bool
    {
        $user = Auth::user();

        $completed = $user->completedLessons()->where('video_id', $video->id)
            ->where('completed', true)  // Check for 'completed' status in the pivot table
            ->exists();
        return $completed;
    }
}
