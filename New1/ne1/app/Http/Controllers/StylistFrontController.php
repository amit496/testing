<?php
namespace App\Http\Controllers\StylistForm;
use App\Http\Controllers\Controller;
use App\Models\StylistForm;
use App\Models\Product;
use App\Models\StylistClientInfo;
use App\Models\StylistClientInfoDetails;
use App\Models\StylistClientBookingAppointments;
use App\Models\stylistClientBookingAppointmentsSendResponse;
use App\Models\Merchant;
use App\Models\Inventory;
use App\Models\Image;
use App\Helpers\ListHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\CartController;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\BookingStatus;
use App\Models\Customer;

use Illuminate\Support\Facades\Crypt;
use DB;
use App\Models\Attribute;
use App\Models\stylistRevealsItems;
use Illuminate\Support\Facades\Auth;


use App\Models\stylistQuestionCatogaries;
use App\Models\stylistQuestions;
use App\Models\stylistQuestionsAnswers;
use App\Models\stylistQuestionSectionName;
use App\Models\StylistCustomerQuestionsAnswer;
use App\Notifications\Dispute\Created;

class StylistFrontController extends Controller
{
	public $stylist_form_obj = null;


    public function __construct(){

        $this->stylist_form_obj = new StylistForm();
    }

    public function index($booking_id = '',$reveal_id = 0){
		$customer = Auth::guard('customer')->check() ? Auth::guard('customer')->user() : null;
	    $name = '';
	    $email = '';
	    $appointment_response_id = 0;
		if($booking_id != '' ){
			$booking_id = Crypt::decryptString($booking_id);
			$reveal_id =  Crypt::decryptString($reveal_id);

			$booking_info = StylistClientBookingAppointments::where('id',$booking_id)->first();

			if($booking_info){
				$name = $booking_info->name;
				$email = $booking_info->email;

			}
			$reveal_info = stylistRevealsItems::find($reveal_id);
			if(isset($reveal_info)){

				$doc_name = $reveal_info->doc_name;
				$video_html = '';
				if($doc_name != ''){
					$video_url =  url('uploads/'.$doc_name);
					$video_html  = '<video width="100%" controls="">';
	   				$video_html .= '<source src="'.$video_url.'" type="video/mp4">';
	   				$video_html .= '<source src="'.$video_url.'" type="video/ogg">';
	   				$video_html .= 'Your browser does not support HTML video.';
	   				$video_html .= '</video>';
   				}

   				$product_ids = $reveal_info->product_ids;
   				$alernative_product_ids = $reveal_info->alernative_product_ids;
   				$product_ids_arr = explode(',',$product_ids);
   				$alernative_product_ids_arr = explode(',',$alernative_product_ids);
   				$products_details = $this->getProductDetails($product_ids_arr);
   				$alernative_products_details = $this->getProductDetails($alernative_product_ids_arr);

				return view('stylist_form.reveal_details',compact('video_html','products_details','alernative_products_details', 'reveal_info'));

			}

		}
		return abort(404);


        $stylist_info = $this->stylist_form_obj->getValueByColumn('slug',$slug_name);
		if($stylist_info){
			$product_ids = $stylist_info->product_ids;
			$product_ids_array = explode(',', $product_ids);
			if(is_array($product_ids_array) && count($product_ids_array)){

				$products_obj = Product::find($product_ids_array)->where('active',1);

				if($products_obj->isNotEmpty()){
					$products_obj_array = array();
					foreach($products_obj as $product_obj){

						$inventory = Inventory::where('product_id', $product_obj->id)->first();


						 $variants = ListHelper::variants_of_product($inventory, $inventory->shop_id);
						//return $variants;
						$attr_pivots = DB::table('attribute_inventory')
							->select('attribute_id', 'inventory_id', 'attribute_value_id')
							->whereIn('inventory_id', $variants->pluck('id'))->get();

						$item_attrs = $attr_pivots->where('inventory_id', $inventory->id)
							->pluck('attribute_value_id')->toArray();

						$attributes = Attribute::select('id', 'name', 'attribute_type_id', 'order')
							->whereIn('id', $attr_pivots->pluck('attribute_id'))
							->with(['attributeValues' => function ($query) use ($attr_pivots) {
								$query->whereIn('id', $attr_pivots->pluck('attribute_value_id'))->orderBy('order');
							}])
							->orderBy('order')->get();




						$products_obj_array[] = array('product_obj'=>$product_obj,'inventory_obj' =>$inventory,'attributes'=>$attributes);
					}

					return view('stylist_form.form',compact('stylist_info','products_obj','products_obj_array', 'name','email','booking_id','appointment_response_id'));
				}



			}
		}
			return abort(404);

    }

