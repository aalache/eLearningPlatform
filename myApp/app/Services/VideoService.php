<?php

namespace App\Services;


use FFMpeg\FFMpeg;
use Illuminate\Http\UploadedFile;
use Illuminate\Http\Request;
use App\Models\Video;

class VideoService
{
    public function upload(UploadedFile $video)
    {
        $path = $video->store('videos', 'public');

        $duration = $this->getVideoDuration(storage_path('app/public/' . $path));

        return ['path' => $path, 'duration' => $duration];
    }

    private function getVideoDuration($filePath)
    {
        $ffmpeg = FFMpeg::create();
        $video = $ffmpeg->open($filePath);
        $ffprobe = \FFMpeg\FFProbe::create();
        $durationInSeconds = $ffprobe->format($filePath)->get('duration');
        $durationInMinutes = ceil($durationInSeconds / 60);

        return $durationInMinutes;
    }
    public function uploadVideo(Request $request)
    {
        $request->validate([
            'video' => 'required|mimes:mp4,mov,ogg,qt|max:20000',
        ]);

        if ($request->hasFile('video')) {
            $uploadResult = $this->upload($request->file('video'));

            $videoModel = new Video();
            $videoModel->path = $uploadResult['path'];
            $videoModel->duration = $uploadResult['duration'];
            $videoModel->save();

            return back()->with('success', 'Video uploaded successfully.');
        }

        return back()->with('error', 'Please choose a video to upload.');
    }
}
