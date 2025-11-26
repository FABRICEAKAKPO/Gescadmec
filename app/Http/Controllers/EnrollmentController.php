<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use App\Models\Student;
use App\Models\Course;
use Illuminate\Http\Request;

/**
 * Contrôleur des inscriptions (Enrollment):
 * - index: liste et filtrage des inscriptions
 * - create: formulaire de création
 * - store: validation et enregistrement
 */
class EnrollmentController extends Controller
{
/**
 * Affiche une liste paginée des inscriptions avec filtres possibles.
 * Filtres acceptés: course_id, level, status.
 */
    public function index(Request $request)
{
    // Récupère uniquement les paramètres de filtre attendus depuis la requête
    $filters = $request->only(['course_id','level','status']);

    // Construit la requête: charge les relations, totalise les paiements, trie et applique les filtres puis pagine
    $enrollments = \App\Models\Enrollment::with(['student', 'course', 'payments'])
                    ->withSum('payments', 'amount')
                    ->latest()
                    ->filter($filters)
                    ->paginate(10)
                    ->appends($request->query());

    // Liste des cours triés par nom (utile pour le filtre)
    $courses = \App\Models\Course::orderBy('name')->get();
    // Nombre total d'inscriptions (pour afficher les statistiques)
    $totalEnrollments = \App\Models\Enrollment::count();

    // Passe les données à la vue Blade 'enrollments.index'
    return view('enrollments.index', compact('enrollments','courses','totalEnrollments'));
}


/**
 * Affiche le formulaire de création d'une inscription.
 */
   public function create()
{
    // Liste des cours pour le sélecteur
    $courses = \App\Models\Course::all(); // si tu as un modèle Course
    return view('enrollments.create', compact('courses'));
}


/**
 * Valide puis enregistre une nouvelle inscription dans la base.
 */
    public function store(Request $request)
    {
        // Valide les champs envoyés depuis le formulaire
        $validated = $request->validate([
            'student_first_name' => 'required|string|max:255',
            'student_last_name'  => 'required|string|max:255',
            'student_email'      => 'nullable|email',
            'student_phone'      => 'nullable|string|max:50',
            'student_address'    => 'nullable|string',
            'course_id'    => 'required|exists:courses,id',
            'level'        => 'required|string|max:50',
            'status'       => 'required|string|in:active,inactive,completed,cancelled',
            'date_debut'   => 'required|date',
            'date_fin'     => 'required|date|after_or_equal:date_debut',
            'total_amount' => 'required|numeric|min:0',
        ]);

        // Vérifier si l'étudiant existe déjà
        $student = Student::where('first_name', $validated['student_first_name'])
                          ->where('last_name', $validated['student_last_name'])
                          ->when($validated['student_email'], function ($query, $email) {
                              return $query->where('email', $email);
                          })
                          ->first();

        // Si l'étudiant n'existe pas, le créer
        if (!$student) {
            $studentData = [
                'first_name' => $validated['student_first_name'],
                'last_name'  => $validated['student_last_name'],
                'email'      => $validated['student_email'] ?? null,
                'phone'      => $validated['student_phone'] ?? null,
                'address'    => $validated['student_address'] ?? null,
            ];
            
            $student = Student::create($studentData);
        }

        // Puis crée l'inscription avec l'ID de l'étudiant
        $enrollmentData = [
            'student_id'   => $student->id,
            'course_id'    => $validated['course_id'],
            'level'        => $validated['level'],
            'status'       => $validated['status'],
            'date_debut'   => $validated['date_debut'],
            'date_fin'     => $validated['date_fin'],
            'total_amount' => $validated['total_amount'],
        ];

        Enrollment::create($enrollmentData);

        // Redirige vers la liste avec un message de succès
        return redirect()->route('enrollments.index')->with('success', 'Inscription enregistrée avec succès.');
    }
}