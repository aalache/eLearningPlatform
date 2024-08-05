<x-page>
    <x-slot:heading>
        Job
    </x-slot:heading>

    <h2 class="font-bold text-lg">{{ $job->title }} </h2>
    <p class=" mb-5">
        This job pay {{ $job->salary }} per year
    </p>

    <p>{{ $job->employer->user->name }}</p>
    @can('edit-job', $job)
        <a href="/jobs/{{ $job->id }}/edit"
            class=" px-4 py-2 text-sm text-gray-700 hover:text-white border border-gray-900 bg-white hover:bg-gray-900 rounded-md ">Edit
            Job</a>
    @endcan

</x-page>
