<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Authentification des identifiants
        $request->authenticate();

        // Vérifier si l'utilisateur est activé
        $user = Auth::user();
        if (!$user->enable) {
            // Si l'utilisateur est désactivé, déconnectez-le et retournez un message d'erreur
            Auth::logout();

            return redirect()->back()->withErrors([
                'email' => 'Your account is deactivated. Please contact the administrator.',
            ]);
        }

        // Régénérer la session
        $request->session()->regenerate();

        // Redirection basée sur le rôle
        return $this->redirectBasedOnRole();
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    /**
     * Redirect the user based on role.
     */
    protected function redirectBasedOnRole(): RedirectResponse
    {
        $user = Auth::user();
        switch ($user->role) {
            case 'admin':
                return redirect()->intended('/admin/profile');
            case 'chauffeur':
                return redirect()->intended('/chauffeur/profile');
            case 'societe':
                return redirect()->intended('/societe/profile');
            case 'adminCentreCollecte':
                return redirect()->intended('/adminCentreCollecte/profile');
            case 'adminCentreRecyclage':
                return redirect()->intended('/adminCentreRecyclage/profile');
            default:
                return redirect()->intended(RouteServiceProvider::HOME);
        }
    }
}
