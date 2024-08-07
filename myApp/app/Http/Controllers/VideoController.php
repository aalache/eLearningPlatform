<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use App\Services\VideoService;

class VideoController extends Controller
{

    // protected $videoService;

    // public function __construct(VideoService $videoService)
    // {
    //     $this->videoService = $videoService;
    // }


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

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $attributes = $request->validate(
            [
                'title' => ['required', 'max:256'],
                'url' => ['required', 'url'],
                'duration' => ['required']
            ]
        );
        // create video
        $video = Video::create($attributes);

        redirect('/videos');
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
                'url' => ['required', 'url'],
                'duration' => ['required']
            ]
        );

        $video->update($attributes);

        return redirect('/videos');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Video $video)
    {
        $video->delete();
        return redirect('/videos');
    }
}
