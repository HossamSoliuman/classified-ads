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
        Schema::create('career_enquires', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('city');
            $table->string('qualification');
            $table->string('post_for_apply');
            $table->string('phone');
            $table->string('experience');
            $table->string('email');
            $table->string('skill');
            $table->string('resume');
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
        Schema::dropIfExists('career_enquires');
    }
};
