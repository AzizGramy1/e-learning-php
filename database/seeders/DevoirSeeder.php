<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Devoir;
use Carbon\Carbon;

class DevoirSeeder extends Seeder
{
    public function run()
    {
        $devoirs = [
            [
                'course_id'      => 1,
                'user_id'        => 1,
                'titre'          => 'Introduction à Laravel',
                'description'    => 'Exercices de base sur les routes et contrôleurs Laravel.',
                'module'         => 'Module 1: Bases Laravel',
                'points'         => 10,
                'date_limite'    => Carbon::now()->addDays(7),
                'categorie'      => 'exercice',
                'statut'         => 'actif',
                'instructions'   => 'Créer un projet Laravel et configurer les routes principales.',
                'type_remise'    => 'fichier',
                'fichiers_joints'=> json_encode(['ressources/laravel_intro.pdf']),
                'fichier_url'    => 'devoirs/intro_laravel.pdf',
            ],
            [
                'course_id'      => 1,
                'user_id'        => 1,
                'titre'          => 'Projet CRUD',
                'description'    => 'Projet pratique pour gérer des utilisateurs avec Laravel.',
                'module'         => 'Module 2: CRUD Avancé',
                'points'         => 20,
                'date_limite'    => Carbon::now()->addDays(14),
                'categorie'      => 'projet',
                'statut'         => 'en_attente',
                'instructions'   => 'Créer un CRUD complet avec modèles, contrôleurs et vues.',
                'type_remise'    => 'fichier_et_lien',
                'fichiers_joints'=> json_encode(['ressources/crud_guide.pdf', 'ressources/crud_exemples.zip']),
                'fichier_url'    => 'devoirs/projet_crud.pdf',
            ],
            [
                'course_id'      => 2,
                'user_id'        => 2,
                'titre'          => 'Quiz ES6',
                'description'    => 'Questions sur les nouvelles fonctionnalités ES6 en JavaScript.',
                'module'         => 'Module 3: ES6+',
                'points'         => 15,
                'date_limite'    => Carbon::now()->addDays(5),
                'categorie'      => 'quiz',
                'statut'         => 'actif',
                'instructions'   => 'Répondre aux questions dans le fichier en ligne.',
                'type_remise'    => 'lien',
                'fichiers_joints'=> json_encode([]),
                'fichier_url'    => '',
            ],
        ];

        foreach ($devoirs as $devoir) {
            Devoir::create($devoir);
        }
    }
}
