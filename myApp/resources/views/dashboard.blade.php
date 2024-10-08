@php
    $isAdmin = Auth::user()->hasRole('admin'); // if user have admin role
    $isStudent = Auth::user()->hasRole('student'); // if user have student role
    $isInstructor = Auth::user()->hasRole('instructor'); // if user have instructor role
    $currentPath = Route::currentRouteName(); // return the current route path
    $isAdminPath = str_starts_with($currentPath, 'admin'); // test if the current route is an admin route
    $isCoachPath = str_starts_with($currentPath, 'coach'); // test if the current route is an coach route
    $isUserPath = str_starts_with($currentPath, 'user'); // test if the current route is an user route
@endphp



<x-app-layout>


    <x-slot name="header">
        <div class="flex justify-end items-center  ">


            @if (request()->routeIs('user.courses.index') || request()->routeIs('coach.courses.index'))
                @php
                    $route = null;
                    if (request()->routeIs('user.courses.index')) {
                        $route = 'user.courses.search';
                    }
                    if (request()->routeIs('coach.courses.index')) {
                        $route = 'coach.courses.search';
                    }
                @endphp

                <form action="{{ route($route) }}" method="POST" data-aos="fade-left" data-aos-duration="400"
                    data-aos-delay="500"
                    class="w-full sm:w-[50%] sm:hover:w-[60%] md:w[40%] md:hover:w[50%] lg:w-[30%] lg:hover:w-[40%] hover:shadow-sm h-12 rounded-xl transition-all ease-in shadow-md">
                    @csrf
                    <input type="text" placeholder="Search..." name="query" id="query"
                        class=" border-none outline-none w-full  h-full bg-white/15 rounded-lg text-gray-300 font-medium px-3">
                </form>
            @endif

        </div>
    </x-slot>

    {{-- ? ########### User Views ############### --}}
    @if ($isStudent && $isUserPath)

        {{-- user dashboard --}}
        @if (request()->routeIs('user.dashboard'))
            <x-userComponents.user-dashboard :inProgressCourses="$inProgressCourses">

            </x-userComponents.user-dashboard>
        @endif

        {{-- user enrollements page --}}
        @if (request()->routeIs('user.enrollement.index'))
            <x-userComponents.user-enrollement :enrollments="$enrollments">

            </x-userComponents.user-enrollement>
        @endif

        {{-- user courses page --}}
        @if (request()->routeIs('user.courses.index'))
            <x-userComponents.user-courses :courses="$courses">

            </x-userComponents.user-courses>
        @endif

    @endif
    {{-- ? --}}

    {{-- ? ############ Instructor Views ############# --}}

    @if ($isInstructor && $isCoachPath)
        {{-- instructor dashboard --}}
        @if (request()->routeIs('coach.dashboard'))
            <x-coachComponents.coach-dashboard>

            </x-coachComponents.coach-dashboard>
        @endif

        @if (request()->routeIs('coach.courses.index'))
            <x-coachComponents.coach-courses :courses="$courses">

            </x-coachComponents.coach-courses>
        @endif

        @if (request()->routeIs('coach.playlists.index'))
            <x-coachComponents.coach-myplaylists :myplaylists="$myplaylists">

            </x-coachComponents.coach-myplaylists>
        @endif

        @if (request()->routeIs('coach.videos.index'))
            <x-coachComponents.coach-myvideos :myVideos="$myVideos" :playlists="$playlists">

            </x-coachComponents.coach-myvideos>
        @endif


    @endif
    {{-- ? --}}

    {{-- ? ############ Admin Views ############# --}}

    @if ($isAdmin && $isAdminPath)
        <x-adminComponents.admin-dashboard>
            <x-slot:msg>{{ $msg }}</x-slot:msg>
        </x-adminComponents.admin-dashboard>
    @endif

    {{-- ? --}}

</x-app-layout>
