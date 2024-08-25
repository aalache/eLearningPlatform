@props(['videoTitle', 'playlist' => null, 'video', 'course' => null])
@php
    use App\Models\VideoProgress;
    $isCurrentRoute = null;
    if ($playlist) {
        $isCurrentRoute = url()->current() == route('coach.viewplaylist', ['playlist' => $playlist, 'video' => $video]);
    }
    if ($course) {
        $isCurrentRoute = url()->current() == route('courses.watch', ['course' => $course, 'video' => $video]);
    }

    $isLessonCompleted = VideoProgress::where('video_id', $video->id)
        ->where('user_id', auth()->id())
        ->exists();

    $currentRouteTextColor = $isCurrentRoute ? 'text-blue-600' : 'text-gray-600';
    $currentRouteBorderColor = $isCurrentRoute ? 'border-blue-600' : 'none';
    $currentRouteBackground = $isCurrentRoute ? 'border-blue-600' : 'bg-gray-600';

    $lessonCompletedBorderColor = $isLessonCompleted ? 'border-green-600' : 'none';
    $lessonCompletedBackground = $isLessonCompleted ? 'bg-green-600' : 'none';
@endphp
<a {{ $attributes->merge(['class' => '']) }}>
    <li
        class="group transition-all ease-in border-r-2 hover:border-blue-600 
        {{ $currentRouteBorderColor }} {{ $lessonCompletedBorderColor }}">
        <div class="flex space-x-3 w-full items-center">
            <div class="flex flex-col items-center gap-1">
                <div
                    class="w-[2px]  h-4 group-hover:bg-blue-600 transition-all ease-in {{ $currentRouteBackground }} 
                    {{ $lessonCompletedBackground }}   ">
                </div>
                <div
                    class="size-1.5 rounded-full  group-hover:bg-blue-600 transition-all ease-in {{ $currentRouteBackground }} 
                    {{ $lessonCompletedBackground }}">
                </div>
                <div
                    class="w-[2px] h-4 grow group-hover:bg-blue-600 transition-all ease-in {{ $currentRouteBackground }} 
                    {{ $lessonCompletedBackground }} ">
                </div>
            </div>
            <p class=" group-hover:text-blue-600  {{ $currentRouteTextColor }} transition-all ease-in">
                {{ $videoTitle }}</p>
        </div>
    </li>
</a>
