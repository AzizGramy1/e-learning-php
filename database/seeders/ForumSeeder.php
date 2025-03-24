<?php

namespace Database\Seeders;


use App\Models\Forum;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ForumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Créer des forums de test
        Forum::create([
            'cours_id' => 1, // ID du cours associé (doit exister dans la table `courses`)
            'titre' => 'Discussion sur Laravel',
            'description' => 'Un forum pour discuter des bases de Laravel.',
            'utilisateur_id' => 1, // ID de l'utilisateur qui a créé le forum (doit exister dans la table `users`)
        ]);

        Forum::create([
            'cours_id' => 2, // ID du cours associé
            'titre' => 'Questions sur Vue.js',
            'description' => 'Un forum pour poser des questions sur Vue.js.',
            'utilisateur_id' => 2, // ID de l'utilisateur qui a créé le forum
        ]);

        Forum::create([
            'cours_id' => 3, // ID du cours associé
            'titre' => 'Projets Full-Stack',
            'description' => 'Un forum pour partager des projets Full-Stack.',
            'utilisateur_id' => 3, // ID de l'utilisateur qui a créé le forum
        ]);

        // Vous pouvez ajouter autant de forums que vous le souhaitez
        Forum::create([
            'cours_id' => 4, // ID du cours associé
            'titre' => 'Base de données MySQL',
            'description' => 'Un forum pour discuter des bases de données MySQL.',
            'utilisateur_id' => 4, // ID de l'utilisateur qui a créé le forum
        ]);

        Forum::create([
            'cours_id' => 5, // ID du cours associé
            'titre' => 'API REST avec Laravel',
            'description' => 'Un forum pour discuter de la création d\'API REST avec Laravel.',
            'utilisateur_id' => 5, // ID de l'utilisateur qui a créé le forum
        ]);
    }
}
