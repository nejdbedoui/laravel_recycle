<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureUserHasRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param string $role Required role to access the route.
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $role)
    {
        // Vérifier si l'utilisateur est connecté
        if (Auth::check()) {
            // Vérifier si l'utilisateur n'a pas le rôle requis
            if (Auth::user()->role !== $role) {
                // Rediriger l'utilisateur selon son rôle
                return $this->redirectBasedOnRole();
            }
        } else {
            // Si l'utilisateur n'est pas connecté, rediriger vers la page d'accueil avec un message d'erreur
            return redirect('/')->with('error', 'You do not have permission to access this page.');
        }

        return $next($request);
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
