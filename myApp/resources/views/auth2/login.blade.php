<x-page-layout>

    <div class=" flex min-h-full h-full  justify-center items-center  lg:px-8  bg-hero ">
        <div
            class="flex justify-center items-center h-full w-full  rounded-none border-none sm:max-w-[400px] sm:max-h-[550px] sm:border-2  sm:rounded-xl sm:border-dashed sm:block sm:p-10 sm:border-indigo-500   backdrop-blur-lg bg-indigo-900/20 ">

            <div class="w-full p-14 sm:p-0">

                <div class="sm:mx-auto sm:w-full sm:max-w-sm">
                    <img class="mx-auto h-10 w-auto"
                        src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="Your Company">
                    <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-200">Sign in to
                        your account</h2>
                </div>

                <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">

                    {{-- ? form start  --}}
                    <form class="space-y-6" action="/login2" method="POST">
                        @csrf

                        <x-form-field>
                            <x-form-label for="username">Email</x-form-label>

                            <div class="mt-2">
                                <x-form-input type="username" name="username" id="username" :value="old('username')"
                                    placeholder="something@exemple.com" required />
                                <x-form-error name="username" />
                            </div>

                        </x-form-field>

                        <div>
                            <div class="flex items-center justify-between">
                                <x-form-label for="password">Password</x-form-label>
                                <div class="text-sm">
                                    <a href="#" class="font-semibold text-indigo-500 hover:text-indigo-400">Forgot
                                        password?</a>
                                </div>
                            </div>
                            <div class="mt-2">
                                <x-form-input id="password" name="password" type="password"
                                    autocomplete="current-password" required />
                            </div>
                        </div>

                        <div>
                            <x-form-button>Login</x-form-button>
                        </div>

                    </form>
                    {{-- ? form's end  --}}

                    <p class="mt-10 text-center text-sm text-gray-400">
                        <a href="/register2">Not a member?</a>
                    </p>

                </div>

            </div>
        </div>
    </div>
</x-page-layout>
