@props(['playlist'])



<a href="{{ route('coach.playlists.show', ['playlist' => $playlist->id]) }}">
    <div
        class=" group flex relative justify-between items-center  bg-white/10 space-x-4 w-full  hover:border-r-4 border-orange-600 rounded-md  transition-all ease-in h-auto max-h-[80px] md:h-[100px] overflow-hidden">

        <div class="relative w-[30%]  h-auto p-2 rounded-lg  bg-[#efefef]  ">
            <img src="{{ asset('images/playlistimage.jpeg') }}" alt=""
                class="w-full  sticky top-0 left-0  shadow-lg group-hover:shadow-xl  rounded-md group-hover:scale-125 transition-all ease-linear">

        </div>

        <div class="flex justify-start items-center w-full">
            <div class="space-y-1 md:space-y-2">
                <div>
                    <h3 class=" text-[#efefef] text-sm md:text-md lg:text-lg font-semibold">{{ $playlist->name }}</h3>
                    <p class="text-xs md:text-sm text-gray-400">
                        Created on {{ $playlist->updated_at->format('M d,Y | h:m a') }}
                    </p>
                </div>
                <p class="text-xs md:text-sm text-orange-600 font-semibold">{{ $playlist->videos->count() }} items</p>
            </div>
        </div>

    </div>
</a>
