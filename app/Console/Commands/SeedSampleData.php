<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Student;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Payment;

/**
 * Commande artisan pour insérer des données de test rapidement.
 * Exécute: php artisan dev:seed-sample
 */
class SeedSampleData extends Command
{
    protected $signature = 'dev:seed-sample'; // Nom de la commande
    protected $description = 'Seed a sample student, course, enrollment and payment for testing'; // Description

    public function handle()
    {
        // Info console
        $this->info('Creating sample data...');

        // Crée un étudiant factice
        $s = Student::create([
            'first_name' => 'Test',
            'last_name' => 'User',
            'email' => 'test+' . time() . '@example.com',
        ]);

        // Crée un cours factice
        $c = new Course();
        $c->name = 'Cours Test ' . time();
        $c->description = 'Description de test';
        $c->save();

        // Enregistre l'inscription factice
        $e = Enrollment::create([
            'student_id' => $s->id,
            'course_id' => $c->id,
            'level' => 'A1',
            'date_debut' => now()->toDateString(),
            'date_fin' => now()->addMonth()->toDateString(),
            'total_amount' => 100,
        ]);

        // Enregistre un paiement lié à l'inscription
        $p = Payment::create([
            'enrollment_id' => $e->id,
            'amount' => 50,
            'method' => 'espece',
        ]);

        // Affiche un résumé
        $this->info('Created: Enrollments=' . Enrollment::count() . ' Payments=' . Payment::count());

        return 0;
    }
}
