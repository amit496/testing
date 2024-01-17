<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStylistQuestionsAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stylist_questions_answers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('image_name')->nullable();
            $table->string('belong_to')->nullable();
            $table->string('question_id')->nullable();
            $table->string('order')->default('');
            $table->char('depend_cat_id',1)->default('N');
            $table->string('tag_id',11)->nullable(true)->default(null);
            $table->string('value')->nullable();
            $table->string('skip_question_id')->nullable();
            $table->char('has_logn_text_ans',1)->default('N');
            $table->string('skip_automatic_class');
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
        Schema::dropIfExists('stylist_questions_answers');
    }
}