    public function getProductDetails($product_ids_array){

    	$products_obj = Product::find($product_ids_array)->where('active',1);
		$products_obj_array = array();
		if($products_obj->isNotEmpty()){

			foreach($products_obj as $product_obj){
				$inventory = Inventory::where('product_id', $product_obj->id)->first();

				$variants = ListHelper::variants_of_product($inventory, $inventory->shop_id);

				$attr_pivots = DB::table('attribute_inventory')
							->select('attribute_id', 'inventory_id', 'attribute_value_id')
							->whereIn('inventory_id', $variants->pluck('id'))->get();

				$item_attrs = $attr_pivots->where('inventory_id', $inventory->id)
							->pluck('attribute_value_id')->toArray();

				$attributes = Attribute::select('id', 'name', 'attribute_type_id', 'order')
						->whereIn('id', $attr_pivots->pluck('attribute_id'))
						->with(['attributeValues' => function ($query) use ($attr_pivots) {
								$query->whereIn('id', $attr_pivots->pluck('attribute_value_id'))->orderBy('order');
							}])
							->orderBy('order')->get();




				$products_obj_array[$product_obj->id] = array('product_obj'=>$product_obj,'inventory_obj' =>$inventory,'attributes'=>$attributes);
			}
		}

		return $products_obj_array;
    }

    public function merchantList(){

       $merchants_obj = Merchant::where('active',1)->get();
       $images_array =  array();
       if($merchants_obj->isNotEmpty()){
			foreach($merchants_obj as $merchant_obj){
				$user_id = $merchant_obj->id;
				$user_img = Image::where('imageable_id', '=', $user_id)->where('imageable_type', '=', 'App\Models\User')->first();
				if($user_img){
					$images_array[$user_id]	 = $user_img->path;
				}

			}

	   }

        return view('stylist_form.merchant-list', compact('merchants_obj','images_array'));
    }


	function clientSubmitProductsSelection(Request $request){

		$cutomer_obj =  Auth::guard('customer')->user();
		$customer_id = $cutomer_obj->id;
		
		//echo $cutomer_obj->id;die;
		$this->validate($request, [
					'merchant_id' => 'required',
					'stylist_form_id' => 'required',
					//'client_name' => 'required',
					//'product_select' => 'required|array|min:1',
					//'client_email' => 'required|email',
		]);
		$selected_product_ids = '';
		$cart_page_redirect = false;
		if(isset($request->product_select)){
            $selected_product_ids_arr = array();
				foreach($request->product_select as $product_id=>$selected){
					$inventory = Inventory::where('product_id', $product_id)->first();
					if($inventory){
						$selected_product_ids_arr[] = $product_id;
						$cart_obj = (new CartController())->addToCart($request,$inventory->slug);
						$cart_page_redirect = true;

					}

				}
				$selected_product_ids = implode('||',$selected_product_ids_arr);
			}

		$info_records_data = array(
						'name' => '',
						'email' => '',
						'merchant_id' => $request->merchant_id,
						'stylist_form_id' => $request->stylist_form_id,
						'booking_id' => $request->booking_id,
						'appointment_response_id' => $request->appointment_response_id,
						'customer_id' => $customer_id,
						'selected_product_ids' => $selected_product_ids,
						);

		
		$info_records_obj =  StylistClientInfo::create($info_records_data);
		if($info_records_obj){

			$reveal_status = array('status' => 'complete');
			$info_records_id = $info_records_obj->id;
			// add product in cart
			
			// store decline product feedback
			
			if(isset($request->stylist_feedback)){
				$reveal_status = array('status' => 'in_progress');
				foreach($request->stylist_feedback as $product_id=>$stylist_feedback_info){
					$decline_options = implode('||',$stylist_feedback_info);
					$other_reason  = '';

					if(isset($request->stylist_feedback_other) && isset($request->stylist_feedback_other[$product_id]['other'])){
						$other_reason  = stylistFieldValidate($request->stylist_feedback_other[$product_id]['other']);


					}
					$info_details_records_data = array(
						'stylist_info_id' => $info_records_id,
						'product_id' => $product_id,
						'selection_type' => '',
						'decline_options' => $decline_options,
						'alternative_options' => '',
						'other_msg' => $other_reason,
					);

					$info_details_records_data_obj =  StylistClientInfoDetails::create($info_details_records_data);
				}
			}

			$dataHasReveal = stylistRevealsItems::where('id',$request->stylist_form_id)->first();

			if(isset($dataHasReveal)){
				$dataHasReveal->update($reveal_status);
			}
			if($cart_page_redirect){
				   return redirect('cart')->withSuccess('your request is submitted successfully');

			}
			return redirect()->back()->withSuccess('your feedback request is submitted successfully');
		
		}

		return redirect()->back()->withError('Problem in request. Please try after some time');
	}

