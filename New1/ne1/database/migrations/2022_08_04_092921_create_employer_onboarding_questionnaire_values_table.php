<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployerOnboardingQuestionnaireValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employer_onboarding_questionnaire_values', function (Blueprint $table) {
            $table->id();
            $table->integer('employer_onboarding_questionnaires_id')->nullable();
            $table->string('name',190)->nullable();
            $table->string('value',255)->nullable();
          
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
        Schema::dropIfExists('employer_onboarding_questionnaire_values');
    }
}
