<?php

namespace App\Http\Controllers;


use App\Http\Requests\UserProfileUpdateRequest;
use App\Models\AdminCentreCollecte;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class AdminCentreCollecteController extends Controller
{
    public function adminCentreCollecteDashboard()
    {
        return view('frontOffice/adminCentreCollecte/adminCentreCollecteDashboard');
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('frontOffice/adminCentreCollecte/adminCentreCollecteProfile', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(UserProfileUpdateRequest $request): RedirectResponse
    {
        $adminCentreCollecte = AdminCentreCollecte::find($request->user()->id);

        // Gérer l'image de profil
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $path = $request->file('image')->store('profile_images', 'public');
//            if ($adminCentreCollecte->image && Storage::disk('public')->exists($adminCentreCollecte->image)) {
//                Storage::disk('public')->delete($adminCentreCollecte->image);
//            }
            $adminCentreCollecte->image = $path;
        }

        // Mise à jour des informations spécifiques
        $adminCentreCollecte->fill($request->except(['image']));
        if ($adminCentreCollecte->isDirty('email')) {
            $adminCentreCollecte->email_verified_at = null;
            $adminCentreCollecte->sendEmailVerificationNotification();
        }

        $adminCentreCollecte->save();

        return redirect()->route('frontOffice.adminCentreCollecteProfile.edit')->with('status', 'profile-updated');
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
