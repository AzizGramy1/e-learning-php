<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::table('users', function (Blueprint $table) {
        $table->string('avatar_url')->nullable();
        $table->string('adresse')->nullable();
        $table->string('niveau')->nullable();
        $table->string('telephone')->nullable();
        $table->date('date_naissance')->nullable();
        $table->string('langues')->nullable();
        $table->integer('progression')->default(0);
        $table->integer('heures')->default(0);
        $table->json('skills')->nullable();
        $table->json('badges')->nullable();
        $table->json('social_links')->nullable();
        $table->json('activities')->nullable();
        $table->json('education')->nullable();
        $table->json('experience')->nullable();
        $table->json('goals')->nullable();
    });
}

public function down()
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn([
            'avatar_url',
            'adresse',
            'niveau',
            'telephone',
            'date_naissance',
            'langues',
            'progression',
            'heures',
            'skills',
            'badges',
            'social_links',
            'activities',
            'education',
            'experience',
            'goals'
        ]);
    });
}

};
