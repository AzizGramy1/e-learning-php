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
        Schema::create('ressource_devoirs', function (Blueprint $table) {
            $table->id();

            // 🔗 Association avec Devoir
            $table->foreignId('devoir_id')
                  ->constrained('devoirs')
                  ->onDelete('cascade');

            // Attributs de la ressource
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('icon')->nullable();
            $table->string('iconType')->nullable();
            $table->string('ressourceLinkName')->nullable();
            $table->text('descriptionLink')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ressource_devoirs');
    }
};
