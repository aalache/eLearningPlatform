<x-page-layout>

    <div class=" flex min-h-full h-full  justify-center items-center  lg:px-8  bg-hero ">
        <div
            class="flex  justify-center items-center h-full sm:h-auto w-full  rounded-none border-none sm:max-w-[400px]  sm:border-2  sm:rounded-xl sm:border-dashed  sm:p-10 sm:block sm:border-indigo-500   backdrop-blur-lg bg-indigo-900/20 ">
            <div class="w-full p-14 sm:p-0">
                <div class="sm:mx-auto sm:w-full sm:max-w-sm">
                    <a href="/">
                        <img class="mx-auto h-10 w-auto"
                            src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="Your Company">
                    </a>

                    <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-200">
                        Upload your new video
                    </h2>
                </div>

                <div class="mt-5 sm:mx-auto sm:w-full sm:max-w-sm ">
                    {{-- ? here form start --}}

                    <form action="/videos" method="POST" enctype="multipart/form-data" class="space-y-5">
                        @csrf

                        {{-- Title field --}}
                        <x-form-field>
                            <x-form-label for="title">Title</x-form-label>
                            <x-form-input type="text" id="title" name="title" placeholder="Video title"
                                required></x-form-input>
                            <x-form-error name="title" />
                        </x-form-field>



                        {{-- duration field --}}
                        <x-form-field>
                            <x-form-label for="duration">Duration</x-form-label>
                            <x-form-input type="text" id="duration" name="duration"
                                placeholder="Video duration in minite" required></x-form-input>
                            <x-form-error name="duration" />
                        </x-form-field>

                        {{-- Video file upload field --}}
                        <x-form-field>
                            <x-form-label for="video"></x-form-label>
                            <x-form-input type="file" id="video" name="video" required></x-form-input>
                            <x-form-error name="video" />
                        </x-form-field>

                        {{--  upload button --}}
                        <x-form-button>Upload</x-form-button>

                    </form>

                    {{-- ? here form ends --}}

                </div>

            </div>
        </div>
    </div>
</x-page-layout>
