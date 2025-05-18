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

         Quiz::create([
            'cours_id' => 1,
            'titre' => 'Quiz Laravel',
            'description' => 'Un quiz de base sur Laravel.',
            'duree' => 30,
            'passage_max' => 3,
            'note_minimale' => 60,
            'est_actif' => true,
            'date_ouverture' => now(),
            'date_fermeture' => now()->addDays(7),
            'aleatoire_questions' => true,
            'correction_auto' => true,
            'certificat_id' => null,
        ]);


        
    }



}
