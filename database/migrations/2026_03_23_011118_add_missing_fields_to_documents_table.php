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
        Schema::table('documents', function (Blueprint $table) {
            $table->string('modele_ia_utilise')->nullable(); // Modèle IA utilisé (gpt-3.5-turbo, gpt-4, etc.)
            $table->timestamp('date_generation')->nullable(); // Date de génération spécifique
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('documents', function (Blueprint $table) {
            $table->dropColumn(['modele_ia_utilise', 'date_generation']);
        });
    }
};
