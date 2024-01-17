<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStylistClientInfoDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stylist_client_info_details', function (Blueprint $table) {
            $table->id();
            
            $table->string('stylist_info_id',190)->nullable();
            $table->integer('product_id')->nullable();
            $table->string('selection_type',190)->nullable();
            $table->string('decline_options',190)->nullable();
            $table->string('alternative_options',190)->nullable();
            $table->text('other_msg')->nullable();
            
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
        Schema::dropIfExists('stylist_client_info_details');
    }
}
