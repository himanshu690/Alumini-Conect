<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-100 leading-tight">
            {{ __('Alumni Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 dark:bg-gray-900 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <!-- Success Notification -->
            @if(session('success'))
                <div class="bg-emerald-50 border-l-4 border-emerald-500 p-4 rounded shadow-sm dark:bg-emerald-950/30 dark:border-emerald-400">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-emerald-500 dark:text-emerald-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-emerald-800 dark:text-emerald-200">
                                {{ session('success') }}
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Profile Completion Alert -->
            @if(!$user->alumniProfile)
                <div class="relative overflow-hidden bg-gradient-to-r from-blue-600 to-indigo-700 text-white rounded-2xl shadow-xl p-6 sm:p-8">
                    <div class="absolute right-0 top-0 opacity-10 transform translate-x-12 -translate-y-12">
                        <svg class="w-64 h-64" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 17h-2v-2h2v2zm2.07-7.75l-.9.92C13.45 12.9 13 13.5 13 15h-2v-.5c0-1.1.45-2.1 1.17-2.83l1.24-1.26c.37-.36.59-.86.59-1.41 0-1.1-.9-2-2-2s-2 .9-2 2H7c0-2.76 2.24-5 5-5s5 2.24 5 5c0 1.04-.42 1.99-1.07 2.75z"/></svg>
                    </div>
                    <div class="relative z-10 space-y-4 max-w-2xl">
                        <h3 class="text-2xl font-bold">Complete Your Alumni Profile</h3>
                        <p class="text-indigo-100 leading-relaxed text-sm sm:text-base">
                            Welcome, {{ $user->name }}! Unlock mentorship, custom invitations, and netoworking by filling out your graduation year, major, current career, and skills.
                        </p>
                        <a href="{{ route('alumni-profile.edit') }}" class="inline-flex items-center px-6 py-3 bg-white text-indigo-700 font-semibold rounded-lg shadow hover:bg-indigo-50 transition duration-150 ease-in-out">
                            Setup Profile Now
                            <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    </div>
                </div>
            @endif

            <!-- Stats grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Profile Status Card -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-6 flex items-center space-x-6">
                    <div class="p-4 rounded-xl bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-400">Your Status</p>
                        @if($user->alumniProfile)
                            <h4 class="text-xl font-bold text-gray-800 dark:text-gray-100">{{ $user->alumniProfile->major }}</h4>
                            <p class="text-xs text-emerald-600 dark:text-emerald-400 font-medium">Profile Complete</p>
                        @else
                            <h4 class="text-xl font-bold text-gray-800 dark:text-gray-100">Guest Profile</h4>
                            <p class="text-xs text-amber-500 font-medium">Please set up your graduation year</p>
                        @endif
                    </div>
                </div>

                <!-- Mentorship Connections Card -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-6 flex items-center space-x-6">
                    <div class="p-4 rounded-xl bg-purple-50 dark:bg-purple-900/30 text-purple-600 dark:text-purple-400">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-400">Active Mentorships</p>
                        <h4 class="text-2xl font-bold text-gray-800 dark:text-gray-100">{{ $activeMentorshipsCount }}</h4>
                        <p class="text-xs text-purple-600 dark:text-purple-400 font-medium">Relationships active</p>
                    </div>
                </div>

                <!-- Quick actions card -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-6 flex items-center space-x-6">
                    <div class="p-4 rounded-xl bg-amber-50 dark:bg-amber-900/30 text-amber-600 dark:text-amber-400">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/></svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-medium text-gray-400">Quick Actions</p>
                        <div class="flex space-x-2 mt-2">
                            <a href="{{ route('events.create') }}" class="text-xs font-semibold px-3 py-1.5 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">Create Event</a>
                            <a href="{{ route('posts.index') }}" class="text-xs font-semibold px-3 py-1.5 bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-200 rounded-md hover:bg-gray-200 dark:hover:bg-gray-600 transition">Create Post</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Split Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <!-- Recent Events (Left 2 cols) -->
                <div class="lg:col-span-2 space-y-6">
                    <div class="flex justify-between items-center">
                        <h3 class="text-xl font-bold text-gray-800 dark:text-gray-100">Upcoming Events</h3>
                        <a href="{{ route('events.index') }}" class="text-sm font-semibold text-blue-600 dark:text-blue-400 hover:underline">View All</a>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @forelse($recentEvents as $event)
                            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden flex flex-col justify-between">
                                <div class="p-6">
                                    <span class="inline-block text-xs font-bold text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-blue-900/30 px-2 py-1 rounded mb-3">
                                        {{ $event->event_date->format('F d, Y') }}
                                    </span>
                                    <h4 class="text-lg font-bold text-gray-800 dark:text-gray-100 mb-2">{{ $event->title }}</h4>
                                    <p class="text-gray-500 dark:text-gray-400 text-sm line-clamp-3 mb-4">{{ $event->description }}</p>
                                </div>
                                <div class="p-6 pt-0 border-t border-gray-50 dark:border-gray-700/50 flex justify-between items-center">
                                    <span class="text-xs text-gray-400 font-medium">📍 {{ $event->location }}</span>
                                    <a href="{{ route('events.show', $event) }}" class="text-xs font-bold text-blue-600 dark:text-blue-400 hover:underline flex items-center">
                                        Details 
                                        <svg class="w-3.5 h-3.5 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                    </a>
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-500 dark:text-gray-400 text-sm py-4">No events scheduled. Be the first to create one!</p>
                        @endforelse
                    </div>
                </div>

                <!-- Forum Feed (Right 1 col) -->
                <div class="space-y-6">
                    <div class="flex justify-between items-center">
                        <h3 class="text-xl font-bold text-gray-800 dark:text-gray-100">Recent Discussions</h3>
                        <a href="{{ route('posts.index') }}" class="text-sm font-semibold text-blue-600 dark:text-blue-400 hover:underline">View All</a>
                    </div>
                    
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-6 space-y-6">
                        @forelse($recentPosts as $post)
                            <div class="group border-b last:border-0 border-gray-100 dark:border-gray-700/50 pb-4 last:pb-0">
                                <a href="{{ route('posts.show', $post) }}" class="block">
                                    <span class="text-[10px] font-bold text-indigo-600 dark:text-indigo-400 uppercase tracking-wide bg-indigo-50 dark:bg-indigo-900/30 px-1.5 py-0.5 rounded">
                                        {{ $post->category }}
                                    </span>
                                    <h4 class="text-sm font-bold text-gray-800 dark:text-gray-100 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition mt-2">
                                        {{ $post->title }}
                                    </h4>
                                    <div class="flex items-center space-x-2 mt-2 text-xs text-gray-400">
                                        <span>By {{ $post->user->name }}</span>
                                        <span>•</span>
                                        <span>{{ $post->created_at->diffForHumans() }}</span>
                                    </div>
                                </a>
                            </div>
                        @empty
                            <p class="text-gray-500 dark:text-gray-400 text-sm py-4">No discussions yet. Spark a conversation!</p>
                        @endforelse
                    </div>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>
