<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;




return new class extends Migration
{
     public function up()
    {
        Schema::create('reunion_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reunion_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('statut_participation')->nullable();
            $table->timestamp('date_inscription')->nullable();
            $table->decimal('note', 2, 1)->nullable();
            $table->timestamps();

            $table->unique(['reunion_id', 'user_id']); // un utilisateur ne peut s’inscrire qu’une fois
        });
    }

    public function down()
    {
        Schema::dropIfExists('reunion_user');
    }
};
