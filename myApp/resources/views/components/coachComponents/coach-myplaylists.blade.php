@props(['myplaylists'])

<div class="py-4  max-w-7xl mx-auto sm:px-6 lg:px-8">

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900 space-y-12">

        <div class="space-y-5 ">
            <h1 class="text-black text-3xl ">My Playlists</h1>

            <div class=" rounded-md py-4 grid grid-cols-4 gap-4">
                @foreach ($myplaylists as $playlist)
                    <x-coachComponents.coach-playlist-item :name="$playlist->name" />
                @endforeach
            </div>
        </div>
    </div>
</div>
