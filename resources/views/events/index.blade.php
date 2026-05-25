<x-app-layout>
    <div class="py-10 bg-slate-50 dark:bg-slate-900 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            
            <!-- Elegant Header / Hero Section -->
            <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-indigo-900 via-indigo-950 to-blue-950 p-8 sm:p-12 shadow-xl border border-indigo-950/20">
                <!-- Decorative background radial gradient -->
                <div class="absolute inset-0 bg-[radial-gradient(circle_at_30%_30%,rgba(99,102,241,0.15),transparent_60%)]"></div>
                
                <div class="relative flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                    <div class="space-y-2 max-w-2xl">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-indigo-500/10 text-indigo-300 border border-indigo-500/20">
                            🏫 Alma Mater Network
                        </span>
                        <h2 class="text-3xl sm:text-4xl font-extrabold text-white tracking-tight">
                            Alumni Events & Gatherings
                        </h2>
                        <p class="text-sm text-indigo-200/80 leading-relaxed">
                            Discover upcoming mixers, academic seminars, webinars, and annual reunions. RSVP to secure your spot and re-connect with old peers!
                        </p>
                    </div>
                    <div class="flex-shrink-0">
                        <a href="{{ route('events.create') }}" class="inline-flex items-center justify-center px-6 py-3.5 bg-gradient-to-r from-indigo-550 to-blue-600 hover:from-indigo-600 hover:to-blue-700 text-white font-bold rounded-xl shadow-lg shadow-indigo-500/20 hover:shadow-indigo-500/30 text-sm transition-all transform hover:-translate-y-0.5 active:scale-[0.98]">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                            Host an Event
                        </a>
                    </div>
                </div>
            </div>

            <!-- Success Alerts -->
            @if(session('success'))
                <div class="flex items-center p-4 mb-4 bg-emerald-50/50 border border-emerald-200 rounded-2xl shadow-sm dark:bg-emerald-950/20 dark:border-emerald-800">
                    <div class="flex-shrink-0 w-8 h-8 rounded-lg bg-emerald-100 dark:bg-emerald-900/30 flex items-center justify-center text-emerald-600 dark:text-emerald-400">
                        ✓
                    </div>
                    <p class="ml-3 text-sm font-semibold text-emerald-800 dark:text-emerald-250">{{ session('success') }}</p>
                </div>
            @endif

            <!-- Main Grid Section -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($events as $event)
                    <div class="group bg-white dark:bg-slate-800 rounded-3xl shadow-sm hover:shadow-xl hover:shadow-indigo-500/5 border border-slate-100 dark:border-slate-700/50 overflow-hidden flex flex-col justify-between transition-all duration-300 transform hover:-translate-y-1">
                        
                        <!-- Event Card Header Banner -->
                        <div class="relative bg-gradient-to-r from-indigo-650 to-blue-600 p-5 text-white overflow-hidden">
                            <!-- Overlay glow -->
                            <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                            
                            <div class="relative flex items-center justify-between">
                                <span class="text-[10px] font-bold uppercase tracking-wider bg-white/10 backdrop-blur-md px-2.5 py-1 rounded-full border border-white/10">
                                    Upcoming Event
                                </span>
                                <div class="flex items-center text-xs font-semibold bg-black/10 px-2.5 py-1 rounded-full">
                                    🕒 {{ $event->event_date->format('M d, Y @ h:i A') }}
                                </div>
                            </div>
                        </div>

                        <!-- Card Body -->
                        <div class="p-6 flex-1 flex flex-col justify-between">
                            <div>
                                <h3 class="text-xl font-bold text-slate-800 dark:text-slate-100 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition mb-3">
                                    {{ $event->title }}
                                </h3>
                                <p class="text-slate-500 dark:text-slate-400 text-sm line-clamp-4 leading-relaxed mb-6">
                                    {{ $event->description }}
                                </p>
                            </div>
                            
                            <!-- Location and Organizer Details -->
                            <div class="space-y-3 pt-4 border-t border-slate-100 dark:border-slate-700/50">
                                <div class="flex items-center text-xs text-slate-450 dark:text-slate-400">
                                    <span class="mr-3 text-lg">📍</span>
                                    <span class="text-slate-650 dark:text-slate-300 font-semibold truncate">{{ $event->location }}</span>
                                </div>
                                <div class="flex items-center text-xs text-slate-450 dark:text-slate-400">
                                    <span class="mr-3 text-lg">👤</span>
                                    <span class="font-medium">
                                        Organized by 
                                        <a href="{{ route('alumni-profile.show', $event->organizer) }}" class="text-indigo-600 dark:text-indigo-400 font-bold hover:underline ml-0.5">
                                            {{ $event->organizer->name }}
                                        </a>
                                    </span>
                                </div>
                                <div class="flex items-center text-xs text-slate-450 dark:text-slate-400">
                                    <span class="mr-3 text-lg">👥</span>
                                    <span class="text-slate-600 dark:text-slate-300 font-semibold">
                                        {{ $event->attendees()->count() }} RSVP'd 
                                        @if($event->max_participants)
                                            <span class="text-slate-400 font-medium">/ {{ $event->max_participants }} spots</span>
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Card Actions Footer -->
                        <div class="p-6 border-t border-slate-100 dark:border-slate-700/50 flex justify-between items-center bg-slate-50/50 dark:bg-slate-800/40">
                            <!-- RSVP Badge -->
                            @if($event->attendees->contains(Auth::id()))
                                <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-100 dark:bg-emerald-950/20 dark:text-emerald-400 dark:border-emerald-900/30">
                                    ✓ Going
                                </span>
                            @elseif($event->max_participants && $event->attendees()->count() >= $event->max_participants)
                                <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold bg-rose-50 text-rose-700 border border-rose-100 dark:bg-rose-950/20 dark:text-rose-400 dark:border-rose-900/30">
                                    Filled
                                </span>
                            @else
                                <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold bg-blue-50 text-blue-700 border border-blue-100 dark:bg-blue-950/20 dark:text-blue-400 dark:border-blue-900/30">
                                    Open
                                </span>
                            @endif

                            <a href="{{ route('events.show', $event) }}" class="inline-flex items-center px-5 py-2.5 bg-indigo-50 hover:bg-indigo-100 dark:bg-slate-700 dark:text-indigo-200 dark:hover:bg-slate-600 font-bold rounded-xl text-xs transition-all">
                                View Details
                                <svg class="w-3 h-3 ml-1.5 transform group-hover:translate-x-0.5 transition" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                </svg>
                            </a>
                        </div>

                    </div>
                @empty
                    <div class="col-span-full bg-white dark:bg-slate-800 rounded-3xl shadow-sm border border-slate-100 dark:border-slate-700 p-16 text-center">
                        <div class="w-16 h-16 mx-auto rounded-2xl bg-indigo-50 dark:bg-indigo-950/30 text-indigo-500 dark:text-indigo-400 flex items-center justify-center text-3xl mb-4">
                            📅
                        </div>
                        <h3 class="text-lg font-bold text-slate-800 dark:text-slate-100">No events currently scheduled</h3>
                        <p class="mt-2 text-sm text-slate-500 dark:text-slate-400 max-w-sm mx-auto">
                            Be the first to rally the alumni group by creating a new meeting, event, or reunion.
                        </p>
                        <div class="mt-6">
                            <a href="{{ route('events.create') }}" class="inline-flex items-center px-5 py-2.5 bg-gradient-to-r from-indigo-550 to-blue-600 text-white font-bold rounded-xl text-xs transition">
                                Create Event
                            </a>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
