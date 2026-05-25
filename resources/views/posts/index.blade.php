<x-app-layout>
    <div class="py-10 bg-slate-50 dark:bg-slate-900 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            
            <!-- Success Notification -->
            @if(session('success'))
                <div class="flex items-center p-4 mb-6 bg-emerald-50/50 border border-emerald-200 rounded-2xl shadow-sm dark:bg-emerald-950/20 dark:border-emerald-800">
                    <span class="text-emerald-600 dark:text-emerald-400 font-bold text-lg">✓</span>
                    <p class="ml-3 text-sm font-semibold text-emerald-800 dark:text-emerald-250">{{ session('success') }}</p>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                
                <!-- Sidebar Category Filter (1 col) -->
                <div class="space-y-4">
                    <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-sm border border-slate-100 dark:border-slate-700/50 p-6">
                        <h3 class="font-extrabold text-slate-800 dark:text-slate-100 text-lg border-b border-slate-100 dark:border-slate-700 pb-3 mb-4">Categories</h3>
                        
                        <nav class="space-y-1.5">
                            <a href="{{ route('posts.index') }}" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl text-xs font-bold transition-all
                                {{ !$category ? 'bg-indigo-50 text-indigo-700 border border-indigo-100 dark:bg-indigo-950/30 dark:text-indigo-400 dark:border-indigo-900/30' : 'text-slate-650 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-750/30 border border-transparent' }}">
                                <span>🌐 All Topics</span>
                            </a>
                            <a href="{{ route('posts.index', ['category' => 'Careers']) }}" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl text-xs font-bold transition-all
                                {{ $category === 'Careers' ? 'bg-indigo-50 text-indigo-700 border border-indigo-100 dark:bg-indigo-950/30 dark:text-indigo-400 dark:border-indigo-900/30' : 'text-slate-650 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-750/30 border border-transparent' }}">
                                <span>💼 Careers & Jobs</span>
                            </a>
                            <a href="{{ route('posts.index', ['category' => 'Reunions']) }}" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl text-xs font-bold transition-all
                                {{ $category === 'Reunions' ? 'bg-indigo-50 text-indigo-700 border border-indigo-100 dark:bg-indigo-950/30 dark:text-indigo-400 dark:border-indigo-900/30' : 'text-slate-650 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-750/30 border border-transparent' }}">
                                <span>🎉 Reunions & Events</span>
                            </a>
                            <a href="{{ route('posts.index', ['category' => 'Q&A']) }}" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl text-xs font-bold transition-all
                                {{ $category === 'Q&A' ? 'bg-indigo-50 text-indigo-700 border border-indigo-100 dark:bg-indigo-950/30 dark:text-indigo-400 dark:border-indigo-900/30' : 'text-slate-650 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-750/30 border border-transparent' }}">
                                <span>❓ Q&A & Support</span>
                            </a>
                            <a href="{{ route('posts.index', ['category' => 'General']) }}" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl text-xs font-bold transition-all
                                {{ $category === 'General' ? 'bg-indigo-50 text-indigo-700 border border-indigo-100 dark:bg-indigo-950/30 dark:text-indigo-400 dark:border-indigo-900/30' : 'text-slate-650 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-750/30 border border-transparent' }}">
                                <span>💬 General Chat</span>
                            </a>
                        </nav>
                    </div>
                </div>

                <!-- Forum Feed & Write post (3 cols) -->
                <div class="lg:col-span-3 space-y-6">
                    
                    <!-- Write a Post Card -->
                    <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-sm border border-slate-100 dark:border-slate-700/50 p-6 space-y-5">
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-indigo-500 to-blue-600 text-white font-extrabold flex items-center justify-center shadow-md shadow-indigo-500/10">
                                {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                            </div>
                            <div>
                                <h3 class="font-extrabold text-slate-800 dark:text-slate-100 text-base leading-tight">Start a Discussion</h3>
                                <p class="text-xs text-slate-400 mt-0.5">Share industry insights, jobs, or ask questions to the alumni pool.</p>
                            </div>
                        </div>

                        <form action="{{ route('posts.store') }}" method="POST" class="space-y-4">
                            @csrf
                            
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                                <div class="sm:col-span-2">
                                    <x-text-input name="title" required placeholder="Give your post a clear, catchy title..." class="block w-full text-sm" :value="old('title')" />
                                </div>
                                <div>
                                    <select name="category" required class="block w-full border-slate-200 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-xl shadow-sm text-sm p-3 font-semibold">
                                        <option value="General">General</option>
                                        <option value="Careers">Careers</option>
                                        <option value="Reunions">Reunions</option>
                                        <option value="Q&A">Q&A</option>
                                    </select>
                                </div>
                            </div>

                            <div>
                                <textarea name="content" rows="3" required class="block w-full text-sm border-slate-200 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-xl shadow-sm p-3.5" placeholder="What is on your mind today? Write details here...">{{ old('content') }}</textarea>
                            </div>

                            <div class="flex justify-end">
                                <button type="submit" class="inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-indigo-550 to-blue-600 hover:from-indigo-600 hover:to-blue-700 text-white font-bold rounded-xl shadow-md shadow-indigo-500/10 text-xs transition">
                                    Publish Discussion
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Forum Feed -->
                    <div class="space-y-4">
                        @forelse($posts as $post)
                            <div class="group bg-white dark:bg-slate-800 rounded-3xl shadow-sm hover:shadow-xl hover:shadow-indigo-500/5 border border-slate-100 dark:border-slate-700/50 p-6 space-y-4 transition-all duration-300">
                                
                                <!-- Author Header -->
                                <div class="flex justify-between items-start">
                                    <div class="flex items-center space-x-3.5">
                                        <div class="w-12 h-12 rounded-2xl bg-slate-50 dark:bg-slate-700/50 text-indigo-600 dark:text-indigo-400 font-extrabold flex items-center justify-center text-sm shadow-inner border border-slate-100 dark:border-slate-700/40">
                                            {{ strtoupper(substr($post->user->name, 0, 2)) }}
                                        </div>
                                        <div>
                                            <a href="{{ route('alumni-profile.show', $post->user) }}" class="font-extrabold text-slate-800 dark:text-slate-100 hover:text-indigo-600 dark:hover:text-indigo-400 transition block text-sm leading-tight">
                                                {{ $post->user->name }}
                                            </a>
                                            <p class="text-[10px] text-slate-400 font-semibold mt-1">
                                                🎓 Class of {{ $post->user->alumniProfile?->graduation_year ?? 'N/A' }} • {{ $post->user->alumniProfile?->major ?? 'Alumnus' }}
                                            </p>
                                        </div>
                                    </div>

                                    <span class="text-[9px] font-bold text-indigo-650 dark:text-indigo-400 uppercase tracking-wider bg-indigo-50 dark:bg-indigo-900/30 px-3 py-1.5 rounded-full border border-indigo-100/50 dark:border-indigo-900/20">
                                        {{ $post->category }}
                                    </span>
                                </div>

                                <!-- Post Title & Snippet -->
                                <div class="space-y-2">
                                    <a href="{{ route('posts.show', $post) }}" class="block">
                                        <h4 class="text-xl font-extrabold text-slate-800 dark:text-slate-150 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition leading-snug">
                                            {{ $post->title }}
                                        </h4>
                                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-2 line-clamp-3 leading-relaxed">
                                            {{ $post->content }}
                                        </p>
                                    </a>
                                </div>

                                <!-- Post Footer Details -->
                                <div class="pt-4 border-t border-slate-100 dark:border-slate-700/50 flex justify-between items-center text-xs text-slate-400">
                                    <div class="flex items-center space-x-1">
                                        <span>🕒</span>
                                        <span class="font-semibold">{{ $post->created_at->diffForHumans() }}</span>
                                    </div>
                                    
                                    <a href="{{ route('posts.show', $post) }}" class="inline-flex items-center space-x-2 bg-slate-50 hover:bg-indigo-50 hover:text-indigo-600 dark:bg-slate-700 dark:hover:bg-slate-650 dark:text-slate-200 dark:hover:text-indigo-400 px-3.5 py-2 rounded-xl font-bold transition">
                                        <span>💬</span>
                                        <span>{{ $post->comments->count() }} Comments</span>
                                    </a>
                                </div>

                            </div>
                        @empty
                            <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-sm border border-slate-100 dark:border-slate-700/50 p-16 text-center">
                                <div class="w-14 h-14 mx-auto rounded-2xl bg-indigo-50 dark:bg-indigo-950/30 text-indigo-500 dark:text-indigo-400 flex items-center justify-center text-2xl mb-4">
                                    💬
                                </div>
                                <p class="text-slate-500 dark:text-slate-400 text-sm font-semibold">No discussions found in this category.</p>
                                <p class="text-xs text-slate-400 mt-1">Be the first to ask a question or drop a career insight!</p>
                            </div>
                        @endforelse
                    </div>

                </div>

            </div>

        </div>
    </div>
</x-app-layout>
