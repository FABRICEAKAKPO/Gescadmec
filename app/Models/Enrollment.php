<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

/**
 * Modèle Enrollment: relie un étudiant à un cours avec niveau, dates et montant total.
 * Helpers: remainingBalance() pour le solde, remainingDays() pour les jours restants.
 * Scope: filter() pour filtrer par cours, niveau et statut de paiement.
 */
class Enrollment extends Model
{
    // Colonnes autorisées pour l'assignation de masse (create/update)
    protected $fillable = [
        'student_id', 'course_id', 'level', 'status', 'date_debut', 'date_fin', 'total_amount'
    ];

    // Convertit automatiquement ces attributs en instances Carbon (dates)
    protected $casts = [
        'date_debut' => 'datetime',
        'date_fin' => 'datetime',

    ];

    // Relations
    // Chaque inscription appartient à un étudiant
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    // Chaque inscription appartient à un cours
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    // Une inscription peut avoir plusieurs paiements
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    // Exemple helper pour montant restant
    /**
     * Calcule le montant restant à payer (total - somme des paiements).
     */
    public function remainingBalance()
    {
        return $this->total_amount - $this->payments->sum('amount');
    }

    /**
     * Retourne le nombre de jours restants jusqu'à la date de fin.
     * Si la date est passée ou non définie, retourne 0.
     *
     * @return int
     */
    public function remainingDays()
    {
        if (empty($this->date_fin)) {
            return 0;
        }

        $now = Carbon::now();
        $end = $this->date_fin instanceof Carbon ? $this->date_fin : Carbon::parse($this->date_fin);

        if ($now->greaterThan($end)) {
            return 0;
        }

        return $now->diffInDays($end);
    }

    // Déclaration de dates (héritée) ; $casts gère déjà ces champs
    protected $dates = ['date_debut', 'date_fin'];

    /**
     * Filtre par course_id, level et status (paid/partial/unpaid).
     */
    public function scopeFilter($query, array $filters)
    {
        if (!empty($filters['course_id'])) {
            $query->where('course_id', $filters['course_id']);
        }
        if (!empty($filters['level'])) {
            $query->where('level', 'like', '%' . $filters['level'] . '%');
        }
        if (!empty($filters['status'])) {
            // Calcule la somme des paiements liés à l'inscription
            $sum = '(SELECT COALESCE(SUM(amount),0) FROM payments WHERE payments.enrollment_id = enrollments.id)';
            // Applique une condition selon le statut demandé
            switch ($filters['status']) {
                case 'paid':
                    $query->whereRaw("$sum >= total_amount");
                    break;
                case 'partial':
                    $query->whereRaw("$sum > 0 AND $sum < total_amount");
                    break;
                case 'unpaid':
                    $query->whereRaw("$sum = 0");
                    break;
                default:
                    // Filter by enrollment status
                    $query->where('status', $filters['status']);
                    break;
            }
        }

        return $query;
    }
}