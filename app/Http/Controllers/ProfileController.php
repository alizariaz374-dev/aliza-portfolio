<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;

class ProfileController extends Controller
{
    public function index()
    {
        return Profile::get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name'               => 'required|string|max:255',
            'email'                   => 'required|email',
            'phone_no'                => 'required|string|max:50',
            'about'                   => 'required|string|max:600',
            'certificate'             => 'nullable|string|max:255',
            'certificate_description' => 'nullable|string|max:500',
            'linkedin_url'            => 'nullable|string|max:255',
            'git_url'                 => 'nullable|string|max:255',
            'web_url'                 => 'nullable|string|max:255',
            'avatar_url'              => 'nullable|string',
        ]);

        $profile = Profile::create($validated);
        return response()->json($profile, 201);
    }

    public function show(Profile $profile)
    {
        return $profile;
    }

    public function update(Request $request, Profile $profile)
    {
        $validated = $request->validate([
            'full_name'               => 'sometimes|required|string|max:255',
            'email'                   => 'sometimes|required|email',
            'phone_no'                => 'sometimes|required|string|max:50',
            'about'                   => 'sometimes|required|string|max:600',
            'certificate'             => 'nullable|string|max:255',
            'certificate_description' => 'nullable|string|max:500',
            'linkedin_url'            => 'nullable|string|max:255',
            'git_url'                 => 'nullable|string|max:255',
            'web_url'                 => 'nullable|string|max:255',
            'avatar_url'              => 'nullable|string',
        ]);

        $profile->update($validated);
        return response()->json($profile);
    }

    public function destroy(Profile $profile)
    {
        $profile->delete();
        return response()->json(null, 204);
    }

    public function uploadAvatar(Request $request)
    {
        $request->validate(['avatar' => 'required|image|max:2048']);

        $path = $request->file('avatar')->store('avatars', 'public');

        return response()->json(['url' => asset('storage/' . $path)]);
    }
}