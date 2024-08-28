@props(['courses' => collect()])


<div class="py-10 px-3 backdrop-blur-3xl bg-black/50  min-h-[100vh]">
    <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
        <div class=" overflow-hidden shadow-sm sm:rounded-lg">
            {{-- header --}}
            <div class="py-6 px-6 text-gray-900 space-y-6">


                <div class=" space-y-2">
                    <h2 class="border-l-4 px-2 border-orange-600 text-2xl text-[#ffffff] font-semibold ">
                        All available courses
                    </h2>
                    <p class="border-l-4 px-2 text-sm font-semibold border-[#efefef]/50 text-[#efefef]/50 ">
                        Discover, Curate, Enjoy
                    </p>
                </div>

                <div class="h-full w-full grid gap-3  sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4  xl:grid-cols-4 ">

                    @foreach ($courses as $course)
                        <x-courseComponents.course-item :course="$course" />
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
