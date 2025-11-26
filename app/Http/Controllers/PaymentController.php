<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Enrollment;
use App\Models\Student;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

/**
 * Contrôleur des paiements (Payment):
 * - index: liste paginée avec filtres
 * - create: formulaire pour enregistrer un paiement
 * - store: validation, création et lien vers reçu
 * - receipt: affiche le reçu d'un paiement
 */
class PaymentController extends Controller
{
/**
 * Liste les paiements avec filtres (étudiant, cours, méthode, dates).
 */
    public function index(Request $request)
{
    // Récupère les paramètres de filtre autorisés
    $filters = $request->only(['student_id','course_id','method','date_from','date_to']);

    // Construit la requête avec relations, tri, filtres et pagination
    $payments = \App\Models\Payment::with('enrollment.student', 'enrollment.course')
                    ->latest()
                    ->filter($filters)
                    ->paginate(10)
                    ->appends($request->query());

    // Prépare les listes utilisées par les filtres (étudiants, cours, méthodes)
    $students = \App\Models\Student::orderBy('first_name')->get();
    $courses  = \App\Models\Course::orderBy('name')->get();
    $methods  = \App\Models\Payment::select('method')->whereNotNull('method')->distinct()->pluck('method');

    // Affiche la vue avec les données
    return view('payments.index', compact('payments','students','courses','methods'));
}

/**
 * Affiche le formulaire de création d'un paiement.
 */
 public function create()
{
    return view('payments.create');
}


/**
 * Valide et enregistre un nouveau paiement, puis redirige avec lien du reçu.
 */
    public function store(Request $request)
    {
        // Valide les champs du formulaire
        $validated = $request->validate([
            'student_first_name' => 'required|string|max:255',
            'student_last_name'  => 'required|string|max:255',
            'amount'        => 'required|numeric|min:1',
            'method'        => 'nullable|string|max:50',
        ]);

        // Vérifier si l'étudiant existe déjà en vérifiant le prénom, le nom et l'email
        $studentQuery = Student::where('first_name', $validated['student_first_name'])
                               ->where('last_name', $validated['student_last_name']);
                               
        // Si l'étudiant existe, on l'utilise, sinon on le crée
        $student = $studentQuery->first();
        
        if (!$student) {
            $student = Student::create([
                'first_name' => $validated['student_first_name'],
                'last_name'  => $validated['student_last_name'],
            ]);
        }

        // Associer le paiement à l'étudiant
        $validated['student_id'] = $student->id;
        
        // Créer une inscription pour l'étudiant s'il n'en a pas
        $enrollment = Enrollment::where('student_id', $student->id)->first();
        
        if (!$enrollment) {
            // Créer une inscription par défaut si aucune n'existe
            $enrollment = Enrollment::create([
                'student_id' => $student->id,
                'course_id' => 1, // Cours par défaut (à adapter selon vos besoins)
                'level' => 'A1', // Niveau par défaut
                'date_debut' => now(),
                'date_fin' => now()->addMonths(3),
                'total_amount' => $validated['amount'],
            ]);
        }

        // Associer le paiement à l'inscription
        $validated['enrollment_id'] = $enrollment->id;
        
        // Génère un numéro de reçu unique
        $validated['receipt_number'] = 'RC-' . strtoupper(uniqid());
        // s'assurer que paid_at existe (la colonne DB a useCurrent, mais garantir côté Eloquent)
        if (empty($validated['paid_at'])) {
            $validated['paid_at'] = now();
        }

        // Crée et sauvegarde le paiement
        $payment = Payment::create($validated);

        // Préparer l'URL du reçu pour affichage immédiat dans la liste
        $receiptUrl = route('payments.receipt', $payment->id);

        // Redirige vers la liste avec message de succès et lien du reçu
        return redirect()->route('payments.index')
            ->with('success', 'Paiement enregistré avec succès.')
            ->with('receipt_url', $receiptUrl);
    }

/**
 * Affiche le reçu du paiement (vue Blade).
 */
    public function receipt($id)
    {
        // Charge le paiement et ses relations pour afficher les informations complètes
        $payment = Payment::with('enrollment.student', 'enrollment.course', 'enrollment.payments')->findOrFail($id);
        return view('payments.receipt', compact('payment'));
    }
}