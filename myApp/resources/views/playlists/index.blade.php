<x-page-layout>

    <div>
        <h1>Playlists</h1>
    </div>
    <div class="w-full h-full flex  p-4 space-x-2 flex-wrap">
        @foreach ($playlists as $playlist)
            <div class=" flex flex-wrap p-3 w-[300px] h-auto">
                <a href="/playlists/{{ $playlist->id }}">
                    <div class="h-auto w-[200px] p-4 rounded-md bg-[#efefef] space-y-2 text-gray-900 overflow-hidden">
                        {{ $playlist->name }}
                    </div>
                </a>
                <!-- Add Video to Playlist Button -->
                <div class=" sm:mx-auto sm:w-full sm:max-w-sm ">
                    {{-- ? here form start --}}

                    <form action="/videos/{{ $playlist->id }}" method="POST" enctype="multipart/form-data"
                        class="space-y-5">
                        @csrf

                        {{-- Title field --}}
                        <x-formComponents.form-field>
                            <x-formComponents.form-label for="title">Title</x-formComponents.form-label>
                            <x-formComponents.form-input type="text" id="title" name="title"
                                placeholder="Video title" required></x-formComponents.form-input>
                            <x-formComponents.form-error name="title" />
                        </x-formComponents.form-field>



                        {{-- duration field --}}
                        <x-formComponents.form-field>
                            <x-formComponents.form-label for="duration">Duration</x-formComponents.form-label>
                            <x-formComponents.form-input type="text" id="duration" name="duration"
                                placeholder="Video duration in minite" required></x-formComponents.form-input>
                            <x-formComponents.form-error name="duration" />
                        </x-formComponents.form-field>

                        {{-- Video file upload field --}}
                        <x-formComponents.form-field>
                            <x-formComponents.form-label for="video"></x-formComponents.form-label>
                            <x-formComponents.form-input type="file" id="video" name="video"
                                required></x-formComponents.form-input>
                            <x-formComponents.form-error name="video" />
                        </x-formComponents.form-field>

                        {{--  upload button --}}
                        <x-formComponents.form-button>Upload</x-formComponents.form-button>

                    </form>

                    {{-- ? here form ends --}}

                </div>
            </div>
        @endforeach
    </div>
</x-page-layout>
