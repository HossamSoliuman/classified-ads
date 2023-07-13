<?php

namespace Database\Seeders;

use App\Models\ContactUsEnquire;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactUsEnquireSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ContactUsEnquire::factory(20)->create();
    }
}
