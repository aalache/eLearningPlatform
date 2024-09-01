@props(['enrollments'])

<div class="">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-4 py-10 h-full min-h-full">
        <div class=" overflow-hidden  sm:rounded-lg min-h-full  ">
            <div class="p-6 text-gray-900 space-y-10">

                <div class=" space-y-2">
                    <h2 class="border-l-4 px-2 border-orange-600 text-2xl text-[#ffffff] font-semibold ">My Enrollements
                    </h2>
                    <p class="border-l-4 px-2 text-sm font-semibold border-[#efefef]/50 text-[#efefef]/50 ">
                        Unlock Your Potential with Every Click
                    </p>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-2">
                    @foreach ($enrollments as $enrollment)
                        <x-cards.enrollement-course-card :enrollment="$enrollment" />
                    @endforeach
                </div>

            </div>
        </div>
    </div>
</div>
