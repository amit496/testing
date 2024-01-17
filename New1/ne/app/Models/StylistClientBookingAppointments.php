<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\stylistClientBookingAppointments;
use App\Models\stylistRevealsItems;
use App\Models\stylistUsers;
use App\Models\Customer;
use App\Models\Image;
use App\Models\StatusFilterModel;

use App\Models\stylistClientBookingAppointmentsChangeStatusHistory;


use Auth;
class StylistClientBookingAppointments extends Model
{
    use HasFactory;
    protected $fillable = ['name','email','merchant_id','appointment_date','customer_id','appointment_time','status'];


    public function list(){

       return  StylistClientBookingAppointments::where("merchant_id", Auth::id())->where("customer_id", '!=', null)->with(['cancellation', 'customer' => function ($q) {
        return  $q->with('orders');
 } ,'customerImage','stylistUser' => function ($q) {
                    return  $q->with('company');
             }])->orderBy('updated_at','desc')->paginate(10);
    }

    public function cancellation()
    {
        return $this->hasOne(Cancellation::class, 'customer_id', 'customer_id' );
    }

    public function filterstatus()
    {
        return $this->hasOne(StatusFilterModel::class, 'booking_id', 'id' );
    }


    public function stylistUser(){
       return $this->hasOne(stylistUsers::class,'user_id','customer_id');
   }

    public function customer(){
       return $this->hasOne(Customer::class,'id','customer_id');
   }
   public function customerdetails(){
    return $this->belongsTo(Customer::class,'customer_id');
}

   public function customerImage(){
       return $this->hasOne(Image::class,'imageable_id','customer_id')->where('imageable_type', '=', 'App\Models\Customer');
   }



   public function listJoinWithRevealsItems(){
       return $this->hasOne(stylistRevealsItems::class,'booking_id');
   }


   public function sendResponse(){
		return $this->hasMany(stylistClientBookingAppointmentsSendResponse::class,'booking_id');
	}


   public function statusHistory(){
       return $this->hasOne(stylistClientBookingAppointmentsChangeStatusHistory::class,'booking_id','id');
   }


    public function reveal(){
       return $this->hasOne(stylistRevealsItems::class,'booking_id','id');
   }

   public function revealStatus(){
    return $this->hasMany(stylistClientBookingAppointmentsSendResponse::class,'status');
   }

}
