<x-app-layout>
    <div class="py-10 bg-slate-50 dark:bg-slate-900 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            
            <!-- Mentorship Hero Section -->
            <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-slate-900 via-indigo-950 to-slate-950 p-8 sm:p-12 shadow-xl border border-slate-950/20">
                <!-- Glowing element -->
                <div class="absolute inset-0 bg-[radial-gradient(circle_at_70%_20%,rgba(99,102,241,0.15),transparent_50%)]"></div>
                
                <div class="relative flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                    <div class="space-y-2 max-w-2xl">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-indigo-500/10 text-indigo-300 border border-indigo-500/20">
                            🤝 Career Accelerator
                        </span>
                        <h2 class="text-3xl sm:text-4xl font-extrabold text-white tracking-tight">
                            Alumni Mentorship Hub
                        </h2>
                        <p class="text-sm text-slate-300 leading-relaxed">
                            Connect with experienced alma mater graduates who volunteered their time to guide you in your career path, interview preparations, or industry networking.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Success/Error Notifications -->
            @if(session('success'))
                <div class="flex items-center p-4 mb-4 bg-emerald-50/50 border border-emerald-200 rounded-2xl shadow-sm dark:bg-emerald-950/20 dark:border-emerald-800">
                    <span class="text-emerald-600 dark:text-emerald-400 font-bold text-lg">✓</span>
                    <p class="ml-3 text-sm font-semibold text-emerald-800 dark:text-emerald-250">{{ session('success') }}</p>
                </div>
            @endif
            @if(session('error'))
                <div class="flex items-center p-4 mb-4 bg-rose-50/50 border border-rose-200 rounded-2xl shadow-sm dark:bg-rose-950/20 dark:border-rose-800">
                    <span class="text-rose-600 dark:text-rose-400 font-bold text-lg">⚠️</span>
                    <p class="ml-3 text-sm font-semibold text-rose-800 dark:text-rose-250">{{ session('error') }}</p>
                </div>
            @endif

            <!-- 1. Requests Dashboard (If there are any sent or received requests) -->
            @if($receivedRequests->count() > 0 || $sentRequests->count() > 0)
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    
                    <!-- Received Requests (For Mentors) -->
                    @if($receivedRequests->count() > 0)
                        <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-sm border border-slate-100 dark:border-slate-700/50 p-6 space-y-6">
                            <h3 class="text-lg font-bold text-slate-850 dark:text-slate-100 border-b border-slate-100 dark:border-slate-700 pb-3">
                                Mentorship Requests Received
                            </h3>
                            
                            <div class="space-y-4">
                                @foreach($receivedRequests as $request)
                                    <div class="p-5 rounded-2xl bg-slate-50 dark:bg-slate-700/30 border border-slate-100 dark:border-slate-600/50 space-y-4">
                                        <div class="flex justify-between items-start">
                                            <div>
                                                <a href="{{ route('alumni-profile.show', $request->mentee) }}" class="font-bold text-slate-800 dark:text-slate-150 hover:text-indigo-600 hover:underline block">
                                                    {{ $request->mentee->name }}
                                                </a>
                                                <p class="text-xs text-slate-400 mt-0.5">
                                                    🎓 Class of {{ $request->mentee->alumniProfile?->graduation_year }} • {{ $request->mentee->alumniProfile?->major }}
                                                </p>
                                            </div>
                                            <span class="text-[10px] font-bold px-2.5 py-1 rounded-full uppercase tracking-wider
                                                {{ $request->status === 'pending' ? 'bg-amber-100 text-amber-700 dark:bg-amber-950/40 dark:text-amber-400' : '' }}
                                                {{ $request->status === 'active' ? 'bg-emerald-100 text-emerald-700 dark:bg-emerald-950/40 dark:text-emerald-400' : '' }}
                                                {{ $request->status === 'declined' ? 'bg-slate-200 text-slate-700 dark:bg-slate-650 dark:text-slate-350' : '' }}
                                            ">
                                                {{ $request->status }}
                                            </span>
                                        </div>

                                        <p class="text-xs text-slate-550 dark:text-slate-300 italic leading-relaxed bg-white dark:bg-slate-850 p-4 rounded-xl border border-slate-100 dark:border-slate-700">
                                            "{{ $request->message }}"
                                        </p>

                                        @if($request->status === 'pending')
                                            <div class="flex space-x-2 pt-2">
                                                <form action="{{ route('mentorship.update', $request) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status" value="active">
                                                    <button type="submit" class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl text-xs font-bold transition shadow-sm">
                                                        Accept Request
                                                    </button>
                                                </form>

                                                <form action="{{ route('mentorship.update', $request) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status" value="declined">
                                                    <button type="submit" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 dark:bg-slate-700 dark:hover:bg-slate-650 dark:text-slate-200 text-slate-700 rounded-xl text-xs font-bold transition">
                                                        Decline
                                                    </button>
                                                </form>
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Sent Requests (For Mentees) -->
                    @if($sentRequests->count() > 0)
                        <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-sm border border-slate-100 dark:border-slate-700/50 p-6 space-y-6">
                            <h3 class="text-lg font-bold text-slate-850 dark:text-slate-100 border-b border-slate-100 dark:border-slate-700 pb-3">
                                Your Sent Mentorship Requests
                            </h3>
                            
                            <div class="space-y-4">
                                @foreach($sentRequests as $request)
                                    <div class="p-5 rounded-2xl bg-slate-50 dark:bg-slate-700/30 border border-slate-100 dark:border-slate-600/50 flex justify-between items-center">
                                        <div>
                                            <a href="{{ route('alumni-profile.show', $request->mentor) }}" class="font-bold text-slate-800 dark:text-slate-150 hover:text-indigo-600 hover:underline block">
                                                {{ $request->mentor->name }}
                                            </a>
                                            <p class="text-xs text-slate-400 mt-0.5">
                                                💼 {{ $request->mentor->alumniProfile?->current_job_title }} at {{ $request->mentor->alumniProfile?->current_company ?? 'N/A' }}
                                            </p>
                                        </div>
                                        <span class="text-[10px] font-bold px-2.5 py-1 rounded-full uppercase tracking-wider
                                            {{ $request->status === 'pending' ? 'bg-amber-100 text-amber-700 dark:bg-amber-950/40 dark:text-amber-400' : '' }}
                                            {{ $request->status === 'active' ? 'bg-emerald-100 text-emerald-700 dark:bg-emerald-950/40 dark:text-emerald-400' : '' }}
                                            {{ $request->status === 'declined' ? 'bg-slate-200 text-slate-700 dark:bg-slate-650 dark:text-slate-350' : '' }}
                                        ">
                                            {{ $request->status }}
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                </div>
            @endif

            <!-- 2. Mentors Grid List -->
            <div class="space-y-6">
                <div class="border-b border-slate-200 dark:border-slate-750 pb-4">
                    <h3 class="text-2xl font-extrabold text-slate-800 dark:text-slate-100 tracking-tight">Available Mentors</h3>
                    <p class="text-sm text-slate-450 dark:text-slate-400 mt-1 leading-relaxed">
                        Filter through experience, field of study, and skills to request individual, focused guidance.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($mentors as $mentor)
                        <div class="group bg-white dark:bg-slate-800 rounded-3xl shadow-sm hover:shadow-xl hover:shadow-indigo-500/5 border border-slate-100 dark:border-slate-700/50 p-6 flex flex-col justify-between transition-all duration-300 transform hover:-translate-y-1">
                            
                            <div>
                                <!-- Mentor Card Header -->
                                <div class="flex items-center space-x-4">
                                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-indigo-500 via-indigo-650 to-blue-600 text-white font-extrabold flex items-center justify-center text-xl shadow-md shadow-indigo-500/10">
                                        {{ strtoupper(substr($mentor->name, 0, 2)) }}
                                    </div>
                                    <div>
                                        <a href="{{ route('alumni-profile.show', $mentor) }}" class="font-extrabold text-slate-800 dark:text-slate-100 hover:text-indigo-600 dark:hover:text-indigo-400 transition block text-base leading-tight">
                                            {{ $mentor->name }}
                                        </a>
                                        <p class="text-[10px] font-bold text-indigo-600 dark:text-indigo-400 uppercase tracking-wider mt-1">
                                            {{ $mentor->alumniProfile?->major }}
                                        </p>
                                    </div>
                                </div>

                                <!-- Current Employment -->
                                @if($mentor->alumniProfile?->current_job_title)
                                    <div class="flex items-center text-xs text-slate-700 dark:text-slate-300 font-semibold mt-5 bg-slate-50 dark:bg-slate-750/30 px-3.5 py-2.5 rounded-xl border border-slate-100 dark:border-slate-700/50">
                                        <span class="mr-2">💼</span>
                                        <span class="truncate">
                                            {{ $mentor->alumniProfile->current_job_title }}
                                            @if($mentor->alumniProfile->current_company)
                                                at <span class="text-indigo-600 dark:text-indigo-400 font-bold">{{ $mentor->alumniProfile->current_company }}</span>
                                            @endif
                                        </span>
                                    </div>
                                @endif

                                <!-- Skills badges -->
                                @if($mentor->alumniProfile?->skills)
                                    <div class="flex flex-wrap gap-1.5 mt-4">
                                        @foreach(array_slice(explode(',', $mentor->alumniProfile->skills), 0, 3) as $skill)
                                            <span class="text-[10px] font-bold text-slate-650 dark:text-slate-300 bg-slate-100 dark:bg-slate-700 px-2.5 py-1 rounded-lg">
                                                {{ trim($skill) }}
                                            </span>
                                        @endforeach
                                        @if(count(explode(',', $mentor->alumniProfile->skills)) > 3)
                                            <span class="text-[10px] text-slate-400 font-semibold align-middle self-center ml-1">+{{ count(explode(',', $mentor->alumniProfile->skills)) - 3 }} more</span>
                                        @endif
                                    </div>
                                @endif

                                <!-- Bio abstract -->
                                <p class="text-xs text-slate-500 dark:text-slate-400 mt-4 line-clamp-3 leading-relaxed">
                                    {{ $mentor->alumniProfile?->bio ?? 'No bio provided.' }}
                                </p>
                            </div>

                            <!-- Footer/Actions -->
                            <div class="mt-6 pt-4 border-t border-slate-100 dark:border-slate-700/50 flex justify-between items-center">
                                <a href="{{ route('alumni-profile.show', $mentor) }}" class="text-xs font-bold text-indigo-600 dark:text-indigo-400 hover:underline">
                                    View Profile
                                </a>
                                
                                @php
                                    $hasRequested = $sentRequests->contains('mentor_id', $mentor->id);
                                @endphp

                                @if($hasRequested)
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-slate-100 text-slate-500 border border-slate-200 dark:bg-slate-700 dark:text-slate-350 dark:border-slate-600">
                                        Request Sent
                                    </span>
                                @else
                                    <button onclick="document.getElementById('modal-{{ $mentor->id }}').classList.remove('hidden')" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl text-xs transition shadow-sm">
                                        Request Mentorship
                                    </button>
                                @endif
                            </div>

                        </div>

                        <!-- Mini Request Modal -->
                        <div id="modal-{{ $mentor->id }}" class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/60 backdrop-blur-sm hidden px-4">
                            <div class="bg-white dark:bg-slate-800 rounded-3xl max-w-md w-full shadow-2xl overflow-hidden border border-slate-100 dark:border-slate-700 p-6 space-y-4 transition-all transform scale-100">
                                <div class="flex justify-between items-center border-b border-slate-100 dark:border-slate-700 pb-3">
                                    <h4 class="font-extrabold text-slate-800 dark:text-slate-100 text-lg">Request Mentorship</h4>
                                    <button onclick="document.getElementById('modal-{{ $mentor->id }}').classList.add('hidden')" class="text-slate-400 hover:text-slate-600 text-2xl font-bold leading-none">&times;</button>
                                </div>
                                
                                <form action="{{ route('mentorship.store') }}" method="POST" class="space-y-4">
                                    @csrf
                                    <input type="hidden" name="mentor_id" value="{{ $mentor->id }}">
                                    <div>
                                        <label for="message-{{ $mentor->id }}" class="block text-xs font-bold text-slate-500 uppercase tracking-wide mb-2">Introduce yourself & outline goals</label>
                                        <textarea id="message-{{ $mentor->id }}" name="message" rows="4" required class="mt-1 block w-full text-sm border-slate-200 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-xl shadow-sm p-3.5" placeholder="e.g. Hi {{ $mentor->name }}, I saw your work at {{ $mentor->alumniProfile?->current_company }} and I am seeking guidance on..."></textarea>
                                    </div>

                                    <div class="flex justify-end space-x-2">
                                        <button type="button" onclick="document.getElementById('modal-{{ $mentor->id }}').classList.add('hidden')" class="px-4 py-2.5 bg-slate-100 dark:bg-slate-700 dark:text-slate-200 hover:bg-slate-200 dark:hover:bg-slate-650 rounded-xl text-xs font-bold">
                                            Cancel
                                        </button>
                                        <button type="submit" class="px-4 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-xs font-bold shadow-sm">
                                            Send Request
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    @empty
                        <div class="col-span-full py-12 text-center text-slate-500 dark:text-slate-400 text-sm">
                            No mentors are currently available. Check back soon!
                        </div>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
