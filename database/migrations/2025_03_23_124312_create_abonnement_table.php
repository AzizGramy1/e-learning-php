<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('abonnement', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('utilisateur_id');
            $table->unsignedBigInteger('cours_id');
            $table->date('date_début');
            $table->date('date_fin')->nullable();
            $table->enum('statut', ['actif', 'expiré', 'annulé'])->default('actif');
            $table->timestamps();

            // Décommenter ces lignes si vous ajoutez des clés étrangères dans le futur
            // $table->foreign('utilisateur_id')->references('id')->on('utilisateurs')->onDelete('cascade');
            // $table->foreign('cours_id')->references('id')->on('cours')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('abonnement');
    }
};
