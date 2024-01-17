<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\StylistTags;
class stylistQuestionsAnswers extends Model
{
    use HasFactory;

    protected $table='stylist_questions_answers';

     public function tag(){
        return $this->hasOne(StylistTags::class,'id','tag_id');
    }
}
