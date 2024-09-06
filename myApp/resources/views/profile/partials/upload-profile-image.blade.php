<section class="">
    <header>
        <h2 class="text-lg font-semibold text-gray-200 ">
            {{ __('Profile Picture') }}
        </h2>

        <p class="mt-1 text-sm text-gray-400 font-semibold">
            {{ __("Update your account's picture .") }}
        </p>
    </header>

    <form action="" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Other form fields -->

        <div class="flex flex-col-reverse sm:flex-row justify-between items-center pt-4 sm:pt-0">
            <div class="flex flex-col h-52 justify-evenly ">
                <div class="space-y-2">
                    <x-input-label for="profile_picture">Profile Picture</x-input-label>
                    <x-text-input type="file" name="profile_picture" id="profile_picture" />
                    <p class="text-gray-400 text-sm">Your current image is {{ Auth::user()->profile_picture }} </p>
                    <x-input-error class="mt-2" :messages="$errors->get('profile_picture')" />
                </div>

                <x-primary-button type="submit" class="w-fit">Update Profile</x-primary-button>
            </div>

            <div class="rounded-lg w-52 h-52 bg-white/30 border-none shadow-xl  outline-none overflow-hidden">
                <img src="{{ asset('upload/profiles') }}/{{ Auth::user()->profile_picture }}" alt=""
                    class="w-full h-full object-cover">
            </div>

        </div>
    </form>

</section>
