@props(['myVideos' => collect(), 'playlists' => collect()])



<div class="py-10 px-3 backdrop-blur-3xl bg-black/50  min-h-[100vh]">

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 overflow-hidden shadow-sm sm:rounded-lg  p-6 text-gray-900 space-y-12">

        <section class="space-y-5 ">

            <div class=" space-y-2">
                <h2 class="border-l-4 px-2 border-orange-600 text-2xl text-[#ffffff] font-semibold ">My Videos</h2>
                <p class="border-l-4 px-2 text-sm font-semibold border-[#efefef]/50 text-[#efefef]/50 ">
                    Where Vision Meets Reality</p>
            </div>

            <div class="backdrop-blur-lg rounded-md p-4 shadow-lg flex justify-between items-center">
                <div>
                    <h3 class="text-md text-gray-200 font-semibold">You don't have any videos uploaded yet</h3>
                    <p class=" text-sm text-orange-600">Upload your first video to get started</p>
                </div>
                <button
                    class="upload-open-btn bg-white/10 hover:bg-black/10 hover:shadow-md py-2 px-4 rounded-md text-white hover:text-orange-600 font-semibold ">
                    Upload Video
                </button>
            </div>

        </section>


        <section class="space-y-3 backdrop-blur-3xl rounded-2xl p-4  ">
            <h2 class=" text-xl border-l-4 px-2 border-orange-600  text-[#ffffff] font-semibold">Video Library</h2>
            <div class="space-y-3">
                <ul class=" border-b  border-gray-200/20  flex justify-start items-center space-x-4">
                    <li class="py-2 border-b-2 text-gray-200 border-orange-600">List</li>
                    <li class="text-gray-500 w-fit">Grid</li>
                </ul>
                <div class="w-full space-y-3 py-2  ">
                    @foreach ($myVideos as $video)
                        <div
                            class="flex p-2 relative justify-between items-center space-x-4 w-full bg-white/10 hover:border-r-4 border-orange-600 rounded-md  transition-all ease-in">
                            <video class="rounded-md w-40 shadow-md" controls>
                                <source src="{{ asset('upload/videos') }}/{{ $video->video }}" type="video/mp4" />
                            </video>
                            <div class="flex justify-between items-center w-full">
                                <div class="space-y-1">
                                    <h3 class="text-lg text-[#efefef] font-semibold ">{{ $video->title }}</h3>
                                    <p class="text-sm text-gray-400">
                                        Uploaded on {{ $video->updated_at->format('M d,Y | h:m a') }}
                                    </p>
                                </div>
                                <button title="view menu" class="video-menu-btn p-3  text-gray-400">
                                    <i class="fa-solid fa-ellipsis"></i>
                                </button>
                                <!-- Hidden video menu -->
                                <div
                                    class="video-menu w-52 z-50 absolute top-[65%] right-3
                                  shadow-md rounded-md bg-[#efefef] overflow-hidden hidden">
                                    <ul class="text-sm text-black">

                                        <li
                                            class="video-menu-item  w-full text-gray-700 hover:bg-blue-600 hover:text-white ">
                                            <button
                                                class="addTo-open-btn p-2 w-full  flex justify-between items-center">
                                                Add To playlist <i class="fa-solid fa-list-ul"></i>
                                            </button>
                                        </li>

                                        <li class="  w-full text-gray-700 hover:bg-blue-600 hover:text-white ">
                                            <button data-id="{{ $video->id }}" data-title="{{ $video->title }}"
                                                data-duration="{{ $video->duration }}"
                                                class="video-menu-item video-edit-open-btn  p-2 w-full flex justify-between items-center">
                                                Edit <i class="fa-solid fa-pen"></i>
                                            </button>
                                        </li>


                                        <li
                                            class="video-menu-item w-full text-red-600 hover:bg-red-600 hover:text-white flex justify-between items-center">
                                            <button type="submit"
                                                class="delete-video-open-btn   p-2 w-full  flex justify-between items-center">
                                                Delete
                                                <i class="fa-solid fa-trash-can ml-2"></i>
                                            </button>
                                        </li>

                                    </ul>
                                </div>
                                <!------------------------>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="py-4">
                    {{ $myVideos->links() }}
                </div>
            </div>
        </section>


        {{-- pop up notification --}}
        @session('success')
            <x-notificationCards.notif-success>{{ session('success') }}</x-notificationCards.notif-success>
        @endsession

        @session('error')
            <x-notificationCards.notif-error>{{ session('error') }}</x-notificationCards.notif-error>
        @endsession

    </div>

</div>



{{-- ? ###### Video Upload PopUp Form Start ########## --}}
<x-formComponents.popup-form id="upload-form">
    <x-slot:closeBtn>
        <button class="upload-close-btn hover:scale-125 transition-all ease-in">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </x-slot:closeBtn>
    {{-- ? form start --}}
    <form action="{{ route('coach.videos.store') }}" method="POST" enctype="multipart/form-data"
        class="space-y-5  mx-auto shadow-lg">
        @csrf

        {{-- Title field --}}
        <x-formComponents.form-field>
            <x-formComponents.form-label for="title">Title</x-formComponents.form-label>
            <x-formComponents.form-input type="text" id="title" name="title" placeholder="Video title"
                required></x-formComponents.form-input>
            <x-formComponents.form-error name="title" />
        </x-formComponents.form-field>

        {{-- duration field --}}
        <x-formComponents.form-field>
            <x-formComponents.form-label for="duration">Duration</x-formComponents.form-label>
            <x-formComponents.form-input type="text" id="duration" name="duration"
                placeholder="Video duration in minite" required></x-formComponents.form-input>
            <x-formComponents.form-error name="duration" />
        </x-formComponents.form-field>

        {{-- Video file upload field --}}
        <x-formComponents.form-field>
            <x-formComponents.form-label for="video"></x-formComponents.form-label>
            <x-formComponents.form-input type="file" id="video" name="video"
                required></x-formComponents.form-input>
            <x-formComponents.form-error name="video" />
        </x-formComponents.form-field>

        {{--  upload button --}}
        <x-formComponents.form-button>Upload</x-formComponents.form-button>

    </form>
    {{-- ? form end --}}
</x-formComponents.popup-form>
{{-- ? ----------------------------------------------------------------------------------- --}}

{{-- ? ######### Video Edit Pop up Form  start ######### --}}
<x-formComponents.popup-form id="edit-video-form">
    <x-slot:closeBtn>
        <button class="video-edit-close-btn hover:scale-125 transition-all ease-in">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </x-slot:closeBtn>
    {{--  here form start --}}
    <form method="POST" action="" enctype="multipart/form-data" class="space-y-5">
        @csrf
        @method('PATCH')

        {{-- Title field --}}
        <x-formComponents.form-field>
            <x-formComponents.form-label for="title">Title</x-formComponents.form-label>
            <x-formComponents.form-input type="text" id="edit-title" name="title" placeholder="Video title"
                required value="{{ $video->title }}"></x-formComponents.form-input>
            <x-formComponents.form-error name="title" />
        </x-formComponents.form-field>

        {{-- duration field --}}
        <x-formComponents.form-field>
            <x-formComponents.form-label for="duration">Duration</x-formComponents.form-label>
            <x-formComponents.form-input type="text" id="edit-duration" name="duration"
                placeholder="Video duration in minite" required
                value="{{ $video->duration }}"></x-formComponents.form-input>
            <x-formComponents.form-error name="duration" />
        </x-formComponents.form-field>

        {{--  upload button --}}
        <div class="flex justify-between items-center space-x-1">
            <x-formComponents.form-button>Update</x-formComponents.form-button>

        </div>
    </form>
    {{--  here form ends --}}
</x-formComponents.popup-form>
{{-- ? --------------------------------------------------------------------------------- --}}

{{-- ? ###### Add To Playlist PopUp Form Start ########## --}}
<x-formComponents.popup-form id="delete-video-form">
    <x-slot:closeBtn>
        <button class="addTo-close-btn hover:scale-125 transition-all ease-in">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </x-slot:closeBtn>
    {{-- form start --}}
    <form action="" method="POST" enctype="multipart/form-data"
        class="edit-form bg-[#172868] rounded-lg  shadow-lg mx-auto  space-y-4">
        @csrf


        <select name="addedTo" id="addedTo"
            class="w-full rounded-md border-0  text-gray-200 shadow-sm  placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6  px-3 py-2.5 focus-visible:outline-dashed focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-400 backdrop-blur-sm bg-gray-300/20 p-2">
            @if ($playlists->isNotEmpty())
                @foreach ($playlists as $playlist)
                    @php
                        $selectedPlaylist = $playlist;
                    @endphp
                    <option value="{{ $playlist->id }}">{{ $playlist->name }}</option>
                @endforeach
            @else
                <option value=""> No playlist available</option>
            @endif
        </select>
        <x-formComponents.form-button type='submit'>Add To Playlist</x-formComponents.form-button>


    </form>
    {{--  form end --}}
</x-formComponents.popup-form>
{{-- ? ----------------------------------------------------------------------------------- --}}

{{-- ? ###### Delete Video PopUp Form Start ########## --}}
<x-formComponents.popup-form id="delete-video-form">
    <x-slot:closeBtn>
        <button class="delete-video-close-btn hover:scale-125 transition-all ease-in">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </x-slot:closeBtn>
    {{-- form start --}}
    <form action="" method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf
        @method('DELETE')

        {{-- playlist name delete confirmation field --}}
        <x-formComponents.form-field>
            <label for="name" class="text-white text-sm">
                Type the playlist name <strong>{{ $playlist->name }}</strong> to confirm deletion:
            </label>
            <x-formComponents.form-input type="text" id="confirm-delete" name="confirm-delete"
                placeholder="'{{ $playlist->name }}'" required></x-formComponents.form-input>
            <x-formComponents.form-error name="confirm-delete" />
        </x-formComponents.form-field>

        {{--  Edit button --}}
        <x-formComponents.form-button>Delete</x-formComponents.form-button>

    </form>
    {{--  form end --}}
</x-formComponents.popup-form>
{{-- ? ----------------------------------------------------------------------------------- --}}


<script>
    // popup show and hide events using click event
    /**
     * upload popUp
     */
    const uploadPopUp = document.getElementById('upload-form');
    const uploadOpenBtn = document.querySelector('.upload-open-btn').addEventListener('click', showUploadPopUp);
    const uploadCloseBtn = document.querySelector('.upload-close-btn').addEventListener('click', hideUploadPopUp);

    function showUploadPopUp() {
        document.body.style.overflow = 'hidden';
        uploadPopUp.classList.remove('hidden');
    }

    function hideUploadPopUp() {
        document.body.style.overflow = 'visible';
        uploadPopUp.classList.add('hidden');
    }

    /**
     * edit video  popUp Form 
     */
    const editVideoForm = document.getElementById('edit-video-form')
    const videoEditOpenBtns = document.querySelectorAll('.video-edit-open-btn')
    document.querySelector('.video-edit-close-btn').addEventListener('click', hideEditVideoForm);

    const videoEditTitle = document.getElementById('edit-title');
    const videoEditDuration = document.getElementById('edit-duration');

    videoEditOpenBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const videoId = this.getAttribute('data-id');
            // console.log(videoId);
            // console.log(this.getAttribute('data-title'));

            videoEditTitle.value = this.getAttribute('data-title');
            videoEditDuration.value = this.getAttribute('data-duration');


            const updateUrl = `{{ url('/coach/myvideos') }}/${videoId}`;

            if (editVideoForm) {
                editVideoForm.setAttribute('action', updateUrl);
                console.log('Form action set to:', editVideoForm.getAttribute('action'));


            } else {
                console.error('Form element not found');
            }
            // Set the form's action attribute to the dynamically constructed URL
            // editVideoForm.action = updateUrl;

            document.body.style.overflow = 'hidden';
            editVideoForm.classList.remove('hidden');
        });
    });


    function hideEditVideoForm() {
        console.log('clicked');
        document.body.style.overflow = 'visible';
        editVideoForm.classList.add('hidden');
    }


    /**
     * Add video to playlist Popup Form
     */
    const addToPlaylistForm = document.getElementById('delete-video-form');
    const addToOpenBtns = document.querySelectorAll('.delete-video-open-btn') /
        const delete - videoCloseBtn = document.querySelector('.delete-video-close-btn').addEventListener('click',
            hideAddToPlaylistPopUp);


    delete - videoOpenBtns.forEach(btn => {
        btn.addEventListener('click', showAddToPlaylistPopUp);
    })

    function showAddToPlaylistPopUp() {
        console.log('clicked')
        document.body.style.overflow = 'hidden';
        delete - videoPlaylistForm.classList.remove('hidden');
    }

    function hideAddToPlaylistPopUp() {
        document.body.style.overflow = 'visible';
        delete - videoPlaylistForm.classList.add('hidden');
    }

    /**
     * Delete video  Popup Form
     */
    const deleteVideoForm = document.getElementById('delete-video-form');
    const deleteVideoOpenBtns = document.querySelectorAll('.delete-video-open-btn')
    // console.log(deleteVideoOpenBtns)
    const deleteVideoCloseBtn = document.querySelector('.delete-video-close-btn').addEventListener('click',
        hideDeleteVideoForm);


    deleteVideoOpenBtns.forEach(btn => {
        btn.addEventListener('click', showAddToPlaylistPopUp);
    })

    function showAddToPlaylistPopUp() {
        console.log('clicked')
        document.body.style.overflow = 'hidden';
        deleteVideoForm.classList.remove('hidden');
    }

    function hideDeleteVideoForm() {
        document.body.style.overflow = 'visible';
        deleteVideoForm.classList.add('hidden');
    }

    // show and hide video menu
    let videoMenuBtns = document.querySelectorAll('.video-menu-btn');
    let videoMenuBtnClicked = false;
    videoMenuBtns.forEach(btn => {
        btn.addEventListener('click', function() {

            let videoMenu = this.nextElementSibling;

            if (!videoMenuBtnClicked) {
                videoMenu.classList.remove('hidden');
                videoMenuBtnClicked = !videoMenuBtnClicked;
            } else {
                videoMenu.classList.add('hidden');
                videoMenuBtnClicked = !videoMenuBtnClicked;
            }


            let menuItems = videoMenu.querySelectorAll('.video-menu-item');
            menuItems.forEach(item => {
                item.addEventListener('click', function() {
                    if (videoMenuBtnClicked) {
                        videoMenu.classList.add('hidden');
                        videoMenuBtnClicked = !videoMenuBtnClicked;
                    }
                })
            })

        })
    })
</script>
{{-- notification handling js file --}}
<script src="{{ asset('js/notif.js') }}"></script>
