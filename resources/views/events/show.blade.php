<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-100 leading-tight">
                {{ $event->title }}
            </h2>
            <a href="{{ route('events.index') }}" class="text-sm font-semibold text-indigo-600 dark:text-indigo-400 hover:underline">
                &larr; Back to Events
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 dark:bg-gray-900 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Success/Error Notifications -->
            @if(session('success'))
                <div class="mb-6 bg-emerald-50 border-l-4 border-emerald-500 p-4 rounded shadow-sm dark:bg-emerald-950/30 dark:border-emerald-400">
                    <p class="text-sm font-medium text-emerald-800 dark:text-emerald-200">{{ session('success') }}</p>
                </div>
            @endif
            @if(session('error'))
                <div class="mb-6 bg-rose-50 border-l-4 border-rose-500 p-4 rounded shadow-sm dark:bg-rose-950/30 dark:border-rose-400">
                    <p class="text-sm font-medium text-rose-800 dark:text-rose-200">{{ session('error') }}</p>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <!-- Main Info Card (2 cols) -->
                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
                        <!-- Card Banner Color -->
                        <div class="h-4 bg-gradient-to-r from-blue-500 to-indigo-600"></div>

                        <div class="p-8">
                            <span class="inline-block text-xs font-bold text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-blue-900/30 px-2.5 py-1.5 rounded mb-4 uppercase tracking-wider">
                                {{ $event->event_date->format('l, F d, Y') }}
                            </span>
                            
                            <h3 class="text-3xl font-extrabold text-gray-900 dark:text-gray-100 mb-6">{{ $event->title }}</h3>
                            
                            <div class="prose dark:prose-invert max-w-none text-gray-650 dark:text-gray-300 leading-relaxed text-sm sm:text-base space-y-4">
                                {!! nl2br(e($event->description)) !!}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Event Details Panel & Attendee List (1 col) -->
                <div class="space-y-6">
                    <!-- RSVP Card -->
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-6 space-y-6">
                        <h4 class="font-bold text-gray-850 dark:text-gray-100 text-lg border-b border-gray-100 dark:border-gray-700 pb-3">Event Details</h4>
                        
                        <div class="space-y-4 text-sm">
                            <div class="flex items-start">
                                <span class="text-gray-400 mr-3">📅</span>
                                <div>
                                    <p class="font-bold text-gray-750 dark:text-gray-250">When</p>
                                    <p class="text-gray-500 dark:text-gray-400 mt-0.5">{{ $event->event_date->format('F d, Y @ h:i A') }}</p>
                                </div>
                            </div>

                            <div class="flex items-start">
                                <span class="text-gray-400 mr-3">📍</span>
                                <div>
                                    <p class="font-bold text-gray-750 dark:text-gray-250">Where</p>
                                    <p class="text-gray-500 dark:text-gray-400 mt-0.5">{{ $event->location }}</p>
                                </div>
                            </div>

                            <div class="flex items-start">
                                <span class="text-gray-400 mr-3">👤</span>
                                <div>
                                    <p class="font-bold text-gray-750 dark:text-gray-250">Organizer</p>
                                    <a href="{{ route('alumni-profile.show', $event->organizer) }}" class="text-indigo-600 dark:text-indigo-400 hover:underline mt-0.5 inline-block font-semibold">
                                        {{ $event->organizer->name }}
                                    </a>
                                </div>
                            </div>

                            <div class="flex items-start">
                                <span class="text-gray-400 mr-3">👥</span>
                                <div>
                                    <p class="font-bold text-gray-750 dark:text-gray-250">Attendance</p>
                                    <p class="text-gray-500 dark:text-gray-400 mt-0.5">
                                        {{ $event->attendees->count() }} attending
                                        @if($event->max_participants)
                                            (Limit: {{ $event->max_participants }} seats)
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- RSVP Form Button -->
                        <div class="pt-4 border-t border-gray-105 dark:border-gray-700/50">
                            <form action="{{ route('events.rsvp', $event) }}" method="POST">
                                @csrf
                                @if($isAttending)
                                    <button type="submit" class="w-full text-center py-3 px-4 bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-gray-200 text-gray-750 font-bold rounded-xl transition shadow-sm text-sm">
                                        Cancel RSVP
                                    </button>
                                @else
                                    <button type="submit" 
                                        @if($event->max_participants && $event->attendees->count() >= $event->max_participants) disabled @endif
                                        class="w-full text-center py-3 px-4 bg-blue-650 hover:bg-blue-700 text-white font-bold rounded-xl transition shadow shadow-blue-500/20 text-sm disabled:opacity-50 disabled:cursor-not-allowed">
                                        {{ $event->max_participants && $event->attendees->count() >= $event->max_participants ? 'Event is Full' : 'RSVP for Event' }}
                                    </button>
                                @endif
                            </form>
                        </div>
                    </div>

                    <!-- Who's attending card -->
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-6 space-y-4">
                        <h4 class="font-bold text-gray-850 dark:text-gray-100 text-lg border-b border-gray-100 dark:border-gray-700 pb-3">Who's Attending</h4>
                        
                        <div class="space-y-3">
                            @forelse($event->attendees as $attendee)
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 rounded-lg bg-indigo-50 dark:bg-indigo-900/30 text-indigo-650 dark:text-indigo-400 font-bold flex items-center justify-center text-xs">
                                        {{ strtoupper(substr($attendee->name, 0, 2)) }}
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <a href="{{ route('alumni-profile.show', $attendee) }}" class="text-sm font-semibold text-gray-850 dark:text-gray-250 truncate hover:underline block">
                                            {{ $attendee->name }}
                                        </a>
                                        <p class="text-[10px] text-gray-400 truncate">
                                            {{ $attendee->alumniProfile?->major ?? 'Alumnus' }}
                                        </p>
                                    </div>
                                </div>
                            @empty
                                <p class="text-xs text-gray-400">No RSVPs yet. Be the first to join!</p>
                            @endforelse
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>
