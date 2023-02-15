<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake() -> unique() -> words(2, true),
            'release_date' => fake() -> date(),
            'cashOut' => fake() -> randomNumber(5, false),
        ];
    }
}