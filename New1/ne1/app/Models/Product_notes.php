<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product_notes extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'product_notes';

    protected $fillable = [
        'customer_id',
        'merchant_id',
        'booking_id',
        'notes'
    ];
}
