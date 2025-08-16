<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'nom' => 'Aziz',
                'email' => 'azizaziz1@gmail.com',
                'password' => Hash::make('password123'),
                'role' => 'étudiant',
                'avatar_url' => 'https://www.freelances.tn/wp-content/uploads/2024/10/2742429639260218-300x300.jpg',
                'adresse' => 'Tunis, Tunisie',
                'niveau' => 'Ingenieur Informatique',
                'telephone' => '+21650760177',
                'date_naissance' => '2001-09-14',
                'langues' => 'Arabe, Français, Anglais',
                'progression' => 75,
                'heures' => 120,
                'skills' => ['Laravel', 'Angular', 'Java'],
                'badges' => ['Développeur débutant', 'Angular Pro'],
                'social_links' => [
                    ['icon' => 'fab fa-linkedin', 'link' => 'https://linkedin.com/in/aziz'],
                    ['icon' => 'fab fa-github', 'link' => 'https://github.com/aziz']
                ],
                'activities' => [
                    ['icon' => '<svg>...</svg>', 'description' => 'A terminé un cours de Laravel', 'time' => 'Il y a 2 jours'],
                ],
                'education' => [
                    ['degree' => 'Licence Informatique', 'institution' => 'Université de Tunis', 'year' => '2022'],
                ],
                'experience' => [
                    ['role' => 'Stagiaire Développeur', 'company' => 'Startup X', 'period' => '2023'],
                ],
                'goals' => [
                    ['name' => 'Apprendre Angular', 'progress' => 60, 'color' => 'text-green-400', 'progressBarClass' => 'bg-green-500']
                ],
            ],
            [
                'nom' => 'Asma Leo',
                'email' => 'asma@example.com',
                'password' => Hash::make('password123'),
                'role' => 'étudiant',
                'avatar_url' => 'https://randomuser.me/api/portraits/women/12.jpg',
                'adresse' => 'Bizerte, Tunisie',
                'niveau' => 'Master 1',
                'telephone' => '+21652156824',
                'date_naissance' => '2003-08-31',
                'langues' => 'Arabe, Francais, Anglais',
                'progression' => 50,
                'heures' => 80,
                'skills' => ['Python', 'Data Science', 'Machine Learning'],
                'badges' => ['Data Analyst', 'Python Ninja'],
                'social_links' => [
                    ['icon' => 'fab fa-twitter', 'link' => 'https://twitter.com/asma'],
                ],
                'activities' => [
                    ['icon' => '<svg>...</svg>', 'description' => 'A participé à un forum IA', 'time' => 'Il y a 1 semaine'],
                ],
                'education' => [
                    ['degree' => 'Licence Math-Info', 'institution' => 'Université de Sfax', 'year' => '2021'],
                ],
                'experience' => [
                    ['role' => 'Assistante Data Analyst', 'company' => 'Entreprise Y', 'period' => '2024'],
                ],
                'goals' => [
                    ['name' => 'Publier un projet ML', 'progress' => 30, 'color' => 'text-blue-400', 'progressBarClass' => 'bg-blue-500']
                ],
            ],
            [
                'nom' => 'Admin Master',
                'email' => 'admin@example.com',
                'password' => Hash::make('admin123'),
                'role' => 'administrateur',
                'avatar_url' => 'https://randomuser.me/api/portraits/men/1.jpg',
                'adresse' => 'Paris, France',
                'niveau' => 'Doctorat',
                'telephone' => '+33100000000',
                'date_naissance' => '1985-02-10',
                'langues' => 'Français, Anglais',
                'progression' => 100,
                'heures' => 500,
                'skills' => ['Gestion de projet', 'Sécurité', 'Cloud'],
                'badges' => ['Super Admin'],
                'social_links' => [],
                'activities' => [],
                'education' => [],
                'experience' => [],
                'goals' => [],
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
