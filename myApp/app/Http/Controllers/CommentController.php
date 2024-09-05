<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;
use App\Models\Course;
use App\Models\Video;

class CommentController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Course $course, Video $video)
    {
        $validator = $request->validate([
            'comment' => 'required|string|max:255',
        ]);

        Comment::create([
            'user_id' => Auth::id(),
            'course_id' => $course->id,
            'video_id' => $video->id,
            'content' => $request->comment,
        ]);
        return redirect()->back()->with('success', 'Comment added successfuly!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