	function clientSubmitBooking(Request $request){

		$this->validate($request, [
					'name' => 'required',
					'email' => 'required',
					'merchant_id' => 'required',
					'booking_appoinment_date' => 'required',

		]);
		$cutomer_obj =  Auth::guard('customer')->user();
		$customer_id = $cutomer_obj->id;
		
		$records_data = array(
						'name' => $request->name,
						'email' => $request->email,
						'merchant_id' => $request->merchant_id,
						'appointment_date' => $request->booking_appoinment_date,
						'customer_id' => $customer_id,
						);

		$records_obj =  StylistClientBookingAppointments::create($records_data);
		if($records_obj){
			return redirect()->back()->withSuccess('Your Appoinment Booked Successfully');
		}
		return redirect()->back()->withError('Problem in request. Please try after some time');
	}

	function reveal(Request $request){

			 return view('stylist_form.reveal');
	}

	/*
    function customerInformation(){
       $cutomer_obj =  Auth::guard('customer')->user();

       $questions_category_obj = stylistQuestionCatogaries::all();
       $questions_section_obj = stylistQuestionSectionName::all();
       $questions_obj = stylistQuestions::where('id', '!=', 0)->orderBy('question_catogary', 'desc')->get();
       //print_r($questions_obj);
       $questions_answer_obj = stylistQuestionsAnswers::all();

      $categry_question_array =  array();
      if($questions_obj->isNotEmpty()){
       	foreach($questions_obj as $question_obj){
       		  $categry_question_array['cat_'.$question_obj->question_catogary][]  = $question_obj->toArray();
       	}
      }

      $answers_array =  array();
      if(isset($questions_answer_obj)){
       	foreach($questions_answer_obj as $question_answer_obj){
       		  $answers_array[$question_answer_obj->question_id][]  = $question_answer_obj;
       	}
      }

      return view('stylist_form.customer_information',compact('cutomer_obj','categry_question_array','answers_array'));

    	//return view('stylist_form.reveal_details',compact('video_html','products_details',   'alernative_products_details', 'reveal_info'));
    
    }*/

    /**
     * Get the user associated with the StylistFrontController
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */

