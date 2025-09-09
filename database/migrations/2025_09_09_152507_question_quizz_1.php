<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
 public function up(): void
    {
        Schema::create('question_quizzs', function (Blueprint $table) {
            $table->id();

            // 🔗 Clé étrangère vers quiz
            $table->unsignedBigInteger('quiz_id');
            $table->foreign('quiz_id')->references('id')->on('quizzes')->onDelete('cascade');

            // Contenu de la question
            $table->string('intitule');              // Texte de la question
            $table->string('type')->default('qcm');  // Type de question : qcm, vrai/faux, texte libre
            $table->integer('points')->default(1);   // Points attribués

            // Réponses possibles
            $table->json('options')->nullable();           // JSON pour stocker les choix (utile pour QCM)
            $table->json('reponse_correcte')->nullable();  // Bonne réponse (JSON si plusieurs)

            // Réponses simples (4 maximum pour QCM)
            $table->string('reponse_1')->nullable();
            $table->string('reponse_2')->nullable();
            $table->string('reponse_3')->nullable();
            $table->string('reponse_4')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('question_quizzs');
    }
};
