<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStylistQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

         Schema::create('stylist_questions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('type')->nullable();
            $table->string('question_catogary')->nullable();
            $table->string('anwer_type')->nullable();
            $table->string('section_heading')->nullable();
            $table->string('required')->default('N');
            $table->string('depending_question')->default('N');
            $table->char('multiple_select',1)->default('N');
            $table->char('depend_on_ans',1)->default('N');
            $table->string('order')->default(0);
            $table->text('description')->nullable();
            $table->string('q_belong_id')->nullable();
            $table->string('skip_id')->nullable();
            $table->string('multiple_answer_limit')->nullable();
            $table->char('hide_answer_label',1)->nullable();
            $table->string('q_type')->nullable();
            $table->string('fix_rand_id')->nullable();
            $table->string('tag_status')->nullable();
            $table->string('tag_category_id')->nullable();
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
        Schema::dropIfExists('stylist_questions');
    }
}
