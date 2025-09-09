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
        Schema::create('module_courses', function (Blueprint $table) {
            $table->id(); // Clé primaire auto-incrémentée
            $table->string('title'); // Titre du module
            $table->text('description')->nullable(); // Description du module
            $table->foreignId('course_id') // Relation avec Course
                  ->constrained('courses') // Fait référence à la table courses
                  ->onDelete('cascade'); // Si un course est supprimé → supprime les modules liés
            $table->timestamps(); // created_at et updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('module_courses');
    }
};
