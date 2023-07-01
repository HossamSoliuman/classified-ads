<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\ProductType;
use App\Models\Service;
use App\Models\SubCategory;
use App\Models\Testimonial;
use Illuminate\Database\Seeder;
use Symfony\Component\HttpKernel\DependencyInjection\ServicesResetter;

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
            CommentSeeder::class,
            ServiceSeeder::class,
            TestimonialSeeder::class,
        ]);
    }
}
