<?php
namespace App\Http\Controllers\StylistForm;
use App\Http\Controllers\Controller;
use App\Models\StylistClientBookingAppointments;
use App\Models\stylistRevealsItems;
use App\Models\Stylistnotify;
use App\Mail\StylistNotifyMail;
use App\Models\StylistCustomerQuestionsAnswer;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Models\Customer;
use App\Models\stylistClientBookingAppointmentsChangeStatusHistory;
use Carbon\Carbon;


class StylistCronController extends Controller
{

	function BookingStatusReset(){

		// update reveal status if order is STATUS_FULFILLED start
			$reveal_status_code = getOrderStatusNumberByKeyListHelper('STATUS_FULFILLED');
			//$reveal_status_text = getRevealStatusKeyNameHelper('completed');

			$order_reveal_ids = array();
			 $nowDate = Carbon::now();
			$order_list = Order::where('order_status_id',$reveal_status_code)->where('reveal_status','=', null)->where('reveal_id','!=', 0)->where('created_at', '<=', $nowDate)->get();


			if($order_list->isNotEmpty()){



				$reset_status_after_day =  stylistResetRevealAfterDispatchDayHelper();
				$reset_status_after_day = Carbon::now()->addDays($reset_status_after_day)->format('Y-m-d');

				$order_reveal_ids = array();

				foreach($order_list as $order_info){

					//echo $order_info->id; echo "+++++";
					$order_reveal_ids['reveal_id'] =  $order_info->reveal_id;
					$order_date = $order_info->updated_at;
					$order_date = Carbon::createFromFormat('Y-m-d H:i:s', $order_date)->format('Y-m-d');
					$order_date = Carbon::createFromFormat('Y-m-d', $order_date);

			   		$reset_date = Carbon::createFromFormat('Y-m-d', $reset_status_after_day);


			   		$needToUpdateStatus = $order_date->gte($reset_date);
					if($needToUpdateStatus){

						$booking_details = StylistClientBookingAppointments::where('id', '=', $order_info->reveal_id)->first();

						if(isset($booking_details)){

							$reveal_status = getRevealStatusKeyNameHelper('not_started');
							StylistClientBookingAppointments::where('id',$booking_info->id)->update(['status' => $reveal_status]);

						}

					}



				}// loop close
				$reveal_status = getRevealStatusKeyNameHelper('not_started');
				$reset_status_after_day =  stylistResetRevealAfterDispatchDayHelper();
				$this->addMultipleRevealChangeHistory($order_reveal_ids,$reveal_status,'status update by cron reset after day  '.$reset_status_after_day);
			}

		// update reveal status if order is STATUS_FULFILLED end



		return false;
		/*$reveal_status = getRevealStatusKeyNameHelper('dispatched');
		$booking_details = StylistClientBookingAppointments::where('status', '!=', $reveal_status)->get();

		$reset_status_after_day =  stylistRevealResetStatusAfterDayHelper();
		if($booking_details->isNotEmpty()){

				$reset_status_after_day = Carbon::now()->addDays($reset_status_after_day)->format('Y-m-d');
			foreach ($booking_details as $booking_info){
				$myDate = $booking_info->updated_at;
				$date1 = Carbon::createFromFormat('Y-m-d H:i:s', $myDate)->format('Y-m-d');
				$date1 = Carbon::createFromFormat('Y-m-d', $date1);
			   $date2 = Carbon::createFromFormat('Y-m-d', $reset_status_after_day);
				$needToUpdateStatus = $date1->gte($date2);
				if($needToUpdateStatus){

					$reveal_status = getRevealStatusKeyNameHelper('not_started');
					StylistClientBookingAppointments::where('id',$booking_info->id)->update(['status' => $reveal_status]);

				}

			}


		}*/
	}


