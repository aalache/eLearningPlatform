@props(['videoTitle', 'playlist' => null, 'video', 'course' => null])
@php
    use App\Models\VideoProgress;
    use App\Models\Video;

    $videoId = request()->video;
    $videoFromRequest = Video::find($videoId);
    $isCurrentRoute = null;

    if ($playlist) {
        if ($videoFromRequest) {
            $videoFromRequest = $videoFromRequest->first();
            $isCurrentRoute =
                request()->routeIs('coach.playlists.show', ['playlist' => $playlist]) &&
                request()->video->id == $video->id;
        }
    }

    if ($course) {
        if ($videoFromRequest) {
            $videoFromRequest = $videoFromRequest->first();
            $isCurrentRoute =
                request()->routeIs('*.courses.watch', ['course' => $course]) && request()->video->id == $video->id;
        }
    }

    $isLessonCompleted = VideoProgress::where('video_id', $video->id)
        ->where('user_id', auth()->id())
        ->exists();

    $currentRouteTextColor = $isCurrentRoute ? 'text-orange-600' : 'text-gray-400';
    $currentRouteBorderColor = $isCurrentRoute ? 'border-orange-600' : 'border-gray-400';
    $currentRouteBackground = $isCurrentRoute ? 'bg-orange-600' : 'bg-gray-400';

    $lessonCompletedBorderColor = $isLessonCompleted ? 'border-green-500' : 'none';
    $lessonCompletedBackground = $isLessonCompleted ? 'bg-green-500' : 'none';
@endphp
<a {{ $attributes->merge(['class' => '']) }}>
    <li
        class="group transition-all ease-in border-r-2 hover:border-orange-600  
        {{ $currentRouteBorderColor }} {{ $lessonCompletedBorderColor }}">
        <div class="flex space-x-3 w-full items-center">
            <div class="flex flex-col items-center gap-1">
                <div
                    class="w-[2px]  h-4 group-hover:bg-orange-600 transition-all ease-in {{ $currentRouteBackground }} 
                    {{ $lessonCompletedBackground }}  ">
                </div>
                <div
                    class="size-1.5 rounded-full  group-hover:bg-orange-600 transition-all ease-in {{ $currentRouteBackground }} 
                    {{ $lessonCompletedBackground }}">
                </div>
                <div
                    class="w-[2px] h-4 grow group-hover:bg-orange-600 transition-all ease-in {{ $currentRouteBackground }} 
                    {{ $lessonCompletedBackground }} ">
                </div>
            </div>
            <p
                class=" group-hover:text-orange-600 text-sm font-semibold  {{ $currentRouteTextColor }} transition-all ease-in">
                {{ $videoTitle }}
            </p>
        </div>
    </li>
</a>
