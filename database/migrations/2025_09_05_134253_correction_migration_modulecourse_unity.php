<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{
    public function up(): void
    {
        // 1️⃣ Migration pour module_courses
        Schema::create('module_courses', function (Blueprint $table) {
            $table->id(); // BIGINT UNSIGNED auto-increment
            $table->string('title');
            $table->text('description')->nullable();
            $table->unsignedBigInteger('course_id'); // Référence vers courses
            $table->foreign('course_id')
                  ->references('id')
                  ->on('courses')
                  ->onDelete('cascade');
            $table->timestamps();
        });

        // 2️⃣ Migration pour unities
        Schema::create('unities', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('type');       // pdf, video, image, code
            $table->text('content')->nullable();
            $table->unsignedBigInteger('module_id'); // Référence vers module_courses
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
        Schema::dropIfExists('module_courses');
    }
};
