<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class InstructionDevoirSeeder extends Seeder
{
/**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('instruction_devoirs')->insert([
            [
                'devoir_id'   => 1,
                'title'       => 'Lire le chapitre 3',
                'description' => 'Étudier les concepts de programmation orientée objet',
                'points'      => '10',
                'sousPoints'  => '2 points pour les exemples, 8 points pour l’explication',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'devoir_id'   => 1,
                'title'       => 'Rédiger un résumé',
                'description' => 'Résumé de 500 mots sur les classes et objets',
                'points'      => '15',
                'sousPoints'  => '5 points pour la structure, 10 points pour le contenu',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
        ]);
    }
}
