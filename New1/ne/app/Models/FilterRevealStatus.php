<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FilterRevealStatus extends Model
{
    protected $fillable = ['customer_id','customer_name','merchant_id','reveal_id','reveal_create_date','reveal_three_month','booking_id', 'order_id', 'status'];
    use HasFactory;
}
