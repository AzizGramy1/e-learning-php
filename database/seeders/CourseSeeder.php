<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('courses')->insert([
            [
                'title' => 'Introduction à Laravel',
                'description' => 'Un cours pour apprendre les bases de Laravel.',
                'image' => 'laravel.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Apprendre Vue.js',
                'description' => 'Un cours pour maîtriser Vue.js avec Laravel.',
                'image' => 'vuejs.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
