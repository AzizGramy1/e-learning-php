<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\QuestionQuizz;   

class QuestionQuizzSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        QuestionQuizz::create([
            'quiz_id' => 3,  // ID du quiz associé
            'intitule' => 'Quelle est la capitale de la France ?',
            'type' => 'QCM',
            'points' => 5,
            'options' => json_encode(['Paris', 'Londres', 'Rome', 'Berlin']),
            'reponse_correcte' => json_encode(['Paris']),
            'reponse_1' => 'Paris',
            'reponse_2' => 'Londres',
            'reponse_3' => 'Rome',
            'reponse_4' => 'Berlin',
        ]);

        QuestionQuizz::create([
            'quiz_id' => 3,
            'intitule' => 'Laravel est un framework PHP ?',
            'type' => 'Vrai/Faux',
            'points' => 3,
            'options' => json_encode(['Vrai', 'Faux']),
            'reponse_correcte' => json_encode(['Vrai']),
            'reponse_1' => 'Vrai',
            'reponse_2' => 'Faux',
        ]);

        QuestionQuizz::create([
            'quiz_id' => 3,
            'intitule' => 'Combien font 5 + 7 ?',
            'type' => 'QCM',
            'points' => 2,
            'options' => json_encode(['10', '11', '12', '13']),
            'reponse_correcte' => json_encode(['12']),
            'reponse_1' => '10',
            'reponse_2' => '11',
            'reponse_3' => '12',
            'reponse_4' => '13',
        ]);
    }
}
