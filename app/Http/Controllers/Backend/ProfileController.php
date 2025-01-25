<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $role = Role::get();
        $user = User::with('roles')->find(Auth::user()->id);
        return view('backend.profile.index', [
            'user' => $user,
            'role' => $role
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update2(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
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

    public function update(Request $request)
    {
        try {
            User::findOrFail($request->id)->update($request->all());
            return response()->json([
                'success' => true,
                'code' => 200,
                'message' => 'Successfully get Data',
                'error' => [],
                'data' => [],
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function updatePassword(Request $request)
    {
        # Validation
        $request->validate([
            'oldPassword' => 'required',
            'newPassword' => 'required|confirmed',
        ]);
        #Match The Old Password
        if (!Hash::check($request->oldPassword, auth()->user()->password)) {
            return response()->json([
                'success' => false,
                'code' => 401,
                'message' => 'Old password dont match',
            ]);
        }

        #Update the new Password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->newPassword)
        ]);

        return response()->json([
            'success' => true,
            'code' => 200,
            'message' => 'Password change successfull',
        ]);
    }

    public function updateAvatar(Request $request)
    {
        try {
            $avatar_file = $request->file('avatar')->store('img/avatar', 'public');
            $user = User::findOrFail(auth()->user()->id);
            $user->update([
                'avatar' => $avatar_file
            ]);
            return response()->json([
                'code' => 200,
                'success' => true,
                'message' => "Successfully saved data!",
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'code' => 400,
                'success' => false,
                'message' =>
                [
                    "System Error!",
                    $e
                ]
            ]);
        }
    }
}
