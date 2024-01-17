<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStylistClientBookingAppointmentsChangeStatusHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stylist_client_booking_appointments_change_status_histories', function (Blueprint $table) {
            $table->id();
            $table->string('booking_id')->nullable();
            $table->string('status')->nullable();
            $table->integer('reveal_id')->nullable();
            $table->string('comment')->nullable();
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
        Schema::dropIfExists('stylist_client_booking_appointments_change_status_histories');
    }
}
