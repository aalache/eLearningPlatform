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
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">

            @if (request()->routeIs('user.dashboard') ||
                    request()->routeIs('coach.dashboard') ||
                    request()->routeIs('admin.dashboard'))
                {{ __('Dashboard') }}
            @endif

            @if (request()->routeIs('user.courses') || request()->routeIs('coach.courses') || request()->routeIs('admin.courses'))
                {{ __('Courses') }}
            @endif

            @if (request()->routeIs('user.enrollement'))
                {{ __('Enrollement') }}
            @endif

            @if (request()->routeIs('admin.users'))
                {{ __('Users') }}
            @endif
        </h2>
    </x-slot>

    @if ($$isStudent && $isUserPath)
        <x-userComponents.user-dashboard>
            <x-slot:msg>{{ $msg }}</x-slot:msg>
        </x-userComponents.user-dashboard>
    @endif


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
