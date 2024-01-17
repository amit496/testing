<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\StylistClientBookingAppointments;

class StylistCustomerQuestionsAnswer extends Model
{
    protected $fillable = ['customer_id','question_id','answer_ids','type','text_ans'];
    use HasFactory;

    public function hasbooking(){
    
       return $this->hasOne(StylistClientBookingAppointments::class,'customer_id','customer_id');
   }

}
