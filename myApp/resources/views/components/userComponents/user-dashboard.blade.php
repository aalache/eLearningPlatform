@php
    use App\Http\Controllers\StudentController;
    use App\Http\Controllers\CourseController;
@endphp

@props(['inProgressCourses'])




<div class="max-w-7xl mx-auto sm:px-6 lg:px-6 py-4 min-h-[100vh]">
    <div class=" overflow-hidden shadow-sm sm:rounded-lg">

        <div class="px-2 pt-8 pb-4 text-gray-900 space-y-6">
            {{-- welcom heading and summary heading --}}
            <div class="space-y-1 text-[#efefef]">
                <h2 class="text-4xl font-semibold">Welcome Back<span class="text-orange-600">,
                        {{ Auth::user()->name }}</span></h2>
            </div>
            {{--  --}}
            {{-- summary details --}}
            <div class="space-y-3">
                <p class=" text-[#ffffff]/60 text-sm font-bold leading-normal">Here's your learning summary</p>
                @php
                    $enrollements = auth()->user()->enrollements()->with('course')->get();
                    foreach ($enrollements as $enrollement) {
                        CourseController::progress($enrollement->course);
                    }
                @endphp
                <div class="  space-x-3 grid grid-cols-3 gap-2">
                    <x-cards.metrics-card :data="StudentController::enrollements()" :label="'Courses Enrolled In'" />
                    <x-cards.metrics-card :data="StudentController::inProgress()" :label="'In Progress'" />
                    <x-cards.metrics-card :data="StudentController::completed()" :label="'Courses completed'" />
                </div>
            </div>
            {{--  --}}
        </div>

        <div class="px-2 py-8 text-gray-900 space-y-4">
            {{-- Your courses section --}}
            @if (Auth::user()->enrollements->count())
                <div class="space-y-2 backdrop-blur-sm  rounded-2xl">
                    <div class=" space-y-5 p-4  rounded-2xl">
                        <h2 class="text-xl text-white font-semibold border-l-4 border-orange-600 px-2">
                            Your Course
                        </h2>
                        <div class=" space-y-2">
                            <div class="grid grid-cols-4 gap-2">
                                @foreach ($inProgressCourses as $enrollement)
                                    <x-cards.user-dashboard-course-card
                                        href="{{ route('user.courses.show', ['course' => $enrollement->course]) }}"
                                        :enrollement="$enrollement" />
                                @endforeach
                            </div>
                            <div>
                                <a href="{{ route('user.enrollement.index') }}"
                                    class="text-orange-500 text-xs font-semibold leading-normal">View more</a>
                            </div>
                        </div>

                    </div>
                </div>
            @endif


            @if (Auth::user()->activities->count())
                <div class="space-y-2 backdrop-blur-3xl rounded-2xl   ">
                    <div class=" space-y-5 p-4  rounded-2xl">
                        <h2 class="text-xl text-white font-semibold border-l-4 border-orange-600 px-2">Activity
                            History
                        </h2>
                        <div class="space-y-2 overflow-y-auto ">
                            @foreach (Auth::user()->activities()->take(6)->latest()->get() as $activity)
                                <x-cards.activity-card :activity="$activity" />
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </div>
</div>
