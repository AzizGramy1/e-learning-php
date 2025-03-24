<?php

namespace Database\Seeders;

use App\Models\Certificat;

use Carbon\Carbon; // ✅ Importer Carbon pour les dates
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB; // ✅ Importer DB correctement



use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CertificatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Vérifie si des utilisateurs et des cours existent
        $utilisateur = DB::table('users')->first();
        $cours = DB::table('courses')->first();

        if (!$utilisateur || !$cours) {
            $this->command->warn("Aucun utilisateur ou cours trouvé. Ajoutez des données dans 'users' et 'courses' d'abord.");
            return;
        }

        // Insérer des certificats fictifs
        DB::table('certificats')->insert([
            [
                'utilisateur_id' => $utilisateur->id,
                'cours_id' => $cours->id,
                'date_émission' => Carbon::now(),
                'code_certificat' => Str::uuid(), // Génération d'un code unique
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'utilisateur_id' => $utilisateur->id,
                'cours_id' => $cours->id,
                'date_émission' => Carbon::now()->subDays(10),
                'code_certificat' => Str::uuid(),
                'created_at' => Carbon::now()->subDays(10),
                'updated_at' => Carbon::now()->subDays(10),
            ],
        ]);
    }

}
