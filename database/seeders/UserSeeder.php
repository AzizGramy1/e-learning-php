<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Créer un administrateur
        User::create([
            'nom' => 'Admin',
            'email' => 'admin@example.com',
            'mot_de_passe' => Hash::make('password'), // Mot de passe : "password"
            'role' => 'administrateur',
        ]);

        // Créer un formateur
        User::create([
            'nom' => 'Formateur',
            'email' => 'formateur@example.com',
            'mot_de_passe' => Hash::make('password'), // Mot de passe : "password"
            'role' => 'formateur',
        ]);

        // Créer un étudiant
        User::create([
            'nom' => 'Étudiant',
            'email' => 'etudiant@example.com',
            'mot_de_passe' => Hash::make('password'), // Mot de passe : "password"
            'role' => 'étudiant',
        ]);

        // Créer 10 utilisateurs supplémentaires avec des rôles aléatoires
        $roles = ['étudiant', 'formateur', 'administrateur'];
        for ($i = 1; $i <= 10; $i++) {
            User::create([
                'nom' => 'User ' . $i,
                'email' => 'user' . $i . '@example.com',
                'mot_de_passe' => Hash::make('password'), // Mot de passe : "password"
                'role' => $roles[array_rand($roles)], // Rôle aléatoire
            ]);
        }
    }
}
