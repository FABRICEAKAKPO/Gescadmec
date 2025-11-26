<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Modèle Need: représente un besoin exprimé par un étudiant.
 * - $fillable: colonnes modifiables
 * - $casts: conversions automatiques
 * - Relation: student()
 */
class Need extends Model
{
    use HasFactory;
    
    // Colonnes autorisées pour l'assignation de masse
    protected $fillable = [
        'student_id',
        'enrollment_id',
        'type',
        'description',
        'status',
        'reported_by'
    ];
    
    // Conversions automatiques
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relation avec le modèle Student (plusieurs besoins par étudiant possible).
     */
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
    
    /**
     * Relation avec le modèle Enrollment (un besoin peut être lié à une inscription).
     */
    public function enrollment()
    {
        return $this->belongsTo(Enrollment::class);
    }
}