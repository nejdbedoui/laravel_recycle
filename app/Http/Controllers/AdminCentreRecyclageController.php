<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserProfileUpdateRequest;
use App\Models\AdminCentreRecyclage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class AdminCentreRecyclageController extends Controller
{
    public function adminCentreRecyclageDashboard()
    {
        return view('frontOffice/adminCentreRecyclage/adminCentreRecyclageDashboard');
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('frontOffice/adminCentreRecyclage/adminCentreRecyclageProfile', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(UserProfileUpdateRequest $request): RedirectResponse
    {
        $adminCentreRecyclage = AdminCentreRecyclage::find($request->user()->id);

        // Gérer l'image de profil
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $path = $request->file('image')->store('profile_images', 'public');
//            if ($adminCentreRecyclage->image && Storage::disk('public')->exists($adminCentreRecyclage->image)) {
//                Storage::disk('public')->delete($adminCentreRecyclage->image);
//            }
            $adminCentreRecyclage->image = $path;
        }

        // Mise à jour des informations spécifiques
        $adminCentreRecyclage->fill($request->except(['image']));
        if ($adminCentreRecyclage->isDirty('email')) {
            $adminCentreRecyclage->email_verified_at = null;
            $adminCentreRecyclage->sendEmailVerificationNotification();
        }

        $adminCentreRecyclage->save();

        return redirect()->route('frontOffice.adminCentreRecyclageProfile.edit')->with('status', 'profile-updated');
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
