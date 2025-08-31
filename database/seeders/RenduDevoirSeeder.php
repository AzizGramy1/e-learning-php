<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Devoir;
use App\Models\RenduDevoir;
use App\Models\User;
use Carbon\Carbon;


class RenduDevoirSeeder extends Seeder
{
    public function run()
    {
        $devoirs = Devoir::all();
        $etudiants = User::where('role', 'etudiant')->get();

        if ($devoirs->isEmpty() || $etudiants->isEmpty()) {
            $this->command->info("Aucun devoir ou étudiant trouvé pour créer des rendus.");
            return;
        }

        foreach ($devoirs as $devoir) {
            $etudiantsAleatoires = $etudiants->random(rand(1, min(5, $etudiants->count())));
            foreach ($etudiantsAleatoires as $etudiant) {
                RenduDevoir::create([
                    'devoir_id'       => $devoir->id,
                    'user_id'         => $etudiant->id,
                    'fichier_url'     => 'rendus/' . strtolower(str_replace(' ', '_', $devoir->titre)) . '_' . $etudiant->id . '.pdf',
                    'note'            => rand(5, 20),
                    'commentaire'     => 'Bon travail, quelques améliorations possibles.',
                    'date_soumission' => Carbon::now()->subDays(rand(0, 10)),
                    'etat'            => 'corrige',
                ]);
            }
        }
    }
}
