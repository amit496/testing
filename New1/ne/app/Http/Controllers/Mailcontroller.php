<?php

namespace App\Http\Controllers;

use App\Mail\DemoMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class Mailcontroller extends Controller
{
    //

    public function sendmail(){
        $details = [
            'name' => 'Amit',
            'class' => 'Diploma 1st Year'
        ];

        Mail::to('amitquckit@gmail.com')->send(new DemoMail($details));
    }
}
