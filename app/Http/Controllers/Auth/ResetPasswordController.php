<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

/**
 * Contrôleur de réinitialisation: applique le nouveau mot de passe.
 * Redirige vers /dashboard après succès.
 */
class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    /**
     * URL de redirection après réinitialisation.
     */
    protected $redirectTo = '/dashboard';
}
