<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Course;

class CourseUserSeeder extends Seeder
{
    public function run(): void
    {
        // ⚠️ Assure-toi d'avoir déjà des users et des courses créés avant !
        $users = User::all();
        $courses = Course::all();

        if ($users->isEmpty() || $courses->isEmpty()) {
            $this->command->warn('⚠️ Aucun utilisateur ou cours trouvé. Exécute d\'abord les seeders de User et Course.');
            return;
        }

        // Associer chaque utilisateur à 2 cours aléatoires
        foreach ($users as $user) {
            $randomCourses = $courses->random(min(2, $courses->count()))->pluck('id');
            $user->courses()->attach($randomCourses);
        }

        $this->command->info('✅ Table course_user remplie avec succès !');
    }
}
