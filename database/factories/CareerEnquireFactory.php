<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CareerEnquire>
 */
class CareerEnquireFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->name,
            'city' => fake()->city,
            'qualification' => fake()->randomElement(['Bachelor', 'Master', 'PhD']),
            'post_for_apply' => fake()->jobTitle,
            'phone' => fake()->phoneNumber,
            'experience' => fake()->numberBetween(0, 10),
            'email' => fake()->email,
            'skill' => fake()->word,
            'resume' => fake()->imageUrl(640, 480, 'cats', true, 'Faker')
        ];
    }
}
