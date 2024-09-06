@props(['myVideos' => collect(), 'playlists' => collect()])



<div class=" py-10 p-3  min-h-[100vh]">

    <div
        class="max-w-7xl mx-auto sm:px-6 lg:px-8 overflow-hidden shadow-sm sm:rounded-lg  py-6 text-gray-900 space-y-8 xl:space-y-12">

        <section class="space-y-5 ">

            <div class=" space-y-2">
                <h2 class="border-l-4 px-2 border-orange-600 text-2xl text-[#ffffff] font-semibold ">My Videos</h2>
                <p class="border-l-4 px-2 text-sm font-semibold border-[#efefef]/50 text-[#efefef]/50 ">
                    Where Vision Meets Reality</p>
            </div>

            <div
                class="backdrop-blur-lg bg-black/40 space-y-3 sm:space-y-0 rounded-md p-4 shadow-lg flex flex-col sm:flex-row  sm:justify-between sm:items-center">
                <div>
                    <h3 class="text-sm sm:text-md text-gray-200 font-semibold">You don't have any videos uploaded yet
                    </h3>
                    <p class=" text-xs sm:text-sm text-orange-600">Upload your first video to get started</p>
                </div>
                <button
                    class="upload-open-btn bg-orange-700 hover:bg-black/10 hover:shadow-md py-2 px-4 rounded-md text-white hover:text-orange-600 font-semibold ">
                    Upload Video
                </button>
            </div>

        </section>


        <section class="space-y-3 backdrop-blur-3xl bg-black/40 rounded-2xl p-4  ">
            <h2 class=" text-md sm:text-lg md:text-xl border-l-4 px-2 border-orange-600  text-[#ffffff] font-semibold">
                Video Library</h2>
            <div class="space-y-3">
                <ul class=" border-b  border-gray-200/20  flex justify-start items-center space-x-4">
                    <li class="py-2 border-b-2 text-gray-200 border-orange-600">List</li>
                    <li class="text-gray-500 w-fit">Grid</li>
                </ul>
                <div class="w-full space-y-3 py-2  ">
                    @foreach ($myVideos as $video)
                        <div
                            class="flex flex-col sm:flex-row relative justify-between items-center space-x-4 w-full bg-white/10 hover:border-r-4 border-orange-600 rounded-md  transition-all ease-in ">
                            {{-- <video class="rounded-md w-40 shadow-md" controls>
                                <source src="{{ asset('upload/videos') }}/{{ $video->video }}" type="video/mp4" />
                            </video> --}}
                            @if ($video->youtube_url)
                                <iframe class="rounded-l-md w-full sm:w-32 md:w-80 sm:h-28 md:h-32 shadow-md"
                                    src="{{ str_replace('watch?v=', 'embed/', $video->youtube_url) }}" frameborder="0"
                                    allowfullscreen></iframe>
                            @else
                                <!-- Handle case for uploaded videos or display a message -->
                            @endif
                            <div class="flex justify-between items-center w-full py-3 sm:py-0">
                                <div class="space-y-1">
                                    <h3 class="text-sm md:text-md lg:text-lg text-[#efefef] font-semibold ">
                                        {{ $video->title }}</h3>
                                    <p class="text-xs md:text-sm text-gray-400">
                                        Uploaded on {{ $video->updated_at->format('M d,Y | h:m a') }}
                                    </p>
                                </div>
                                <button title="view menu" class="video-menu-btn p-3  text-gray-400">
                                    <i class="fa-solid fa-ellipsis"></i>
                                </button>
                                <!-- Hidden video menu -->
                                <div
                                    class="video-menu w-52 z-50 absolute top-[65%] right-3
                                  shadow-md rounded-md bg-white/80 overflow-hidden hidden">
                                    <ul class="text-sm text-black">

                                        <li
                                            class="video-menu-item  w-full text-gray-700 hover:bg-black/50 hover:text-white ">
                                            <button data-videoId="{{ $video->id }}"
                                                class="addTo-open-btn p-2 w-full  flex justify-between items-center">
                                                Add To playlist <i class="fa-solid fa-list-ul"></i>
                                            </button>
                                        </li>

                                        <li class="  w-full text-gray-700 hover:bg-black/50 hover:text-white ">
                                            <button data-id="{{ $video->id }}" data-title="{{ $video->title }}"
                                                data-url="{{ $video->youtube_url }}"
                                                data-description="{{ $video->description }}"
                                                class="video-menu-item video-edit-open-btn  p-2 w-full flex justify-between items-center">
                                                Edit <i class="fa-solid fa-pen"></i>
                                            </button>
                                        </li>


                                        <li
                                            class="video-menu-item w-full text-red-600 hover:bg-red-600 hover:text-white flex justify-between items-center">
                                            <button data-videoId="{{ $video->id }}" data-title="{{ $video->title }}"
                                                type="submit"
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
<x-formComponents.popup-form id="upload-popup">
    <x-slot:closeBtn>
        <button class="upload-close-btn hover:scale-125 transition-all ease-in">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </x-slot:closeBtn>
    {{-- ? form start --}}
    <form action="{{ route('coach.videos.store') }}" method="POST" enctype="multipart/form-data"
        class="space-y-5  mx-auto ">
        @csrf

        {{-- Title field --}}
        <x-formComponents.form-field>
            <x-formComponents.form-label for="title">Title</x-formComponents.form-label>
            <x-formComponents.form-input type="text" id="title" name="title" placeholder="Video title"
                required></x-formComponents.form-input>
            <x-formComponents.form-error name="title" />
        </x-formComponents.form-field>

        {{-- Video file upload field --}}
        <x-formComponents.form-field>
            <x-formComponents.form-label for="youtube_url"></x-formComponents.form-label>
            <x-formComponents.form-input type="url" id="youtube_url" name="youtube_url"
                placeholder="https://www.youtube.com/watch?v=example" required></x-formComponents.form-input>
            <x-formComponents.form-error name="video" />
        </x-formComponents.form-field>

        {{-- Description field --}}
        <x-formComponents.form-field>
            <x-formComponents.form-label for="description">
                Description</x-formComponents.form-label>
            <x-formComponents.form-textarea id="description" name="description"
                placeholder="description of your video content" :value="old('description')" required />
            <x-formComponents.form-error name="description" />
        </x-formComponents.form-field>

        {{--  upload button --}}
        <x-formComponents.form-button>Upload</x-formComponents.form-button>

    </form>
    {{-- ? form end --}}
