@php
    use App\Models\Video;
    use App\Http\Controllers\VideoController;
    $video = Video::find(6);
@endphp

<x-page-layout>

    <div class=" text-black">
        <h1>Video Gallery </h1>
    </div>
    <div class="w-full h-full flex  space-x-3 space-y-3 flex-wrap">
        {{-- @foreach ($videos as $video) --}}
        <a href="/videos/{{ $video->id }}">
            <div class="h-[400px] w-[300px] rounded-md bg-[#efefef] space-y-2 text-gray-900 overflow-hidden">
                <video width="320" height="240" controls>
                    <source src="{{ asset('upload') }}/{{ $video->video }} " type="video/mp4">
                    Your browser does not support the video tag.
                </video>
                <h1>Video {{ $video->id }}</h1>

                <div class="w-full h-full flex items-baseline p-2 space-x-3 space-y-3">
                    <div class="px-2">
                        <p>id : {{ $video->id }}</p>
                        <p>Name: {{ $video->video }}</p>
                        <p>Title: {{ $video->title }}</p>
                        <p>Duration: {{ $video->duration }} minutes</p>
                        <p>// {{ VideoController::isMarkedAsCompleted($video) }}</p>

                    </div>
                </div>
            </div>
        </a>
        {{-- @endforeach --}}
    </div>
</x-page-layout>
