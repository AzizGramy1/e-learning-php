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
        Schema::create('message', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('forum_id');       // ID du forum (sans clé étrangère)
            $table->unsignedBigInteger('utilisateur_id'); // ID de l'utilisateur (sans clé étrangère)
            $table->text('contenu');                      // Contenu du message
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('message');
    }
};
