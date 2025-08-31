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
    Schema::create('devoirs', function (Blueprint $table) {
        $table->id();
        $table->foreignId('course_id')->constrained('courses')->onDelete('cascade');
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

        $table->string('titre');
        $table->text('description')->nullable();
        $table->string('module')->nullable();
        $table->integer('points')->default(0);

        $table->dateTime('date_limite')->nullable();
        $table->string('categorie')->nullable();
        $table->enum('statut', ['en_attente', 'en_retard', 'terminé', 'actif'])->default('actif');

        $table->longText('instructions')->nullable();
        $table->enum('type_remise', ['fichier', 'lien', 'fichier_et_lien'])->default('fichier');
        $table->json('fichiers_joints')->nullable();

        $table->string('fichier_url')->nullable();

        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_devoir_avec_etat_et_corrections_attributs_1');
    }
};
