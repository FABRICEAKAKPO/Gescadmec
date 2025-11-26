<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    /**
     * Redirige vers le tableau de bord après authentification.
     * Cette route sert de passerelle pour les anciennes configs Laravel.
     */
    public function index()
    {
        // Redirection vers la route nommée 'dashboard'
        return redirect()->route('dashboard');
    }
}
