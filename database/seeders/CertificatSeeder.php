<?php

namespace Database\Seeders;

use App\Models\Certificat;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
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
            $this->command->warn("⚠️ Aucun utilisateur ou cours trouvé. Ajoutez des données dans 'users' et 'courses' d'abord.");
            return;
        }

        // Données factices pour les certificats
        $certificats = [
            [
                'utilisateur_id'      => $utilisateur->id,
                'cours_id'            => $cours->id,
                'date_émission'       => Carbon::now(),
                'code_certificat'     => Str::upper(Str::random(10)), // ex: XGTR92LMNB
                'note'                => 95,
                'description_obtention' => 'Certification obtenue avec mention "Excellent".',
                'created_at'          => Carbon::now(),
                'updated_at'          => Carbon::now(),
            ],
            [
                'utilisateur_id'      => $utilisateur->id,
                'cours_id'            => $cours->id,
                'date_émission'       => Carbon::now()->subDays(15),
                'code_certificat'     => Str::upper(Str::random(10)),
                'note'                => 88,
                'description_obtention' => 'Certification validée après un projet final.',
                'created_at'          => Carbon::now()->subDays(15),
                'updated_at'          => Carbon::now()->subDays(15),
            ],
            [
                'utilisateur_id'      => $utilisateur->id,
                'cours_id'            => $cours->id,
                'date_émission'       => Carbon::now()->subMonths(3),
                'code_certificat'     => Str::upper(Str::random(10)),
                'note'                => 76,
                'description_obtention' => 'Certification obtenue avec une bonne performance globale.',
                'created_at'          => Carbon::now()->subMonths(3),
                'updated_at'          => Carbon::now()->subMonths(3),
            ],
        ];

        // Insertion
        DB::table('certificats')->insert($certificats);

        $this->command->info("✅ Certificats insérés avec succès !");
    }
}
