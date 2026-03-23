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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->enum('type', ['cv', 'lettre', 'email']); // Type
            $table->string('title'); // Titre
            $table->longText('content'); // Contenu
            $table->string('modele_ia_utilise')->nullable(); // Modèle IA utilisé
            $table->timestamp('date_generation')->nullable(); // Date de génération
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
