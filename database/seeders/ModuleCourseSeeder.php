<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ModuleCourse;
use App\Models\Course;

class ModuleCourseSeeder extends Seeder
{
 /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Récupération des IDs des cours existants
        $coursIds = Course::pluck('id')->toArray();

        if (empty($coursIds)) {
            $this->command->info('Aucun cours trouvé, impossible de créer des modules.');
            return;
        }

        // Création de 10 modules
        for ($i = 1; $i <= 10; $i++) {
            ModuleCourse::create([
                'title' => "Module $i",
                'description' => "Description détaillée du module $i.",
                'course_id' => $coursIds[array_rand($coursIds)],
            ]);
        }

        $this->command->info('10 modules ont été créés avec succès.');
    }
}
