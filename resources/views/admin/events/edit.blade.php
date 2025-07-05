<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Event: ') . $event->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('admin.events.update', $event) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT') {{-- Required for update --}}

                        <div>
                            <x-input-label for="title" :value="__('Title')" />
                            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title', $event->title)" required autofocus />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="description" :value="__('Description')" />
                            <textarea id="description" name="description" rows="5" class="block w-full mt-1 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('description', $event->description) }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="start_date" :value="__('Start Date')" />
                            <x-text-input id="start_date" class="block mt-1 w-full" type="date" name="start_date" :value="old('start_date', $event->start_date)" required />
                            <x-input-error :messages="$errors->get('start_date')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="end_date" :value="__('End Date')" />
                            <x-text-input id="end_date" class="block mt-1 w-full" type="date" name="end_date" :value="old('end_date', $event->end_date)" required />
                            <x-input-error :messages="$errors->get('end_date')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="location" :value="__('Location')" />
                            <x-text-input id="location" class="block mt-1 w-full" type="text" name="location" :value="old('location', $event->location)" required />
                            <x-input-error :messages="$errors->get('location')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="banner_image" :value="__('Banner Image (Optional)')" />
                            @if ($event->banner_image)
                                <img src="{{ asset($event->banner_image) }}" alt="Current Banner" class="mt-2 mb-2 w-48 h-auto object-cover rounded">
                                <div class="flex items-center">
                                    <input type="checkbox" name="clear_image" id="clear_image" value="1" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                                    <label for="clear_image" class="ml-2 text-sm text-gray-600">Remove current image</label>
                                </div>
                            @endif
                            <input id="banner_image" class="block mt-1 w-full" type="file" name="banner_image" accept="image/*" />
                            <x-input-error :messages="$errors->get('banner_image')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button>
                                {{ __('Update Event') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>