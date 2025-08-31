<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RenduDevoir>
 */
class RenduDevoirFactory extends Factory
{
   protected $model = RenduDevoir::class;

    public function definition()
    {
        return [
            'devoir_id'       => Devoir::inRandomOrder()->first()->id ?? 1,
            'user_id'         => User::where('role','etudiant')->inRandomOrder()->first()->id ?? 1,
            'fichier_url'     => $this->faker->filePath(),
            'note'            => $this->faker->randomFloat(2, 5, 20),
            'commentaire'     => $this->faker->sentence,
            'date_soumission' => $this->faker->dateTimeBetween('-10 days', 'now'),
            'etat'            => $this->faker->randomElement(['en_attente', 'corrige', 'en_retard']),
        ];
    }
}
