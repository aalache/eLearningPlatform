<x-guest-layout>

    {{-- ? here form start --}}
    <form class="space-y-3 " method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <x-form-field>
            <x-form-label for="first_name">
                Name</x-form-label>

            <div class="mt-2">
                <x-form-input id="name" type="text" name="name" :value="old('name')" autofocus autocomplete="name"
                    placeholder="Joe" />
                <x-form-error name="name" />
            </div>
        </x-form-field>

        <!-- Email Address -->
        <x-form-field>
            <x-form-label for="email">Email</x-form-label>

            <div class="mt-2">
                <x-form-input id="email" type="email" name="email" :value="old('email')" autocomplete="username"
                    placeholder="something@exemple.com" />
                <x-form-error name="email" />
            </div>
        </x-form-field>

        <!-- Password -->
        <x-form-field>
            <x-form-label for="password">Password</x-form-label>

            <div class="mt-2">
                <x-form-input id="password" type="password" name="password" autocomplete="new-password"
                    placeholder="*****" />
                <x-form-error name="password" />
            </div>
        </x-form-field>

        <!-- Confirm Password -->
        <x-form-field>
            <x-form-label for="password_confirmation">Confirm Password</x-form-label>

            <div class="mt-2">
                <x-form-input id="password_confirmation" class="block mt-1 w-full" type="password"
                    name="password_confirmation" autocomplete="new-password" />
                <x-form-error name="password_confirmation" />
            </div>
        </x-form-field>

        <div>
            <x-form-button type="submit">Sign Up</x-form-button>
        </div>

        <p class="mt-5 text-center text-sm text-gray-400">
            <a href="/login">I allready have account?</a>
        </p>
    </form>
    {{-- ? here form ends --}}

</x-guest-layout>
























{{-- <x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}
