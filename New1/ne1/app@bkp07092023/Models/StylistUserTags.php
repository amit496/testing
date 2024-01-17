<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\StylistTags;

class StylistUserTags extends Model
{
    use HasFactory;

     public function tag(){
        return $this->hasOne(StylistTags::class,'id','tag_id');
    }
}
