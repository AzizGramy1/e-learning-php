<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rapport', function (Blueprint $table) {
            $table->id(); // Colonne ID auto-incrémentée
            $table->unsignedBigInteger('utilisateur_id'); // Clé étrangère vers la table `utilisateurs`
            $table->string('titre'); // Titre du rapport
            $table->text('contenu'); // Contenu du rapport
            $table->dateTime('date_génération'); // Date de génération du rapport
            $table->timestamps(); // Colonnes `created_at` et `updated_at`

            // Ajout des clés étrangères
            $table->foreign('utilisateur_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rapport');
    }
};
