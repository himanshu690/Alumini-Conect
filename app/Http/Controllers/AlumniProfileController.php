<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\AlumniProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlumniProfileController extends Controller
{
    public function show(User $user)
    {
        $user->load('alumniProfile');
        return view('profile.alumni-show', compact('user'));
    }

    public function edit()
    {
        $user = Auth::user()->load('alumniProfile');
        return view('profile.alumni-edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'graduation_year' => 'required|integer|min:1900|max:' . (date('Y') + 5),
            'major' => 'required|string|max:255',
            'current_job_title' => 'nullable|string|max:255',
            'current_company' => 'nullable|string|max:255',
            'skills' => 'nullable|string',
            'bio' => 'nullable|string',
            'is_mentor' => 'nullable|boolean',
            'linkedin_url' => 'nullable|url|max:255',
        ]);

        $user->update([
            'name' => $request->name,
        ]);

        $user->alumniProfile()->updateOrCreate(
            ['user_id' => $user->id],
            [
                'graduation_year' => $request->graduation_year,
                'major' => $request->major,
                'current_job_title' => $request->current_job_title,
                'current_company' => $request->current_company,
                'skills' => $request->skills,
                'bio' => $request->bio,
                'is_mentor' => $request->has('is_mentor'),
                'linkedin_url' => $request->linkedin_url,
            ]
        );

        return redirect()->route('dashboard')->with('success', 'Alumni profile updated successfully!');
    }
}
