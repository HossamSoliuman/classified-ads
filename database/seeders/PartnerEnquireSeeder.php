<?php

namespace Database\Seeders;

use App\Models\PartnerEnquire;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PartnerEnquireSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PartnerEnquire::factory(20)->create();
    }
}
