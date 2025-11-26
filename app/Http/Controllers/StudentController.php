<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

/**
 * Contrôleur des étudiants (Student):
 * - index: liste et recherche
 * - create: formulaire d'ajout
 * - store: validation et création
 * - edit: formulaire de modification
 * - update: validation et mise à jour
 * - destroy: suppression d'un étudiant
 */
class StudentController extends Controller
{
/**
 * Affiche une liste paginée d'étudiants, avec recherche par terme 'q'.
 */
    public function index(Request $request)
    {
        // Construit la requête: tri par date, filtre par terme, puis pagination
        $students = Student::latest()
            ->filter($request->only(['q']))
            ->paginate(10)
            ->appends($request->query());
        // Compte total des étudiants (pour les statistiques)
        $totalStudents = Student::count();
        // Passe la liste et le total à la vue 'students.index'
        return view('students.index', compact('students', 'totalStudents'));
    }

/**
 * Affiche le formulaire d'ajout d'un étudiant.
 */
    public function create()
    {
        return view('students.create');
    }

/**
 * Valide puis enregistre un nouvel étudiant.
 */
    public function store(Request $request)
    {
        // Valide les champs du formulaire avec règles simples
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => 'nullable|email|unique:students,email',
            'phone'      => 'nullable|string|max:50',
            'birth_date' => 'nullable|date',
            'address'    => 'nullable|string',
        ]);

        // Crée l'étudiant avec les données validées
        Student::create($validated);

        // Redirige vers la liste des étudiants avec message de succès
        return redirect()->route('students.index')->with('success', 'Étudiant ajouté avec succès.');
    }
    
/**
 * Affiche le formulaire de modification d'un étudiant.
 */
    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }
    
/**
 * Valide puis met à jour un étudiant.
 */
    public function update(Request $request, Student $student)
    {
        // Valide les champs du formulaire avec règles simples
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => 'nullable|email|unique:students,email,'.$student->id,
            'phone'      => 'nullable|string|max:50',
            'birth_date' => 'nullable|date',
            'address'    => 'nullable|string',
        ]);

        // Met à jour l'étudiant avec les données validées
        $student->update($validated);

        // Redirige vers la liste des étudiants avec message de succès
        return redirect()->route('students.index')->with('success', 'Étudiant mis à jour avec succès.');
    }
    
/**
 * Supprime un étudiant.
 */
    public function destroy(Student $student)
    {
        // Supprime l'étudiant
        $student->delete();

        // Redirige vers la liste des étudiants avec message de succès
        return redirect()->route('students.index')->with('success', 'Étudiant supprimé avec succès.');
    }
}