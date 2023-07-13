<?php

namespace Database\Seeders;

use App\Models\CareerEnquire;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CareerEnquireSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CareerEnquire::factory(20)->create();
    }
}
