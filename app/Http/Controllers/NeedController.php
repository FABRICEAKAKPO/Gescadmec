<?php

namespace App\Http\Controllers;

use App\Models\Need;
use App\Models\Student;
use Illuminate\Http\Request;

/**
 * Contrôleur des besoins (Need):
 * - index: liste des besoins
 * - create: formulaire d'ajout
 * - store: validation et enregistrement
 * - edit: formulaire de modification
 * - update: mise à jour d'un besoin
 * - destroy: suppression d'un besoin
 */
class NeedController extends Controller
{
/**
 * Affiche la liste paginée des besoins avec l'étudiant lié.
 */
    public function index(Request $request)
{
    // Récupère les filtres
    $filters = $request->only(['student_id', 'type', 'status']);
    
    // Construit la requête avec relations, tri et filtres
    $needs = Need::with('student')
                ->when(!empty($filters['student_id']), function($query) use ($filters) {
                    return $query->where('student_id', $filters['student_id']);
                })
                ->when(!empty($filters['type']), function($query) use ($filters) {
                    return $query->where('type', 'like', '%' . $filters['type'] . '%');
                })
                ->when(!empty($filters['status']), function($query) use ($filters) {
                    return $query->where('status', $filters['status']);
                })
                ->latest()
                ->paginate(10)
                ->appends($request->query());

    // Liste des étudiants pour le filtre
    $students = Student::orderBy('first_name')->get();
    
    return view('needs.index', compact('needs', 'students'));
}

/**
 * Affiche le formulaire de création d'un besoin.
 */
public function create()
{
    return view('needs.create');
}

/**
 * Valide puis enregistre un besoin.
 */
    public function store(Request $request)
    {
        // Valide les champs essentiels du besoin
        $validated = $request->validate([
            'student_first_name' => 'required|string|max:255',
            'student_last_name'  => 'required|string|max:255',
            'type'        => 'nullable|string|max:100',
            'description' => 'required|string',
            'status'      => 'nullable|string|max:50',
        ]);

        // Vérifier si l'étudiant existe déjà
        $student = Student::where('first_name', $validated['student_first_name'])
                          ->where('last_name', $validated['student_last_name'])
                          ->first();

        // Si l'étudiant n'existe pas, le créer
        if (!$student) {
            $student = Student::create([
                'first_name' => $validated['student_first_name'],
                'last_name'  => $validated['student_last_name'],
            ]);
        }

        // Définit un statut par défaut si non spécifié
        $validated['status'] = $validated['status'] ?? 'en attente';
        
        // Ajoute l'ID de l'étudiant aux données validées
        $validated['student_id'] = $student->id;
        
        // Supprime les champs de nom d'étudiant
        unset($validated['student_first_name'], $validated['student_last_name']);
        
        // Crée le besoin avec les données validées
        Need::create($validated);

        // Redirige vers la liste avec message de succès
        return redirect()->route('needs.index')->with('success', 'Besoin enregistré.');
    }
    
/**
 * Affiche le formulaire de modification d'un besoin.
 */
public function edit(Need $need)
{
    return view('needs.edit', compact('need'));
}

/**
 * Valide puis met à jour un besoin.
 */
public function update(Request $request, Need $need)
{
    // Valide les champs essentiels du besoin
    $validated = $request->validate([
        'student_first_name' => 'required|string|max:255',
        'student_last_name'  => 'required|string|max:255',
        'type'        => 'nullable|string|max:100',
        'description' => 'required|string',
        'status'      => 'nullable|string|max:50',
    ]);

    // Vérifier si l'étudiant existe déjà
    $student = Student::where('first_name', $validated['student_first_name'])
                      ->where('last_name', $validated['student_last_name'])
                      ->first();

    // Si l'étudiant n'existe pas, le créer
    if (!$student) {
        $student = Student::create([
            'first_name' => $validated['student_first_name'],
            'last_name'  => $validated['student_last_name'],
        ]);
    }

    // Ajoute l'ID de l'étudiant aux données validées
    $validated['student_id'] = $student->id;
    
    // Supprime les champs de nom d'étudiant
    unset($validated['student_first_name'], $validated['student_last_name']);

    // Met à jour le besoin avec les données validées
    $need->update($validated);

    // Redirige vers la liste avec message de succès
    return redirect()->route('needs.index')->with('success', 'Besoin mis à jour.');
}

/**
 * Supprime un besoin.
 */
public function destroy(Need $need)
{
    // Supprime le besoin
    $need->delete();

    // Redirige vers la liste avec message de succès
    return redirect()->route('needs.index')->with('success', 'Besoin supprimé.');
}
}