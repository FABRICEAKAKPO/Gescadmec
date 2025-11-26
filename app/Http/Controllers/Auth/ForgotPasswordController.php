<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

/**
 * Contrôleur "Mot de passe oublié": envoie le lien de réinitialisation.
 * Le trait SendsPasswordResetEmails s’occupe du mail et du token.
 */
class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;
}
