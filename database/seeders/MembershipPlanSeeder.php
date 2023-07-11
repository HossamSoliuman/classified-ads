<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MembershipPlan;

class MembershipPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MembershipPlan::factory()->create([
            'name' => 'Basic',
            'description' => 'Basic membership plan with limited features',
            'duration' => 30,
            'price' => 0,
            'currency' => 'USD',
            'limit' => 10,
        ]);

        MembershipPlan::factory()->create([
            'name' => 'Premium',
            'description' => 'Premium membership plan with more features',
            'duration' => 30,
            'price' => 30,
            'currency' => 'USD',
            'limit' => 50,
        ]);

        MembershipPlan::factory()->create([
            'name' => 'Pro',
            'description' => 'Pro membership plan with all features',
            'duration' => 30,
            'price' => 50,
            'currency' => 'USD',
            'limit' => 100,
        ]);
    }
}
