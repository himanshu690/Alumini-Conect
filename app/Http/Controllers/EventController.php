<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::with('organizer')->orderBy('event_date', 'asc')->get();
        return view('events.index', compact('events'));
    }

    public function show(Event $event)
    {
        $event->load(['organizer', 'attendees']);
        $isAttending = $event->attendees->contains(Auth::id());
        return view('events.show', compact('event', 'isAttending'));
    }

    public function create()
    {
        return view('events.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'event_date' => 'required|date|after:now',
            'location' => 'required|string|max:255',
            'max_participants' => 'nullable|integer|min:1',
        ]);

        Auth::user()->events()->create($request->all());

        return redirect()->route('events.index')->with('success', 'Event created successfully!');
    }

    public function rsvp(Event $event)
    {
        $userId = Auth::id();
        
        if ($event->attendees->contains($userId)) {
            $event->attendees()->detach($userId);
            $message = 'RSVP cancelled successfully.';
        } else {
            // Check if full
            if ($event->max_participants && $event->attendees()->count() >= $event->max_participants) {
                return back()->with('error', 'Sorry, this event is already full.');
            }
            
            $event->attendees()->attach($userId, ['status' => 'registered']);
            $message = 'RSVP confirmed successfully!';
        }

        return back()->with('success', $message);
    }
}
