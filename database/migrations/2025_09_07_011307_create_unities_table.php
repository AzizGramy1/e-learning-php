<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('unities', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->enum('type', ['pdf', 'video', 'image', 'code']); // Type unité
        $table->text('content')->nullable(); // chemin fichier ou contenu du code

        // Unity appartient à une capsule
        $table->foreignId('capsule_id')
              ->constrained('capsules')
              ->onDelete('cascade');

        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unities');
    }
};
