<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OurServiceEnquiry>
 */
class OurServiceEnquiryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->name(),
            'address' => fake()->streetAddress(),
            'city' => fake()->city(),
            'contact_number' => fake()->phoneNumber(),
            'email' => fake()->email(),
            'company_name' => fake()->company(),
            'website' => fake()->url(),
            'service_id' => fake()->randomDigitNotNull(),
            'enquirement' => fake()->text(100),
        ];
    }
}
