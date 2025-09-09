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
        Schema::table('quizzes', function (Blueprint $table) {
            $table->string('intitule')->nullable()->after('titre'); 
            $table->string('type')->nullable()->after('intitule'); 
            $table->integer('points')->default(0)->after('type'); 
            $table->json('options')->nullable()->after('points');
            $table->json('reponse_correcte')->nullable()->after('options');
            $table->string('reponse_1')->nullable()->after('reponse_correcte');
            $table->string('reponse_2')->nullable()->after('reponse_1');
            $table->string('reponse_3')->nullable()->after('reponse_2');
            $table->string('reponse_4')->nullable()->after('reponse_3');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('quizzes', function (Blueprint $table) {
            $table->dropColumn([
                'intitule',
                'type',
                'points',
                'options',
                'reponse_correcte',
                'reponse_1',
                'reponse_2',
                'reponse_3',
                'reponse_4',
            ]);
        });
    }

};
