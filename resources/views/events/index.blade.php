<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Available Events') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{-- Display success, info, or error messages --}}
                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('info'))
                        <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded relative mb-4" role="alert">
                            {{ session('info') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @forelse ($events as $event)
                            <div class="border rounded-lg shadow-md p-4 flex flex-col justify-between">
                                <div>
                                    <h3 class="text-xl font-bold mb-2">{{ $event->title }}</h3>
                                    @if ($event->banner_image)
                                        <img src="{{ asset($event->banner_image) }}" alt="{{ $event->title }}" class="w-full h-30 object-cover rounded-md mb-2">
                                    @endif
                                    {{-- Limit description length for card view --}}
                                    <p class="text-gray-700 text-sm mb-2 line-clamp-3">{{ $event->description ?: 'No description provided.' }}</p>
                                    <p class="text-xs text-gray-600"><strong>Dates:</strong> {{ \Carbon\Carbon::parse($event->start_date)->format('M d, Y') }} - {{ \Carbon\Carbon::parse($event->end_date)->format('M d, Y') }}</p>
                                    <p class="text-xs text-gray-600"><strong>Location:</strong> {{ $event->location }}</p>
                                </div>

                                <div class="mt-4">
                                    @auth {{-- Only show registration buttons if a user is logged in --}}
                                        @php
                                            // Check if the current event's ID is in the array of registered event IDs
                                            $isRegistered = in_array($event->id, $registeredEventIds);
                                        @endphp

                                        @if ($isRegistered)
                                            <form action="{{ route('events.unregister', $event) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="w-full bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                                    Unregister
                                                </button>
                                            </form>
                                            <span class="text-green-600 text-sm mt-2 block text-center">You are registered!</span>
                                        @else
                                            <form action="{{ route('events.register', $event) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                                    Register
                                                </button>
                                            </form>
                                        @endif
                                    @else
                                        {{-- Message for guests to log in --}}
                                        <p class="text-sm text-center text-gray-500">
                                            <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Login</a> to register.
                                        </p>
                                    @endauth
                                </div>
                            </div>
                        @empty
                            {{-- Message if no events are available --}}
                            <div class="col-span-full p-4 text-center text-gray-500">
                                No events available at the moment.
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>