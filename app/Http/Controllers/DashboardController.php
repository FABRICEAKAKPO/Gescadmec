<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use App\Models\Payment;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

/**
 * Contrôleur du tableau de bord:
 * - Agrège des statistiques financières et d'activité
 * - Prépare des listes d'inscriptions actives avec jours restants
 */
class DashboardController extends Controller
{
/**
 * Construit et passe les métriques à la vue du tableau de bord.
 */
    public function index()
    {
        // 1️⃣ - Statistiques par niveau (somme du dû, somme payé, solde)
        $byLevel = Enrollment::select('level',
                DB::raw('SUM(total_amount) as total_amount'),
                DB::raw('SUM((SELECT COALESCE(SUM(payments.amount),0) FROM payments WHERE payments.enrollment_id = enrollments.id)) as total_paid')
            )
            ->groupBy('level')
            ->get()
            ->map(function ($item) {
                $item->balance = $item->total_amount - $item->total_paid;
                return $item;
            });

        // 2️⃣ - Inscriptions actives: calcule montant payé, solde et jours restants
        $activeEnrollments = Enrollment::with(['student', 'course', 'payments'])
            ->get()
            ->map(function ($enrollment) {
                $enrollment->paid = $enrollment->payments->sum('amount');
                $enrollment->balance = $enrollment->total_amount - $enrollment->paid;
                $enrollment->remaining_days = $enrollment->remainingDays();
                return $enrollment;
            });

        // 3️⃣ - Sommaires globaux: total payé, total dû et solde
        $totalPaid = Payment::sum('amount');
        $totalDue = Enrollment::sum('total_amount');
        $totalBalance = $totalDue - $totalPaid;
        $totalStudents = Student::count();
        $totalEnrollments = Enrollment::count();

        // Passe toutes les données à la vue 'dashboard.index'
        return view('dashboard.index', compact('byLevel', 'activeEnrollments', 'totalPaid', 'totalBalance', 'totalDue', 'totalStudents', 'totalEnrollments'));
    }
}

