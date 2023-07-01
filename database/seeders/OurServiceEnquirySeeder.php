<?php

namespace Database\Seeders;

use App\Models\OurServiceEnquiry;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OurServiceEnquirySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OurServiceEnquiry::factory(10)->create();
    }
}
