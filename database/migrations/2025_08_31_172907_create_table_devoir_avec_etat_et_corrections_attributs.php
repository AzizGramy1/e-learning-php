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
            $table->id(); // id_devoir
            $table->string('titre'); // titre du devoir
            $table->text('description')->nullable(); // consignes ou détails
            $table->date('date_limite'); // date de rendu
            $table->enum('etat', ['en_attente', 'soumis', 'corrigé'])->default('en_attente'); // état du devoir

            // Relations
            $table->foreignId('etudiant_id')->constrained('users')->onDelete('cascade'); // l’étudiant qui soumet
            $table->foreignId('correcteur_id')->nullable()->constrained('users')->onDelete('set null'); // prof/correcteur

            // Fichiers (optionnel)
            $table->string('fichier')->nullable(); // chemin du fichier soumis
            $table->string('fichier_corrige')->nullable(); // fichier de correction (prof)

            // Notes
            $table->float('note')->nullable(); // note attribuée

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('devoirs');
    }
};
