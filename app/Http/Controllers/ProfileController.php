<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $user = Auth::user();
        return view('profile.edit', [
            'user' => $user,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        // Separate user and profile data
        $userData = $request->only(['name', 'email']);
        $profileData = $request->only(['name','phone', 'address', 'birthday']); // Add profile fields here

        // Update the User model
        $user->fill($userData);

        // Check if email was changed, and if so, reset email verification
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        // Save user data
        $user->save();

        // Update or create the Profile model associated with the user
        if ($user->profile) {
            $user->profile->fill($profileData);
            $user->profile->save();
        } else {
            $user->profile()->create($profileData);
        }

        return Redirect::route('user.dashboard')->with('status', 'profile-updated');
    }
    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
