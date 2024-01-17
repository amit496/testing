<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStylistClientBookingAppointmentsSendResponsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stylist_client_booking_appointments_send_responses', function (Blueprint $table) {
            $table->id();
            $table->integer('merchant_id')->nullable();
            $table->integer('booking_id')->nullable();
            $table->integer('reveal_id')->nullable();
            $table->integer('email_template_id')->nullable();
            $table->integer('type_form_id')->nullable();
            $table->string('subject',190)->nullable();
            $table->longText('body',190)->nullable();
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
        Schema::dropIfExists('stylist_client_booking_appointments_send_responses');
    }
}
