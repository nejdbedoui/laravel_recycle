<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return $this->redirectBasedOnRole();
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        return $this->redirectBasedOnRole();
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
