<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partner_enquires', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('city');
            $table->string('company')->nullable();
            $table->string('phone');
            $table->string('address');    
            $table->string('partnership');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('partner_enquires');
    }
};
