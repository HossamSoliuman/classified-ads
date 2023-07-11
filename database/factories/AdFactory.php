<?php

namespace Database\Factories;

use App\Models\Ad;
use Illuminate\Database\Eloquent\Factories\Factory;

class AdFactory extends Factory
{
    protected $model = Ad::class;

    public function definition()
    {
        return [
            'start_date' => $this->faker->dateTimeThisMonth(),
            'status' => $this->faker->randomElement([
                Ad::DRAFT,
                Ad::PENDING_APPROVAL,
                Ad::APPROVED,
                Ad::PUBLISHED,
                Ad::REJECTED,
                Ad::SUSPENDED,
            ]),
            'user_id' => $this->faker->numberBetween(1, 10), // replace 10 with the number of users in your system
            'badge' => $this->faker->word(),
            'product_title' => $this->faker->sentence(),
            'address' => $this->faker->address(),
            'state' => $this->faker->state(),
            'city' => $this->faker->city(),
            'contact_no' => $this->faker->phoneNumber(),
            'opening_hours' => $this->faker->text(),
            'year_of_establishment' => $this->faker->year(),
            'gstn' => $this->faker->numerify('##########'),
            'pan' => $this->faker->numerify('##########'),
            'social_links' => "
                'facebook' => 'https://facebook.com',
                'twitter' => 'https://twitter.com',
                'instagram' => 'https://instagram.com',
             ",
            'category_id' => $this->faker->numberBetween(1, 5), 
            'sub_category_id' => $this->faker->numberBetween(1, 5), 
            'product_type_id' => $this->faker->numberBetween(1, 5), 
            'price_type_id' => $this->faker->numberBetween(1, 5), 
            'unit_type_id' => $this->faker->numberBetween(1, 5), 
            'order_type_id' => $this->faker->numberBetween(1, 5), 
            'mode_of_payment_id' => $this->faker->numberBetween(1, 5),
            'area_id' => $this->faker->numberBetween(1, 5), 
            'offer_type_id' => $this->faker->numberBetween(1, 5),
            'return_policy_id' => $this->faker->numberBetween(1, 5),
            'features' => implode(',', [
                $this->faker->word(),
                $this->faker->word(),
                $this->faker->word(),
            ]),
            'product_description' => $this->faker->paragraph(),
            'company_description' => $this->faker->paragraph(),
            'featured'=>rand(0,3),
        ];
    }
}
