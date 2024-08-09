<x-page-layout>

    <div class="p-2">
        <h1>Courses </h1>
    </div>
    <div class="w-full h-full flex  space-x-3 space-y-3 flex-wrap">
        @foreach ($courses as $course)
            <a href="/courses/{{ $course->id }}">
                <div class="h-auto w-[300px] rounded-md bg-[#efefef] space-y-2 text-gray-900 overflow-hidden">

                    <img src="{{ asset('upload') }}/courses/{{ $course->image }}" alt="">
                    <ul>
                        <li><strong>Name: </strong> {{ $course->name }}</li>
                        <li><strong>Description: </strong>{{ $course->description }}</li>
                        <li><strong>Level: </strong> {{ $course->level }}</li>
                        <li><strong>Category: </strong> {{ $course->category }}</li>
                        <li><strong>Price: </strong>${{ $course->price }}</li>
                        <li><strong>Author: </strong>@ {{ $course->user->name }}</li>
                        <li><strong>Thumbnail: </strong> {{ $course->image }}</li>
                    </ul>
                </div>
            </a>
        @endforeach
    </div>
</x-page-layout>
