@props(['playlist'])



<a href="{{ route('coach.viewplaylist', ['playlist' => $playlist->id]) }}">
    <div
        class=" group flex relative justify-between items-center space-x-4 w-full h- hover:border-x-4 border-blue-600 rounded-md  transition-all ease-in">

        <div class="relative w-[150px] h-auto p-3 rounded-lg  bg-[#efefef]  ">
            <img src="{{ asset('images/playlistimage.jpeg') }}" alt=""
                class="w-full  sticky top-0 left-0  shadow-lg group-hover:shadow-xl transition-all ease-in rounded-md group-hover:translate-y-[-10px] ">

        </div>

        <div class="flex justify-between items-center w-full">
            <div>
                <h3 class=" text-black">{{ $playlist->name }}</h3>
                <p class="text-sm text-blue-600">
                    Created on {{ $playlist->updated_at->format('M d,Y | h:m a') }}
                </p>
                <p class="text-sm text-gray-600">{{ $playlist->videos->count() }} items</p>
            </div>
            {{-- <button title="view menu" class="playlist-menu-btn px-3">
            <i class="fa-solid fa-ellipsis"></i>
        </button> --}}

        </div>

    </div>
</a>
