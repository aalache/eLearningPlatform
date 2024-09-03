<div
    {{ $attributes->merge(['class' => 'hidden w-full h-screen bg-black/40 backdrop-blur-sm absolute top-0 left-0 z-50 flex justify-center items-center shadow-md ']) }}>
    <div class="bg-white/80 backdrop-blur-md  rounded-lg  shadow-lg mx-auto min-w-[500px] max-w-[600px] overflow-hidden">

        {{-- ? form start --}}
        <div class="w-full py-3 ">
            <div class="text-orange-600 flex justify-end items-center px-3 ">
                {{-- close btn start --}}
                {{ $closeBtn }}
                {{-- close btn end --}}
            </div>
            {{-- <div class="sm:mx-auto sm:w-full sm:max-w-sm">
                <a href="#">
                    <img class="mx-auto h-10 w-auto"
                        src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="Your Company">
                </a>
            </div> --}}

            <div class=" sm:mx-auto sm:w-full px-5 ">
                {{-- here form start --}}

                {{ $slot }}

                {{-- here form ends --}}

            </div>

        </div>
        {{-- ? form end --}}
    </div>
</div>

<script></script>
