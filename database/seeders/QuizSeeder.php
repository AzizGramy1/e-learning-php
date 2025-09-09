<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

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
        $faker = Faker::create();

        $courses = Course::all();

        if ($courses->count() === 0) {
            $this->command->warn('⚠️ Aucun cours trouvé. Exécute d’abord CourseSeeder.');
            return;
        }

        foreach ($courses as $course) {
            // Générer entre 1 et 3 quizz par cours
            for ($i = 0; $i < rand(1, 3); $i++) {
                Quiz::create([
                    'cours_id' => $course->id,
                    'titre' => $faker->sentence(4),
                    'description' => $faker->paragraph(),
                    'duree' => $faker->numberBetween(10, 90), // entre 10 et 90 min
                    'passage_max' => $faker->numberBetween(1, 5),
                    'note_minimale' => $faker->randomFloat(2, 5, 20), // note entre 5 et 20
                    'est_actif' => $faker->boolean(80), // 80% de chance d’être actif
                    'date_ouverture' => $faker->dateTimeBetween('-1 month', '+1 week'),
                    'date_fermeture' => $faker->dateTimeBetween('+1 week', '+2 months'),
                    'aleatoire_questions' => $faker->boolean(),
                    'correction_auto' => $faker->boolean(),
                    'certificat_id' => null, // à remplir plus tard si besoin
                ]);
            }
        }
    }


}
