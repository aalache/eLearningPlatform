<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CoachController extends Controller
{
    public function index()
    {
        return view('dashboard', ['msg' => 'instructor dashboard']);
    }

    public function courses()
    {
        $myVideos = Video::where('user_id', Auth::id())->latest()->simplepaginate(8);
        $playlists = Playlist::where('user_id', Auth::id())->latest()->get();
        return view('dashboard', ['myVideos' => $myVideos, 'playlists' => $playlists]);
    }
}
