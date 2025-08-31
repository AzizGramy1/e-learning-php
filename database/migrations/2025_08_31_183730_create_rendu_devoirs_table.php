<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rendu_devoirs', function (Blueprint $table) {
            $table->id();
            
            // 🔹 Références
            $table->unsignedBigInteger('devoir_id');
            $table->unsignedBigInteger('user_id');        // étudiant
            $table->unsignedBigInteger('correcteur_id')->nullable(); // facultatif

            // 🔹 Contenu du rendu
            $table->string('fichier_url');
            $table->decimal('note', 5, 2)->nullable();
            $table->text('commentaire')->nullable();
            $table->timestamp('date_soumission')->nullable();
            $table->enum('etat', ['en_attente', 'corrige', 'en_retard'])->default('en_attente');

            $table->timestamps();

            // 🔹 Clés étrangères
            $table->foreign('devoir_id')->references('id')->on('devoirs')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('correcteur_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rendu_devoirs');
    }
};
