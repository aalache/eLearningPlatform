<x-page-layout>
    {{-- ! visible page --}}
    <section class=" h-auto bg-white min-h-full ">

        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden  sm:rounded-lg">
                    {{-- ? nav menu (go back | edit | delete ) --}}
                    <div class="px-6 w-full flex justify-between items-center mb-4">
                        <a href="{{ route('coach.myplaylists') }}" class="text-gray-600 hover:text-blue-600">
                            <i class="fa-solid fa-arrow-left"></i> Go Back
                        </a>
                        <div>
                            <button
                                class="add-to-course-open-btn bg-white py-1.5 px-3 rounded-md text-gray-600 hover:text-blue-600">
                                <i class="text-sm fa-solid fa-plus"></i> Add To Course
                            </button>
                            <button
                                class="remove-from-course-open-btn bg-white py-1.5 px-3 rounded-md text-gray-600 hover:text-blue-600">
                                <i class="text-sm fa-solid fa-minus"></i> Remove From Course
                            </button>
                            <button
                                class="edit-playlist-open-btn bg-white py-1.5 px-3 rounded-md text-gray-600 hover:text-blue-600">
                                <i class="text-sm fa-solid fa-pen"></i> Edit
                            </button>
                            <button
                                class="delete-playlist-open-btn bg-white py-1.5 px-1 rounded-md text-gray-600 hover:text-red-600  ">
                                <i class="text-sm fa-solid fa-trash-can ml-2"></i> Delete
                            </button>
                        </div>
                    </div>
                    {{-- ? --}}
                    @if ($videoToDisplay)
                        <div class="p-6 text-gray-900 grid grid-cols-6 gap-2 ">
                            {{-- ? Video section --}}
                            <div class="col-span-4 space-y-5">
                                <video class="lesson rounded-md w-full bg-gray-600 " controls muted>
                                    <source src="{{ asset('upload/videos/' . $videoToDisplay->video) }}"
                                        type="video/mp4" />
                                </video>
                                <div class="flex items-center justify-between">
                                    <p class="border-l-4 border-blue-600 px-2 text-lg text-black">
                                        {{ $videoToDisplay->title }}
                                    </p>
                                    <button
                                        class="remove-from-playlist-open-btn bg-white py-1.5 px-1 rounded-md text-gray-600 hover:text-red-600">
                                        <i class="text-sm fa-solid fa-trash-can ml-2"></i> Remove from Playlist
                                    </button>
                                </div>
                            </div>
                            {{-- ? --}}
                            {{-- ? Playlist section --}}
                            <div class="col-span-2 p-4 space-y-5">
                                <div class="bg-white rounded-md ">
                                    <h2 class="text-2xl border-l-4 border-blue-600 px-2  text-gray-900">
                                        {{ $playlist->name }}
                                    </h2>
                                </div>

                                <ul class="  mx-[-1px] space-y-0 ">
                                    @foreach ($playlist->videos as $video)
                                        <x-courseComponents.playlist-item
                                            href="{{ route('coach.viewplaylist', ['playlist' => $playlist, 'video' => $video]) }}"
                                            :videoTitle="$video->title" :video="$video" :playlist="$playlist" />
                                    @endforeach

                                </ul>
                            </div>
                            {{-- ? --}}
                        </div>
                    @else
                        <div class="w-full p-5 space-y-8">
                            <div class="bg-white rounded-md ">
                                <h2 class="text-2xl border-l-4 border-blue-600 px-2  text-gray-900">
                                    {{ $playlist->name }}
                                </h2>
                            </div>
                            <div class="rounded-lg w-full  bg-orange-100 p-3 shadow-sm">

                                <p class="text-lg  text-orange-400   ">
                                    No video available to play :(
                                </p>
                            </div>
                        </div>
                    @endif


                </div>
            </div>
    </section>
    {{-- ! end --}}




    {{-- ? ########## Add To course form ############## --}}
    <x-formComponents.popup-form id="add-to-course-form">
        <x-slot:closeBtn>
            <button class="add-to-course-close-btn hover:scale-125 transition-all ease-in">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </x-slot:closeBtn>


        {{-- here form start --}}
        <form action="{{ route('playlists.addToCourse', ['playlist' => $playlist]) }}" method="POST"
            enctype="multipart/form-data" class="space-y-5">
            @csrf
            <select name="course_id" id="course_id"
                class="w-full rounded-md border-0  text-gray-200 shadow-sm  placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6  px-3 py-2.5 focus-visible:outline-dashed focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-400 backdrop-blur-sm bg-gray-300/20 p-2">
                @if ($courses->isNotEmpty())
                    @foreach ($courses as $course)
                        <option value="{{ $course->id }}">{{ $course->name }}</option>
                    @endforeach
                @else
                    <option value=""> No playlist available</option>
                @endif
            </select>
            <x-formComponents.form-button type='submit'>Add To Course</x-formComponents.form-button>

        </form>
        {{-- here form ends --}}
    </x-formComponents.popup-form>
    {{-- ? -------------------- end --}}


    {{-- ? ########## Remove From Course form ############## --}}
    <x-formComponents.popup-form id="remove-from-course-form">
        <x-slot:closeBtn>
            <button class="remove-from-course-close-btn hover:scale-125 transition-all ease-in">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </x-slot:closeBtn>
        {{-- here form start --}}
        <form action="{{ route('coach.playlist.removeFromCourse', ['playlist' => $playlist]) }}" method="POST"
            enctype="multipart/form-data" class="space-y-5">
            @csrf
            <select name="course_id" id="course_id"
                class="w-full rounded-md border-0  text-gray-200 shadow-sm  placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6  px-3 py-2.5 focus-visible:outline-dashed focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-400 backdrop-blur-sm bg-gray-300/20 p-2">
                @if ($coursesContainingPlaylist->isNotEmpty())
                    @foreach ($coursesContainingPlaylist as $course)
                        <option value="{{ $course->id }}">{{ $course->name }}</option>
                    @endforeach
                @else
                    <option value=""> No playlist available</option>
                @endif
            </select>
            <x-formComponents.form-button type='submit'>Remove From Course</x-formComponents.form-button>

        </form>
        {{-- here form ends --}}
    </x-formComponents.popup-form>
    {{-- ? -------------------- end --}}


    {{-- ? edit playlist form --}}
    <x-formComponents.popup-form id="edit-playlist-form">
        <x-slot:closeBtn>
            <button class="edit-playlist-close-btn hover:scale-125 transition-all ease-in">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </x-slot:closeBtn>
        {{-- here form start --}}
        <form action="{{ route('playlists.update', ['playlist' => $playlist->id]) }}" method="POST"
            enctype="multipart/form-data" class="space-y-5">
            @csrf
            @method('PATCH')

            {{-- playlist name field --}}
            <x-formComponents.form-field>
                <label for="name" class="text-white text-sm">Playlist Name</label>
                <x-formComponents.form-input type="text" id="name" name="name" placeholder="playlist name"
                    value="{{ $playlist->name }}" required></x-formComponents.form-input>
                <x-formComponents.form-error name="name" />
            </x-formComponents.form-field>

            {{--  Edit button --}}
            <x-formComponents.form-button>Edit</x-formComponents.form-button>

        </form>
        {{-- here form ends --}}
    </x-formComponents.popup-form>
    {{-- ? edit form end --}}

    {{-- ? delete form start --}}
    <x-formComponents.popup-form id="delete-playlist-form">
        <x-slot:closeBtn>
            <button class="delete-playlist-close-btn hover:scale-125 transition-all ease-in">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </x-slot:closeBtn>
        {{-- form start --}}
        <form action="{{ route('playlists.destroy', ['playlist' => $playlist->id]) }}" method="POST"
            enctype="multipart/form-data" class="space-y-5">
            @csrf
            @method('DELETE')

            {{-- playlist name field --}}
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
        {{-- form end --}}
    </x-formComponents.popup-form>
    {{-- ? delete form end --}}

    {{-- ? remove from playlist Form start --}}
    @if ($videoToDisplay)
        <x-formComponents.popup-form id="remove-from-playlist-form">
            <x-slot:closeBtn>
                <button class="remove-from-playlist-close-btn hover:scale-125 transition-all ease-in">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </x-slot:closeBtn>
            {{-- form start --}}
            <form
                action="{{ route('videos.removeFromPlaylist', ['playlist' => $playlist, 'video' => $videoToDisplay]) }}"
                method="POST" enctype="multipart/form-data" class="space-y-5">
                @csrf

                {{-- playlist name field --}}
                <x-formComponents.form-field>
                    <label for="name" class="text-white text-sm">
                        Type the video name <strong>{{ $videoToDisplay->title }}</strong> to confirm removing:
                    </label>
                    <x-formComponents.form-input type="text" id="confirm-remove" name="confirm-remove"
                        placeholder="'{{ $videoToDisplay->title }}'" required></x-formComponents.form-input>
                    <x-formComponents.form-error name="confirm-remove" />
                </x-formComponents.form-field>

                {{--  Edit button --}}
                <x-formComponents.form-button>Remove Video</x-formComponents.form-button>

            </form>
            {{-- form end --}}
        </x-formComponents.popup-form>
    @endif
    {{-- ? remove from playlist Form  end --}}

    {{-- notifications --}}
    @session('success')
        <x-notificationCards.notif-success>{{ session('success') }}</x-notificationCards.notif-success>
    @endsession
    @session('error')
        <x-notificationCards.notif-error>{{ session('error') }}</x-notificationCards.notif-error>
    @endsession



</x-page-layout>



<script>
    /**
     * Add To Course pop Up form handling
     */
    const addToCourseForm = document.getElementById('add-to-course-form');
    document.querySelector('.add-to-course-open-btn').addEventListener('click', showAddToCourseForm);
    document.querySelector('.add-to-course-close-btn').addEventListener('click', hideAddToCourseForm);;

    function showAddToCourseForm() {
        document.body.overflow = "hidden";
        addToCourseForm.classList.remove('hidden');
    }

    function hideAddToCourseForm() {
        document.body.overflow = "visible";
        addToCourseForm.classList.add('hidden');
    }
    /**
     *  Remove From Course pop Up form handling
     */
    const removeFromCourseForm = document.getElementById('remove-from-course-form');
    document.querySelector('.remove-from-course-open-btn').addEventListener('click', showRemoveFromCourseForm);
    document.querySelector('.remove-from-course-close-btn').addEventListener('click', hideRemoveFromCourseForm);;

    function showRemoveFromCourseForm() {
        document.body.overflow = "hidden";
        removeFromCourseForm.classList.remove('hidden');
    }

    function hideRemoveFromCourseForm() {
        document.body.overflow = "visible";
        removeFromCourseForm.classList.add('hidden');
    }
    /**
     * Edit pop Up form handling
     */
    const editPlaylistForm = document.getElementById('edit-playlist-form');
    document.querySelector('.edit-playlist-open-btn').addEventListener('click', showEditPlaylistForm);
    document.querySelector('.edit-playlist-close-btn').addEventListener('click', hideEditPlaylistForm);;

    function showEditPlaylistForm() {
        document.body.overflow = "hidden";
        editPlaylistForm.classList.remove('hidden');
    }

    function hideEditPlaylistForm() {
        document.body.overflow = "visible";
        editPlaylistForm.classList.add('hidden');
    }

    /**
     * Delete pop Up form handling
     */
    const deletePlaylistForm = document.getElementById('delete-playlist-form');
    document.querySelector('.delete-playlist-open-btn').addEventListener('click', showDeletePlaylistForm);
    document.querySelector('.delete-playlist-close-btn').addEventListener('click', hideDeletePlaylistForm);;

    function showDeletePlaylistForm() {
        document.body.overflow = "hidden";
        deletePlaylistForm.classList.remove('hidden');
    }

    function hideDeletePlaylistForm() {
        document.body.overflow = "visible";
        deletePlaylistForm.classList.add('hidden');
    }

    /**
     * Remove from playlist form 
     */
    const removeFromPlaylistForm = document.getElementById('remove-from-playlist-form');
    document.querySelector('.remove-from-playlist-open-btn').addEventListener('click', showRemoveFromPlaylistForm);
    document.querySelector('.remove-from-playlist-close-btn').addEventListener('click', hideRemoveFromPlaylistForm);

    function showRemoveFromPlaylistForm() {
        document.body.overflow = "hidden";
        removeFromPlaylistForm.classList.remove('hidden');
    }

    function hideRemoveFromPlaylistForm() {
        document.body.overflow = "visible";
        removeFromPlaylistForm.classList.add('hidden');
    }
</script>
<script src="{{ asset('js/notif.js') }}"></script>
