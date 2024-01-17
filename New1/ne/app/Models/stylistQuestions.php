<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\stylistQuestionCatogaries;
use App\Models\stylistQuestionsAnswers;
use App\Models\StylistCustomerQuestionsAnswer;
use App\Models\stylistQuestionSectionName;
use App\Models\stylistTagCatogaries;
use Illuminate\Support\Facades\Auth;

class stylistQuestions extends Model
{
    use HasFactory;

    public function category(){
        return $this->belongsTo(stylistQuestionCatogaries::class,'question_catogary');
    }

    public function tagCategory(){
        return $this->belongsTo(stylistTagCatogaries::class,'tag_category_id');
    }

    public function answers(){
        return $this->hasMany(stylistQuestionsAnswers::class,'question_id')->orderBy('id');
    }

    public function customerQuestions(){

        $cutomer_obj =  Auth::guard('customer')->user();
        $customer_id = $cutomer_obj->id;
        return $this->hasMany(StylistCustomerQuestionsAnswer::class,'question_id')->where('customer_id',$customer_id);
    }


     public function sectionHeading(){
       return $this->belongsTo(stylistQuestionSectionName::class,'section_heading');
    }
}
