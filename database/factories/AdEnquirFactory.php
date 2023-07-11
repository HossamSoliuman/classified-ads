<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AdEnquir>
 */
class AdEnquirFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'sender_id'=>rand(1,10),
            'ad_id'=>rand(1,20),
            'body'=>fake()->text(),
            'ad_owner_id'=>rand(1,10),
        ];
    }
}
