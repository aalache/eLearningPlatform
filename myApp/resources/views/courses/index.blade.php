<x-page-layout>

    <div class="p-2">
        <h1>Courses </h1>
    </div>
    <div class=" flex  space-x-3 space-y-3 flex-wrap p-3 mb-10 mx-auto my-auto">
        @foreach ($courses as $course)
            <div class="h-atuo  w-[300px] rounded-md bg-[#ffffff] space-y-2 text-gray-900">
                <a href="/courses/{{ $course->id }}">

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


                </a>
                <form action="{{ route('courses.enroll', ['course' => $course]) }}" method="POST">
                    @csrf
                    <button class="bg-indigo-500 p-2 rounded-md ">Enroll</button>
                </form>
            </div>
        @endforeach
    </div>
</x-page-layout>
