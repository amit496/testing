<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStylistClientBookingAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stylist_client_booking_appointments', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name',190)->nullable();
            $table->integer('merchant_id')->nullable();
            $table->string('email',190)->nullable();
            $table->string('appointment_date',190)->nullable();
            $table->integer('customer_id')->nullable();
            $table->string('appointment_time',190)->nullable();
            $table->string('status',190)->nullable();
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stylist_client_booking_appointments');
    }
}
