<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-100 leading-tight">
                Forum Discussion
            </h2>
            <a href="{{ route('posts.index') }}" class="text-sm font-semibold text-indigo-600 dark:text-indigo-400 hover:underline">
                &larr; Back to Forum
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 dark:bg-gray-900 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Success Notification -->
            @if(session('success'))
                <div class="bg-emerald-50 border-l-4 border-emerald-500 p-4 rounded shadow-sm dark:bg-emerald-950/30 dark:border-emerald-400">
                    <p class="text-sm font-medium text-emerald-800 dark:text-emerald-200">{{ session('success') }}</p>
                </div>
            @endif

            <!-- Original Post Card -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-6 sm:p-8 space-y-6">
                
                <!-- Header with author -->
                <div class="flex justify-between items-start border-b border-gray-50 dark:border-gray-700/50 pb-4">
                    <div class="flex items-center space-x-3">
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-indigo-500 to-purple-600 text-white font-bold flex items-center justify-center text-base shadow-sm">
                            {{ strtoupper(substr($post->user->name, 0, 2)) }}
                        </div>
                        <div>
                            <a href="{{ route('alumni-profile.show', $post->user) }}" class="font-bold text-gray-900 dark:text-gray-150 hover:underline block">
                                {{ $post->user->name }}
                            </a>
                            <p class="text-xs text-gray-400">
                                🎓 Class of {{ $post->user->alumniProfile?->graduation_year ?? 'N/A' }} • {{ $post->user->alumniProfile?->major ?? 'Alumnus' }}
                            </p>
                        </div>
                    </div>

                    <span class="text-xs font-bold text-indigo-600 dark:text-indigo-400 uppercase tracking-wide bg-indigo-50 dark:bg-indigo-900/30 px-2.5 py-1.5 rounded-lg">
                        {{ $post->category }}
                    </span>
                </div>

                <!-- Content -->
                <div class="space-y-4">
                    <h3 class="text-2xl font-extrabold text-gray-900 dark:text-gray-100">
                        {{ $post->title }}
                    </h3>
                    <p class="text-gray-650 dark:text-gray-300 leading-relaxed text-sm sm:text-base whitespace-pre-wrap">
                        {{ $post->content }}
                    </p>
                </div>

                <!-- Footer details -->
                <div class="pt-4 border-t border-gray-50 dark:border-gray-700/30 text-xs text-gray-400 flex justify-between items-center">
                    <span>🕒 Posted {{ $post->created_at->format('F d, Y @ h:i A') }} ({{ $post->created_at->diffForHumans() }})</span>
                </div>

            </div>

            <!-- Comments Section -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-6 sm:p-8 space-y-6">
                <h4 class="font-bold text-gray-850 dark:text-gray-100 text-lg border-b border-gray-100 dark:border-gray-700 pb-3">
                    Comments ({{ $post->comments->count() }})
                </h4>

                <!-- Add Comment Form -->
                <form action="{{ route('posts.comment', $post) }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <x-input-label for="content" :value="__('Join the conversation')" />
                        <textarea id="content" name="content" rows="3" required class="mt-1 block w-full text-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" placeholder="Write a supportive comment or ask a follow-up question..."></textarea>
                        <x-input-error class="mt-2" :messages="$errors->get('content')" />
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-lg text-xs transition shadow-sm">
                            Submit Comment
                        </button>
                    </div>
                </form>

                <!-- Comments List -->
                <div class="space-y-6 pt-6 border-t border-gray-50 dark:border-gray-700/50">
                    @forelse($post->comments as $comment)
                        <div class="flex items-start space-x-4 border-b last:border-b-0 border-gray-50 dark:border-gray-750/30 pb-6 last:pb-0">
                            <div class="w-9 h-9 rounded-lg bg-gray-50 dark:bg-gray-700/50 text-indigo-600 dark:text-indigo-400 font-bold flex items-center justify-center text-xs shadow-inner">
                                {{ strtoupper(substr($comment->user->name, 0, 2)) }}
                            </div>
                            
                            <div class="flex-1 space-y-1">
                                <div class="flex justify-between items-baseline">
                                    <div>
                                        <a href="{{ route('alumni-profile.show', $comment->user) }}" class="text-sm font-bold text-gray-855 dark:text-gray-150 hover:underline">
                                            {{ $comment->user->name }}
                                        </a>
                                        <span class="text-[10px] text-gray-400 ml-2 font-medium">
                                            Class of {{ $comment->user->alumniProfile?->graduation_year ?? 'N/A' }}
                                        </span>
                                    </div>
                                    <span class="text-[10px] text-gray-405 dark:text-gray-500">{{ $comment->created_at->diffForHumans() }}</span>
                                </div>
                                <p class="text-xs text-gray-650 dark:text-gray-305 leading-relaxed pt-1">
                                    {{ $comment->content }}
                                </p>
                            </div>
                        </div>
                    @empty
                        <p class="text-sm text-gray-500 dark:text-gray-400 italic">No comments yet. Be the first to join the thread!</p>
                    @endforelse
                </div>

            </div>

        </div>
    </div>
</x-app-layout>
