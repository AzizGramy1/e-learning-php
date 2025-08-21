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
        Schema::table('certificats', function (Blueprint $table) {
            $table->integer('note')->nullable()->after('code_certificat'); // Note sur 100
            $table->text('description_obtention')->nullable()->after('note'); // Description de l'obtention
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('certificats', function (Blueprint $table) {
            $table->dropColumn(['note', 'description_obtention']);
        });
    }
};

