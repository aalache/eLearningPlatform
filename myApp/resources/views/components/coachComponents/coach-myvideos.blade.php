@props(['myVideos' => collect(), 'playlists' => collect()])



<div class="py-4  max-w-7xl mx-auto sm:px-6 lg:px-8">

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg  p-6 text-gray-900 space-y-12">

        <div class="space-y-5 ">
            <div class=" space-y-0">
                <h2 class="border-l-4 px-2 border-blue-600 text-2xl font-meduim ">My Videos</h2>
                <p class="border-l-4 px-2 text-sm border-blue-600 text-blue-600 ">Where Vision Meets Reality</p>
            </div>

            <div class="border border-gray-500/30 rounded-md p-4 flex justify-between items-center">
                <div>
                    <h3 class="text-md text-black">You don't have any videos uploaded yet</h3>
                    <p class=" text-sm text-gray-600">Upload your first video to get started</p>
                </div>
                <button
                    class="upload-open-btn bg-blue-500 hover:bg-blue-700 hover:shadow-md py-2 px-4 rounded-md text-white ">
                    Upload Video
                </button>
            </div>
        </div>

        {{-- Hidden video upload pop up form --}}
        <div
            class="upload-pop-up bg-black/30 backdrop-blur-sm w-full h-[105vh] fixed top-[-8vh] left-0 z-50 flex justify-center items-center hidden">
            <div id="video-upload-form" class="rounded-md bg-[#172868]  max-w-[500px] w-[500px] ">
                <div class="text-white flex justify-end items-center p-3">
                    <button class="upload-close-btn hover:scale-125 transition-all ease-in"><i
                            class="fa-solid fa-xmark"></i></button>
                </div>
                <div class="py-10 px-8">
                    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
                        <a href="/">
                            <img class="mx-auto h-10 w-auto"
                                src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600"
                                alt="Your Company">
                        </a>

                        <h2 class="mt-10 text-center text-2xl  leading-9 tracking-tight text-gray-200">
                            Upload Video
                        </h2>
                    </div>
                    {{-- ? form start --}}
                    <form action="/videos" method="POST" enctype="multipart/form-data"
                        class="space-y-5 max-w-[400px] mx-auto shadow-lg">
                        @csrf

                        {{-- Title field --}}
                        <x-formComponents.form-field>
                            <x-formComponents.form-label for="title">Title</x-formComponents.form-label>
                            <x-formComponents.form-input type="text" id="title" name="title"
                                placeholder="Video title" required></x-formComponents.form-input>
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
                </div>

            </div>
        </div>
        {{-- ##### --}}

        <div class="space-y-3 ">
            <h2 class=" text-black text-xl font-">Video Library</h2>
            <div class="space-y-3">
                <ul class=" border-b  border-gray-500/20  flex justify-start items-center space-x-4">
                    <li class="py-2 border-b-2 border-black w-fit">List</li>
                    <li class="text-gray-600">Grid</li>
                </ul>
                <div class="w-full space-y-3  ">
                    @foreach ($myVideos as $video)
                        <div
                            class="flex relative justify-between items-center space-x-4 w-full  hover:border-x-4 border-blue-600 rounded-md  transition-all ease-in">
                            <video class="rounded-md w-40 shadow-md" controls>
                                <source src="{{ asset('upload/videos') }}/{{ $video->video }}" type="video/mp4" />
                            </video>
                            <div class="flex justify-between items-center w-full">
                                <div>
                                    <h3 class=" text-black">{{ $video->title }}</h3>
                                    <p class="text-sm text-blue-600">
                                        Uploaded on {{ $video->updated_at->format('M d,Y | h:m a') }}
                                    </p>
                                </div>
                                <button title="view menu" class="video-menu-btn px-3">
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
                                                Add To playlist
                                                <i class="fa-solid fa-list-ul"></i>
                                            </button>
                                        </li>


                                        <li class="  w-full text-gray-700 hover:bg-blue-600 hover:text-white ">
                                            <button data-id={{ $video->id }} data-title={{ $video->title }}
                                                data-duration={{ $video->duration }}
                                                class="video-menu-item video-edit-open-btn  p-2 w-full flex justify-between items-center">Edit
                                                <i class="fa-solid fa-pen"></i></button>

                                        </li>

                                        <form action="{{ route('videos.destroy', ['video' => $video]) }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('DELETE')
                                            <li
                                                class=" w-full text-red-600 hover:bg-red-600 hover:text-white flex justify-between items-center">
                                                <button type="submit"
                                                    class="video-menu-item  p-2 w-full  flex justify-between items-center">
                                                    Delete
                                                    <i class="fa-solid fa-trash-can ml-2"></i>
                                                </button>
                                            </li>
                                        </form>
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
        </div>

        {{-- Pop up Video Edit Form --}}
        <div
            class="edit-video-pop-up hidden  bg-black/30 backdrop-blur-sm w-full h-[105vh] fixed top-[-8vh] left-0 z-50 flex justify-center items-center shadow-md">
            <div class="w-full   rounded-md bg-[#172868] max-w-[500px]">
                <div class="text-white flex justify-end items-center p-3">
                    <button class="video-edit-close-btn hover:scale-125 transition-all ease-in">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <div class="sm:mx-auto sm:w-full sm:max-w-sm">
                    <a href="/">
                        <img class="mx-auto h-10 w-auto"
                            src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="Your Company">
                    </a>

                    <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-200">
                        Edit video information
                    </h2>
                </div>

                <div class="mt-5 sm:mx-auto sm:w-full sm:max-w-sm  pb-10">
                    {{-- ? here form start --}}

                    <form method="POST" enctype="multipart/form-data" class="space-y-5">
                        @csrf
                        @method('PATCH')

                        {{-- Title field --}}
                        <x-formComponents.form-field>
                            <x-formComponents.form-label for="title">Title</x-formComponents.form-label>
                            <x-formComponents.form-input type="text" id="edit-title" name="title"
                                placeholder="Video title" required
                                value="{{ $video->title }}"></x-formComponents.form-input>
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



                    {{-- ? here form ends --}}

                </div>
            </div>
        </div>
        {{--  --}}

        {{-- Pop Up Add to list feature --}}
        <div
            class="add-to-playlist-pop-up hidden bg-black/30 backdrop-blur-sm w-full h-[105vh] fixed top-[-8vh] left-0 z-50 flex justify-center items-center shadow-md">
            <div class="bg-[#172868] rounded-lg  shadow-lg mx-auto max-w-[500px] min-w-[500px]">
                <div class="text-white flex justify-end items-center p-3">
                    <button class="addTo-close-btn hover:scale-125 transition-all ease-in">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <div class="sm:mx-auto sm:w-full sm:max-w-sm ">
                    <a href="/">
                        <img class="mx-auto h-10 w-auto"
                            src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="Your Company">
                    </a>

                    {{-- <h2 class="mt-10 text-center text-2xl  leading-9 tracking-tight text-gray-200">
                Select Playlist
            </h2> --}}
                </div>
                {{-- ? form start --}}
                <form action="" method="POST" enctype="multipart/form-data"
                    class="bg-[#172868] rounded-lg  shadow-lg mx-auto max-w-[500px] min-w-[500px] ">
                    @csrf

                    <div class="p-10 space-y-5">
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
                        <x-formComponents.form-button type='submit'>Add To</x-formComponents.form-button>
                        <p>{{ $selectedPlaylist }}</p>
                    </div>

                </form>
                {{-- ? form end --}}
            </div>
        </div>
        {{--  --}}
        {{-- pop up notification --}}
        @session('success')
            <x-notificationCards.notif-success>{{ session('success') }}</x-notificationCards.notif-success>
        @endsession

        @session('error')
            <x-notificationCards.notif-error>{{ session('error') }}</x-notificationCards.notif-error>
        @endsession



    </div>




</div>

<script>
    // popup show and hide events using click event
    //upload popUp
    const uploadPopUp = document.querySelector('.upload-pop-up');
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
    // edit video popUp 
    const editVideoPopUp = document.querySelector('.edit-video-pop-up')
    const videoEditOpenBtns = document.querySelectorAll('.video-edit-open-btn')
    const videoEditCloseBtn = document.querySelector('.video-edit-close-btn')
    const videoEditTitle = document.getElementById('edit-title');
    const videoEditDuration = document.getElementById('edit-duration');

    videoEditOpenBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            console.log('clicked')

            const videoId = this.getAttribute('data-id');
            console.log(videoId);
            console.log(this.getAttribute('data-title'))

            videoEditTitle.value = this.getAttribute('data-title');;
            videoEditDuration.value = this.getAttribute('data-duration');

            editVideoPopUp.action = `{{ route('videos.update', ['video' => 12]) }}`;

            document.body.style.overflow = 'hidden';
            editVideoPopUp.classList.remove('hidden');
        });
    });

    videoEditCloseBtn.addEventListener('click', function() {
        document.body.style.overflow = 'visible';
        editVideoPopUp.classList.add('hidden');
    })

    // Add video to playlist Popup
    const addToPlaylistPopUp = document.querySelector('.add-to-playlist-pop-up');
    const addToOpenBtns = document.querySelectorAll('.addTo-open-btn')
    console.log(addToOpenBtns)
    const addToCloseBtn = document.querySelector('.addTo-close-btn').addEventListener('click', hideAddToPlaylistPopUp);


    addToOpenBtns.forEach(btn => {
        btn.addEventListener('click', showAddToPlaylistPopUp);
    })

    function showAddToPlaylistPopUp() {
        console.log('clicked')
        document.body.style.overflow = 'hidden';
        addToPlaylistPopUp.classList.remove('hidden');
    }

    function hideAddToPlaylistPopUp() {
        document.body.style.overflow = 'visible';
        addToPlaylistPopUp.classList.add('hidden');
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

    // notification timeout
    document.addEventListener('DOMContentLoaded', function() {
        const notifications = document.querySelectorAll('.notif-card');
        notifications.forEach(notif => {
            setTimeout(function() {
                if (notif) {
                    notif.classList.add('hidden');
                }
            }, 4000);
        });
    })
</script>
