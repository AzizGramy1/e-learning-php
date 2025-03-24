<?php

namespace Database\Seeders;

use App\Models\Message;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
//
use App\Models\User;
use App\Models\Forum;
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
        // Vérifie si des forums et des utilisateurs existent
        $forum = DB::table('forums')->first();
        $utilisateur = DB::table('users')->first();

        if (!$forum || !$utilisateur) {
            $this->command->warn("Aucun forum ou utilisateur trouvé. Ajoutez des données dans 'forums' et 'users' d'abord.");
            return;
        }

        // Insérer des messages fictifs
        DB::table('messages')->insert([
            [
                'forum_id' => $forum->id,
                'utilisateur_id' => $utilisateur->id,
                'contenu' => "Bienvenue dans ce forum ! Partageons nos idées.",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'forum_id' => $forum->id,
                'utilisateur_id' => $utilisateur->id,
                'contenu' => "Quelqu'un a-t-il des conseils sur ce sujet ?",
                'created_at' => Carbon::now()->subDays(5),
                'updated_at' => Carbon::now()->subDays(5),
            ],
        ]);
    }

}
