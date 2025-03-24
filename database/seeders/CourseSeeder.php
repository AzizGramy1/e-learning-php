<?php

namespace Database\Seeders;

use App\Models\Course;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      // Créer des cours de test
      Course::create([
        'titre' => 'Introduction à Laravel',
        'description' => 'Un cours pour apprendre les bases de Laravel.',
        'image' => 'laravel.jpg',
    ]);

    Course::create([
        'titre' => 'Apprendre Vue.js',
        'description' => 'Un cours pour maîtriser Vue.js avec Laravel.',
        'image' => 'vuejs.jpg',
    ]);

    Course::create([
        'titre' => 'Développement Full-Stack',
        'description' => 'Un cours complet pour devenir développeur Full-Stack.',
        'image' => 'fullstack.jpg',
    ]);

    // Ajouter d'autres cours si nécessaire
    Course::create([
        'titre' => 'Base de données avec MySQL',
        'description' => 'Apprenez à concevoir et manipuler des bases de données MySQL.',
        'image' => 'mysql.jpg',
    ]);

    Course::create([
        'titre' => 'API REST avec Laravel',
        'description' => 'Découvrez comment créer des API RESTful avec Laravel.',
        'image' => 'api.jpg',
    ]);

    Course::create([
        'titre' => 'Développement Front-End avec React',
        'description' => 'Maîtrisez React pour créer des interfaces utilisateur modernes.',
        'image' => 'react.jpg',
    ]);
  
    }
}
