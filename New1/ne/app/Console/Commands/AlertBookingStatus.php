<?php

namespace App\Console\Commands;

use App\Mail\BookingStatus;
use App\Models\stylistClientBookingAppointmentsSendResponse;
use App\Models\stylistClientBookingAppointments;
use App\Models\stylistQuestionsAnswers;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AlertBookingStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'incevio:notBookedStatus';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will alert users who have answered one or any questions but their booking status is not active';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
		$login_cutomer_obj =  Auth::guard('customer')->user();
        $customer_id = $login_cutomer_obj->id;
        $style = stylistQuestionsAnswers::where('customer_id',$customer_id)->first();


        $details = [
            'title' => 'Dappr',
            'body' => 'Dear customer you have not booked any order yet ! Book your order now. '
        ];

        if($style){
            if(stylistClientBookingAppointments::where('customer_id',$customer_id)->first()){
                // return 0;
            
            }else{
                // ->diffInDays(Carbon::now()) == 14
                if(Carbon::parse($style->created_at) < Carbon::now()){
					Mail::to('abhishekquckit@gmail.com')->send(new BookingStatus($details));
                    // dd("Mail sEnt");
				}
            }
        }
    }
}
