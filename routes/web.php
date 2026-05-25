<?php

use App\Http\Controllers\AlumniProfileController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\MentorshipController;
use App\Http\Controllers\PostController;
use App\Models\Event;
use App\Models\Post;
use App\Models\MentorshipRelation;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    $user = Auth::user()->load('alumniProfile');
    $recentEvents = Event::orderBy('event_date', 'asc')->take(3)->get();
    $recentPosts = Post::with('user')->orderBy('created_at', 'desc')->take(3)->get();
    
    $activeMentorshipsCount = 0;
    if ($user->alumniProfile) {
        $activeMentorshipsCount = MentorshipRelation::where('status', 'active')
            ->where(function ($query) use ($user) {
                $query->where('mentor_id', $user->id)
                      ->orWhere('mentee_id', $user->id);
            })->count();
    }
    
    return view('dashboard', compact('user', 'recentEvents', 'recentPosts', 'activeMentorshipsCount'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Alumni Specific Routes
    Route::get('/alumni/profile/edit', [AlumniProfileController::class, 'edit'])->name('alumni-profile.edit');
    Route::post('/alumni/profile/update', [AlumniProfileController::class, 'update'])->name('alumni-profile.update');
    Route::get('/alumni/profile/{user}', [AlumniProfileController::class, 'show'])->name('alumni-profile.show');

    // Events Routes
    Route::get('/events', [EventController::class, 'index'])->name('events.index');
    Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
    Route::post('/events', [EventController::class, 'store'])->name('events.store');
    Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');
    Route::post('/events/{event}/rsvp', [EventController::class, 'rsvp'])->name('events.rsvp');

    // Mentorship Routes
    Route::get('/mentorship', [MentorshipController::class, 'index'])->name('mentorship.index');
    Route::post('/mentorship/request', [MentorshipController::class, 'store'])->name('mentorship.store');
    Route::patch('/mentorship/{mentorship}', [MentorshipController::class, 'update'])->name('mentorship.update');

    // Posts & Forum Routes
    Route::get('/forum', [PostController::class, 'index'])->name('posts.index');
    Route::post('/forum', [PostController::class, 'store'])->name('posts.store');
    Route::get('/forum/{post}', [PostController::class, 'show'])->name('posts.show');
    Route::post('/forum/{post}/comment', [PostController::class, 'storeComment'])->name('posts.comment');
});

require __DIR__.'/auth.php';
