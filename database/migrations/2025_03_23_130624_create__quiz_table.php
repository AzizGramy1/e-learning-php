<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('quizzes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cours_id');
            $table->string('titre');
            $table->text('description')->nullable();

            $table->integer('duree')->nullable(); // durée en minutes
            $table->integer('passage_max')->nullable(); // nombre max de tentatives
            $table->float('note_minimale')->nullable(); // note minimale pour validation

            $table->boolean('est_actif')->default(true); // quiz actif ou non

            $table->dateTime('date_ouverture')->nullable();
            $table->dateTime('date_fermeture')->nullable();

            $table->boolean('aleatoire_questions')->default(false);
            $table->boolean('correction_auto')->default(false);

            $table->unsignedBigInteger('certificat_id')->nullable();

            $table->timestamps();

            // Clés étrangères
            $table->foreign('cours_id')->references('id')->on('courses')->onDelete('cascade');
            $table->foreign('certificat_id')->references('id')->on('certificats')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quizzes');
    }
};
