@props(['myplaylists'])

{{-- ! Visible page  --}}
<div class=" py-10 px-3  min-h-[100vh]">

    <div
        class="max-w-7xl mx-auto  sm:px-6 lg:px-8  overflow-hidden  sm:rounded-lg py-6 text-gray-900 space-y-8 lg:space-y-12">
        <div class="space-y-8 ">
            {{-- <h1 class="border-l-4 px-2 border-blue-600 text-black text-3xl ">My Playlists</h1> --}}
            <div class=" space-y-2">
                <h2 class="border-l-4 px-2 border-orange-600 text-2xl text-[#ffffff] font-semibold " data-aos="fade-right"
                    data-aos-duration="400" data-aos-delay="500">
                    My Playlists
                </h2>
                <p data-aos="fade-right" data-aos-duration="400" data-aos-delay="600"
                    class="border-l-4 px-2 text-sm font-semibold border-[#efefef]/50 text-[#efefef]/50 ">
                    Crafting the Perfect Playlist Experience.
                </p>
            </div>

            <div data-aos="fade-left" data-aos-duration="400" data-aos-delay="700"
                class=" backdrop-blur-lg  bg-black/40 space-y-3 sm:space-y-0 rounded-md p-4 shadow-lg flex flex-col sm:flex-row  sm:justify-between sm:items-center">
                <div>
                    <h3 class="text-sm sm:text-md text-gray-200 font-semibold" data-aos="fade-right"
                        data-aos-duration="400" data-aos-delay="800">
                        You don't have any playlist created yet
                    </h3>
                    <p class="text-xs sm:text-sm text-orange-600" data-aos="fade-right" data-aos-duration="400"
                        data-aos-delay="900">
                        create your first playlist to get started
                    </p>
                </div>
                <button data-aos="fade-left" data-aos-duration="400" data-aos-delay="1000"
                    class="add-playlist-open-btn text-sm sm:text-md w-full sm:w-auto bg-orange-700 hover:bg-black/10 hover:shadow-md py-2 px-4 rounded-md text-white hover:text-orange-600 font-semibold ">
                    Add Playlist
                </button>
            </div>
        </div>

        <div data-aos="fade-right" data-aos-duration="400" data-aos-delay="1100"
            class="space-y-3 backdrop-blur-3xl bg-black/40 rounded-2xl py-4  px-2 md:p-4 ">
            <div class="space-y-2">
                <h2 data-aos="fade-right" data-aos-duration="400" data-aos-delay="1300"
                    class="text-md sm:text-lg md:text-xl border-l-4 px-2 border-orange-600  text-[#ffffff] font-semibold">
                    Playlist Library
                </h2>
                {{-- <p class="text-blue-600 text-sm ">Crafting the Perfect Playlist Experience.</p> --}}
            </div>
            <ul class=" border-b  border-gray-200/20  flex justify-start items-center space-x-4">
                <li class="w-fit py-2 border-b-2 text-gray-200 border-orange-600 md:text-gray-500 md:border-none ">List
                </li>
                <li class="w-fit text-gray-500 md:py-2 md:border-b-2 md:text-gray-200 md:border-orange-600">Grid</li>
            </ul>
            <div class=" w-full  grid grid-cols-1 md:grid-cols-2 gap-2 md:gap-5 py-2 ">
                @php
                    $delay = 1400;
                @endphp
                @foreach ($myplaylists as $playlist)
                    @php
                        $delay += 200;
                    @endphp
                    <x-coachComponents.coach-playlist-item :delay="$delay" :playlist="$playlist" />
                @endforeach
            </div>
        </div>
    </div>

</div>

</div>
{{-- ! Visible page end  --}}

{{-- ? Add playlist PopUp form --}}
<x-formComponents.popup-form id="add-playlist-form">
    <x-slot:closeBtn>
        <button class="add-playlist-close-btn hover:scale-125 transition-all ease-in">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </x-slot:closeBtn>

    {{--  here form start --}}
    <form action="{{ route('coach.playlists.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf

        {{-- playlist name field --}}
        <x-formComponents.form-field>
            {{-- <x-formComponents.form-label for="name">Playlist Name</x-formComponents.form-label> --}}
            <x-formComponents.form-input type="text" id="name" name="name" placeholder="playlist name"
                required></x-formComponents.form-input>
            <x-formComponents.form-error name="name" />
        </x-formComponents.form-field>

        {{--  Add button --}}
        <x-formComponents.form-button>Add</x-formComponents.form-button>

    </form>
    {{-- here form ends --}}

</x-formComponents.popup-form>


{{-- pop up notification --}}
@session('success')
    <x-notificationCards.notif-success>{{ session('success') }}</x-notificationCards.notif-success>
@endsession

@session('error')
    <x-notificationCards.notif-error>{{ session('error') }}</x-notificationCards.notif-error>
@endsession

<script>
    let initialScrollPosition = 0;
    /**
     *  hide & show Add playlist form 
     */
    const addPlaylistForm = document.getElementById('add-playlist-form');
    document.querySelector('.add-playlist-open-btn').addEventListener('click', showAddPlaylistForm);
    document.querySelector('.add-playlist-close-btn').addEventListener('click', hideAddPlaylistForm);


    function showAddPlaylistForm() {
        document.body.style.overflow = 'hidden';
        initialScrollPosition = window.scrollY;
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
        setTimeout(() => {
            addPlaylistForm.classList.remove('hidden');
        }, 300);
    }

    function hideAddPlaylistForm() {
        document.body.style.overflow = 'visible';
        window.scrollTo({
            top: initialScrollPosition,
            behavior: 'smooth'
        });
        addPlaylistForm.classList.add('hidden');
    }
</script>
<script src="{{ asset('js/notif.js') }}"></script>
