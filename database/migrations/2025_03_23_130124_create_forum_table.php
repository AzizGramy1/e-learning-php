<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   /**
     * Run the database seeds.
     */
    public function up(): void
    {
        Schema::create('forums', function (Blueprint $table) { // Nom de la table au pluriel
            $table->engine = 'InnoDB'; // Nécessaire pour les clés étrangères
            $table->id();
            $table->string('titre');
            $table->text('description');
            
            // Clé étrangère vers la table `courses`
            $table->unsignedBigInteger('cours_id');
            $table->foreign('cours_id')
                  ->references('id')
                  ->on('courses')
                  ->onDelete('cascade'); // Suppression en cascade

            // Clé étrangère vers la table `users`
            $table->unsignedBigInteger('utilisateur_id');
            $table->foreign('utilisateur_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Annule les migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('forums');
    }
};
