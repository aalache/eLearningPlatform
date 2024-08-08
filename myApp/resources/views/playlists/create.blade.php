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
                        Add new playlist
                    </h2>
                </div>

                <div class="mt-5 sm:mx-auto sm:w-full sm:max-w-sm ">
                    {{-- ? here form start --}}

                    <form action="/playlists" method="POST" enctype="multipart/form-data" class="space-y-5">
                        @csrf

                        {{-- playlist name field --}}
                        <x-formComponents.form-field>
                            <x-formComponents.form-label for="name">Playlist Name</x-formComponents.form-label>
                            <x-formComponents.form-input type="text" id="name" name="name"
                                placeholder="playlist name" required></x-formComponents.form-input>
                            <x-formComponents.form-error name="name" />
                        </x-formComponents.form-field>

                        {{--  Add button --}}
                        <x-formComponents.form-button>Add</x-formComponents.form-button>

                    </form>

                    {{-- ? here form ends --}}

                </div>

            </div>
        </div>
    </div>
</x-page-layout>
