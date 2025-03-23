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
        Schema::create('paiement', function (Blueprint $table) {
            $table->id(); // Colonne ID auto-incrémentée
            $table->unsignedBigInteger('utilisateur_id'); // Clé étrangère vers la table `utilisateurs`
            $table->decimal('montant', 10, 2); // Montant du paiement (10 chiffres au total, 2 décimales)
            $table->string('statut')->default('en_attente'); // Statut du paiement (par défaut 'en_attente')
            $table->dateTime('date_paiement')->nullable(); // Date du paiement (peut être nulle)
            $table->string('méthode_paiement'); // Méthode de paiement (ex. carte de crédit, PayPal)
            $table->timestamps(); // Colonnes `created_at` et `updated_at`

            // Ajout des clés étrangères
            $table->foreign('utilisateur_id')->references('id')->on('user')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('paiement');
    }
};
