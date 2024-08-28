@props(['enrollement'])


<a {{ $attributes->merge(['class' => 'relative   rounded-md shadow-md overflow-hidden h-[240px]']) }}>
    <img src="{{ asset('upload/courses') }}/{{ $enrollement->course->image }}" alt=""
        class="h-[100%] w-full  object-cover" />

    <div
        class="group w-full h-full absolute  rounded-b-md p-3  hover:p-3 translate-y-[-50%]  hover:translate-y-[-100%]  hover:rounded-md bg-[#ffffff]/5 backdrop-blur-xl  space-y-4 hover:space-y-6 overflow-hidden transition-all ease-linear">
        <div>
            <p class=" font-semibold text-[#efefef] text-md  leading-relaxed">
                {{ $enrollement->course->name }}</p>
            <p class="text-blue-500 text-xs font-semibold leading-normal">In Progress</p>
        </div>

        <div class="space-y-2">
            <div class="flex justify-between items-center text-orange-600">
                <p class="text-xs font-bold">Progress</p>
                <p class="text-xs font-bold">{{ $enrollement->progress }}%</p>
            </div>
            {{-- progress bar --}}
            <div class="w-full bg-gray-200/50 rounded-full h-2">
                <div class="bg-green-600 h-2 rounded-full text-center text-white"
                    style="width: {{ $enrollement->progress }}%;">
                </div>
            </div>
            {{--  --}}
        </div>
    </div>

</a>
