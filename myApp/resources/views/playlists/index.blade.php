<x-page-layout>

    <div>
        <h1>Playlists</h1>
    </div>
    <div class="w-full h-full flex  p-4 space-x-2 flex-wrap">
        @foreach ($playlists as $playlist)
            <a href="/playlists/{{ $playlist->id }}">
                <div class="h-auto w-[200px] p-4 rounded-md bg-[#efefef] space-y-2 text-gray-900 overflow-hidden">
                    {{ $playlist->name }}
                </div>
            </a>
        @endforeach
    </div>
</x-page-layout>
