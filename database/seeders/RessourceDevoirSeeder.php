<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RessourceDevoirSeeder extends Seeder
{
/**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ressource_devoirs')->insert([
            [
                'devoir_id'        => 1,
                'name'             => 'Présentation POO',
                'description'      => 'Slides expliquant les concepts de base',
                'icon'             => 'fa-file-powerpoint',
                'iconType'         => 'ppt',
                'ressourceLinkName'=> 'Télécharger le fichier',
                'descriptionLink'  => 'http://example.com/poo-slides.pptx',
                'created_at'       => now(),
                'updated_at'       => now(),
            ],
            [
                'devoir_id'        => 1,
                'name'             => 'Vidéo explicative',
                'description'      => 'Cours vidéo sur les classes et objets',
                'icon'             => 'fa-video',
                'iconType'         => 'mp4',
                'ressourceLinkName'=> 'Voir la vidéo',
                'descriptionLink'  => 'http://example.com/poo-video.mp4',
                'created_at'       => now(),
                'updated_at'       => now(),
            ],
        ]);
    }
}
