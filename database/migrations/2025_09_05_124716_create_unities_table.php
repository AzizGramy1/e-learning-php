<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;




return new class extends Migration
{
    public function up(): void
    {
        Schema::create('unities', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->enum('type', ['pdf', 'video', 'image', 'code']);
            $table->text('content');

            // clé étrangère bien explicite
            $table->unsignedBigInteger('module_id');
            $table->foreign('module_id')
                  ->references('id')
                  ->on('module_courses')
                  ->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('unities');
    }
};
