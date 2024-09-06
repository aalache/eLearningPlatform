<div
    {{ $attributes->merge(['class' => 'hidden w-full h-screen bg-black/40 backdrop-blur-sm absolute top-0 left-0 z-50 flex md:justify-center items-center shadow-md ']) }}>
    <div
        class="bg-white/80 backdrop-blur-md  rounded-lg   mx-auto w-full h-fit md:min-w-[500px] max-w-[600px] overflow-hidden">

        {{-- ? form start --}}
        <div class="w-full py-3 ">
            <div class="text-orange-600 flex justify-end items-center px-3 ">
                {{-- close btn start --}}
                {{ $closeBtn }}
                {{-- close btn end --}}
            </div>

            <div class=" w-full px-2 md:px-5 ">
                {{-- here form start --}}
                {{ $slot }}
                {{-- here form ends --}}
            </div>

        </div>
        {{-- ? form end --}}
    </div>
</div>

<script></script>
