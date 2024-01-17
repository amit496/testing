<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class StylistNotify extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
    {
        Schema::create('stylist_notify', function (Blueprint $table) {
            $table->id();
            $table->string('customer_id')->nullable();
            $table->string('notify_status')->nullable();
            $table->timestamp('sent_at');
            $table->string('notify_type')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stylist_notify');
    }
}
