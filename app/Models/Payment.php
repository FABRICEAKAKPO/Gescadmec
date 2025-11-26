<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Modèle Payment: représente un paiement lié à une inscription.
 * - $fillable: colonnes autorisées pour l'assignation de masse
 * - $casts: conversion automatique de 'paid_at' en date
 * - Relation: enrollment()
 * - Scope: filter() pour filtrer par étudiant, cours, méthode, dates
 */
class Payment extends Model
{
    use HasFactory;

    // Colonnes autorisées lors de create()/update()
    protected $fillable = [
        'enrollment_id','student_id','amount','paid_at','method','reference','receipt_number','recorded_by'
    ];

    // Cast automatique pour la date de paiement
    protected $casts = [
        'paid_at' => 'datetime',
    ];

    // Chaque paiement appartient à une inscription
    public function enrollment() {
        return $this->belongsTo(Enrollment::class);
    }
    
    // Chaque paiement est associé à un étudiant
    public function student() {
        return $this->belongsTo(Student::class);
    }

    /**
     * Filtre les paiements:
     * - par étudiant (via relation enrollment.student)
     * - par cours (via relation enrollment.course)
     * - par méthode
     * - par intervalle de dates
     */
    public function scopeFilter($query, array $filters)
    {
        // Filtre par étudiant lié
        if (!empty($filters['student_id'])) {
            $query->whereHas('enrollment.student', function ($q) use ($filters) {
                $q->where('id', $filters['student_id']);
            });
        }
        // Filtre par cours lié
        if (!empty($filters['course_id'])) {
            $query->whereHas('enrollment.course', function ($q) use ($filters) {
                $q->where('id', $filters['course_id']);
            });
        }
        // Filtre par méthode de paiement
        if (!empty($filters['method'])) {
            $query->where('method', $filters['method']);
        }
        // Filtre par date de début
        if (!empty($filters['date_from'])) {
            $query->whereDate('paid_at', '>=', $filters['date_from']);
        }
        // Filtre par date de fin
        if (!empty($filters['date_to'])) {
            $query->whereDate('paid_at', '<=', $filters['date_to']);
        }

        return $query;
    }
}