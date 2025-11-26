<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('needs', function (Blueprint $table) {
            // Clé primaire
            $table->id();
            // Étudiant concerné (supprime le besoin si l'étudiant est supprimé)
            $table->foreignId('student_id')->constrained()->cascadeOnDelete();
            // Inscription liée (facultative), null si l'inscription est supprimée
            $table->foreignId('enrollment_id')->nullable()->constrained()->nullOnDelete();
            // Type de besoin (facultatif)
            $table->string('type')->nullable();
            // Description du besoin (obligatoire)
            $table->text('description');
            // Statut du besoin (par défaut: open)
            $table->string('status')->default('open');
            // Utilisateur qui a déclaré le besoin
            $table->foreignId('reported_by')->nullable()->constrained('users')->nullOnDelete();
            // Timestamps
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('needs');
    }
};
