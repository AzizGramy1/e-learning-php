<?php

namespace Database\Seeders;


use App\Models\Forum;
use App\Models\Course;  
use App\Models\User;
use Faker\Factory;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ForumSeeder extends Seeder
{
    public function run()
{
    // Créez d'abord des cours et utilisateurs
    \App\Models\Course::factory()->count(5)->create();
    \App\Models\User::factory()->count(10)->create();

    Forum::factory()
        ->count(30)
        ->create([
            'cours_id' => \App\Models\Course::inRandomOrder()->first()->id,
            'utilisateur_id' => \App\Models\User::inRandomOrder()->first()->id,
        ]);
}
}
