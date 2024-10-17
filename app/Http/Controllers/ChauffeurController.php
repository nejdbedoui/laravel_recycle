<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserProfileUpdateRequest;
use App\Models\Chauffeur;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ChauffeurController extends Controller
{
    public function chauffeurDashboard()
    {
        return view('frontOffice/chauffeur/chauffeurDashboard');
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('frontOffice/chauffeur/chauffeurProfile', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(UserProfileUpdateRequest $request): RedirectResponse
    {
        $chauffeur = Chauffeur::find($request->user()->id);

        // Gérer l'image de profil
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $path = $request->file('image')->store('profile_images', 'public');
//            if ($chauffeur->image && Storage::disk('public')->exists($chauffeur->image)) {
//                Storage::disk('public')->delete($chauffeur->image);
//            }
            $chauffeur->image = $path;
        }

        // Mise à jour des informations spécifiques
        $chauffeur->fill($request->except(['image']));
        if ($chauffeur->isDirty('email')) {
            $chauffeur->email_verified_at = null;
            $chauffeur->sendEmailVerificationNotification();
        }

        $chauffeur->save();

        return redirect()->route('frontOffice.chauffeurProfile.edit')->with('success', 'Profile Updated Successfully');
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



    public function getAvailableDrivers(Request $request)
    {
        // Valider la date
        $request->validate([
            'date' => 'required|date',
        ]);

        $date = $request->input('date');

        // Utiliser la méthode statique getAvailableDrivers du modèle Chauffeur
        $chauffeurs = Chauffeur::getAvailableDrivers($date);

        return response()->json($chauffeurs); // Retourner les chauffeurs disponibles en JSON
    }

    public function getAvailableDriversUpdate(Request $request)
    {
        // Récupérer la date sélectionnée et l'ID du déplacement
        $date = $request->query('date');
        $deplacementId = $request->query('deplacement_id');

        // Utiliser la méthode pour récupérer les chauffeurs disponibles pour la mise à jour
        $chauffeursDisponibles = Chauffeur::getAvailableDriversForUpdate($date, $deplacementId);

        // Retourner les chauffeurs disponibles sous forme de JSON pour l'AJAX
        return response()->json($chauffeursDisponibles);
    }

}
