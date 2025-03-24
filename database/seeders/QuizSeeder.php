<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Models\Quiz;

class QuizSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Vérifie si un cours existe avant d'insérer des quizzes
        $cours = DB::table('courses')->first();

        if (!$cours) {
            $this->command->warn("Aucun cours trouvé. Ajoutez des données dans 'courses' d'abord.");
            return;
        }

        // Insérer des quizzes fictifs
        DB::table('quizzes')->insert([
            [
                'cours_id' => $cours->id,
                'titre' => 'Introduction à Laravel',
                'description' => 'Testez vos connaissances de base sur Laravel.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'cours_id' => $cours->id,
                'titre' => 'PHP avancé',
                'description' => 'Un quiz pour évaluer votre compréhension des concepts avancés de PHP.',
                'created_at' => Carbon::now()->subDays(2),
                'updated_at' => Carbon::now()->subDays(2),
            ],
        ]);
    }
}
