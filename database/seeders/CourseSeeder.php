<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $courses = [
            [
                'titre' => 'Laravel pour Débutants',
                'description' => 'Découvrez les bases de Laravel et développez votre première application web.',
                'image' => 'laravel.png',
                'categorie' => 'Développement Web',
                'difficulte' => 'Débutant',
                'note' => 4.7,
                'statut' => 'Nouveau',
                'auteur' => 'Jean Dupont',
                'tags' => json_encode(['Laravel', 'PHP', 'Backend']),
                'chapitres_total' => 20,
                'chapitres_completes' => 5,
                'progression' => 25,
                'certificat_obtenu' => false,
                'langue' => 'Français',
                'prerequis' => 'Bases de PHP',
                'format' => 'Vidéo',
                'nombre_inscrits' => 120,
                'nombre_commentaires' => 15,
                'favoris' => 30,
                'date_publication' => '2025-01-10',
                'date_mise_a_jour' => '2025-05-01',
                'temps_appris' => 600,
            ],
            [
                'titre' => 'Introduction à Python pour la Data Science',
                'description' => 'Apprenez Python et ses bibliothèques pour débuter en Data Science.',
                'image' => 'python.png',
                'categorie' => 'Data Science',
                'difficulte' => 'Débutant',
                'note' => 4.9,
                'statut' => 'Populaire',
                'auteur' => 'Alice Martin',
                'tags' => json_encode(['Python', 'Data Science', 'Pandas']),
                'chapitres_total' => 25,
                'chapitres_completes' => 10,
                'progression' => 40,
                'certificat_obtenu' => false,
                'langue' => 'Français',
                'prerequis' => 'Aucun',
                'format' => 'Vidéo + Exercices',
                'nombre_inscrits' => 300,
                'nombre_commentaires' => 50,
                'favoris' => 80,
                'date_publication' => '2025-02-15',
                'date_mise_a_jour' => '2025-06-10',
                'temps_appris' => 1200,
            ],
            [
                'titre' => 'React Avancé',
                'description' => 'Maîtrisez React, Redux et le développement d’applications complexes.',
                'image' => 'react.png',
                'categorie' => 'Développement Frontend',
                'difficulte' => 'Avancé',
                'note' => 4.8,
                'statut' => 'Recommandé',
                'auteur' => 'Marc Leroy',
                'tags' => json_encode(['React', 'Redux', 'Frontend']),
                'chapitres_total' => 30,
                'chapitres_completes' => 30,
                'progression' => 100,
                'certificat_obtenu' => true,
                'langue' => 'Anglais',
                'prerequis' => 'Bases de JavaScript et React',
                'format' => 'Vidéo + Projets',
                'nombre_inscrits' => 500,
                'nombre_commentaires' => 100,
                'favoris' => 200,
                'date_publication' => '2025-03-20',
                'date_mise_a_jour' => '2025-07-01',
                'temps_appris' => 2000,
            ],
        ];

        foreach ($courses as $course) {
            Course::create($course);
        }
    }
}
