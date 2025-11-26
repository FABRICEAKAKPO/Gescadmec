<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Modèle Student: représente un étudiant.
 * - $fillable: colonnes modifiables en masse
 * - Relations: enrollments() et needs()
 * - scopeFilter(): recherche simple par terme 'q'
 */
class Student extends Model
{
    use HasFactory;

    // Colonnes autorisées à être remplies via create()/update()
    protected $fillable = [
        'first_name', 'last_name', 'email', 'phone', 'birth_date', 'address', 'created_by'
    ];

    // Un étudiant a plusieurs inscriptions
    public function enrollments() {
        return $this->hasMany(Enrollment::class);
    }

    // Un étudiant a plusieurs besoins
    public function needs() {
        return $this->hasMany(Need::class);
    }

    /**
     * Filtre par terme de recherche 'q' sur plusieurs colonnes.
     */
    public function scopeFilter($query, array $filters)
    {
        // Si un terme 'q' est fourni, on prépare la recherche
        if (!empty($filters['q'])) {
            // Nettoie le terme (enlevant les espaces de début/fin)
            $term = trim($filters['q']);
            // Recherche sur prénom, nom, email ou téléphone
            $query->where(function ($qb) use ($term) {
                $qb->where('first_name', 'like', "%$term%")
                   ->orWhere('last_name', 'like', "%$term%")
                   ->orWhere('email', 'like', "%$term%")
                   ->orWhere('phone', 'like', "%$term%");
            });
        }
        return $query;
    }
}
