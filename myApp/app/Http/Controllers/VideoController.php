<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\VideoProgress;
use App\Services\ActivityLogger;

class VideoController extends Controller
{

    //


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $myVideos = Video::where('user_id', Auth::id())->latest()->simplepaginate(8);
        $playlists = Playlist::where('user_id', Auth::id())->latest()->get();
        return view('dashboard', ['myVideos' => $myVideos, 'playlists' => $playlists]);
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

        ActivityLogger::log('Video Uploaded', 'you uploaded ' . $video->title . ' to your workspace');

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
        dd('hello');
        $attributes = $request->validate(
            [
                'title' => ['required', 'max:256'],
                'duration' => ['required']
            ]
        );

        $video->update($attributes);

        ActivityLogger::log('Video Updated ', 'you have updated ' . $video->title);

        return redirect()->route('coach.myvideos')->with('success', 'Video updated successfuly');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Video $video)
    {

        $video->delete();
        ActivityLogger::log('Video Deleted ', 'you have deleted ' . $video->title . ' from your workspace');
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

        ActivityLogger::log('Video Added To Playlist ', 'you have added ' . $video->title . ' to ' . $playlist->name . ' playlist');

        return redirect()->route('playlists.show', $playlist->id);
    }

    /**
     * remove a video from  a specified playlist
     * @param $playlist  specified playlist where the action will take place
     * @param $video    the video that will be removed from specified playlist
     */
    public function removeFromPlaylist(Request $request, Playlist $playlist, Video $video)
    {
        $validator = $request->validate([
            'confirm-remove' => ['required', 'string']
        ]);

        $removeConfirmationInput = $request->input('confirm-remove');

        if ($removeConfirmationInput == $video->title) {
            $video = Video::findorfail($video->id);
            $playlist->videos()->detach($video->id);
            ActivityLogger::log('Video Removed From Playlist ', 'you have removed ' . $video->title . ' from ' . $playlist->name . ' playlist');
            return redirect()
                ->route('coach.viewplaylist', $playlist->id)
                ->with('success', 'Video removed from playlist successfuly');
        }

        return redirect()
            ->route('coach.viewplaylist', $playlist->id)
            ->with('error', 'Video Name does not match');
    }




    public function markAsCompleted(Request $request)
    {
        $videoId = $request->input('video_id');
        $userId = $request->input('user_id');

        $video = Video::find($videoId);

        // Update or create a record in the database
        $progress = VideoProgress::Create(
            [
                'video_id' => $videoId,
                'user_id' => $userId,
                'completed' => true,
            ],
        );

        ActivityLogger::log('Lesson Completed', 'you successfuly completed ' . $video->title . 'lesson');
        return response()->json(['success' => true]);
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