	function revealUpdateStatusFromDispatch(){

		// update reveal status if order is STATUS_CONFIRMED start
			$reveal_status_code = getOrderStatusNumberByKeyListHelper('STATUS_CONFIRMED');

			$order_reveal_ids = array();
			$order_list = order::where('order_status_id',$reveal_status_code)->where('reveal_status','=', null)->where('reveal_id','!=', 0)->pluck('reveal_id','id')->toArray();

			$order_ids = array();
	        if(is_array($order_list) && count($order_list)){
	           $order_reveal_ids = $order_list;
	           $order_ids = array_keys($order_list);
	        }
			$reveal_booking_ids = stylistRevealsItems::whereIn('id',$order_reveal_ids)->pluck('booking_id','id')->toArray();

			if(is_array($reveal_booking_ids)){
				$reveal_status = getRevealStatusKeyNameHelper('completed');
				StylistClientBookingAppointments::whereIn('id',$reveal_booking_ids)->update(['status' => $reveal_status]);
				stylistRevealsItems::whereIn('id',$order_reveal_ids)->update(['status' => $reveal_status]);
				order::whereIn('id',$order_ids)->update(['reveal_status' => $reveal_status]);
								// create reveal history
				$this->addMultipleRevealChangeHistory($order_reveal_ids,$reveal_status, 'status update by cron '.$reveal_status);
			}
		// update reveal status if order is STATUS_CONFIRMED end



		// update reveal status if order is STATUS_CANCELED start
			$reveal_status_code = getOrderStatusNumberByKeyListHelper('STATUS_CANCELED');
			$order_reveal_ids = array();
			$order_list = order::where('order_status_id',$reveal_status_code)->where('reveal_status','=', null)->where('reveal_id','!=', 0)->pluck('reveal_id','id')->toArray();

			$order_ids = array();
	        if(is_array($order_list) && count($order_list)){
	           $order_reveal_ids = $order_list;
	           $order_ids = array_keys($order_list);
	        }
			$reveal_booking_ids = stylistRevealsItems::whereIn('id',$order_reveal_ids)->pluck('booking_id','id')->toArray();

			if(is_array($reveal_booking_ids)){
				$reveal_status = getRevealStatusKeyNameHelper('decline');
				StylistClientBookingAppointments::whereIn('id',$reveal_booking_ids)->update(['status' => $reveal_status]);
				stylistRevealsItems::whereIn('id',$order_reveal_ids)->update(['status' => $reveal_status]);
				order::whereIn('id',$order_ids)->update(['reveal_status' => $reveal_status]);
				// create reveal history
				$this->addMultipleRevealChangeHistory($order_reveal_ids,$reveal_status, 'status update by cron '.$reveal_status);
			}
		// update reveal status if order is STATUS_CANCELED end


		// update reveal status if order is STATUS_RETURNED start
			$reveal_status_code = getOrderStatusNumberByKeyListHelper('STATUS_RETURNED');
			$order_reveal_ids = array();
			$order_list = order::where('order_status_id',$reveal_status_code)->where('reveal_status','=', null)->where('reveal_id','!=', 0)->pluck('reveal_id','id')->toArray();

			$order_ids = array();
	        if(is_array($order_list) && count($order_list)){
	           $order_reveal_ids = $order_list;
	           $order_ids = array_keys($order_list);
	        }
			$reveal_booking_ids = stylistRevealsItems::whereIn('id',$order_reveal_ids)->pluck('booking_id','id')->toArray();

			if(is_array($reveal_booking_ids)){
				$reveal_status = getRevealStatusKeyNameHelper('decline');
				StylistClientBookingAppointments::whereIn('id',$reveal_booking_ids)->update(['status' => $reveal_status]);
				stylistRevealsItems::whereIn('id',$order_reveal_ids)->update(['status' => $reveal_status]);
				order::whereIn('id',$order_ids)->update(['reveal_status' => $reveal_status]);

				// create reveal history
				$this->addMultipleRevealChangeHistory($order_reveal_ids,$reveal_status, 'status update by cron '.$reveal_status);


			}
		// update reveal status if order is return_initiated end





		return false;

		/*$booking_details = StylistClientBookingAppointments::where('status', $reveal_status)->get();
		$change_status_after_day =  stylistRevealChangeStatusFromDispatchToCompleteAfterDayHelper();
		 if($booking_details->isNotEmpty()){
		 	$change_status_after_day_date = Carbon::now()->addDays($change_status_after_day)->format('Y-m-d');
				foreach ($booking_details as $booking_info) {


						$dataHasReveal = stylistRevealsItems::where('booking_id',$booking_info->id)->where('status',$reveal_status)->get();

					 if($dataHasReveal->isNotEmpty()){
						foreach ($dataHasReveal as $data_reveal_info) {

							$myDate = $data_reveal_info->updated_at;

       					$date1 = Carbon::createFromFormat('Y-m-d H:i:s', $myDate)->format('Y-m-d');
       					$date1 = Carbon::createFromFormat('Y-m-d', $date1);
        				   $date2 = Carbon::createFromFormat('Y-m-d', $change_status_after_day_date);

        					$needToUpdateStatus = $date1->gte($date2);
        					if($needToUpdateStatus){


        							$order = order:: where('reveal_id',$data_reveal_info->id)->first();
        							if(isset($order)){

        								$need_status_update = false;
        								if(!in_array($order->order_status_id,getRevealStatusNotChangeFromDispatchHelper())){
        									$reveal_status = getRevealStatusKeyNameHelper('completed');
							            $need_status_update = true;

        								}else if($order->order_status_id == 7){
													$reveal_status = getRevealStatusKeyNameHelper('return_initiated');
													 $need_status_update = true;
        								}else if($order->order_status_id == 8){
        										$reveal_status = getRevealStatusKeyNameHelper('decline');
        										 $need_status_update = true;
        								}

        								if($need_status_update){
        									 StylistClientBookingAppointments::where('id',$data_reveal_info->booking_id)->update(['status' => $reveal_status]);
							            $reveal_status = array('status' => $reveal_status);
							            $dataHasRevealUpdate = stylistRevealsItems::where('id',$data_reveal_info->id)->first();
							            $dataHasRevealUpdate->update($reveal_status);
        								}
        							}

        					}else{
        						//echo "not need to udpate status";
        					}


						}
					}

			}
		}*/

	}

