<x-page-layout>

    <div class="mx-auto  flex items-baseline p-2 space-x-3 space-y-3">
        <div class="p-3 w-[50%] rounded-md bg-[#efefef] mx-auto space-y-2 text-gray-900 overflow-hidden">
            <h1> {{ $course->name }}</h1>
            <img src="{{ asset('upload') }}/courses/{{ $course->image }}" class="w-full h-52" alt="">
            <ul>
                <li><strong>Name: </strong> {{ $course->name }}</li>
                <li><strong>Description: </strong>{{ $course->description }}</li>
                <li><strong>Level: </strong> {{ $course->level }}</li>
                <li><strong>Category: </strong> {{ $course->category }}</li>
                <li><strong>Price: </strong>${{ $course->price }}</li>
                <li><strong>Author: </strong>@ {{ $course->user->name }}</li>
            </ul>
            <form action="/courses/{{ $course->id }}" method="POST">
                @csrf
                @method('DELETE')
                <x-formComponents.form-button>Delete</x-formComponents.form-button>
            </form>
        </div>

    </div>
</x-page-layout>
