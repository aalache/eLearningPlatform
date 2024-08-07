<x-page-layout>
    <h1>Video Gallery</h1>

    <div class="w-full h-full flex items-baseline p-2 space-x-3 space-y-3">
        @foreach ($videos as $video)
            <a href="/videos/{{ $video->id }}">
                <div class="h-[300px] w-[300px] rounded-md bg-[#efefef] space-y-2 text-gray-900">
                    <video width="320" height="240" controls>
                        <source src="{{ $video->url }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                    <h1>Video {{ $video->id }}</h1>

                    <div class="w-full h-full flex items-baseline p-2 space-x-3 space-y-3">
                        <div class="px-2">
                            <p>Title: {{ $video->title }}</p>
                            <p>Duration: {{ $video->duration }} minutes</p>
                        </div>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
</x-page-layout>