	function customerInformation(){

		$login_cutomer_obj =  Auth::guard('customer')->user();


		$show_question_answer_screen = 'block';
		$show_booknig_screen = 'none';
		$show_booknig_review_screen = 'none';
		$cutomer_obj =  Auth::guard('customer')->user();
		$customer_id = $cutomer_obj->id;
 		$show_screen = 'questions_answer';
		//$questions = stylistQuestions::orderBy("question_catogary")->limit(10)->get();
		$questions = stylistQuestions::orderBy("question_catogary")->get();

      
		$merchants_obj = Merchant::where('active',1)->get();
      $images_array =  array();
      if($merchants_obj->isNotEmpty()){
			foreach($merchants_obj as $merchant_obj){
				$user_id = $merchant_obj->id;
				$user_img = Image::where('imageable_id', '=', $user_id)->where('imageable_type', '=', 'App\Models\User')->first();
				if($user_img){
					$images_array[$user_id]	 = $user_img->path;
				}

			}

	   }

	   $Customer_quesiton_obj = StylistCustomerQuestionsAnswer::where('customer_id',$customer_id)->where('question_id','all')->where('answer_ids','all')->first();
		if(isset($Customer_quesiton_obj)){
			$show_question_answer_screen = 'none';
			$show_booknig_screen = 'block';
			$show_booknig_review_screen = 'none';

		}

	   $booking_review_arr  = $this->customerBookingReviewhtml();
	   $booking_review_html = '';
	   if(isset($booking_review_arr['html']) && isset($booking_review_arr['data_has']) && ($booking_review_arr['data_has'] == 'Y')){
	   	$booking_review_html = $booking_review_arr['html'];
	   	$show_question_answer_screen = 'none';
			$show_booknig_screen = 'none';
			$show_booknig_review_screen = 'block';
	   }


		return view('stylist_form.customer_question_answer',compact('questions','merchants_obj','images_array','booking_review_html','show_question_answer_screen','show_booknig_review_screen','show_booknig_screen'));
	}

	function saveDataAjax(Request $request){
		$output = array();
		$method_name = $request->method_name;
		if($method_name == 'save_question_answers'){
			$data = $request->data;
			$output =  $this->saveCustomerQuestionsAnswer($data);
		}else if($method_name == 'get_booking_time_list'){
			$booking_date = $request->booking_date;
			$stylist_id = $request->stylist_id;
			$output =  $this->getBookingTimeList($stylist_id, $booking_date);	
		}else if($method_name == 'save_booking_date_time'){
			$booking_date = $request->booking_date;
			$stylist_id = $request->stylist_id;
			$booking_time = $request->booking_time;
			$output =  $this->saveBooking($stylist_id, $booking_date, $booking_time);		
		}else{
			$output['error'] = 'Something Wrong';
		}
		return response()->json($output);

	}

	function saveCustomerQuestionsAnswer($data){
		if(is_array($data)){
			$cutomer_obj =  Auth::guard('customer')->user();
			$customer_id = $cutomer_obj->id;

			foreach ($data as $question_ans_info) {
				
				$question_id = 0;
				$answer_id = 0;
				$type = '';
				if(isset($question_ans_info['question_id'])){
					$question_id = $question_ans_info['question_id'];
				}

				if(isset($question_ans_info['answer_id'])){
					$answer_id = $question_ans_info['answer_id'];
				}
				if(isset($question_ans_info['type'])){
					$type = $question_ans_info['type'];
				}
				
				$records_data = array();
				$records_data['customer_id'] = $customer_id;
				$records_data['question_id'] = $question_id;
				$records_data['answer_ids'] = $answer_id;
				$records_data['type'] = $type;
				$hasData = StylistCustomerQuestionsAnswer::where('customer_id',$customer_id)->where('question_id',$question_id)->first();
				if(isset($hasData)){
					unset($records_data['customer_id']);
					unset($records_data['question_id']);
					$hasData->update($records_data);
				}else{
					StylistCustomerQuestionsAnswer::create($records_data);
				}
				
				
				
			}
			$output['msg'] = 'saved';
			$output['continue_later'] = 'Saved. You will continue later.';
			$output['success'] = 'saved';

		}else{
			$output['error'] = 'Something Wrong';
		}

		return $output;

	}

	function getBookingTimeList($stylist_id = 0, $booking_date = ''){

      $times_am = array(9,10,11);
      $times_pm = array(12,1,2,3);
      $html = '';
      foreach($times_am as $time_am){
      	$time_am_val = $time_am.':30';
      	
			$html .= '  <div class="style-field-checkbox-outer col-md-2_rename  style-field-checkbox-outer-box  " >
                        <div class=" product_box  product_box_outer">
                           <h6 class="text-center mt-2  product_box_single_select  product_select_box  "> '.$time_am_val.' am</h6>
                           <input type="radio" class="style-field-hide style-options-checkbox stylist_field_required" name="booking_time" value="'.$time_am_val.'">
                        </div>
                  </div>';
         }


         foreach($times_pm as $time_pm){
      	$time_am_val = $time_pm.':30';
      	
			$html .= '  <div class="style-field-checkbox-outer col-md-2_rename  style-field-checkbox-outer-box  " >
                        <div class=" product_box product_box_outer  ">
                           <h6 class="text-center mt-2  product_box_single_select  product_select_box  "> '.$time_am_val.' am</h6>
                           <input type="radio" class="style-field-hide style-options-checkbox stylist_field_required" name="booking_time" value="'.$time_am_val.'">
                        </div>
                  </div>';
         }

         $output = array();
         $output['booking_time_html'] = $html; 
         $output['success'] = 'load' ;

         return $output;


	}

