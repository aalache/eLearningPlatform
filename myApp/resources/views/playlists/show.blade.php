<x-page-layout>
    <h1>{{ $playlist->name }} / {{ $playlist->id }}</h1>


    @foreach ($playlist->videos as $video)
        <div class="w-full h-full flex p-2 space-x-3 space-y-3">
            <video height="500px" width="600px" controls autoplay loop>
                <source src="{{ asset('upload') }}/{{ $video->video }}" type="video/mp4" />
            </video>
        </div>
    @endforeach
</x-page-layout>
