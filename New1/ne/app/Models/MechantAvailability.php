<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MechantAvailability extends Model
{
    use HasFactory;
    protected $table = 'mechant_availability';
    protected $fillable = array('merchant_id', 	'days' , 'start_time', 'end_time', 'status','full_time_availability');
}
