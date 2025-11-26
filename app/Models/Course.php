<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Modèle Course: représente un cours.
 * Ajoutez $fillable si vous utilisez create()/update() pour éviter le MassAssignmentException.
 */
class Course extends Model
{
    use HasFactory;
    
    // Colonnes autorisées à être remplies via create()/update()
    protected $fillable = [
        'name'
    ];

    // Ce modèle mappe la table 'courses' et peut définir des relations (ex: inscriptions) et des attributs.
}