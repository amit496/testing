<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\StylistClientInfoDetails;
use Auth;
use App\Models\Product;
use App\Models\StylistForm;
class StylistClientInfo extends Model
{
    use HasFactory;
     protected $fillable = ['name','email','merchant_id','stylist_form_id','appointment_response_id','booking_id','customer_id','selected_product_ids'];
     
    public function clientDetails(){  
		
		return $this->hasMany(StylistClientInfoDetails::class,'stylist_info_id');
	}
	
	public function stylistFormDetails(){  
		
		return $this->hasOne(StylistForm::class,'id','stylist_form_id');
	}
	
	public function list(){
       $merchant_id = Auth::id();
       return  StylistClientInfo::where('merchant_id', $merchant_id)->orderBy('updated_at','desc')->get()->paginate(10);
   }
}
