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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nom', 100);             // Nom avec longueur explicite
            $table->string('email', 150)->unique(); // Email avec longueur augmentée
            $table->timestamp('email_verified_at')->nullable();
            $table->string('mot_de_passe');         // Compatible avec Laravel Auth
            $table->string('role', 20)->default('étudiant');
            $table->rememberToken();
            $table->timestamps();
            
            $table->index('role'); // Index pour les requêtes filtrées par rôle
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
