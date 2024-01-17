<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotifyMailStylistClientbookingResponse extends Mailable
{
    use Queueable, SerializesModels;
    public $details;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        //
        $this->details = $details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {   
		$details = $this->details;
		$from = '';
		$subject = '';
		$body = '';
		
		if(isset($details['from'])){
			$from = $details['from'];
		}
		
		if(isset($details['subject'])){
			$subject = $details['subject'];
		}
		
		if(isset($details['body'])){
			$body = $details['body'];
		}
		
		return $this->from($from)->subject($subject)->view('email.stylist',compact('body'));
		
        
    }
}
