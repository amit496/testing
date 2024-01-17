<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployerOnboardingQuestionnairesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employer_onboarding_questionnaires', function (Blueprint $table) {
            $table->id();           
            $table->string('company_name',190)->nullable();
            $table->string('physical_address',190)->nullable();
            $table->string('primary_contact',190)->nullable();
            $table->string('primary_email',190)->nullable();
            $table->string('primary_direct_phone_number',190)->nullable();
            $table->string('secondary_contact',190)->nullable();
            $table->string('secondary_email',190)->nullable();
            $table->string('secondary_direct_phone_number',190)->nullable();
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
        Schema::dropIfExists('employer_onboarding_questionnaires');
    }
}
