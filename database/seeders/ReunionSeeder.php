<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Reunion;
use App\Models\User;
use App\Models\Categorie;
use App\Models\Course;

class ReunionSeeder extends Seeder
{
    /**
     * Exécuter le seeder.
     */
    public function run(): void
    {
        // On récupère quelques utilisateurs, catégories et cours
        $instructeur = User::first(); // premier utilisateur comme instructeur
        $categorie = Categorie::first(); // première catégorie
        $course = Course::first(); // premier cours

        // Créer une réunion
        $reunion = Reunion::create([
            'titre' => 'Réunion de lancement du projet',
            'description' => 'Présentation des objectifs du projet et répartition des tâches',
            'date_debut' => now()->addDays(2),
            'date_fin' => now()->addDays(2)->addHours(2),
            'statut' => 'planifie',
            'lien_video' => 'https://zoom.us/j/123456789',
            'nombre_participants' => 0,
            'max_participants' => 20,
            'note' => 0,
            'instructeur_id' => $instructeur?->id ?? User::factory()->create()->id,
            'categorie_id' => $categorie?->id,
            'course_id' => $course?->id,
            'image_url' => null,
            'est_prive' => false,
            'mot_de_passe' => null,
            'enregistrement_url' => null,
            'duree' => 120,
        ]);

        // Ajouter des participants
        $participants = User::inRandomOrder()->take(5)->get();

        foreach ($participants as $participant) {
            $reunion->participants()->attach($participant->id, [
                'statut_participation' => 'inscrit',
                'date_inscription' => now(),
                'note' => null,
            ]);

            // Incrémenter le nombre de participants
            $reunion->increment('nombre_participants');
        }
    }
}
