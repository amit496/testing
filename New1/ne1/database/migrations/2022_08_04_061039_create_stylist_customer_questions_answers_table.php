<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStylistCustomerQuestionsAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stylist_customer_questions_answers', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id')->nullable();
            $table->integer('question_id')->nullable();
            $table->string('answer_ids',190)->nullable();
            $table->string('type',190)->nullable();
            $table->string('text_ans',190)->nullable();
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
        Schema::dropIfExists('stylist_customer_questions_answers');
    }
}
