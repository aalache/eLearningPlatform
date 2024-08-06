<x-page>
    <x-slot:heading>
        Contact
    </x-slot:heading>
    <h1>Hello from contact page</h1>

    {{ Auth::user()->name }}
    <br>
    {{ Auth::check() }}
    <br>
    {{ $msg }}
</x-page>
