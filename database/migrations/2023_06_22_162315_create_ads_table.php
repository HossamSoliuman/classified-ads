<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdsTable extends Migration
{
    public function up()
    {
        Schema::create('ads', function (Blueprint $table) {
            $table->id();
            $table->dateTime('start_date');
            $table->string('status')->default('draft');
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('badge')->nullable();
            $table->string('product_title')->nullable();
            $table->text('address')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->string('contact_no')->nullable();
            $table->text('opening_hours')->nullable();
            $table->year('year_of_establishment')->nullable();
            $table->string('gstn')->nullable();
            $table->string('pan')->nullable();
            $table->json('social_links')->nullable();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->foreignId('sub_category_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_type_id')->constrained()->cascadeOnDelete();
            $table->foreignId('price_type_id')->constrained()->cascadeOnDelete();
            $table->foreignId('unit_type_id')->constrained()->cascadeOnDelete();
            $table->foreignId('order_type_id')->constrained()->cascadeOnDelete();
            $table->foreignId('mode_of_payment_id')->constrained()->cascadeOnDelete();
            $table->foreignId('area_id')->constrained()->cascadeOnDelete();
            $table->foreignId('offer_type_id')->constrained()->cascadeOnDelete();
            $table->foreignId('return_policy_id')->constrained()->cascadeOnDelete();
            $table->text('features')->nullable();
            $table->text('product_description');
            $table->text('company_description');
            $table->integer('featured');
            $table->integer('custom_rating')->nullable();
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('ads');
    }
}
