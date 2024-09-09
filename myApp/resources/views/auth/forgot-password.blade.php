<x-guest-layout>
    <div class="mb-4 text-sm text-gray-900">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-formComponents.form-label for="email" :value="__('Email')" />
            <x-formComponents.form-input id="email" class="block mt-1 w-full" type="email" name="email"
                :value="old('email')" required autofocus />
            <x-formComponents.form-error name="email" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-formComponents.form-button>
                {{ __('Email Password Reset Link') }}
            </x-formComponents.form-button>
        </div>
    </form>
</x-guest-layout>
