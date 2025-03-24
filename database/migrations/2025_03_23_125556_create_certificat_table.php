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
        Schema::create('certificats', function (Blueprint $table) {
            $table->id(); // Colonne ID auto-incrémentée
            $table->unsignedBigInteger('utilisateur_id'); // Clé étrangère vers la table `utilisateurs`
            $table->unsignedBigInteger('cours_id'); // Clé étrangère vers la table `cours`
            $table->dateTime('date_émission'); // Date d'émission du certificat
            $table->string('code_certificat')->unique(); // Code unique du certificat
            $table->timestamps(); // Colonnes `created_at` et `updated_at`

            // Ajout des clés étrangères
            $table->foreign('utilisateur_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('cours_id')->references('id')->on('courses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('certificats');
    }
};
