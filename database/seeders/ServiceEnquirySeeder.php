<?php

namespace Database\Seeders;

use App\Models\ServiceEnquiry;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceEnquirySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ServiceEnquiry::factory(50)->create();
    }
}
