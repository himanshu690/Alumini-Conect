<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-100 leading-tight">
            {{ __('Host a New Alumni Event') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 dark:bg-gray-900 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
                <div class="p-8 sm:p-10">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-6">Event Details</h3>

                    <form action="{{ route('events.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <!-- Event Title -->
                        <div>
                            <x-input-label for="title" :value="__('Event Title')" />
                            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title')" placeholder="e.g. 2018 Reunion, Tech Panel, Career Mixer" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('title')" />
                        </div>

                        <!-- Description -->
                        <div>
                            <x-input-label for="description" :value="__('Event Description')" />
                            <textarea id="description" name="description" rows="5" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" placeholder="Detail the schedule, topics, speakers, food/drink availability, or Zoom details..." required>{{ old('description') }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('description')" />
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <!-- Event Date -->
                            <div>
                                <x-input-label for="event_date" :value="__('Event Date & Time')" />
                                <x-text-input id="event_date" name="event_date" type="datetime-local" class="mt-1 block w-full" :value="old('event_date')" required />
                                <x-input-error class="mt-2" :messages="$errors->get('event_date')" />
                            </div>

                            <!-- Max Participants -->
                            <div>
                                <x-input-label for="max_participants" :value="__('Capacity (Optional)')" />
                                <x-text-input id="max_participants" name="max_participants" type="number" class="mt-1 block w-full" :value="old('max_participants')" placeholder="e.g. 100 (Leave empty if unlimited)" />
                                <x-input-error class="mt-2" :messages="$errors->get('max_participants')" />
                            </div>
                        </div>

                        <!-- Location -->
                        <div>
                            <x-input-label for="location" :value="__('Location')" />
                            <x-text-input id="location" name="location" type="text" class="mt-1 block w-full" :value="old('location')" placeholder="e.g. Campus Courtyard, Room 402, or Zoom Webinar Link" required />
                            <x-input-error class="mt-2" :messages="$errors->get('location')" />
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex justify-end pt-6 border-t border-gray-100 dark:border-gray-700/50 space-x-3">
                            <a href="{{ route('events.index') }}" class="px-5 py-2.5 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-200 rounded-lg font-semibold text-sm transition">Cancel</a>
                            <button type="submit" class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-semibold text-sm transition">Publish Event</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
