<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStylistUserTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stylist_user_tags', function (Blueprint $table) {
           
            $table->increments('id'); 
            $table->string('user_id',11)->nullable(true)->default(null);
            $table->string('tag_id',11)->nullable(true)->default(null);
            $table->string('question_id',11)->nullable(true)->default(null);
            $table->string('answer_id',11)->nullable(true)->default(null);
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
        Schema::dropIfExists('stylist_user_tags');
    }
}
