<x-page-layout>
    <h1>{{ $playlist->name }} / {{ $playlist->id }}</h1>


    @foreach ($playlist->videos as $video)
        <div class="w-full h-full flex p-2 space-x-3 space-y-3">
            <video height="500px" width="600px" controls autoplay loop>
                <source src="{{ asset('upload') }}/{{ $video->video }}" type="video/mp4" />
            </video>
            <form action="{{ route('videos.removeFromPlaylist', ['playlist' => $playlist->id, 'video' => $video->id]) }}"
                method="POST">
                @csrf
                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white">remove</button>
            </form>
        </div>
    @endforeach
</x-page-layout>
