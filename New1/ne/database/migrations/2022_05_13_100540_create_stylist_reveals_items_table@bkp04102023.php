<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStylistRevealsItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stylist_reveals_items', function (Blueprint $table) {
            $table->id();
            
			$table->integer('merchant_id')->nullable();
			$table->integer('booking_id')->nullable();
			$table->text('product_ids')->nullable();
			$table->text('alernative_product_ids')->nullable();
			$table->text('status')->nullable();
			$table->string('doc_name')->nullable();
            $table->string('reveal_name')->nullable();
			
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
        Schema::dropIfExists('stylist_reveals_items');
    }
}
