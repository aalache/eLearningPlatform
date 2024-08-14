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
            <h2 class="text-xl text-gray-800 leading-tight">




                @if (request()->routeIs('user.enrollement'))
                    {{ __('Enrollement') }}
                @endif

                @if (request()->routeIs('admin.users'))
                    {{ __('Users') }}
                @endif
            </h2>

            @if (request()->routeIs('user.courses'))
                <form action="{{ route('user.courses.search') }}" method="POST"
                    class=" w-[30%] hover:w-[40%] hover:shadow-sm h-12 rounded-xl transition-all ease-in border-2 ">
                    @csrf
                    <input type="text" placeholder="Search..." name="query" id="query"
                        class=" border-none outlin-none w-full  h-full bg-[#efefef] rounded-xl text-gray-700">
                </form>
            @endif

        </div>
    </x-slot>

    {{-- ? User interface --}}
    @if ($isStudent && $isUserPath)

        {{-- user dashboard --}}
        @if (request()->routeIs('user.dashboard'))
            <x-userComponents.user-dashboard :activities="$activities">
            </x-userComponents.user-dashboard>
        @endif

        {{-- user enrollements page --}}
        @if (request()->routeIs('user.enrollement'))
            <x-userComponents.user-enrollement>
                <x-slot:msg>{{ $msg }}</x-slot:msg>
            </x-userComponents.user-enrollement>
        @endif

        {{-- user courses page --}}
        @if (request()->routeIs('user.courses'))
            <x-userComponents.user-courses :courses="$courses">

            </x-userComponents.user-courses>
        @endif

    @endif
    {{-- ? --}}


    @if ($isInstructor && $isCoachPath)
        <x-coachComponents.coach-dashboard>
            <x-slot:msg>{{ $msg }}</x-slot:msg>
        </x-coachComponents.coach-dashboard>
    @endif

    @if ($isAdmin && $isAdminPath)
        <x-adminComponents.admin-dashboard>
            <x-slot:msg>{{ $msg }}</x-slot:msg>
        </x-adminComponents.admin-dashboard>
    @endif

</x-app-layout>
