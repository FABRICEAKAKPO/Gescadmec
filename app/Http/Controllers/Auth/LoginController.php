<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

/**
 * Contrôleur Login: gère l'authentification des utilisateurs.
 * Utilise le trait AuthenticatesUsers pour les actions (login, logout, remember, throttling).
 */
class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * URL de redirection après connexion (ici vers le tableau de bord).
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Affiche le formulaire de connexion.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }
}
