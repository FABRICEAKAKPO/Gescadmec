<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
{
    Schema::create('enrollments', function (Blueprint $table) {
        // Clé primaire
        $table->id();
        // Clés étrangères vers étudiant et cours (suppriment l'inscription si liées supprimées)
        $table->foreignId('student_id')->constrained()->onDelete('cascade');
        $table->foreignId('course_id')->constrained()->onDelete('cascade');
        // Niveau de formation (ex: A1, B2)
        $table->string('level');
        // Période de formation
        $table->date('date_debut');
        $table->date('date_fin');
        // Montant total dû pour l'inscription
        $table->decimal('total_amount', 10, 2)->default(0);
        // Timestamps
        $table->timestamps();
    });
}


    public function down(): void {
        Schema::dropIfExists('enrollments');
    }
};