	public function stylistNotifyCustomerIfNotBookAnyStylist(){


		return false;
		$style_customer_list = StylistCustomerQuestionsAnswer::select('*')->orderBy('id', 'DESC')->groupBy('customer_id')->get();

		$customer_ids = array();
		if($style_customer_list->isNotEmpty()){



			$customer_email_details['subject'] = 'Dappr Not Book any Stylist';
			$customer_email_details['body'] = 'Dear customer you have not booked any Stylist yet. Please  <a href="">Click Here </a> to book.';


			$send_mail_customer_ids = array();
			$send_mail_customer_email_ids = array();
			$not_book_stylist_after_day = stylistNotifyCustomerIfNotBookAnyStylistAfterDayHelper();

			foreach($style_customer_list as $style_customer_info){
				 //	 echo    $style_customer_info->customer_id.'++++++++'.$style_customer_info->created_at.'<br>';
				//  echo Carbon::parse($style_customer_info->created_at)->diffInDays(Carbon::now());
				   if(Carbon::parse($style_customer_info->created_at)->diffInDays(Carbon::now()) >= $not_book_stylist_after_day){

				   		$notified_already = Stylistnotify::where('customer_id',$style_customer_info->customer_id)->where('notify_type','not_booking_stylist')->first();
				   		if($notified_already){
				   			continue;
				   		}

				   }else{
				   	continue;
				   }



				$has_booking = $style_customer_info->hasbooking()->first();
				if(isset($has_booking)){

				}else{
					// need to send the notify mail
					$send_mail_customer_ids[] = $style_customer_info->customer_id;

				}
			}

			if(count($send_mail_customer_ids)){
				$customers_info_obj = Customer::whereIn('id',$send_mail_customer_ids)->get();
				if($customers_info_obj->isNotEmpty()){
					foreach($customers_info_obj as $customer_info){
						$customer_email_id = $customer_info->email;
						$send_mail_customer_email_ids[] =  $customer_email_id;
						Mail::to($customer_email_id)->send(new StylistNotifyMail($customer_email_details));
						if (0) {

						}else{
							$notified = new Stylistnotify;
							$notified->customer_id = $customer_info->id;
							$notified->notify_status = '1';
							$notified->notify_type = 'not_booking_stylist';
							$notified->sent_at = date('Y-m-d');
							$notified->save();
						}

					}


					// send to admin notify

					$admin_email_id = '';
					$amdin_details = User::where('role_id',2)->first();
					if(isset($amdin_details)){
						$admin_email_id = $amdin_details->email;
						$customer_email_ids_str = implode(',', $send_mail_customer_email_ids);
						$admin_email_details['subject'] = 'Dappr Not Book any Stylist Customer List';
						$admin_email_details['body'] = 'These customers ('.$customer_email_ids_str.') is not book any Stylist after days '.$not_book_stylist_after_day.'.';

						Mail::to($admin_email_id)->send(new StylistNotifyMail($admin_email_details));
					}
				}
			}


		}



		/*$customers = Customer::get(); whereIn('id',[1,2,..])->get();

		foreach($customers as $customer){

			$customer_id = $customer->id;

			$style = StylistCustomerQuestionsAnswer::where('customer_id',$customer_id)->first();

       			 if($style){

	           	 if(stylistClientBookingAppointments::where('customer_id',$customer_id)->first()){
	                // do nothing
	           	 }else{
	                // ->diffInDays(Carbon::now()) == 14
	                if(Carbon::parse($style->created_at)->diffInDays(Carbon::now()) == stylistNotifyCustomerIfNotBookAnyStylistAfterDayHelper()){

				$customer_details = [
					'title' => 'Dappr',
					'subject' => 'Merchant Not Booked',
					'body' => 'Dear customer you have not booked any order yet ! Book your order now.'
				];

				$admin_details = '';

				//Mail::to($customer->email)->send(new BookingStatus($customer_details));

				// Mail::to('tech@dappr.com')->send();

				if($user_notified = BookingAlert::where('customer_id',$customer_id)->first()){
						BookingAlert::where('customer_id',$customer_id)->first()
						->update([
							'sent_at' => now()
						]);
						return "sent Again";
				}else{

					$notified = new BookingAlert;

					$notified->customer_id = $customer_id;
					$notified->email = $customer->email;
					$notified->name = $customer->name;
					$notified->notify_status = '1';
					$notified->type = 'No booking notification';
					$notified->sent_at = now()->timestamp;
					$notified->save();
					return "Email sent";
				}
			}else{
				return "Not to be sent before two weeks";
			}
            }


			}


		}*/
	}

	function addMultipleRevealChangeHistory($order_reveal_ids = null, $reveal_status = '', $comment = ''){

		if(is_array($order_reveal_ids) && count($order_reveal_ids)){
			$reveals_obj = stylistRevealsItems::whereIn('id',$order_reveal_ids)->get();
			if($reveals_obj->isNotEmpty()){
				$data = array();
				foreach($reveals_obj as $reveal_info){
					$data[] = array('booking_id'=>$reveal_info->booking_id,'reveal_id'=>$reveal_info->id,'status'=>$reveal_status,'comment'=>$comment);
				}
				stylistClientBookingAppointmentsChangeStatusHistory::insert($data); // Eloquent approach
			}

		}
    }

	 function addRevealChangeHistory($booking_id = 0 , $reveal_id = 0, $status = '', $comment = ''){
            $obj = new stylistClientBookingAppointmentsChangeStatusHistory();

            $obj->booking_id = $booking_id;
            $obj->reveal_id = $reveal_id;
            $obj->comment = $comment;
            $obj->status = $status;
            $obj->save();
    }

}



