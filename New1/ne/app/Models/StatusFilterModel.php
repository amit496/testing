<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusFilterModel extends Model
{
    use HasFactory;
    protected $table = 'status_filter';
    protected $fillable = [
        'customer_id',
        'customer_name',
        'booking_id',
        'booking_status',
        'reveal_id',
        'reveal_status',
        'reveal_send_date',
        'order_id',
        'order_number',
        'order_product_id',
        'order_delivery_date',
        'merchant_id',
        'shop_name',
        'shop_id',
        'call_complete',
        'order_status_id',
        'total_amount',
        'grand_total_amount',
        'coupon_id',
        'cancel_id',
        'cancellation_status',
        'appointment_date',
        'appointment_time',
    ];

}
