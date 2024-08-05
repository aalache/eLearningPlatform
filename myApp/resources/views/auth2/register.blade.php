<x-page>
    <x-slot:heading>
        Registration
    </x-slot:heading>


    <form method="POST" action="/register2">
        @csrf

        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">


                <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">

                    <x-form-field>
                        <x-form-label for="first_name"> Name</x-form-label>

                        <div class="mt-2">
                            <x-form-input type="text" name="name" id="name" placeholder="Joe" required />
                            <x-form-error name="name" />
                        </div>
                    </x-form-field>



                    <x-form-field>
                        <x-form-label for="email">Email</x-form-label>

                        <div class="mt-2">
                            <x-form-input type="email" name="email" id="email"
                                placeholder="something@exemple.com" required />
                            <x-form-error name="email" />
                        </div>
                    </x-form-field>


                    <x-form-field>
                        <x-form-label for="password">Password</x-form-label>

                        <div class="mt-2">
                            <x-form-input type="password" name="password" id="password" required />
                            <x-form-error name="password" />
                        </div>
                    </x-form-field>

                    <x-form-field>
                        <x-form-label for="password_confirmation">Confirm Password</x-form-label>

                        <div class="mt-2">
                            <x-form-input type="password" name="password_confirmation" id="password_confirmation"
                                required />
                            <x-form-error name="password_confirmation" />
                        </div>
                    </x-form-field>

                </div>
            </div>




        </div>

        <div class="mt-6 flex items-center justify-end gap-x-6">
            <a href="/home" class="text-sm font-semibold leading-6 text-gray-900">Cancel</a>
            <x-form-button type="submit">Register</x-form-button>
        </div>
    </form>

</x-page>
