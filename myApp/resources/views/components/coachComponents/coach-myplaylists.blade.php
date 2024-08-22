@props(['myplaylists'])

{{-- ! Visible page  --}}
<div class="py-4  max-w-7xl mx-auto sm:px-6 lg:px-8">

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900 space-y-12">
        <div class="space-y-5 ">
            {{-- <h1 class="border-l-4 px-2 border-blue-600 text-black text-3xl ">My Playlists</h1> --}}
            <div class=" space-y-0">
                <h2 class="border-l-4 px-2 border-blue-600 text-2xl font-meduim ">My Playlists</h2>
                <p class="border-l-4 px-2 text-sm border-blue-600 text-blue-600 ">Crafting the Perfect Playlist
                    Experience.</p>
            </div>

            <div class="border border-gray-500/30 rounded-md p-4 flex justify-between items-center">
                <div>
                    <h3 class="text-md text-black">You don't have any playlist created yet</h3>
                    <p class=" text-sm text-gray-600">create your first playlist to get started</p>
                </div>
                <button
                    class="add-playlist-open-btn bg-blue-500 hover:bg-blue-700 hover:shadow-md py-2 px-4 rounded-md text-white ">
                    Add Playlist
                </button>
            </div>
        </div>

        <div class="space-y-3">
            <div class="space-y-2">
                <h2 class="text-xl text-black">Playlist Library</h2>
                {{-- <p class="text-blue-600 text-sm ">Crafting the Perfect Playlist Experience.</p> --}}
            </div>
            <ul class=" border-b  border-gray-500/20  flex justify-start items-center space-x-4">
                <li class="text-gray-600 w-fit">List</li>
                <li class="w-fit py-2 border-b-2 border-black">Grid</li>
            </ul>
            <div class=" w-full  grid grid-cols-2 gap-5 ">
                @foreach ($myplaylists as $playlist)
                    <x-coachComponents.coach-playlist-item :playlist="$playlist" />
                @endforeach
            </div>
        </div>
    </div>

</div>

</div>
{{-- ! Visible page end  --}}

{{-- ? Add playlist PopUp form --}}
<div
    class="add-playlist-pop-up hidden flex min-h-full h-full absolute top-0 left-0 w-full backdrop-blur-sm justify-center items-center bg-black/30 lg:px-8  shadow-md ">
    <div
        class="flex bg-[#172868]  justify-center items-center h-full sm:h-auto w-full  rounded-none border-none sm:max-w-[500px]  sm:border-2  sm:rounded-lg  sm:block    backdrop-blur-lg  ">
        <div class="text-white flex justify-end items-center p-3">
            <button class="add-playlist-close-btn hover:scale-125 transition-all ease-in"><i
                    class="fa-solid fa-xmark"></i></button>
        </div>
        <div class="w-full p-10 ">
            <div class="sm:mx-auto sm:w-full sm:max-w-sm">
                {{-- <a href="/">
        <img class="mx-auto h-10 w-auto"
            src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="Your Company">
    </a> --}}

                {{-- <h2 class="mt-10 text-center text-xl font-bold leading-9 tracking-tight text-gray-200">
        Add new playlist
    </h2> --}}
            </div>
            <h2 class=" text-xl   text-gray-200">Add new playlist</h2>

            <div class="mt-5 sm:mx-auto sm:w-full  ">
                {{-- ? here form start --}}

                <form action="/playlists" method="POST" enctype="multipart/form-data" class="space-y-5">
                    @csrf

                    {{-- playlist name field --}}
                    <x-formComponents.form-field>
                        {{-- <x-formComponents.form-label for="name">Playlist Name</x-formComponents.form-label> --}}
                        <x-formComponents.form-input type="text" id="name" name="name"
                            placeholder="playlist name" required></x-formComponents.form-input>
                        <x-formComponents.form-error name="name" />
                    </x-formComponents.form-field>

                    {{--  Add button --}}
                    <x-formComponents.form-button>Add</x-formComponents.form-button>

                </form>

                {{-- ? here form ends --}}

            </div>

        </div>
    </div>
</div>
{{-- ? --}}

{{-- pop up notification --}}
@session('success')
    <x-notificationCards.notif-success>{{ session('success') }}</x-notificationCards.notif-success>
@endsession

@session('error')
    <x-notificationCards.notif-error>{{ session('error') }}</x-notificationCards.notif-error>
@endsession

<script>
    /**
     *  hide & show Add playlist form 
     */
    const addPlaylistPopUp = document.querySelector('.add-playlist-pop-up');
    document.querySelector('.add-playlist-open-btn').addEventListener('click', showAddPlaylistPopUp);
    document.querySelector('.add-playlist-close-btn').addEventListener('click', hideAddPlaylistPopUp);


    function showAddPlaylistPopUp() {
        document.body.style.overflow = 'hidden';
        addPlaylistPopUp.classList.remove('hidden');
    }

    function hideAddPlaylistPopUp() {
        document.body.style.overflow = 'visible';
        addPlaylistPopUp.classList.add('hidden');
    }
</script>
