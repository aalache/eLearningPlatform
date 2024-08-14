@php
    use App\Models\Course;
    use App\Models\Playlist;
    // $course = Course::with('playlists')->find($course->id);
@endphp
<x-page-layout>
    <div class="p-6 bg-whiter">
        <div class=" max-w-8xl mx-auto ">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                {{-- header --}}
                <div class="p-4 text-gray-900 space-y-6">

                    <div class="py-2">
                        <h1 class="text-2xl ">
                            {{ $course->name }}
                        </h1>
                    </div>

                    <div class="h-full w-full grid gap-3  sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4  xl:grid-cols-5 ">

                        {{-- video section --}}
                        <div class="col-span-4 space-y-3 ">
                            <video class="rounded-md w-full bg-gray-600 shadow-lg border-2 " controls autoplay loop
                                muted>
                                <source src="{{ asset('upload') }}/videos/{{ $item->video }}" type="video/mp4" />

                            </video>
                            <h4 class="text-xl text-black px-2">{{ $item->title }}</h4>
                        </div>
                        {{--  --}}


                        {{-- playlists section --}}
                        <div class="col-span-1 space-y-3  px-4   ">
                            <h3 class="text-black text-xl pb-2">Playlists</h3>
                            @foreach ($course->playlists as $playlist)
                                @php
                                    $playlist = Playlist::with('videos')->find($playlist->id);
                                @endphp
                                <div class=" space-y-1">
                                    <div
                                        class="playlist group w-full flex justify-between items-center rounded-md px-3 py-2 border-2   text-gray-800 hover:text-black  ">
                                        <h3>{{ $playlist->name }}</h3>
                                        <i class="fa-solid fa-angle-right group-hover:rotate-90"></i>
                                    </div>
                                    <ul
                                        class="list-items px-2  space-y-1  hidden flex-col  justify-center items-center ">
                                        @foreach ($playlist->videos as $video)
                                            <a href="{{ route('courses.watch', ['course' => $course, 'video' => $video]) }}"
                                                class="w-full">
                                                <li
                                                    class="w-full rounded-md px-3 py-2 text-gray-700  hover:text-black bg-[#efefef] overflow-hidden text-sm ">
                                                    {{ $video->title }}
                                                </li>
                                            </a>
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
