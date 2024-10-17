<?php

namespace App\Http\Controllers;

use App\Http\Requests\SocieteProfileUpdateRequest;
use App\Models\Societe;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class SocieteController extends Controller
{
    public function societeDashboard()
    {
        return view('frontOffice/societe/societeDashboard');
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('frontOffice/societe/societeProfile', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(SocieteProfileUpdateRequest $request): RedirectResponse
    {
        $societe = Societe::find($request->user()->id);

        // Gérer l'image de profil
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $path = $request->file('image')->store('profile_images', 'public');
//            if ($societe->image && Storage::disk('public')->exists($societe->image)) {
//                Storage::disk('public')->delete($societe->image);
//            }
            $societe->image = $path;
        }

        // Mise à jour des informations spécifiques
        $societe->fill($request->except(['image']));
        if ($societe->isDirty('email')) {
            $societe->email_verified_at = null;
            $societe->sendEmailVerificationNotification();
        }

        $societe->save();

        return redirect()->route('frontOffice.societeProfile.edit')->with('success', 'Profile Updated Successfully');
    }



    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
