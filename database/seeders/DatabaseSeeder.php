<?php

namespace Database\Seeders;


use Illuminate\Support\Facades\DB;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            AbonnementSeeder::class,
            CapsuleSeeder::class,
            UnitySeeder::class,
            DevoirSeeder::class,
            ChapitreSeeder::class,
            ModuleCourseSeeder::class,
            CoursSeeder::class,
            QuizSeeder::class,
            QuestionQuizzSeeder::class,




        ]);
    }




}
