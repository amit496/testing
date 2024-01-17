<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Productnote extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_notes', function (Blueprint $table) {
            $table->increments('id');          
            $table->string('customer_id',20)->nullable();
            $table->string('merchant_id',20)->nullable();
            $table->string('booking_id',20)->nullable();            
            $table->longtext('notes')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('product_notes');
    }
}
