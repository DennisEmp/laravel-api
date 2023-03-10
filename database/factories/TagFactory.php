<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TagFactory extends Factory
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
            'description' => fake() -> boolean() ? fake() -> text(100) : null,
        ];
    }
}