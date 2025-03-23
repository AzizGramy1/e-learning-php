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
        Schema::create('forum', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cours_id');       // ID du cours (sans clé étrangère)
            $table->unsignedBigInteger('utilisateur_id'); // ID de l'utilisateur (sans clé étrangère)
            $table->string('titre');                      // Titre du forum
            $table->text('description')->nullable();      // Description du forum (optionnelle)
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('forum');
    }
};
