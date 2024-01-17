<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStylistClientInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stylist_client_infos', function (Blueprint $table) {
            $table->id();
            $table->string('name',190)->nullable();
            $table->string('email',190)->nullable();
            $table->integer('merchant_id')->nullable();
            $table->integer('stylist_form_id')->nullable();
            $table->integer('booking_id')->nullable();
            $table->integer('appointment_response_id')->nullable();
            $table->integer('customer_id')->nullable();
            $table->string('selected_product_ids',190)->nullable();
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
        Schema::dropIfExists('stylist_client_infos');
    }
}
