<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\AlumniProfile;
use App\Models\MentorshipRelation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MentorshipController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // 1. Get all mentors except current user
        $mentors = User::whereHas('alumniProfile', function ($query) {
            $query->where('is_mentor', true);
        })->where('id', '!=', $user->id)
          ->with('alumniProfile')
          ->get();

        // 2. Sent requests
        $sentRequests = MentorshipRelation::where('mentee_id', $user->id)
            ->with('mentor')
            ->get();

        // 3. Received requests
        $receivedRequests = MentorshipRelation::where('mentor_id', $user->id)
            ->with('mentee')
            ->get();

        return view('mentorship.index', compact('mentors', 'sentRequests', 'receivedRequests'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'mentor_id' => 'required|exists:users,id',
            'message' => 'nullable|string',
        ]);

        $menteeId = Auth::id();
        $mentorId = $request->mentor_id;

        if ($mentorId == $menteeId) {
            return back()->with('error', 'You cannot request mentorship from yourself.');
        }

        // Check if existing request
        $existing = MentorshipRelation::where('mentor_id', $mentorId)
            ->where('mentee_id', $menteeId)
            ->first();

        if ($existing) {
            return back()->with('error', 'You already have an active or pending mentorship relationship with this alumnus.');
        }

        MentorshipRelation::create([
            'mentor_id' => $mentorId,
            'mentee_id' => $menteeId,
            'status' => 'pending',
            'message' => $request->message,
        ]);

        return back()->with('success', 'Mentorship request sent successfully!');
    }

    public function update(Request $request, MentorshipRelation $mentorship)
    {
        // Only the mentor can accept or decline
        if ($mentorship->mentor_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'status' => 'required|in:active,declined,completed',
        ]);

        $mentorship->update([
            'status' => $request->status,
        ]);

        return back()->with('success', 'Mentorship request status updated to ' . $request->status . '.');
    }
}
