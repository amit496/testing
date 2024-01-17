<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStylistFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stylist_forms', function (Blueprint $table) {
            $table->id();
            $table->string('name',190)->nullable();
            $table->string('video_name',190)->nullable();
            $table->string('product_ids',190)->nullable();
            $table->string('status',1)->nullable();
            $table->string('slug',190)->unique();
            $table->integer('merchant_id')->nullable();
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
        Schema::dropIfExists('stylist_forms');
    }
}
