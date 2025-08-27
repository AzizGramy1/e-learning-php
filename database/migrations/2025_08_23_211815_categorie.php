<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
     /**
     * Exécuter les migrations.
     */
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('slug')->unique();
            $table->string('image_url')->nullable(); // 🔹 champ image_url
            $table->text('description')->nullable();
            $table->string('couleur')->nullable();
            $table->string('icone')->nullable();
            $table->boolean('est_active')->default(true);
            $table->integer('ordre_affichage')->default(0);
            $table->integer('nombre_reunions')->default(0);
            $table->foreignId('parent_id')->nullable()->constrained('categories')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Annuler les migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
