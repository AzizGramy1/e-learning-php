<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('abonnements', function (Blueprint $table) {
            $table->id(); // Colonne ID auto-incrémentée
            $table->unsignedBigInteger('utilisateur_id'); // Clé étrangère vers la table `utilisateurs`
            $table->unsignedBigInteger('cours_id'); // Clé étrangère vers la table `cours`
            $table->dateTime('date_début'); // Date de début de l'abonnement
            $table->dateTime('date_fin'); // Date de fin de l'abonnement
            $table->string('statut')->default('actif'); // Statut de l'abonnement (par défaut 'actif')
            $table->timestamps(); // Colonnes `created_at` et `updated_at`

            // Ajout des clés étrangères
            $table->foreign('utilisateur_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('cours_id')->references('id')->on('courses')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('abonnements');
    }
};
