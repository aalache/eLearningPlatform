@php
    use App\Models\Course;
    use App\Models\Playlist;
    $course = Course::with('playlists')->find($course->id);
@endphp
<x-page-layout>

    <div class="mx-auto  flex items-baseline p-2 space-x-3 space-y-3">
        <div class="p-3 w-[50%] rounded-md bg-[#efefef] mx-auto space-y-2 text-gray-900 overflow-hidden">
            {{-- <div class="bg-black/20 p-2 rounded-md text-gray-500">{{ $status }}</div> --}}
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
</x-page-layout>
