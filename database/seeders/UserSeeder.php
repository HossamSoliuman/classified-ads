<?php

namespace Database\Seeders;

use App\Models\MembershipPlan;
use App\Models\Usage;  
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $freePlan = MembershipPlan::find(1);
        
        User::factory()->create([
            'role' => 'admin',
            'email' => 'admin@gmail.com',
        ]);
        
        Usage::create([
            'user_id' => 1,
            'used' => 0,
            'max_limit' => $freePlan->limit,
        ]);
        
        User::factory(10)->create()->each(function ($user) use ($freePlan) {
            Usage::create([
                'user_id' => $user->id,
                'used' => 0,    
                'max_limit' => $freePlan->limit,   
            ]);  
        });      
    }
}