<x-page-layout>
    <div class=" flex min-h-full h-full  justify-center items-center  lg:px-8  bg-hero ">
        <div
            class="flex  justify-center items-center h-full w-full  rounded-none border-none sm:max-w-[400px] sm:max-h-[600px] sm:border-2  sm:rounded-xl sm:border-dashed  sm:p-10 sm:block sm:border-indigo-500   backdrop-blur-lg bg-indigo-900/20 ">
            <div class="w-full p-14 sm:p-0">
                <div class="sm:mx-auto sm:w-full sm:max-w-sm">
                    <img class="mx-auto h-10 w-auto"
                        src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="Your Company">
                    <h2 class="mt-3 text-center text-2xl font-bold leading-9 tracking-tight text-gray-200">Create your
                        account</h2>
                </div>

                <div class="mt-5 sm:mx-auto sm:w-full sm:max-w-sm l">
                    {{-- ? here form start --}}
                    <form class="space-y-3 " action="#" method="POST">

                        <div>
                            <x-form-label for="email">Username</x-form-label>
                            <div class="mt-2">
                                <x-form-input id="username" name="username" type="text" autocomplete="username"
                                    required />
                            </div>
                        </div>

                        <div>
                            <x-form-label for="email" class="block text-sm font-medium leading-6 text-gray-200">Email
                                address</x-form-label>
                            <div class="mt-2">
                                <x-form-input id="email" name="email" type="email" autocomplete="email"
                                    required />
                            </div>
                        </div>

                        <div>
                            <x-form-label for="password"
                                class="block text-sm font-medium leading-6 text-gray-200">Password</x-form-label>
                            <div class="mt-2">
                                <x-form-input id="password" name="password" type="password"
                                    autocomplete="current-password" required />
                            </div>
                        </div>
                        <div>
                            <x-form-label for="password_confirmation"
                                class="block text-sm font-medium leading-6 text-gray-200">Confirm
                                Password</x-form-label>
                            <div class="mt-2">
                                <x-form-input id="password_confirmation" name="password_confirmation" type="password"
                                    required />
                            </div>
                        </div>

                        <div>
                            <x-form-button type="submit">Sign Up</x-form-button>
                        </div>
                    </form>
                    {{-- ? here form ends --}}

                    <p class="mt-5 text-center text-sm text-gray-400">
                        <a href="/login2">I allready have account?</a>
                    </p>
                </div>

            </div>
        </div>
</x-page-layout>
