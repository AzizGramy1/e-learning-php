<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Models\Quiz;
use App\Models\Course;
use App\Models\ModuleCourse;
use App\Models\Certificat;

class QuizSeeder extends Seeder
{

/**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Récupération des IDs existants
        $coursIds = Course::pluck('id')->toArray();
        $moduleIds = ModuleCourse::pluck('id')->toArray();
        $certificatIds = Certificat::pluck('id')->toArray();

        if (empty($coursIds) || empty($moduleIds)) {
            $this->command->info('Aucun cours ou module trouvé, impossible de créer des quizzes.');
            return;
        }

        // Création de 10 quizzes
        for ($i = 1; $i <= 10; $i++) {
            Quiz::create([
                'module_id' => $moduleIds[array_rand($moduleIds)],
                'titre' => "Quiz Test $i",
                'description' => "Description complète du quiz $i avec tous les détails.",
                'duree' => rand(5, 60), // durée en minutes
                'passage_max' => rand(1, 5),
                'note_minimale' => rand(50, 100),
                'est_actif' => (bool)rand(0, 1),
                'date_ouverture' => Carbon::now()->subDays(rand(0, 10)),
                'date_fermeture' => Carbon::now()->addDays(rand(1, 20)),
                'aleatoire_questions' => (bool)rand(0, 1),
                'correction_auto' => (bool)rand(0, 1),
                'certificat_id' => !empty($certificatIds) ? $certificatIds[array_rand($certificatIds)] : null,
            ]);
        }

        $this->command->info('10 quizzes ont été créés avec succès.');
    }


}
