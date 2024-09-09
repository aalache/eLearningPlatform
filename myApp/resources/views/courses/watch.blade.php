@php
    use App\Models\Course;
    use App\Models\Playlist;
    use App\Models\VideoProgress;
    use App\Http\Controllers\CourseController;

@endphp
<x-page-layout>

    <div class=" max-w-7xl mx-auto md:px-3 sm:px-6 lg:px-6  py-4  overflow-hidden  sm:rounded-lg min-h-full">

        <div class=" flex justify-between items-baseline">
            @if (request()->routeIs('coach.*'))
                <a href="{{ url()->route('coach.courses.index') }}"
                    class=" hover:bg-white/15 hover:shadow-md py-2 px-4 rounded-md text-gray-400 hover:text-gray-200 font-semibold">
                    <i class="fa-solid fa-arrow-left text-orange-600"></i> Go Back
                </a>
            @else
                <a href="{{ url()->route('user.courses.index') }}"
                    class=" hover:bg-white/15 hover:shadow-md py-2 px-4 rounded-md text-gray-400 hover:text-gray-200 font-semibold">
                    <i class="fa-solid fa-arrow-left text-orange-600"></i> Go Back
                </a>
            @endif

            @if (Auth::user()->hasRole('instructor') && request()->routeIs('coach.*'))
                <div class="flex items-center space-x-2">
                    <button title="Edit course"
                        class="edit-course-open-btn flex justify-between items-center space-x-1 hover:bg-white/15 py-2 px-3 rounded-md text-gray-400 font-semibold hover:text-gray-200">
                        <i class="text-sm fa-solid fa-pen text-orange-600"></i> <span class="hidden md:flex">Edit
                            Course</span>
                    </button>
                    <button title="Delete course"
                        class="delete-course-open-btn flex justify-between items-center space-x-1  hover:bg-white/15 py-2 px-3 rounded-md text-gray-400 font-semibold hover:text-gray-200">
                        <i class="text-sm fa-solid fa-trash-can text-orange-600"></i> <span
                            class="hidden md:flex">Delete Course</span>
                    </button>
                </div>
            @endif

        </div>
        <div class=" space-y-10 px-2">
            <div class="mt-7 space-y-2">
                <p
                    class="text-white font-semibold border-l-4 border-orange-600 px-2 tracking-light text-4xl  leading-tight">
                    {{ $course->name }}
                </p>
                <p class="text-gray-400 px-3 border-l-4 border-gray-400 font-semibold text-lg leading-normal">
                    By: {{ $course->user->name }}
                </p>
            </div>
            <div class="h-full  w-full grid gap-y-5 xl:gap-3  grid-cols-6 ">
                @if ($videoToDisplay)
                    {{-- Video Section --}}
                    <div class="col-span-full xl:col-span-4 space-y-5 ">
                        <iframe id="video-{{ $videoToDisplay->id }}" data-user-id="{{ auth()->user()->id }}"
                            data-video-id="{{ $videoToDisplay->id }}"
                            class="lesson rounded-md w-full bg-gray-600 shadow-lg h-[450px]"
                            src="{{ str_replace('watch?v=', 'embed/', $videoToDisplay->youtube_url) }}?enablejsapi=1"
                            frameborder="0" allowfullscreen></iframe>

                        <h4 class="text-xl text-gray-400 font-semibold border-l-4 border-orange-600 px-2">
                            {{ $videoToDisplay->title }}</h4>
                    </div>
                    {{--  --}}
                    {{-- Playlists Section --}}
                    <div class=" col-span-full xl:col-span-2 space-y-3  h-full overflow-y-scroll">
                        @foreach ($course->playlists as $playlist)
                            @php
                                $playlist = Playlist::with('videos')->find($playlist->id);
                            @endphp

                            {{-- ? Playlist section --}}
                            <div class="col-span-2 p-4 space-y-5 bg-black/50 rounded-md">
                                <div class="playlist group w-full flex justify-between items-center  ">
                                    <h2
                                        class="text-md lg:text-lg text-gray-300 font-semibold border-l-4 border-orange-600 px-2">
                                        {{ $playlist->name }}
                                    </h2>
                                    <i class="fa-solid fa-angle-right text-orange-600 group-hover:rotate-90"></i>
                                </div>

                                <ul style="display: block" class="list-items   mx-[-1px] space-y-0 ">

                                    @if (request()->routeIs('coach.*'))
                                        @foreach ($playlist->videos as $video)
                                            <x-courseComponents.playlist-item id="link-{{ $video->id }}"
                                                href="{{ route('coach.courses.watch', ['course' => $course, 'video' => $video]) }}"
                                                :videoTitle="$video->title" :video="$video" :course="$course" />
                                        @endforeach
                                    @endif

                                    @if (request()->routeIs('user.*'))
                                        @foreach ($playlist->videos as $video)
                                            <x-courseComponents.playlist-item id="link-{{ $video->id }}"
                                                href="{{ route('user.courses.watch', ['course' => $course, 'video' => $video]) }}"
                                                :videoTitle="$video->title" :video="$video" :course="$course" />
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                            {{-- ? --}}
                        @endforeach
                    </div>
                    {{--  --}}
                    {{-- comment form section --}}
                    <div class="col-span-full xl:col-span-4 space-y-2 mt-6 px-0">
                        <h2 class="font-semibold text-gray-300">
                            {{ $videoToDisplay->comments->where('course_id', $course->id)->count() }} Comments</h2>
                        <form method="POST"
                            action="{{ route('user.courses.comments.store', ['course' => $course, 'video' => $videoToDisplay]) }}"
                            class="flex flex-col sm:flex-row justify-between items-center space-y-2 sm:space-x-2">
                            @csrf
                            <div class="w-full">
                                <x-formComponents.form-textarea id="comment" name="comment"
                                    placeholder="Leave a comment..." required class="bg-black/40 text-gray-300 " />
                                <x-formComponents.form-error name="comment" />
                            </div>
                            <x-formComponents.form-button type="submit" class="w-full sm:max-w-32">Add
                                comment</x-formComponents.form-button>
                        </form>
                    </div>
                    {{--  --}}
                    {{-- comments section --}}
                    <div class="col-span-full xl:col-span-4 space-y-2 mt-6 ">
                        @foreach ($videoToDisplay->comments()->where('course_id', $course->id)->with('user')->latest()->take(20)->get() as $comment)
                            <div class="bg-black/70 p-3 rounded-md flex space-x-4 shadow-md">
                                <div class="space-y-2">
                                    <img src="{{ $comment->user->profile_picture }}" alt=""
                                        class="w-16 h-16 rounded-lg object-cover">
                                </div>
                                <div class="space-y-2">
                                    <div class="space-y-1">
                                        <h2 class="text-gray-300 text-sm font-semibold ">@ {{ $comment->user->name }}
                                        </h2>
                                        <p class="text-orange-600 text-xs">Posted
                                            {{ $comment->updated_at->diffForHumans() }}
                                        </p>
                                    </div>
                                    <p class="text-gray-400 text-sm font-medium">{{ $comment->content }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    {{--  --}}
                @else
                    <div class="rounded-lg col-span-6  bg-orange-600/30 p-3 shadow-sm">

                        <p class="text-lg  text-orange-500   ">
                            No video available to play :(
                        </p>
                    </div>
                @endif
            </div>
            {{--  --}}
        </div>
    </div>
    {{--  --}}


    {{-- notifications --}}
    @if (session('success'))
        <x-notificationCards.notif-success>{{ session('success') }}</x-notificationCards.notif-success>
    @endif

    @if (session('error'))
        <x-notificationCards.notif-error>{{ session('error') }}</x-notificationCards.notif-error>
    @endif

</x-page-layout>

{{-- ? Edit Course PopUp form --}}
<x-formComponents.popup-form id="edit-course-form">
    <x-slot:closeBtn>
        <button class="edit-course-close-btn hover:scale-125 transition-all ease-in">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </x-slot:closeBtn>

    {{--  here form start --}}
    <form action="{{ route('coach.courses.update', ['course' => $course, 'video' => $videoToDisplay]) }}"
        method="POST" enctype="multipart/form-data" class="space-y-5 min-w-screen-md grid grid-cols-2 gap-x-2">
        @csrf
        @method('PATCH')

        {{-- Course name field --}}
        <x-formComponents.form-field>
            <x-formComponents.form-label for="name">Name</x-formComponents.form-label>
            <x-formComponents.form-input type="text" id="name" name="name" placeholder="course_name"
                value="{{ $course->name }}" required></x-formComponents.form-input>
            <x-formComponents.form-error name="name" />
        </x-formComponents.form-field>

        {{-- duration field --}}
        <x-formComponents.form-field>
            <x-formComponents.form-label for="duration">Duration</x-formComponents.form-label>
            <x-formComponents.form-input type="number" id="duration" name="duration" placeholder="10 weeks"
                value="{{ $course->duration }}" required></x-formComponents.form-input>
            <x-formComponents.form-error name="duration" />
        </x-formComponents.form-field>

        {{-- level field --}}
        <x-formComponents.form-field>
            <x-formComponents.form-label for="level">Level</x-formComponents.form-label>
            <x-formComponents.form-input type="text" id="level" name="level" placeholder="easy"
                value="{{ $course->level }}" required></x-formComponents.form-input>
            <x-formComponents.form-error name="level" />
        </x-formComponents.form-field>

        {{-- Categorie field --}}
        <x-formComponents.form-field>
            <x-formComponents.form-label for="category">Category</x-formComponents.form-label>
            <x-formComponents.form-input type="text" id="category" name="category" placeholder="IT"
                value="{{ $course->category }}" required></x-formComponents.form-input>
            <x-formComponents.form-error name="category" />
        </x-formComponents.form-field>

        {{-- price field --}}
        <x-formComponents.form-field>
            <x-formComponents.form-label for="price">Price</x-formComponents.form-label>
            <x-formComponents.form-input type="number" id="price" name="price" placeholder="$99,99"
                value="{{ $course->price }}" required></x-formComponents.form-input>
            <x-formComponents.form-error name="price" />
        </x-formComponents.form-field>

        {{-- image file upload field --}}
        <x-formComponents.form-field>
            <x-formComponents.form-label for="image">Thumbnail</x-formComponents.form-label>
            <x-formComponents.form-input type="file" id="image" name="image"></x-formComponents.form-input>
            <!-- Show the name of the previously uploaded file, if it exists -->
            @if ($course->image)
                <p class="text-sm text-gray-500 px-3">Current file: {{ $course->image }}</p>
            @endif
            <x-formComponents.form-error name="image" />
        </x-formComponents.form-field>

        {{-- Description field --}}
        <x-formComponents.form-field class=" col-span-2">
            <x-formComponents.form-label for="description">
                Description</x-formComponents.form-label>
            <x-formComponents.form-textarea id="description" name="description" placeholder="course_description"
                required>{{ $course->description }}</x-formComponents.form-textarea>
            <x-formComponents.form-error name="description" />
        </x-formComponents.form-field>

        {{--  update button --}}
        <div class=" col-span-2">
            <x-formComponents.form-button>Update</x-formComponents.form-button>
        </div>

    </form>
    {{-- here form ends --}}

</x-formComponents.popup-form>
{{-- ? --}}

{{-- ? Delete Course PopUp form --}}
<x-formComponents.popup-form id="delete-course-form">
    <x-slot:closeBtn>
        <button class="delete-course-close-btn hover:scale-125 transition-all ease-in">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </x-slot:closeBtn>
    {{-- form start --}}
    <form id="delete-form" method="POST" action="{{ route('coach.courses.destroy', ['course' => $course]) }}"
        class="space-y-5">
        @csrf
        @method('DELETE')
        {{-- playlist name delete confirmation field --}}
        <x-formComponents.form-field>
            <x-formComponents.form-label for="confirm-deletion" class="text-sm">
                Type the course name <strong>{{ $course->name }}</strong> to confirm deletion:
            </x-formComponents.form-label>
            <x-formComponents.form-input type="text" id="confirm-deletion" name="confirm-deletion"
                placeholder="'{{ $course->name }}'" required></x-formComponents.form-input>
            <x-formComponents.form-error name="confirm-deletion" />
        </x-formComponents.form-field>

        <x-formComponents.form-button type='submit'>Delete Course</x-formComponents.form-button>
    </form>
</x-formComponents.popup-form>


{{-- scripts --}}
<script src="{{ asset('js/notif.js') }}"></script>
<script src="https://www.youtube.com/iframe_api"></script>
<script>
    let initialScrollPosition;
    /**
     * Edit course Form 
     */
    const editCourseForm = document.getElementById('edit-course-form');
    document.querySelector('.edit-course-open-btn').addEventListener('click', showEditCourseForm);

    document.querySelector('.edit-course-close-btn').addEventListener('click', hideEditCourseForm);


    function showEditCourseForm() {
        document.body.style.overflow = 'hidden';
        initialScrollPosition = window.scrollY;
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
        setTimeout(() => {
            editCourseForm.classList.remove('hidden');
        }, 300);
    }

    function hideEditCourseForm() {
        document.body.style.overflow = 'visible';
        window.scrollTo({
            top: initialScrollPosition,
            behavior: 'smooth'
        });
        editCourseForm.classList.add('hidden');
    }
    /**
     * Delete course pop Up form handling
     */
    const deleteCourseForm = document.getElementById('delete-course-form');
    document.querySelector('.delete-course-open-btn').addEventListener('click', showDeleteCourseForm);
    document.querySelector('.delete-course-close-btn').addEventListener('click', hideDeleteCourseForm);;

    function showDeleteCourseForm() {
        document.body.overflow = "hidden";
        initialScrollPosition = window.scrollY;
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
        setTimeout(() => {
            deleteCourseForm.classList.remove('hidden');
        }, 300);
    }

    function hideDeleteCourseForm() {
        document.body.overflow = "visible";
        window.scrollTo({
            top: initialScrollPosition,
            behavior: 'smooth'
        });
        deleteCourseForm.classList.add('hidden');
    }

    // video Tracking
    var player;

    function onYouTubeIframeAPIReady() {
        player = new YT.Player('video-' + @json($videoToDisplay->id), {
            events: {
                'onStateChange': onPlayerStateChange
            }
        });
    }

    function onPlayerStateChange(event) {
        console.log('function called');
        if (event.data === YT.PlayerState.ENDED) {
            console.log('video ended successfuly');
            const videoElement = document.getElementById('video-' + @json($videoToDisplay->id))
            markVideoAsCompleted(videoElement);
        }
    }
</script>
