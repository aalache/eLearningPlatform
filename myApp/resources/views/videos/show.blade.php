<x-page-layout>
    <h1>Video {{ $video->id }}</h1>

    <div class="w-full h-full flex items-baseline p-2 space-x-3 space-y-3">
        {{-- <video height="500px" width="600px" controls autoplay loop>
            <source src="{{ asset('upload') }}/videos/{{ $video->video }}" type="video/mp4" />
        </video> --}}
        <iframe height="500px" width="600px" class="rounded-l-md w-80 h-32 shadow-md"
            src="{{ str_replace('watch?v=', 'embed/', $video->youtube_url) }}" frameborder="0" allowfullscreen></iframe>
    </div>
</x-page-layout>
