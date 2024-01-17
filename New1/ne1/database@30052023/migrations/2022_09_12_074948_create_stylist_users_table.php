<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStylistUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stylist_users', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->string('company_id')->nullable();
            $table->string('budget_price')->nullable();
            $table->string('budget_price_calculate_type')->nullable();
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
        Schema::dropIfExists('stylist_users');
    }
}
