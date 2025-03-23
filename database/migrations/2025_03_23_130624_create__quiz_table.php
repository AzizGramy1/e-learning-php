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
        Schema::create('quiz', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cours_id'); // ID du cours (sans clé étrangère)
            $table->string('titre');               // Titre du quiz
            $table->text('description')->nullable(); // Description du quiz (optionnelle)
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quiz');
    }
};
