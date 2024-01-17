<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\employerOnboardingQuestionnaireValues;
class employerOnboardingQuestionnaire extends Model
{
    protected $fillable = ['company_name','physical_address','primary_contact','primary_email','primary_direct_phone_number','secondary_contact','secondary_email','secondary_direct_phone_number'];
    use HasFactory;

    public function empOnboardQuestions(){
        return $this->hasMany(employerOnboardingQuestionnaireValues::class,'employer_onboarding_questionnaires_id','id');
    }
}
