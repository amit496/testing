<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\StylistForm;

class stylistClientBookingAppointmentsSendResponse extends Model
{
    use HasFactory;
     protected $fillable = ['email_template_id','type_form_id','booking_id','merchant_id','subject','body','reveal_id'];
     
     public function StylistForm()
    {
        return $this->belongsTo(StylistForm::class,'type_form_id'); 
    }
}
