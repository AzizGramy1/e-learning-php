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
        Schema::create('rapport', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('utilisateur_id'); // ID de l'utilisateur (sans clé étrangère)
            $table->string('titre');                     // Titre du rapport
            $table->text('contenu');                     // Contenu du rapport
            $table->dateTime('date_generation');         // Date de génération du rapport
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rapport');
    }
};
