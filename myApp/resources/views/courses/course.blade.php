@php
    use App\Models\Course;
    use App\Models\Playlist;
    use App\Models\VideoProgress;
    use App\Http\Controllers\CourseController;
    // $course = Course::with('playlists')->find($course->id);
@endphp
<x-page-layout>
    <div class="p-6 bg-white bg-whiter">
        <div class=" max-w-8xl mx-auto ">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                {{-- header --}}
                <div class="p-4 text-gray-900 space-y-6">

                    <div class="flex min-w-72 flex-col space-y-1">
                        <p class="text-[#0d151c] tracking-light text-[32px]  leading-tight">{{ $course->name }}
                        </p>
                        <p>{{ CourseController::progress($course) }}</p>
                        <p class="text-[#49779c] text-sm font-normal leading-normal">By: {{ $course->user->name }}</p>
                    </div>

                    <div class="h-full w-full grid gap-3  sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4  xl:grid-cols-6 ">

                        {{-- Video Section --}}
                        <div class="col-span-4 space-y-3">
                            <video id="video-{{ $item->id }}" data-user-id="{{ auth()->user()->id }}"
                                data-video-id="{{ $item->id }}"
                                class="lesson rounded-md w-full bg-gray-600 shadow-lg" controls muted>
                                <source src="{{ asset('upload/videos/' . $item->video) }}" type="video/mp4" />
                            </video>
                            <h4 class="text-xl text-black px-2">{{ $item->title }}</h4>
                        </div>

                        {{-- Playlists Section --}}
                        <div class="col-span-2 space-y-3 px-4">
                            @foreach ($course->playlists as $playlist)
                                @php
                                    $playlist = Playlist::with('videos')->find($playlist->id);
                                @endphp
                                <div class="space-y-1">
                                    <div
                                        class="playlist group w-full flex justify-between cursor-pointer items-center rounded-md px-3 py-2 text-gray-800 hover:text-black">
                                        <h3 class="">{{ $playlist->name }}</h3>
                                        <i class="fa-solid fa-angle-right group-hover:rotate-90"></i>
                                    </div>
                                    <ul class="list-items px-2 space-y-1 hidden flex-col justify-center items-center">
                                        @foreach ($playlist->videos as $video)
                                            <div class="flex px-2 w-full items-center">
                                                <div class="flex flex-col items-center gap-1">
                                                    <div class="w-[1.5px] bg-[#cedde8] h-4"></div>
                                                    <div class="size-2 rounded-full bg-[#0d151c]"></div>
                                                    <div class="w-[1.5px] bg-[#cedde8] h-4 grow"></div>
                                                </div>
                                                <a id="link-{{ $video->id }}"
                                                    href="{{ route('courses.watch', ['course' => $course, 'video' => $video]) }}"
                                                    class="video-item w-full">
                                                    <li
                                                        class="{{ url()->current() == route('courses.watch', ['course' => $course, 'video' => $video]) ? 'text-[#49779c]' : 'text-gray-700' }} w-full px-3 py-2 hover:text-black overflow-hidden text-sm
                                                        {{ VideoProgress::where('video_id', $video->id)->where('user_id', auth()->id())->exists()? 'border-r-4 border-green-600': 'border-none' }}">
                                                        {{ $video->title }}
                                                    </li>
                                                </a>
                                            </div>
                                        @endforeach
                                    </ul>
                                </div>
                            @endforeach
                        </div>
                        {{--  --}}



                    </div>

                </div>
            </div>
        </div>
    </div>
</x-page-layout>
