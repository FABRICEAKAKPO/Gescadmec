<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ConfirmsPasswords;

/**
 * Contrôleur de confirmation du mot de passe: protège les actions sensibles.
 */
class ConfirmPasswordController extends Controller
{
    use ConfirmsPasswords;

    /**
     * URL de redirection si l'URL prévue échoue.
     */
    protected $redirectTo = '/dashboard';

    /**
     * Construit le contrôleur avec middleware auth.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
}
