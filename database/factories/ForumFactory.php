<?php

namespace Database\Factories;

use App\Models\Forum;
use Illuminate\Database\Eloquent\Factories\Factory;

class ForumFactory extends Factory
{
    protected $model = Forum::class; // Lien explicite

    public function definition()
    {
        return [
            'titre' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'cours_id' => \App\Models\Course::factory(),
            'utilisateur_id' => \App\Models\User::factory(),
        ];
    }
}