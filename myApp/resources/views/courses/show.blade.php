 @php
     use App\Models\Course;
     use App\Models\Playlist;
     $course = Course::with('playlists')->find($course->id);
 @endphp
 <x-page-layout>
     <div class="py-12">
         <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
             <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                 {{-- header --}}
                 <div class="p-10 text-gray-900 space-y-8">

                     {{-- ? image and couse title and description section --}}
                     <div class="h-full w-full flex items-center justify-between  space-x-2">

                         <div class=" w-full  space-y-5">
                             <h2 class="course-name text-3xl  tracking-wide text-gray-800 mb-4">
                                 {{ $course->name }}
                             </h2>
                             <p class="course-description text-gray-600  leading-relaxed">
                                 {{ $course->description }}
                             </p>

                             <div class=" space-y-4">
                                 @if (Auth::user()->isEnrolledIn($course))
                                     <x-courseComponents.course-link
                                         href="{{ route('courses.watch', ['course' => $course]) }}">
                                         Go to course
                                     </x-courseComponents.course-link>
                                 @else
                                     <form action="{{ route('courses.enroll', ['course' => $course]) }}" method="POST">
                                         @csrf
                                         <x-courseComponents.course-enrollbutton
                                             type='submit'>Enroll</x-courseComponents.course-enrollbutton>
                                     </form>
                                 @endif

                             </div>
                         </div>

                         <div class="  shadow-lg w-full h-[300px] rounded-md">

                             <img src="{{ asset('upload/courses') }}/{{ $course->image }}"
                                 class="w-full h-full object-cover rounded-md" alt="">
                         </div>

                     </div>

                     {{-- ? coure detail section --}}
                     <div class="border-t-2 border-gray-400/50  w-full"></div>

                     <div class="w-full flex justify-evenly items-baseline  ">
                         <div class=" w-fit  rounded-md  flex flex-col items-center justify-center space-y-2">
                             <span class="text-lg">Category</span>
                             <span class="rounded-md w-fit p-2 text-xs text-gray-800 bg-blue-500/30">
                                 #{{ $course->category }} </span>
                         </div>

                         <div class=" w-fit  rounded-md  flex flex-col items-center justify-center space-y-2">
                             <span class="text-lg"> Purshace for</span>
                             <span class="text-gray-700 ">$ {{ $course->price }}</span>
                         </div>

                         <div class=" w-fit  rounded-md  flex flex-col items-center justify-center space-y-2">
                             <span class="text-lg">Istemeted Time </span>
                             <span class="text-gray-700 ">{{ $course->duration }} weeks</span>
                         </div>
                         <div class="w-fit  rounded-md  flex flex-col items-center justify-center space-y-2">
                             <span class="text-lg">Level</span>
                             <span class="text-gray-700 ">{{ $course->level }}</span>
                         </div>

                     </div>

                     <div class="border-t-2 border-gray-400/50  w-full"></div>

                     <div class=" space-y-8">
                         <h2 class="text-xl  text-black ">Course content</h2>
                         <div class=" w-full space-y-3">

                             @foreach ($course->playlists as $playlist)
                                 @php
                                     $playlist = Playlist::with('videos')->find($playlist->id);
                                 @endphp
                                 <div class=" space-y-3">
                                     {{-- ? Playlist section --}}
                                     <div class="col-span-2 p-4 space-y-5">
                                         <div
                                             class="playlist group w-full flex justify-between items-center bg-white rounded-md ">
                                             <h2 class="text-lg border-l-4 border-blue-600 px-2  text-gray-900">
                                                 {{ $playlist->name }}
                                             </h2>
                                             <i class="fa-solid fa-angle-right group-hover:rotate-90"></i>
                                         </div>

                                         <ul class="list-items hidden  mx-[-1px] space-y-0 ">
                                             @foreach ($playlist->videos as $video)
                                                 <x-courseComponents.playlist-item
                                                     href="{{ route('coach.viewplaylist', ['playlist' => $playlist, 'video' => $video]) }}"
                                                     :videoTitle="$video->title" :video="$video" :playlist="$playlist" />
                                             @endforeach

                                         </ul>
                                     </div>
                                     {{-- ? --}}
                                 </div>
                             @endforeach
                         </div>
                     </div>

                 </div>
             </div>
 </x-page-layout>

 <script></script>
























 {{-- @php
    use App\Models\Course;
    use App\Models\Playlist;
    $course = Course::with('playlists')->find($course->id);
@endphp
<x-page-layout>

    <div class="mx-auto  flex items-baseline p-2 space-x-3 space-y-3">
        <div class="p-3 w-[50%] rounded-md bg-[#efefef] mx-auto space-y-2 text-gray-900 overflow-hidden">
            <h1> {{ $course->name }}</h1>
            <img src="{{ asset('upload') }}/courses/{{ $course->image }}" class="w-full h-52" alt="">
            <ul>
                <li><strong>Name: </strong> {{ $course->name }}</li>
                <li><strong>Description: </strong>{{ $course->description }}</li>
                <li><strong>Level: </strong> {{ $course->level }}</li>
                <li><strong>Category: </strong> {{ $course->category }}</li>
                <li><strong>Price: </strong>${{ $course->price }}</li>
                <li><strong>Author: </strong>@ {{ $course->user->name }}</li>
            </ul>
            <div class="mt-2">
                <h2><strong>Playlists</strong></h2>

                @foreach ($course->playlists as $playlist)
                    <div class="bg-[#efefef] w-[100px] rounded-md">
                        <form
                            action="{{ route('playlists.removeFromCourse', ['course' => $course, 'playlist' => $playlist]) }}"
                            method="POST" id="delete-form">
                            @csrf
                        </form>
                        @php
                            $playlist = Playlist::with('videos')->find($playlist->id);
                        @endphp
                        <div class="space-x-3 text-sm font-medium flex justify-between items-center">
                            <a
                                href="{{ route('playlists.show', ['playlist' => $playlist]) }}"><span>#{{ $playlist->name }}</span></a>
                            <span class="text-red-600 p-1 rounded-md bg-black/20"><button
                                    form="delete-form">delete</button></span>
                        </div>
                        <ul>

                            @foreach ($playlist->videos as $video)
                                <a href="{{ route('videos.show', ['video' => $video]) }}">
                                    <li class="text-sm text-gray-500">-> {{ $video->title }}</li>
                                </a>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>
            <hr>
            <form action="{{ route('playlists.addToCourse', ['course' => $course->id]) }}" method="POST">
                @csrf
                <select name="playlist" id="playlist" class="p-2 bg-black/20 w-full rounded-md mb-2">
                    @foreach ($playlists as $playlist)
                        <option value="{{ $playlist->id }}">{{ $playlist->name }}</option>
                    @endforeach
                </select>
                <x-formComponents.form-button>add</x-formComponents.form-button>
            </form>
            <form action="/courses/{{ $course->id }}" method="POST">
                @csrf
                @method('DELETE')
                <x-formComponents.form-button>Delete</x-formComponents.form-button>
            </form>



        </div>

    </div>
</x-page-layout> --}}
