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
        Schema::create('instruction_devoirs', function (Blueprint $table) {
            $table->id();

            // 🔗 Association avec Devoir
            $table->foreignId('devoir_id')
                  ->constrained('devoirs')
                  ->onDelete('cascade');

            // Attributs de l'instruction
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('points')->nullable();
            $table->string('sousPoints')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instruction_devoirs');
    }
};
