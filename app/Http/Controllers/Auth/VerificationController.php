<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\VerifiesEmails;

/**
 * Contrôleur de vérification d'email: confirme l'adresse et gère les renvois.
 */
class VerificationController extends Controller
{
    use VerifiesEmails;

    /**
     * URL de redirection après vérification.
     */
    protected $redirectTo = '/dashboard';

    /**
     * Middlewares: auth pour protéger, signed pour lien signé, throttle pour limiter.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }
}
