<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Auth;
class stylistRevealsItems extends Model
{
    use HasFactory;
    
    protected $fillable = ['merchant_id','booking_id','product_ids','status','alernative_product_ids','doc_name','name', 'reveal_send_date'];
    
    public function list(){
        
       return  stylistRevealsItems::where("merchant_id", Auth::id())->orderBy('updated_at','desc')->paginate(10);
   }
   
   public function listByBookingId($booking_id = 0){
        
       return  stylistRevealsItems::where("booking_id", $booking_id)->where("merchant_id", Auth::id())->orderBy('updated_at','desc')->paginate(10);
   }

    public function listById($id = 0){
        
       return  stylistRevealsItems::where("id", $id)->frist();
   }


   

    
    
}
