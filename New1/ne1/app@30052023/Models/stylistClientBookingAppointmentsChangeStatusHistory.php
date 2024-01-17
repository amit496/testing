<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class stylistClientBookingAppointmentsChangeStatusHistory extends Model
{
    use HasFactory;
    public $table = 'stylist_client_booking_appointments_change_status_histories';
    public function customerdetails(){
        return $this->belongsTo(Customer::class,'customer_id');
    }
    
}
