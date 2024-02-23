<?php

namespace Database\Factories;

use App\Models\{Question, User};
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Question>
 */
class QuestionFactory extends Factory
{
    public function definition(): array
    {
        return [
            'question'   => fake()->realText(50),
            'draft'      => fake()->boolean(true),
            'created_by' => User::factory()->create(),
        ];
    }
}
