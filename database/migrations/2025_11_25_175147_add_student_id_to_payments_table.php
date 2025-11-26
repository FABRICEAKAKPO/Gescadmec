<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('payments', function (Blueprint $table) {
            // Ajouter la colonne student_id
            $table->foreignId('student_id')->nullable()->constrained()->nullOnDelete();
        });
    }

    public function down(): void {
        Schema::table('payments', function (Blueprint $table) {
            // Supprimer la colonne student_id
            $table->dropForeign(['student_id']);
            $table->dropColumn('student_id');
        });
    }
};