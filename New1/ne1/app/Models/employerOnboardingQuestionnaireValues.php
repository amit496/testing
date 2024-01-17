<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\employerOnboardingQuestionnaire;
class employerOnboardingQuestionnaireValues extends Model
{
    protected $fillable = ['employer_onboarding_questionnaires_id','name','value'];

    use HasFactory;

    public function emOnboardQuestion(){
        return $this->belongsTo(employerOnboardingQuestionnaire::class,'id','employer_onboarding_questionnaires_id');
    }     
    
}
