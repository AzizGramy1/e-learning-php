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
        // Supprimer d'abord les clés étrangères des tables liées
        Schema::disableForeignKeyConstraints();

        // Drop propre de la table courses
        Schema::dropIfExists('courses');

        Schema::enableForeignKeyConstraints();

        // Création de la nouvelle table
        Schema::create('courses', function (Blueprint $table) {
            $table->id();

            // Informations de base
            $table->string('titre');
            $table->text('description')->nullable();
            $table->string('image')->nullable();

            // Catégorie, niveau, note, statut
            $table->string('categorie')->nullable();
            $table->string('difficulte')->nullable();
            $table->decimal('note', 3, 1)->default(0); // ex: 4.8
            $table->string('statut')->default('Nouveau');

            // Auteur et tags
            $table->string('auteur')->nullable();
            $table->json('tags')->nullable();

            // Contenu du cours
            $table->integer('chapitres_total')->default(0);
            $table->integer('chapitres_completes')->default(0);
            $table->integer('progression')->default(0); // en %

            $table->boolean('certificat_obtenu')->default(false);
            $table->string('langue')->default('Français');
            $table->string('prerequis')->nullable();
            $table->string('format')->nullable();

            // Interaction utilisateur
            $table->integer('nombre_inscrits')->default(0);
            $table->integer('nombre_commentaires')->default(0);
            $table->integer('favoris')->default(0);

            // Gestion du temps
            $table->date('date_publication')->nullable();
            $table->date('date_mise_a_jour')->nullable();
            $table->integer('temps_appris')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
