<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Exécute la migration.
     */
    public function up(): void
    {
        Schema::create('devoirs', function (Blueprint $table) {
            $table->id();
            
            // 🔹 Relation avec Course
            $table->foreignId('course_id')->constrained('courses')->onDelete('cascade');
            
            // 🔹 Relation avec User (créateur du devoir)
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            
            // 🔹 Attributs spécifiques
            $table->string('titre');
            $table->text('description')->nullable();
            $table->date('date_limite')->nullable();
            $table->string('categorie')->nullable();
            $table->string('fichier_url')->nullable();
            
            // 🔹 Statut (par ex: "en attente", "actif", "fermé")
            $table->enum('statut', ['en_attente', 'actif', 'ferme'])->default('en_attente');
            
            $table->timestamps();
        });
    }

    /**
     * Annule la migration.
     */
    public function down(): void
    {
        Schema::dropIfExists('devoirs');
    }
};
