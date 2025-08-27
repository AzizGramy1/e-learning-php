<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Categorie;


class CategorieSeeder extends Seeder
{
    /**
     * Exécuter le seeder.
     */
    public function run(): void
    {
        $categories = [
            [
                'nom' => 'Réunions de projet',
                'description' => 'Réunions dédiées à la planification, au suivi et à l’avancement des projets.',
                'image_url' => 'https://example.com/images/projet.png',
            ],
            [
                'nom' => 'Formations',
                'description' => 'Sessions de formation animées par un instructeur pour développer des compétences.',
                'image_url' => 'https://example.com/images/formation.png',
            ],
            [
                'nom' => 'Ateliers pratiques',
                'description' => 'Réunions interactives pour mettre en pratique les connaissances acquises.',
                'image_url' => 'https://example.com/images/atelier.png',
            ],
            [
                'nom' => 'Conférences',
                'description' => 'Présentations et discussions autour d’un thème spécifique avec un public large.',
                'image_url' => 'https://example.com/images/conference.png',
            ],
            [
                'nom' => 'Réunions internes',
                'description' => 'Réunions destinées aux équipes internes pour échanger et aligner les objectifs.',
                'image_url' => 'https://example.com/images/interne.png',
            ],
        ];

        foreach ($categories as $categorie) {
            Categorie::create($categorie);
        }
    }
}
