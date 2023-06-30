<?php

namespace Database\Factories;

use App\Models\ServiceEnquiry;
use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceEnquiryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail, 
            'city' => $this->faker->city,
            'requirement' => $this->faker->text(50),
            'contact_number' => $this->faker->e164PhoneNumber,
            'type_of_sender' => $this->faker->randomElement([ServiceEnquiry::SELLER, ServiceEnquiry::BUYER]),
            
        ];
    }
}