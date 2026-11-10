<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
    <h3 class="text-lg font-semibold mb-4">My cities</h3>

    @forelse ($places as $place)
        <div class="border rounded-lg p-4 mb-4">
            <h4 class="text-xl font-bold">
                {{ $place->name }}
            </h4>

            <p>Latitude: {{ $place->latitude }}</p>
            <p>Longitude: {{ $place->longitude }}</p>
        </div>
    @empty
        <p>No cities have been saved yet.</p>
    @endforelse
</div>
            </div>
        </div>
    </div>
</x-app-layout>
