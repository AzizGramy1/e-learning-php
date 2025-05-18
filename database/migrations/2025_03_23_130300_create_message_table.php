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
        Schema::create('messages', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            
            // Clé étrangère vers forums
            $table->unsignedBigInteger('forum_id');
            $table->foreign('forum_id')
                  ->references('id')
                  ->on('forums') // Bien référencer `forums`
                  ->onDelete('cascade');

            // Clé étrangère vers users
            $table->unsignedBigInteger('utilisateur_id');
            $table->foreign('utilisateur_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');

            $table->text('contenu');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
