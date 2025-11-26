<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('payments', function (Blueprint $table) {
            // Clé primaire
            $table->id();
            // Inscription liée (cascade delete)
            $table->foreignId('enrollment_id')->constrained()->cascadeOnDelete();
            // Montant payé
            $table->decimal('amount', 12, 2);
            // Date/heure du paiement (par défaut: maintenant)
            $table->dateTime('paid_at')->useCurrent();
            // Méthode de paiement (facultative)
            $table->string('method')->nullable();
            // Référence facultative
            $table->string('reference')->nullable();
            // Numéro de reçu unique
            $table->string('receipt_number')->nullable()->unique();
            // Utilisateur ayant enregistré le paiement (null si supprimé)
            $table->foreignId('recorded_by')->nullable()->constrained('users')->nullOnDelete();
            // Timestamps
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('payments');
    }
};
