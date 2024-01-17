<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\employerOnboardingQuestionnaire;
class stylistUsers extends Model
{
    use HasFactory;

    protected $table = 'stylist_users';
    protected $fillable = array('	user_id', 'company_id', 'budget_price', 'budget_price_calculate_type');
     public function company(){
       return $this->hasOne(employerOnboardingQuestionnaire::class,'id','company_id');

   }
}
