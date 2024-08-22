<div
    {{ $attributes->merge(['class' => 'hidden w-full bg-black/30 backdrop-blur-sm min-h-full h-full fixed top-0 left-0 z-50 flex justify-center items-center shadow-md']) }}>
    <div class="bg-[#172868] rounded-lg  shadow-lg mx-auto max-w-[500px] min-w-[500px]">

        {{-- ? form start --}}
        <div class="w-full ">
            <div class="text-white flex justify-end items-center p-3">
                {{ $closeBtn }}
            </div>
            <div class="sm:mx-auto sm:w-full sm:max-w-sm">
                <a href="/">
                    <img class="mx-auto h-10 w-auto"
                        src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="Your Company">
                </a>
            </div>

            <div class=" sm:mx-auto sm:w-full p-5 ">
                {{-- ? here form start --}}

                {{ $slot }}

                {{-- ? here form ends --}}

            </div>

        </div>
        {{-- ? form end --}}
    </div>
</div>

<script></script>
