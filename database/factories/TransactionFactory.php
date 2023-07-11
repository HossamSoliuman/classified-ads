<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
            return [
                'user_id'=>rand(1,10),
                'date' => fake()->date(),
                'membership' => fake()->word(),
                'service' => fake()->word(),
                'amount' => fake()->randomFloat(2, 10, 1000),
                'payment_mode' => fake()->word(),
                'status' => fake()->randomElement(['pending', 'completed', 'failed']),
            ];
    }
}
