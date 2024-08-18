@props(['myVideos'])



<div class="py-4  max-w-7xl mx-auto sm:px-6 lg:px-8">

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg  p-6 text-gray-900 space-y-12">

        <div class="space-y-5 ">
            <h1 class="text-black text-3xl ">My Videos</h1>

            <div class="border border-gray-500/30 rounded-md p-4 flex justify-between items-center">
                <div>
                    <h3 class="text-md text-black">You don't have any videos uploaded yet</h3>
                    <p class=" text-sm text-gray-600">Upload your first video to get started</p>
                </div>
                <button class="open-btn bg-blue-500 hover:bg-blue-700 hover:shadow-md py-2 px-4 rounded-md text-white ">
                    Upload Video
                </button>
            </div>
        </div>

        {{-- Hidden video upload pop up form --}}
        <div
            class="pop-up bg-black/30 backdrop-blur-sm w-full h-[105vh] fixed top-[-8vh] left-0 z-50 flex justify-center items-center hidden">
            <div id="video-upload-form" class="rounded-md bg-[#172868]  max-w-[500px] ">
                <div class="text-white flex justify-end items-center p-3">
                    <button class="close-btn hover:scale-125 transition-all ease-in"><i
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
                        class="space-y-5 max-w-[400px] mx-auto">
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
                                        Uploaded on {{ $video->updated_at->format('M d,Y') }}
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
                                        <a href="">
                                            <li
                                                class="video-menu-item p-2 w-full text-blue-600 hover:bg-blue-600 hover:text-white flex justify-between items-center">
                                                <p>Add To playlist</p>
                                                <i class="fa-solid fa-list-ul"></i>
                                            </li>
                                        </a>
                                        <a href="{{ route('videos.edit', ['video' => $video]) }}">
                                            <li
                                                class="video-menu-item p-2 w-full text-blue-600 hover:bg-blue-600 hover:text-white flex justify-between items-center">
                                                <p>Edit</p>
                                                <i class="fa-solid fa-pen"></i>
                                            </li>
                                        </a>
                                        <a href="{{ route('videos.destroy',['video' => $video]) }}">
                                            <li
                                                class="video-menu-item p-2 w-full text-red-600 hover:bg-red-600 hover:text-white flex justify-between items-center">
                                                <p>Delete</p>
                                                <i class="fa-solid fa-trash-can"></i>
                                            </li>
                                        </a>
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


    </div>




</div>

<script>
    // popup show and hide events using click event
    let popUp = document.querySelector('.pop-up');
    let openBtn = document.querySelector('.open-btn').addEventListener('click', showPopup);
    let closeBtn = document.querySelector('.close-btn').addEventListener('click', hidePopup);

    function showPopup() {
        document.body.style.overflow = 'hidden';
        popUp.classList.remove('hidden');
    }

    function hidePopup() {
        document.body.style.overflow = 'visible';
        popUp.classList.add('hidden');
    }

    // show and hide video menu 
    let videoMenuBtns = document.querySelectorAll('.video-menu-btn');
    let videoMenuBtnClicked = false;
    console.log(videoMenuBtns);
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
