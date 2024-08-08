<x-page-layout>
    <h1>Video {{ $video->id }}</h1>

    <div class="w-full h-full flex items-baseline p-2 space-x-3 space-y-3">
        <video height="500px" width="600px" controls autoplay loop>
            <source src="{{ asset('upload') }}/{{ $video->video }}" type="video/mp4" />
        </video>
    </div>
</x-page-layout>
