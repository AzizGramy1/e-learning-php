<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{
 public function up(): void
    {
        Schema::create('quizzes', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('module_id'); // Liaison avec ModuleCourse
            $table->unsignedBigInteger('certificat_id')->nullable(); // Liaison avec Certificat

            $table->string('titre');
            $table->text('description')->nullable();
            $table->integer('duree')->default(0); // Durée en minutes
            $table->integer('passage_max')->default(1); // Nombre de tentatives
            $table->decimal('note_minimale', 5, 2)->default(0); // Note minimale pour réussir
            $table->boolean('est_actif')->default(true);
            $table->dateTime('date_ouverture');
            $table->dateTime('date_fermeture');
            $table->boolean('aleatoire_questions')->default(false);
            $table->boolean('correction_auto')->default(false);

            $table->timestamps();

            // Clés étrangères
            $table->foreign('module_id')
                  ->references('id')
                  ->on('module_courses')
                  ->onDelete('cascade');

            $table->foreign('certificat_id')
                  ->references('id')
                  ->on('certificats')
                  ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quizzes');
    }
};
