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
        Schema::create('certificat', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('utilisateur_id'); // ID de l'utilisateur (sans clé étrangère)
            $table->unsignedBigInteger('cours_id');       // ID du cours (sans clé étrangère)
            $table->dateTime('date_emission');            // Date d'émission du certificat
            $table->string('code_certificat')->unique();  // Code unique du certificat
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('certificat');
    }
};
