<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Event Details: ') . $event->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-medium text-gray-900">{{ $event->title }}</h3>
                        <div class="flex space-x-2">
                            <a href="{{ route('admin.events.edit', $event) }}" class="inline-flex items-center px-4 py-2 bg-yellow-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-400 focus:bg-yellow-400 active:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Edit
                            </a>
                            <form action="{{ route('admin.events.destroy', $event) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this event?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>

                    @if ($event->banner_image)
                        <img src="{{ asset($event->banner_image) }}" alt="{{ $event->title }}" class="w-full h-64 object-cover rounded-md mb-4">
                    @endif

                    <p class="text-gray-700 mb-2"><strong>Description:</strong> {{ $event->description ?: 'N/A' }}</p>
                    <p class="text-gray-700 mb-2"><strong>Start Date:</strong> {{ $event->start_date }}</p>
                    <p class="text-gray-700 mb-2"><strong>End Date:</strong> {{ $event->end_date }}</p>
                    <p class="text-gray-700 mb-2"><strong>Location:</strong> {{ $event->location }}</p>

                    <div class="mt-6">
                        <a href="{{ route('admin.events.index') }}" class="text-indigo-600 hover:text-indigo-900">Back to Event List</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>