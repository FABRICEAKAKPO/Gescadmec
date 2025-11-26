<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('courses', function (Blueprint $table) {
            // Clé primaire
            $table->id();
            // Nom du cours
            $table->string('name');
            // Description facultative
            $table->text('description')->nullable();
            // Durée par défaut (en jours), facultative
            $table->integer('default_duration_days')->nullable();
            // Timestamps
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('courses');
    }
};
