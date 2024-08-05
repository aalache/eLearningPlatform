<x-page>
    <x-slot:heading>
        Jobs list
    </x-slot:heading>

    <div class="space-y-2">
        @foreach ($jobs as $job)
            <a href="/jobs/{{ $job->id }}"
                class=" block px-4 py-6 border border-gray-200  bg-white rounded-md hover:bg-gray-300 hover:shadow-sm">
                <div class="text-gray-600">
                    {{ $job->employer->name }}
                </div>
                <div>
                    <strong>{{ $job->title }} :</strong> {{ $job->salary }}
                </div>
            </a>
        @endforeach
        <div class="pb-4">
            {{ $jobs->links() }}
        </div>
    </div>
</x-page>
