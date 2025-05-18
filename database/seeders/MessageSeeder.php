<?php

namespace Database\Seeders;

use App\Models\Message;
use App\Models\Course;
use App\Models\Forum;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
//
use App\Models\User;
//
//


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Ajoute 3 messages supplémentaires à chaque forum existant
        Forum::each(function ($forum) {
            Message::factory()
                ->count(3)
                ->create([
                    'forum_id' => $forum->id,
                    'utilisateur_id' => User::inRandomOrder()->first()->id
                ]);
        });

        $this->command->info('✅ Messages supplémentaires ajoutés aux forums !');
    }
}
