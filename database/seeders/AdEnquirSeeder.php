<?php

namespace Database\Seeders;

use App\Models\AdEnquir;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdEnquirSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AdEnquir::factory(50)->create();
    }
}
