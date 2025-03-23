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
        Schema::create('paiement', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('utilisateur_id'); // ID de l'utilisateur (sans clé étrangère)
            $table->decimal('montant', 10, 2);            // Montant du paiement avec 2 décimales
            $table->string('statut');                    // Statut du paiement (ex: en_attente, complété)
            $table->dateTime('date_paiement');           // Date du paiement
            $table->string('methode_paiement');          // Méthode de paiement (ex: carte, PayPal)
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('paiement');
    }
};
