<?php

namespace Database\Factories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{
    protected $model = Course::class;

    public function definition()
    {
        return [
            'titre' => $this->faker->words(3, true),
            'description' => $this->faker->paragraphs(3, true),
            'image' => $this->faker->imageUrl(640, 480, 'technics'),
        ];
    }
}