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
        Schema::create('cv_templates', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Moderne, Classique, Créatif, etc.
            $table->string('style'); // Couleurs, polices, mise en page
            $table->text('description')->nullable(); // Description du template
            $table->json('options')->nullable(); // Options personnalisables (couleurs, sections, etc.)
            $table->boolean('is_default')->default(false); // Template par défaut
            $table->boolean('is_active')->default(true); // Template disponible
            $table->string('preview_image')->nullable(); // Image de prévisualisation
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cv_templates');
    }
};
