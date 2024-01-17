<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatusFilterModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('status_filter', function (Blueprint $table) {
            $table->id();
            $table->string('customer_id')->nullable();
            $table->string('customer_name')->nullable();
            $table->string('booking_id')->nullable();
            $table->string('booking_status')->nullable();
            $table->string('reveal_id')->nullable();
            $table->string('reveal_status')->nullable();
            $table->string('reveal_send_date')->nullable();
            $table->string('order_id')->nullable();
            $table->string('order_number')->nullable();
            $table->string('order_product_id')->nullable();
            $table->string('order_delivery_date')->nullable();
            $table->string('merchant_id')->nullable();
            $table->string('shop_name')->nullable();
            $table->string('shop_id')->nullable();
            $table->string('call_complete')->nullable();
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
        Schema::dropIfExists('status_filter');
    }
}
