<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Rapport;
use App\Models\User;


class RapportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Vérifie si un utilisateur existe avant d'insérer des rapports
        $utilisateur = DB::table('users')->first();

        if (!$utilisateur) {
            $this->command->warn("Aucun utilisateur trouvé. Ajoutez des utilisateurs d'abord.");
            return;
        }

        // Insérer des rapports fictifs
        DB::table('rapports')->insert([
            [
                'utilisateur_id' => $utilisateur->id,
                'titre' => 'Analyse des ventes',
                'contenu' => 'Ce rapport analyse les ventes du dernier trimestre et propose des améliorations.',
                'date_génération' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'utilisateur_id' => $utilisateur->id,
                'titre' => 'Rapport de performance',
                'contenu' => 'Une évaluation complète des performances des employés pour le mois de mars.',
                'date_génération' => Carbon::now()->subDays(5),
                'created_at' => Carbon::now()->subDays(5),
                'updated_at' => Carbon::now()->subDays(5),
            ],
        ]);
    }
}
