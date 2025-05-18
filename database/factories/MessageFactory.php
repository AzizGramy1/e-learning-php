<?php



namespace Database\Factories;


use App\Models\Forum;
use App\Models\User;
use App\Models\Message;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class MessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'contenu' => $this->faker->paragraph,
            'forum_id' => Forum::inRandomOrder()->first()->id,
            'utilisateur_id' => User::inRandomOrder()->first()->id,
        ];
    }
}
