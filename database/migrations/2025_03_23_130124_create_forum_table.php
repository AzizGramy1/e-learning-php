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
        Schema::create('forum', function (Blueprint $table) {
            $table->id(); // Colonne ID auto-incrémentée
            $table->unsignedBigInteger('cours_id'); // Clé étrangère vers la table `cours`
            $table->string('titre'); // Titre du forum
            $table->text('description')->nullable(); // Description du forum (peut être nulle)
            $table->unsignedBigInteger('utilisateur_id'); // Clé étrangère vers la table `utilisateurs`
            $table->timestamps(); // Colonnes `created_at` et `updated_at`

            // Ajout des clés étrangères
            $table->foreign('cours_id')->references('id')->on('course')->onDelete('cascade');
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
        Schema::dropIfExists('forum');
    }
};
