@php
    use App\Models\Course;
    use App\Models\Playlist;
    use App\Models\VideoProgress;
    use App\Http\Controllers\CourseController;

@endphp
<x-page-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{-- header --}}
                    <div class="p-4 text-gray-900 space-y-6">

                        <div class=" flex justify-between  items-baseline">
                            <div class="flex min-w-72 flex-col space-y-1">
                                <p class="text-[#0d151c] tracking-light text-[32px]  leading-tight">{{ $course->name }}
                                </p>
                                <p class="text-[#49779c] text-sm font-normal leading-normal">By:
                                    {{ $course->user->name }}
                                </p>
                            </div>
                            @if (Auth::user()->hasRole('instructor') && request()->routeIs('coach.*'))
                                <div>
                                    <button
                                        class="edit-course-open-btn  py-1.5 hover:bg-[#efefef] px-1 rounded-md text-gray-600 hover:text-blue-600">
                                        <i class="text-sm fa-solid fa-pen p-1.5"></i>Edit Course
                                    </button>
                                    <button
                                        class="delete-course-open-btn  py-1.5 hover:bg-[#efefef] px-1 rounded-md text-gray-600 hover:text-red-600">
                                        <i class="text-sm fa-solid fa-trash-can p-1.5"></i>Delete Course
                                    </button>
                                </div>
                            @endif
                        </div>

                        <div
                            class="h-full  w-full grid gap-3  sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4  xl:grid-cols-6 ">
                            @if ($videoToDisplay)
                                {{-- Video Section --}}
                                <div class="col-span-4 space-y-3 ">
                                    <video id="video-{{ $videoToDisplay->id }}" data-user-id="{{ auth()->user()->id }}"
                                        data-video-id="{{ $videoToDisplay->id }}"
                                        class="lesson rounded-md w-full bg-gray-600 shadow-lg" controls muted>
                                        <source src="{{ asset('upload/videos/' . $videoToDisplay->video) }}"
                                            type="video/mp4" />
                                    </video>
                                    <h4 class="text-xl text-black px-2">{{ $videoToDisplay->title }}</h4>
                                </div>
                                {{--  --}}
                                {{-- Playlists Section --}}
                                <div class="col-span-2 space-y-3 px-4">
                                    @foreach ($course->playlists as $playlist)
                                        @php
                                            $playlist = Playlist::with('videos')->find($playlist->id);
                                        @endphp

                                        {{-- ? Playlist section --}}
                                        <div class="col-span-2 p-4 space-y-5">
                                            <div
                                                class="playlist group w-full flex justify-between items-center bg-white rounded-md ">
                                                <h2 class="text-md border-l-4 border-blue-600 px-2  text-gray-900">
                                                    {{ $playlist->name }}
                                                </h2>
                                                <i class="fa-solid fa-angle-right group-hover:rotate-90"></i>
                                            </div>

                                            <ul class="list-items hidden  mx-[-1px] space-y-0 ">

                                                @if (request()->route('coach.*'))
                                                    @foreach ($playlist->videos as $video)
                                                        <x-courseComponents.playlist-item id="link-{{ $video->id }}"
                                                            href="{{ route('coach.courses.watch', ['course' => $course, 'video' => $video]) }}"
                                                            :videoTitle="$video->title" :video="$video" :course="$course" />
                                                    @endforeach
                                                @endif
                                                @if (request()->route('user.*'))
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
                            @else
                                <p class="text-lg text-gray-500 w-[300px]  ">No video available to play :(
                                </p>
                            @endif
                            {{--  --}}


                        </div>
                        {{--  --}}
                    </div>
                </div>
            </div>
        </div>

        {{-- notifications --}}
        @session('success')
            <x-notificationCards.notif-success>{{ session('success') }}</x-notificationCards.notif-success>
        @endsession
        @session('error')
            <x-notificationCards.notif-error>{{ session('error') }}</x-notificationCards.notif-error>
        @endsession

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
        method="POST" class="space-y-5 min-w-screen-md grid grid-cols-2 gap-x-2">
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
                <p class="text-sm text-gray-400 px-3">Current file: {{ $course->image }}</p>
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
            <label for="confirm-deletion" class="text-white text-sm">
                Type the course name <strong>{{ $course->name }}</strong> to confirm deletion:
            </label>
            <x-formComponents.form-input type="text" id="confirm-deletion" name="confirm-deletion"
                placeholder="'{{ $course->name }}'" required></x-formComponents.form-input>
            <x-formComponents.form-error name="confirm-deletion" />
        </x-formComponents.form-field>

        <x-formComponents.form-button type='submit'>Delete Course</x-formComponents.form-button>
    </form>
</x-formComponents.popup-form>


{{-- scripts --}}
<script src="{{ asset('js/notif.js') }}"></script>
<script>
    /**
     * Edit course Form 
     */
    const editCourseForm = document.getElementById('edit-course-form');
    document.querySelector('.edit-course-open-btn').addEventListener('click', showEditCourseForm);
    document.querySelector('.edit-course-close-btn').addEventListener('click', hideEditCourseForm);


    function showEditCourseForm() {
        document.body.style.overflow = 'hidden';
        editCourseForm.classList.remove('hidden');
    }

    function hideEditCourseForm() {
        document.body.style.overflow = 'visible';
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
        deleteCourseForm.classList.remove('hidden');
    }

    function hideDeleteCourseForm() {
        document.body.overflow = "visible";
        deleteCourseForm.classList.add('hidden');
    }
</script>
