<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                
                <ul class="mt-4">
                        <li>
    
    <a href="{{ route('admin.events.index') }}" class="text-blue-600">Manage Events</a></li>
                        {{-- Add more admin links here later if needed --}}
                    </ul>
            </div>
        </div>
    </div>

    
</x-app-layout>
