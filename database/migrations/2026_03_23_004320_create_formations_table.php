<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('formations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('profile_id')->constrained()->onDelete('cascade');
            $table->string('etablissement'); // Établissement
            $table->string('diplome'); // Diplôme
            $table->string('specialite')->nullable(); // Spécialité
            $table->text('description')->nullable(); // Description
            $table->date('date_debut'); // Date de début
            $table->date('date_fin')->nullable(); // Date de fin
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('formations');
    }
};
