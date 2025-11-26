<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\NeedController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Routes publiques (Login et Register)
// Génère automatiquement les routes d'authentification (login, register, reset)
Auth::routes();

// Page d'accueil redirige vers login si non connecté, sinon vers dashboard
// Route d'accueil : si l'utilisateur est connecté, on le redirige vers le tableau de bord ; sinon on affiche la page d'accueil "welcome"
Route::get('/', function () {
    // Auth::check() vérifie si un utilisateur est authentifié
    return Auth::check() ? redirect()->route('dashboard') : view('welcome');
});

// Routes protégées par authentification
// Groupe de routes protégées par le middleware 'auth' : uniquement accessible aux utilisateurs connectés
Route::middleware(['auth'])->group(function () {
    // Page "home" fournie par Laravel, souvent inutilisée dans les projets récents
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    // Page du tableau de bord principal
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Génère toutes les routes CRUD pour les étudiants (index, create, store, show, edit, update, destroy)
    Route::resource('students', StudentController::class);
    // Génère toutes les routes CRUD pour les inscriptions
    Route::resource('enrollments', EnrollmentController::class);
    // Génère toutes les routes CRUD pour les paiements
    Route::resource('payments', PaymentController::class);
    // Génère les routes CRUD pour les besoins, en excluant l'action 'show'
    Route::resource('needs', NeedController::class)->except(['show']);
    
    // Reçu PDF
    // Route pour générer/afficher le reçu PDF d'un paiement spécifique
    Route::get('payments/{id}/receipt', [PaymentController::class, 'receipt'])->name('payments.receipt');
});
