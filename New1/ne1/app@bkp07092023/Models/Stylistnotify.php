<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stylistnotify extends Model
{
    protected $table = 'stylist_notify';
    protected $fillable = [
        'sent_at'
    ];
    use HasFactory;

}
