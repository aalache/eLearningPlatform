<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            {{-- header --}}
            <div class="p-6 text-gray-900">
                {{ __("You're logged in!") }}
                <br>
                {{ $msg }}
                <h2 class="">All available courses</h2>

                <div class="h-full w-full">

                    <x-courseComponents.course-item />
                </div>
            </div>
        </div>
    </div>
</div>
