<?php

namespace Database\Seeders;


use App\Models\Forum;
use App\Models\Course;
use App\Models\Message;  
use App\Models\User;
use Faker\Factory;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ForumSeeder extends Seeder
{
    public function run()
    {
        // Création de 5 cours et 10 utilisateurs
        Course::factory()->count(5)->create();
        User::factory()->count(10)->create();

        // Création de 30 forums avec messages
        Forum::factory()
            ->count(30)
            ->create()
            ->each(function ($forum) {
                // Crée 3 messages par forum
                $forum->messages()->createMany(
                    \App\Models\Message::factory()
                        ->count(3)
                        ->make()
                        ->toArray()
                );
            });

        $this->command->info('✅ 30 forums avec 3 messages chacun créés !');
    }
}
