<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StylistClientInfoDetails extends Model
{
    use HasFactory;
    protected $fillable = ['stylist_info_id','product_id','selection_type','decline_options','alternative_options','other_msg'];
}
