<?php

namespace App\Http\Controllers;


use App\Http\Requests\UserProfileUpdateRequest;
use App\Models\AdminCentreCollecte;
use App\Models\ZoneCollecte;
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
        $adminCentreCollecte = AdminCentreCollecte::findOrFail(Auth::user()->id);
        $centreCollecte = $adminCentreCollecte->centreCollecte;

        $zoneCollectes = ZoneCollecte::all();

        return view('frontOffice/adminCentreCollecte/adminCentreCollecteDashboard', compact('centreCollecte', 'zoneCollectes'));
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $adminCentreCollecte = AdminCentreCollecte::findOrFail(Auth::user()->id);
        $centreCollecte = $adminCentreCollecte->centreCollecte;

        $zoneCollectes = ZoneCollecte::whereDoesntHave('centreCollecte')->get();

        return view('frontOffice/adminCentreCollecte/adminCentreCollecteProfile', compact('centreCollecte', 'zoneCollectes'), [
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

        return redirect()->route('frontOffice.adminCentreCollecteProfile.edit')->with('success', 'Profile Updated Successfully');
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
