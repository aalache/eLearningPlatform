@props(['courses' => collect()])


<div class=" pb-10 px-3  min-h-[100vh] ">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class=" overflow-hidden shadow-sm sm:rounded-lg">
            {{-- header --}}
            <div class="py-6  text-gray-900 space-y-6  flex justify-between items-center">
                <div class=" space-y-2">
                    <h2 class="border-l-4 px-2 border-orange-600 text-2xl text-[#ffffff] font-semibold "
                        data-aos="fade-right" data-aos-duration="400" data-aos-delay="500">
                        All available courses
                    </h2>
                    <p class="border-l-4 px-2 text-sm font-semibold border-[#efefef]/50 text-[#efefef]/50 "
                        data-aos="fade-right" data-aos-duration="400" data-aos-delay="700">
                        Discover, Curate, Enjoy
                    </p>
                </div>

                <button data-aos="fade-left" data-aos-duration="400" data-aos-delay="800"
                    class="create-course-open-btn flex justify-between items-center md:space-x-1 bg-white/10 py-2 px-3 rounded-md text-white font-semibold hover:bg-black/10 transition ease-in">
                    <i class="text-sm fa-solid fa-plus text-orange-600"></i> <span class="hidden md:flex">
                        Create Course
                    </span>
                </button>
            </div>


            <div class="h-full w-full grid gap-3  sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4  xl:grid-cols-4 ">
                @php
                    $delay = 1000;
                @endphp
                @foreach ($courses as $course)
                    @php
                        $delay += 200;
                    @endphp
                    <x-courseComponents.course-item :delay="$delay" :course="$course" />
                @endforeach
            </div>

        </div>
    </div>
    {{-- notfication  --}}
    @session('success')
        <x-notificationCards.notif-success>{{ session('success') }}</x-notificationCards.notif-success>
    @endsession
    @session('error')
        <x-notificationCards.notif-error>{{ session('error') }}</x-notificationCards.notif-error>
    @endsession

</div>

{{-- ? Create Course PopUp form --}}
<x-formComponents.popup-form id="create-course-form">
    <x-slot:closeBtn>
        <button class="create-course-close-btn hover:scale-125 transition-all ease-in">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </x-slot:closeBtn>

    {{--  here form start --}}
    <form action="{{ route('coach.courses.store') }}" method="POST" enctype="multipart/form-data"
        class="space-y-5 min-w-screen-md grid grid-cols-2 gap-x-2">
        @csrf

        {{-- Course name field --}}
        <x-formComponents.form-field>
            <x-formComponents.form-label for="name">Name</x-formComponents.form-label>
            <x-formComponents.form-input type="text" id="name" name="name" placeholder="course title"
                :value="old('name')" required></x-formComponents.form-input>
            <x-formComponents.form-error name="name" />
        </x-formComponents.form-field>

        {{-- duration field --}}
        <x-formComponents.form-field>
            <x-formComponents.form-label for="duration">Duration</x-formComponents.form-label>
            <x-formComponents.form-input type="number" id="duration" name="duration"
                placeholder="course duration on weeks " :value="old('duration')" required></x-formComponents.form-input>
            <x-formComponents.form-error name="duration" />
        </x-formComponents.form-field>

        {{-- level field --}}
        <x-formComponents.form-field>
            <x-formComponents.form-label for="level">Level</x-formComponents.form-label>
            <x-formComponents.form-input type="text" id="level" name="level" placeholder="easy"
                :value="old('level')" required></x-formComponents.form-input>
            <x-formComponents.form-error name="level" />
        </x-formComponents.form-field>

        {{-- Categorie field --}}
        <x-formComponents.form-field>
            <x-formComponents.form-label for="category">Category</x-formComponents.form-label>
            <x-formComponents.form-input type="text" id="category" name="category" placeholder="IT"
                :value="old('category')" required></x-formComponents.form-input>
            <x-formComponents.form-error name="category" />
        </x-formComponents.form-field>

        {{-- price field --}}
        <x-formComponents.form-field>
            <x-formComponents.form-label for="price">Price</x-formComponents.form-label>
            <x-formComponents.form-input type="number" id="price" name="price" :value="old('price')"
                placeholder="$99,99" required></x-formComponents.form-input>
            <x-formComponents.form-error name="price" />
        </x-formComponents.form-field>

        {{-- Video file upload field --}}
        <x-formComponents.form-field>
            <x-formComponents.form-label for="image">Thumbnail</x-formComponents.form-label>
            <x-formComponents.form-input type="file" id="image" name="image" :value="old('image')"
                required></x-formComponents.form-input>
            <x-formComponents.form-error name="image" />
        </x-formComponents.form-field>

        {{-- Description field --}}
        <div class="col-span-2 ">
            <x-formComponents.form-field class="w-full">
                <x-formComponents.form-label for="description">
                    Description</x-formComponents.form-label>
                <x-formComponents.form-textarea id="description" name="description"
                    class="block w-full rounded-md border-0  text-orange-700 font-medium shadow-sm  placeholder:text-gray-500 focus:ring-2 focus:ring-inset focus:ring-orange-600 sm:text-sm sm:leading-6  px-3 py-2.5 focus-visible:outline-dashed focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-orange-400 backdrop-blur-sm bg-white/5"
                    placeholder="description of your course content" :value="old('description')" required />
                <x-formComponents.form-error name="description" />
            </x-formComponents.form-field>
        </div>

        {{--  upload button --}}
        <div class="col-span-2 flex justify-center items-center">
            <x-formComponents.form-button type='submit'>Create</x-formComponents.form-button>
        </div>

    </form>
    {{-- here form ends --}}

</x-formComponents.popup-form>


<script>
    let initialScrollPosition;
    const createCourseForm = document.getElementById('create-course-form');
    document.querySelector('.create-course-open-btn').addEventListener('click', showCreateCourseForm);
    document.querySelector('.create-course-close-btn').addEventListener('click', hideCreateCourseForm);


    function showCreateCourseForm() {
        document.body.style.overflow = 'hidden';
        initialScrollPosition = window.scrollY;
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
        setTimeout(() => {
            createCourseForm.classList.remove('hidden');
        }, 300);
    }

    function hideCreateCourseForm() {
        document.body.style.overflow = 'visible';
        window.scrollTo({
            top: initialScrollPosition,
            behavior: 'smooth'
        });
        createCourseForm.classList.add('hidden');
    }
</script>
<script src="{{ asset('js/notif.js') }}"></script>
