<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\AdminMessage;
use App\Models\ProductType;
use App\Models\Service;
use App\Models\SubCategory;
use App\Models\Testimonial;
use App\Models\Transaction;
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
            MembershipPlanSeeder::class,
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
            OurServiceEnquirySeeder::class,
            AdEnquirSeeder::class,
            SubscriptionRequestSeeder::class,
            TransactionSeeder::class,
            AdminMessageSeeder::class,
        ]);
    }
}
