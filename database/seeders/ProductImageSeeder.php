<?php

namespace Database\Seeders;

use App\Models\Ad;
use App\Models\ProductImage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(Ad::all(['id']) as $ad){
            ProductImage::factory()->create([
                'ad_id' => $ad->id,
            ]);
        }
    }
}
