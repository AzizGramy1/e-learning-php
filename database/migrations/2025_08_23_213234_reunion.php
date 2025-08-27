<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
     /**
     * Exécuter les migrations.
     */
    public function up(): void
    {
        Schema::create('reunions', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->text('description')->nullable();
            $table->dateTime('date_debut');
            $table->dateTime('date_fin');

            // Enum pour le statut (on met directement les valeurs au lieu d'utiliser Reunion::STATUT_XXX)
            $table->enum('statut', [
                'planifie',
                'en_cours',
                'termine',
                'annule',
            ])->default('planifie');

            $table->string('lien_video')->nullable();
            $table->integer('nombre_participants')->default(0);
            $table->integer('max_participants')->nullable();
            $table->decimal('note', 2, 1)->nullable()->default(0);

            // Relations
            $table->foreignId('instructeur_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('categorie_id')->nullable()->constrained('categories')->nullOnDelete();
            $table->foreignId('course_id')->nullable()->constrained('courses')->nullOnDelete();

            // Autres champs
            $table->string('image_url')->nullable();
            $table->boolean('est_prive')->default(false);
            $table->string('mot_de_passe')->nullable();
            $table->string('enregistrement_url')->nullable();
            $table->integer('duree')->nullable()->comment('Durée en minutes');

            $table->timestamps();
            $table->softDeletes();
        });

        // Table pivot pour les participants
        Schema::create('reunion_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reunion_id')->constrained('reunions')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('statut_participation')->nullable(); // ex: inscrit, absent, présent
            $table->dateTime('date_inscription')->nullable();
            $table->decimal('note', 2, 1)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Annuler les migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reunion_user');
        Schema::dropIfExists('reunions');
    }
};
