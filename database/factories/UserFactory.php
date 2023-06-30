<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->safeEmail,
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),

            'role' => 'user',
            'designation' => $this->faker->jobTitle,
            'image' => $this->faker->imageUrl(),
            'birthday' => $this->faker->date('Y-m-d', '1980-01-01'),
            'phone' => $this->faker->phoneNumber,


            'image' => $this->faker->imageUrl(),

            'birthday' => $this->faker->date('Y-m-d', '1980-01-01'),

            'phone' => $this->faker->phoneNumber,

            'company_name' => $this->faker->company,

            'website' => $this->faker->url,

            'pan_number' => $this->faker->lexify('?????????'),

            'gst_number' => $this->faker->lexify('?????????'),

            'social_links' => $this->faker->url,

            'house_no' => $this->faker->buildingNumber,

            'street' => $this->faker->streetName,

            'landmark' => $this->faker->secondaryAddress,

            'post_code' => $this->faker->postcode,

            'city' => $this->faker->city,

            'state' => $this->faker->state,

            'country' => $this->faker->country,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
