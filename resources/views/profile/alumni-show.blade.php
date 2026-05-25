<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-100 leading-tight">
            {{ $user->name }}'s Profile
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 dark:bg-gray-900 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
                
                <!-- Profile Header Banner -->
                <div class="h-32 bg-gradient-to-r from-blue-500 to-indigo-600"></div>

                <div class="p-8 relative">
                    <!-- Avatar placeholder -->
                    <div class="absolute -top-16 left-8">
                        <div class="w-28 h-28 bg-white dark:bg-gray-800 rounded-2xl shadow-md border-4 border-white dark:border-gray-850 flex items-center justify-center font-bold text-3xl text-indigo-600 dark:text-indigo-400">
                            {{ strtoupper(substr($user->name, 0, 2)) }}
                        </div>
                    </div>

                    <!-- Name and Basic Info -->
                    <div class="pt-12 sm:flex sm:justify-between sm:items-start">
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100 flex items-center">
                                {{ $user->name }}
                                @if($user->alumniProfile?->is_mentor)
                                    <span class="ml-3 text-xs font-bold text-emerald-600 dark:text-emerald-400 bg-emerald-50 dark:bg-emerald-950/30 px-2.5 py-1 rounded-full uppercase tracking-wide">
                                        Mentor
                                    </span>
                                @endif
                            </h3>
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mt-1">
                                🎓 Class of {{ $user->alumniProfile?->graduation_year ?? 'N/A' }} • {{ $user->alumniProfile?->major ?? 'N/A' }}
                            </p>
                            @if($user->alumniProfile?->current_job_title)
                                <p class="text-base text-gray-700 dark:text-gray-300 mt-3 font-semibold">
                                    💼 {{ $user->alumniProfile->current_job_title }}
                                    @if($user->alumniProfile->current_company)
                                        at <span class="text-indigo-600 dark:text-indigo-400">{{ $user->alumniProfile->current_company }}</span>
                                    @endif
                                </p>
                            @endif
                        </div>

                        <!-- LinkedIn and actions -->
                        <div class="mt-4 sm:mt-0 flex space-x-2">
                            @if($user->alumniProfile?->linkedin_url)
                                <a href="{{ $user->alumniProfile->linkedin_url }}" target="_blank" class="p-2.5 bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 rounded-lg hover:bg-blue-100 dark:hover:bg-blue-900/50 transition">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.779-1.75-1.75s.784-1.75 1.75-1.75 1.75.779 1.75 1.75-.784 1.75-1.75 1.75zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                                </a>
                            @endif
                        </div>
                    </div>

                    <!-- Skills Section -->
                    @if($user->alumniProfile?->skills)
                        <div class="mt-8 pt-8 border-t border-gray-100 dark:border-gray-700/50">
                            <h4 class="text-sm font-bold text-gray-400 uppercase tracking-wide">Skills & Expertise</h4>
                            <div class="flex flex-wrap gap-2 mt-3">
                                @foreach(explode(',', $user->alumniProfile->skills) as $skill)
                                    <span class="text-xs font-bold text-indigo-600 dark:text-indigo-400 bg-indigo-50 dark:bg-indigo-900/30 px-3 py-1.5 rounded-lg">
                                        {{ trim($skill) }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Bio Section -->
                    <div class="mt-8 pt-8 border-t border-gray-100 dark:border-gray-700/50">
                        <h4 class="text-sm font-bold text-gray-400 uppercase tracking-wide">About</h4>
                        <p class="text-gray-650 dark:text-gray-300 text-sm mt-3 leading-relaxed">
                            {{ $user->alumniProfile?->bio ?? 'This alumnus hasn\'t written a bio yet.' }}
                        </p>
                    </div>

                    <!-- Mentorship request block -->
                    @if($user->id !== Auth::id() && $user->alumniProfile?->is_mentor)
                        <div class="mt-10 p-6 rounded-2xl bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-gray-700/30 dark:to-indigo-900/10 border border-blue-100/50 dark:border-gray-600">
                            <h4 class="font-bold text-gray-800 dark:text-gray-150">Need mentorship from {{ $user->name }}?</h4>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Send a polite request introducing yourself and explaining what you hope to learn.</p>
                            
                            <form action="{{ route('mentorship.store') }}" method="POST" class="mt-4">
                                @csrf
                                <input type="hidden" name="mentor_id" value="{{ $user->id }}">
                                <textarea name="message" rows="3" required class="block w-full text-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" placeholder="Hi {{ $user->name }}, I'd love to connect to discuss..."></textarea>
                                <button type="submit" class="mt-3 inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg shadow-sm text-xs transition">
                                    Send Mentorship Request
                                </button>
                            </form>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
