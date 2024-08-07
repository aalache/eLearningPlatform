<x-page-layout>
    <h1>Video {{ $video->id }}</h1>

    <div class="w-full h-full flex items-baseline p-2 space-x-3 space-y-3">
        <div class="px-2">
            <p>Url: {{ $video->url }}</p>
            <p>Title: {{ $video->title }}</p>
            <p>Duration: {{ $video->duration }} minutes</p>
        </div>
    </div>
</x-page-layout>
