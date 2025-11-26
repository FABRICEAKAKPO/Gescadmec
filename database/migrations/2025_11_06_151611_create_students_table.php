<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('students', function (Blueprint $table) {
            // Clé primaire auto-incrémentée
            $table->id();
            // Prénom et nom de l'étudiant
            $table->string('first_name');
            $table->string('last_name');
            // Email unique mais facultatif
            $table->string('email')->nullable()->unique();
            // Téléphone facultatif
            $table->string('phone')->nullable();
            // Date de naissance facultative
            $table->date('birth_date')->nullable();
            // Adresse texte facultative
            $table->text('address')->nullable();
            // Référence vers l'utilisateur créateur, nullable, supprime la valeur si l'user est supprimé
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            // Horodatage de création et mise à jour
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('students');
    }
};
