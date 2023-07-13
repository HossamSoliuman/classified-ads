<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ContactUsEnquireFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'city' => $this->faker->city(),
            'topic' => $this->faker->sentence(),
            'company' => $this->faker->company(),
            'website' => $this->faker->domainName(),
            'message' => $this->faker->paragraph(2)      
        ];
    }
}