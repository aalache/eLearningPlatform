@php
    use Illuminate\Support\Facades\Auth;
    use App\Http\Controllers\StudentController;
    use App\Http\Controllers\CourseController;
    use App\Http\Controllers\CoachController;
@endphp

@props(['activities'])


<div class="max-w-7xl mx-auto sm:px-6 lg:px-6 min-h-[100vh]">
    <div class=" overflow-hidden  sm:rounded-lg">
        <div class="px-2 pt-8 pb-20 text-gray-900 space-y-8">
            {{-- welcom heading and summary heading --}}
            <div class="space-y-1 text-[#efefef]" data-aos="fade-right" data-aos-duration="400" data-aos-delay="300">
                <h2 class="text-4xl font-semibold">Welcome Back<span class="text-orange-600">,
                        {{ Auth::user()->name }}</span></h2>
            </div>
            {{--  --}}

            {{-- summary details --}}
            <div class="space-y-3">

                <p class=" text-[#ffffff]/60 text-sm font-bold leading-normal" data-aos="fade-right"
                    data-aos-duration="400" data-aos-delay="500">
                    Here's your workspace metrics
                </p>
                @php

                    $enrollements = auth()->user()->enrollements()->with('course')->get();
                    foreach ($enrollements as $enrollement) {
                        CourseController::progress($enrollement->course);
                    }

                @endphp

                <div class="  xl:space-x-3 grid grid-cols-2 sm:grid-cols-3 xl:grid-cols-5 gap-2">
                    <x-cards.metrics-card :data="CoachController::metrics('total_videos')" :label="'Videos'" :delay="700" />
                    <x-cards.metrics-card :data="CoachController::metrics('total_playlists')" :label="'Playlists'" :delay="900" />
                    <x-cards.metrics-card :data="CoachController::metrics('total_courses')" :label="'Courses'" :delay="1100" />
                    <x-cards.metrics-card :data="CoachController::metrics('total_enrollements')" :label="'Enrollements'" :delay="1300" />
                    <x-cards.metrics-card :data="CoachController::metrics('total_users')" :label="'Active Users'" :delay="1500" />
                </div>
            </div>
            {{--  --}}

            {{-- Your activities section --}}

            @if (Auth::user()->activities->count())
                <div class="space-y-2  backdrop-blur-3xl bg-black/40 rounded-2xl" data-aos="zoom-in"
                    data-aos-duration="500" data-aos-delay="1600">
                    <div class=" space-y-5 p-4  rounded-2xl">
                        <h2 data-aos="fade-right" data-aos-duration="400" data-aos-delay="1700"
                            class="text-xl text-white font-semibold border-l-4 border-orange-600 px-2">
                            Activity History
                        </h2>
                        <div class="space-y-2 h-auto">

                            @foreach (Auth::user()->activities()->take(6)->latest()->get() as $activity)
                                <x-cards.activity-card :delay="700" :activity="$activity" />
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif



        </div>
    </div>
</div>
