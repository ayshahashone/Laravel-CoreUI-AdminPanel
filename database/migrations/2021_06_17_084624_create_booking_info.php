<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_info', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedInteger('driver_id');
            $table->foreign('driver_id')->references('id')->on('drivers');
            $table->unsignedInteger('cab_id');
            $table->foreign('cab_id')->references('id')->on('cabs');
            $table->string('pickup_address')->nullable();
            $table->string('dropoff_address')->nullable();
            $table->string('services')->nullable();
            $table->string('request_time')->nullable();
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
        Schema::dropIfExists('booking_info');
    }
}
