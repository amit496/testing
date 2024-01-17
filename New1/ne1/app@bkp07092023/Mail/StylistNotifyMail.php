<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class StylistNotifyMail extends Mailable
{
    use Queueable, SerializesModels;

    public $customer_details;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($customer_details)
    {
        $this->customer_details = $customer_details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {       
		$customer_details = $this->customer_details;
		$from = '';
		$subject = '';
		$body = '';
		
		if(isset($customer_details['from'])){
			$from = $customer_details['from'];
		}
		
		if(isset($customer_details['subject'])){
			$subject = $customer_details['subject'];
		}
		
		if(isset($customer_details['body'])){
			$body = $customer_details['body'];
		}
		
		return $this->from($from)->subject($subject)->view('email.stylist_notify',compact('body'));
		
    }
}