	function saveBooking($stylist_id = 0, $booking_date = '',  $booking_time = ''){
		$cutomer_obj =  Auth::guard('customer')->user();
		$customer_id = $cutomer_obj->id;
		$records_data = array(
				'name' => '',
				'email' => '',
				'merchant_id' => $stylist_id,
				'appointment_date' => $booking_date,
				'customer_id' => $customer_id,
				'appointment_time' => $booking_time,
				'status' => 'in_progress',
		);

		$records_obj =  StylistClientBookingAppointments::create($records_data);
		$output = array();
      $output['success'] = 'You Call is booked' ;
      $review_html = $this->customerBookingReviewhtml();

      $output['review_html'] = $review_html['html'];
      return $output;

	}

	function customerBookingReviewhtml(){

		$cutomer_obj =  Auth::guard('customer')->user();

		$customer_id = $cutomer_obj->id;
		$name = $cutomer_obj->name;
		$data_obj = StylistClientBookingAppointments::where('customer_id',$customer_id)->where('status','in_progress')->first();
		$html = '';
		 $output = array();
		$output['data_has'] = 'N';
		if($data_obj ){
		   $output['data_has'] = 'Y';
			$merchant_id = $data_obj->merchant_id;
			$appointment_date = $data_obj->appointment_date;
			$appointment_time = $data_obj->appointment_time;

			$merchant_obj = Merchant::where('id',$data_obj->merchant_id )->first();
     
	      $img = url('').'/images/stylist/dummy-profile-pic.png';
	      $merchant_name = '';
	      if(isset($merchant_obj)){
	      	
	      	$merchant_name = $merchant_obj->name;
				$user_img = Image::where('imageable_id', '=', $merchant_obj->id)->where('imageable_type', '=', 'App\Models\User')->first();
				if($user_img){
					$img	 = $user_img->path;
				}
		   }

			$html = '<div class="container">
            <div class="card  my-5">
               <div class="row p-4">
                  <div class=" mb-5 dappr-text-h">
                     <h3>Welcome '.$name.'</h3>
                  </div>
                   <div class="mb-5 dappr-text-h">
                     <h3>In Progress</h3>
                  </div>
                  
                  <div class="row stylist_field_outer  product_box_wrappr m-auto">
                        <div class="style-field-checkbox-outer col-md-3 my-2">
                           <div class=" merchant_item product_box_outer">
                              <div class=" product_box  ">
                                 <div class=" my-3">
                                    <h4> You booking with '.$merchant_name.'</h4>
                                  
                                    <p>Is coming up on the '.$appointment_date.' '.$appointment_time.'</p>
                                 </div>
                                 <div class=" product_img_box pro_img_has">
                                    <img data-qa-loaded="true" src="'.$img.'" height="200px" onclick_rename="stf_type_form_booking_form(this,3)">
                                 </div>
                                 
                              </div>
                           </div>
                        </div>

                  </div>   

                  <div class="py-4 px-5 justify-content-between botom-style-previous-rename">
                     <a href="javascript:void(0)" class="btn stf_save_btn d-block" onclick="stylist_show_change_booking_screen()">Change Your Booking</a>
                  </div>
                  
                  <div class="preview_reveal_info preview_sub_heading_info">
                     <div class="mb-1 dappr-text-h">
                        <h3> Previous Reveals</h3>
                     </div>
                     <p>Nothing to show here yet</p>
                  </div>
                   <div class="preview_order_info preview_sub_heading_info">
                     <div class="mb-1 dappr-text-h">
                        <h3> Previous Orders</h3>
                     </div>
                     <p>No orders to show here yet</p>
                  </div>



               </div>   
            </div>   
         </div>';
      	}

        
         $output['html'] = $html;
         return $output;



	}


}



