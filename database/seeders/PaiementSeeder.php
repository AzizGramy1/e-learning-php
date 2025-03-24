<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use App\Models\Paiement;
use App\Models\User;

class PaiementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Vérifie si un utilisateur existe avant d'insérer des paiements
        $utilisateur = DB::table('users')->first();

        if (!$utilisateur) {
            $this->command->warn("Aucun utilisateur trouvé. Ajoutez des données dans 'users' d'abord.");
            return;
        }

        // Insérer des paiements fictifs
        DB::table('paiements')->insert([
            [
                'utilisateur_id' => $utilisateur->id,
                'montant' => 99.99,
                'statut' => 'payé',
                'date_paiement' => Carbon::now(),
                'méthode_paiement' => 'Carte de crédit',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'utilisateur_id' => $utilisateur->id,
                'montant' => 49.99,
                'statut' => 'en_attente',
                'date_paiement' => null,
                'méthode_paiement' => 'PayPal',
                'created_at' => Carbon::now()->subDays(3),
                'updated_at' => Carbon::now()->subDays(3),
            ],
        ]);
    }
}
