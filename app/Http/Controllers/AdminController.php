<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\AdminCentreCollecte;
use App\Models\AdminCentreRecyclage;
use App\Models\Chauffeur;
use App\Models\Societe;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Validation\Rules;

class AdminController extends Controller
{
    public function adminDashboard()
    {
        return view('backOffice.adminDashboard');
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('backOffice.adminProfile', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

        // Gestion de l'image de profil
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            // Enregistrer l'image dans le dossier public/profile_images
            $path = $request->file('image')->store('profile_images', 'public');

            // Vérifier si un ancien fichier existe et le supprimer
//            if ($user->image && Storage::disk('public')->exists($user->image)) {
//                Storage::disk('public')->delete($user->image);
//            }

            // Assigner le nouveau chemin à l'attribut image de l'utilisateur
            $user->image = $path;
        }

        // Mise à jour des autres informations de l'utilisateur
        $user->fill($request->except(['image'])); // Exclure 'image' de la mise à jour directe

        // Réinitialiser la date de vérification de l'e-mail si l'e-mail a été modifié
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
            // Envoyer un nouvel email de vérification si nécessaire
            $user->sendEmailVerificationNotification();
        }

        $user->save();

        return redirect()->route('backOffice.adminProfile.edit')->with('status', 'profile-updated');
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

    public function listSociete()
    {
        $societes = Societe::all();
        return view('backOffice.listSociete', compact('societes'));
    }

    public function detailSociete($id)
    {
        $societe = Societe::find($id);
        return view('backOffice.detailSociete', compact('societe'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function addChauffeur(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'chauffeur',
        ]);

        event(new Registered($user));

        return redirect()->route('backOffice.listChauffeur')->with('status', 'Driver added successfully');
    }

    public function listChauffeur()
    {
        $chauffeurs = Chauffeur::all();
        return view('backOffice.listChauffeur', compact('chauffeurs'));
    }

    public function detailChauffeur($id)
    {
        $chauffeur = Chauffeur::find($id);
        return view('backOffice.detailChauffeur', compact('chauffeur'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function addAdminCentreCollecte(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'adminCentreCollecte',
        ]);

        event(new Registered($user));

        return redirect()->route('backOffice.listAdminCentreCollecte')->with('status', 'Collection Center Admin added successfully');
    }

    public function listAdminCentreCollecte()
    {
        $adminCentreCollectes = AdminCentreCollecte::all();
        return view('backOffice.listAdminCentreCollecte', compact('adminCentreCollectes'));
    }

    public function detailAdminCentreCollecte($id)
    {
        $adminCentreCollecte = AdminCentreCollecte::find($id);
        return view('backOffice.detailAdminCentreCollecte', compact('adminCentreCollecte'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function addAdminCentreRecyclage(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'adminCentreRecyclage',
        ]);

        event(new Registered($user));

        return redirect()->route('backOffice.listAdminCentreRecyclage')->with('status', 'Recycling Center Admin added successfully');
    }

    public function listAdminCentreRecyclage()
    {
        $adminCentreRecyclages = AdminCentreRecyclage::all();
        return view('backOffice.listAdminCentreRecyclage', compact('adminCentreRecyclages'));
    }

    public function detailAdminCentreRecyclage($id)
    {
        $adminCentreRecyclage = AdminCentreRecyclage::find($id);
        return view('backOffice.detailAdminCentreRecyclage', compact('adminCentreRecyclage'));
    }

    public function enableUser($id)
    {
        $user = User::findOrFail($id);
        $user->enable = true;
        $user->save();

        return back()->with('success', 'The user has been successfully activated.');
    }

    public function disableUser($id)
    {
        $user = User::findOrFail($id);
        $user->enable = false;
        $user->save();

        return back()->with('success', 'The user has been successfully deactivated.');
    }
}
