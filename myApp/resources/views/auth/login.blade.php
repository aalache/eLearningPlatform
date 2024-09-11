<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('success')" />

    <form class="space-y-6" method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <x-formComponents.form-field data-aos="fade-right" data-aos-duration="400" data-aos-delay="300">
            <x-formComponents.form-label for="email">Email</x-formComponents.form-label>

            <div class="mt-2">
                <x-formComponents.form-input id="email" class="block mt-1 w-full" type="email" name="email"
                    :value="old('email')" required autofocus autocomplete="username" />
                <x-formComponents.form-error name="email" />
            </div>
        </x-formComponents.form-field>

        <x-formComponents.form-field data-aos="fade-left" data-aos-duration="400" data-aos-delay="500">
            <div class="flex items-center justify-between">
                <x-formComponents.form-label for="password">Password</x-formComponents.form-label>
                <div class="text-sm">
                    @if (Route::has('password.request'))
                        <a class="font-semibold text-indigo-500 hover:text-indigo-400"
                            href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif
                </div>
            </div>
            <div class="mt-2">
                <x-formComponents.form-input id="password" class="block mt-1 w-full" type="password" name="password"
                    required autocomplete="current-password" />
                <x-formComponents.form-error name="password" />
            </div>
        </x-formComponents.form-field>

        <!-- Remember Me -->
        <div class="block mt-4" data-aos="fade-right" data-aos-duration="400" data-aos-delay="700">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div data-aos="zoom-in" data-aos-duration="400" data-aos-delay="1000">
            <x-formComponents.form-button>Login</x-formComponents.form-button>
        </div>

        <p class="mt-10 text-center text-sm text-gray-600" data-aos="zoom-in" data-aos-duration="400"
            data-aos-delay="1200">
            <a href="/register">Not a member?</a>
        </p>

    </form>
</x-guest-layout>