</x-formComponents.popup-form>
{{-- ? ----------------------------------------------------------------------------------- --}}

{{-- ? ###### Add To Playlist PopUp Form Start ########## --}}
<x-formComponents.popup-form id="addTo-video-popup">
    <x-slot:closeBtn>
        <button class="addTo-close-btn hover:scale-125 transition-all ease-in">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </x-slot:closeBtn>
    {{-- form start --}}
    <form id="addToPlaylistForm" method="POST" enctype="multipart/form-data"
        class="  rounded-lg  shadow-lg mx-auto  space-y-5">
        @csrf

        <div class="space-y-2">
            <x-formComponents.form-label for="course_id">
                Select the playlist name where this video will be added :
            </x-formComponents.form-label>
            <select name="addedTo" id="addedTo"
                class="block w-full rounded-md border-0  text-orange-700 font-medium shadow-sm  placeholder:text-gray-500 focus:ring-2 focus:ring-inset focus:ring-orange-600 sm:text-sm sm:leading-6  px-3 py-2.5 focus-visible:outline-dashed focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-orange-400 backdrop-blur-sm bg-white/5">
                @if ($playlists->isNotEmpty())
                    <option value="">--- select your playlist ---</option>
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
        </div>
        <x-formComponents.form-button type='submit'>Add To Playlist</x-formComponents.form-button>


    </form>
    {{--  form end --}}
</x-formComponents.popup-form>
{{-- ? ----------------------------------------------------------------------------------- --}}

{{-- ? ######### Video Edit Pop up Form  start ######### --}}
<x-formComponents.popup-form id="edit-video-popup">
    <x-slot:closeBtn>
        <button class="video-edit-close-btn hover:scale-125 transition-all ease-in">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </x-slot:closeBtn>
    {{--  here form start --}}
    <form method="POST" id="edit-video-form" enctype="multipart/form-data" class="space-y-5">
        @csrf
        @method('PATCH')

        {{-- Title field --}}
        <x-formComponents.form-field>
            <x-formComponents.form-label for="title">Title</x-formComponents.form-label>
            <x-formComponents.form-input type="text" id="edit-title" name="title" placeholder="Video title"
                required></x-formComponents.form-input>
            <x-formComponents.form-error name="title" />
        </x-formComponents.form-field>


        {{-- url field --}}
        <x-formComponents.form-field>
            <x-formComponents.form-label for="youtube_url"></x-formComponents.form-label>
            <x-formComponents.form-input type="url" id="edit-youtube_url" name="youtube_url"
                placeholder="https://www.youtube.com/watch?v=example" required></x-formComponents.form-input>
            <x-formComponents.form-error name="video" />
        </x-formComponents.form-field>

        {{-- Description field --}}
        <x-formComponents.form-field>
            <x-formComponents.form-label for="description">
                Description</x-formComponents.form-label>
            <x-formComponents.form-textarea id="edit-description" name="description"
                placeholder="description of your video content" :value="old('description')" required />
            <x-formComponents.form-error name="description" />
        </x-formComponents.form-field>

        {{--  upload button --}}
        <div class="flex justify-between items-center space-x-1">
            <x-formComponents.form-button>Update</x-formComponents.form-button>

        </div>
    </form>
    {{--  here form ends --}}
</x-formComponents.popup-form>
{{-- ? --------------------------------------------------------------------------------- --}}


{{-- ? ###### Delete Video PopUp Form Start ########## --}}
<x-formComponents.popup-form id="delete-video-popup">
    <x-slot:closeBtn>
        <button class="delete-video-close-btn hover:scale-125 transition-all ease-in">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </x-slot:closeBtn>
    {{-- form start --}}
    <form id="delete-video-form" method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf

        {{-- playlist name delete confirmation field --}}
        <x-formComponents.form-field>
            <x-formComponents.form-label for="name">
                Type the playlist name <strong id="video-label"></strong> to confirm deletion:
            </x-formComponents.form-label>
            <x-formComponents.form-input type="text" id="confirm-deletion" name="confirm-deletion"
                required></x-formComponents.form-input>
            <x-formComponents.form-error name="confirm-delete" />
        </x-formComponents.form-field>

        {{--  Edit button --}}
        <x-formComponents.form-button>Delete</x-formComponents.form-button>

    </form>
    {{--  form end --}}
</x-formComponents.popup-form>
{{-- ? ----------------------------------------------------------------------------------- --}}


<script>
    let initialScrollPosition;
    // popup show and hide events using click event
    /**
     * upload popUp
     */
    const uploadPopup = document.getElementById('upload-popup');
    const uploadOpenBtn = document.querySelector('.upload-open-btn').addEventListener('click', showUploadPopup);
    const uploadCloseBtn = document.querySelector('.upload-close-btn').addEventListener('click', hideUploadPopup);


    function showUploadPopup() {
        document.body.style.overflow = 'hidden';
        initialScrollPosition = window.scrollY;

        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
        setTimeout(() => {
            uploadPopup.classList.remove('hidden');
        }, 300);
    }

    function hideUploadPopup() {
        document.body.style.overflow = 'visible';
        window.scrollTo({
            top: initialScrollPosition,
            behavior: 'smooth'
        });

        uploadPopup.classList.add('hidden');
    }

    /**
     * Add video to playlist Popup Form
     */
    const addToPlaylistPopup = document.getElementById('addTo-video-popup');
    const addToOpenBtns = document.querySelectorAll('.addTo-open-btn')
    const addToCloseBtn = document.querySelector('.addTo-close-btn').addEventListener('click',
        hideAddToPlaylistPopup);


    let videoId;

    addToOpenBtns.forEach(btn => {
        btn.addEventListener('click', showAddToPlaylistPopup);
    })

    function showAddToPlaylistPopup() {
        videoId = this.getAttribute('data-videoId');
        console.log(videoId);
        document.body.style.overflow = 'hidden';

        initialScrollPosition = window.scrollY;
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
        setTimeout(() => {
            addToPlaylistPopup.classList.remove('hidden');
        }, 300);
    }

    function hideAddToPlaylistPopup() {
        document.body.style.overflow = 'visible';

        window.scrollTo({
            top: initialScrollPosition,
            behavior: 'smooth'
        });
        addToPlaylistPopup.classList.add('hidden');
    }

    document.getElementById('addedTo').addEventListener('change', function() {
        console.log('changed');
        let playlistId = this.value;

        let form = document.getElementById('addToPlaylistForm');
        console.log(form)

        if (playlistId) {
            let actionUrl = `{{ route('coach.videos.addToPlaylist', [':playlistId', ':videoId']) }}`;
            actionUrl = actionUrl.replace(':playlistId', playlistId).replace(':videoId', videoId);

            console.log(actionUrl)
            form.setAttribute('action', actionUrl);
        } else {
            form.setAttribute('action', ''); // handle case where no playlist is selected
        }
    });

    /**
     * edit video  popUp Form 
     */
    const editVideoPopup = document.getElementById('edit-video-popup')
    const videoEditOpenBtns = document.querySelectorAll('.video-edit-open-btn')
    document.querySelector('.video-edit-close-btn').addEventListener('click', hideEditVideoPopup);
    const editVideoForm = document.getElementById('edit-video-form');

    const videoEditTitle = document.getElementById('edit-title');
    const videoEditYoutubeUrl = document.getElementById('edit-youtube_url');
    const videoEditDescription = document.getElementById('edit-description');

    videoEditOpenBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const videoId = this.getAttribute('data-id');
            // console.log(videoId);
            // console.log(this.getAttribute('data-title'));

            videoEditTitle.value = this.getAttribute('data-title');
            videoEditYoutubeUrl.value = this.getAttribute('data-url');
            videoEditDescription.value = this.getAttribute('data-description');


            // const updateUrl = `{{ url('/coach/myvideos') }}/${videoId}`;
            let actionUrl = `{{ route('coach.videos.update', ':videoId') }}`
            actionUrl = actionUrl.replace(':videoId', videoId);

            editVideoForm.action = actionUrl;

            document.body.style.overflow = 'hidden';

            initialScrollPosition = window.scrollY;
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
            setTimeout(() => {
                editVideoPopup.classList.remove('hidden');
            }, 300);
        });
    });


    function hideEditVideoPopup() {
        console.log('clicked');
        document.body.style.overflow = 'visible';
        window.scrollTo({
            top: initialScrollPosition,
            behavior: 'smooth'
        });

        editVideoPopup.classList.add('hidden');
    }




    /**
     * Delete video  Popup Form
     */
    const deleteVideoPopup = document.getElementById('delete-video-popup');
    const deleteVideoOpenBtns = document.querySelectorAll('.delete-video-open-btn')
    // console.log(deleteVideoOpenBtns)
    const deleteVideoCloseBtn = document.querySelector('.delete-video-close-btn').addEventListener('click',
        hideDeleteVideoPopup);

    const videoDeleteLabel = document.getElementById('video-label');
    const videoConfirmDeleteInputPlaceholder = document.getElementById('confirm-deletion');
    console.log(videoConfirmDeleteInputPlaceholder);




    deleteVideoOpenBtns.forEach(btn => {
        btn.addEventListener('click', showDeleteVideoPopup);
    })

    function showDeleteVideoPopup() {
        const videoId = this.getAttribute('data-videoId');
        const videoName = this.getAttribute('data-title');

        videoDeleteLabel.innerText = videoName;

        let placeholder = ` '${videoName}' `
        console.log(placeholder)
        videoConfirmDeleteInputPlaceholder.setAttribute('placeholder', placeholder)

        form = document.getElementById('delete-video-form');

        actionUrl = `{{ route('coach.videos.destroy', ':videoId') }}`;
        actionUrl = actionUrl.replace(':videoId', videoId);
        form.action = actionUrl;

        document.body.style.overflow = 'hidden';
        initialScrollPosition = window.scrollY;
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
        setTimeout(() => {
            deleteVideoPopup.classList.remove('hidden');
        }, 300);
    }

    function hideDeleteVideoPopup() {
        document.body.style.overflow = 'visible';
        window.scrollTo({
            top: initialScrollPosition,
            behavior: 'smooth'
        });
        deleteVideoPopup.classList.add('hidden');
    }

    /**
     *  show and hide video menu
     */

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
