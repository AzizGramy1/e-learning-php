<?php

namespace Database\Seeders;


use App\Models\Abonnement;

use Carbon\Carbon; // ✅ Importer Carbon pour les dates
use Illuminate\Support\Facades\DB; // ✅ Importer DB correctement


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AbonnementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insérer des abonnements fictifs
        DB::table('abonnements')->insert([
            [
                'utilisateur_id' => 1,
                'cours_id' => 1,
                'date_début' => Carbon::now(),
                'date_fin' => Carbon::now()->addMonth(),
                'statut' => 'actif',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'utilisateur_id' => 2,
                'cours_id' => 2,
                'date_début' => Carbon::now(),
                'date_fin' => Carbon::now()->addMonth(),
                'statut' => 'actif',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'utilisateur_id' => 3,
                'cours_id' => 1,
                'date_début' => Carbon::now(),
                'date_fin' => Carbon::now()->addMonth(),
                'statut' => 'expiré',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
