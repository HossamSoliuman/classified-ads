<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\ProductType;
use App\Models\SubCategory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            AreaSeeder::class,
            ModeOfPaymentSeeder::class,
            OfferTypeSeeder::class,
            OrderTypeSeeder::class,
            PriceTypeSeeder::class,
            ProductTypeSeeder::class,
            ReturnPolicySeeder::class,
            CategorySeeder::class,
            SubCategorySeeder::class,
            UnitTypeSeeder::class,
            AdSeeder::class,
            ProductImageSeeder::class,
            ReviewSeeder::class,
            ServiceEnquirySeeder::class,
            PostSeeder::class,
        ]);
    }
}
