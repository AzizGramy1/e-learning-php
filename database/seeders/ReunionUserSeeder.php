<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Reunion;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReunionUserSeeder extends Seeder
{
/**
     * Run the database seeds.
     */
    public function run(): void
    {
        $reunions = Reunion::all();
        $users = User::all();

        if ($reunions->isEmpty() || $users->isEmpty()) {
            $this->command->info('Aucune réunion ou aucun utilisateur trouvé.');
            return;
        }

        foreach ($reunions as $reunion) {
            // Nombre aléatoire de participants pour cette réunion
            $nbParticipants = rand(1, min($users->count(), $reunion->max_participants ?? $users->count()));

            // Choisir aléatoirement des utilisateurs
            $participants = $users->random($nbParticipants);

            foreach ($participants as $user) {
                DB::table('reunion_user')->updateOrInsert(
                    [
                        'reunion_id' => $reunion->id,
                        'user_id' => $user->id
                    ],
                    [
                        'statut_participation' => ['present', 'absent', 'en_attente'][array_rand(['present', 'absent', 'en_attente'])],
                        'date_inscription' => Carbon::now()->subDays(rand(0, 30)),
                        'note' => rand(0, 50) / 10, // note entre 0.0 et 5.0
                        'created_at' => now(),
                        'updated_at' => now()
                    ]
                );
            }
        }

        $this->command->info('Seeder reunion_user exécuté avec succès !');
    }
}
