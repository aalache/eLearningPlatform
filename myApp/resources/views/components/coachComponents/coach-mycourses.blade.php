@props(['mycourses' => collect()])


<div class="py-0 px-3 bg-white">
    <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            {{-- header --}}
            <div class="py-6 px-6 text-gray-900 space-y-8">

                <div class=" space-y-0">
                    <h2 class="border-l-4 px-2 border-blue-600 text-2xl font-meduim ">All your courses</h2>
                    <p class="border-l-4 px-2 text-sm border-blue-600 text-blue-600 ">Push Boundaries, Spark Innovation
                    </p>
                </div>

                <div class="h-full w-full grid gap-3  sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4  xl:grid-cols-5 ">

                    @foreach ($mycourses as $course)
                        <x-courseComponents.course-item :course="$course" />
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
