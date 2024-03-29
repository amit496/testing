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

use Illuminate\Support\Facades\Crypt;
use DB;
use App\Models\Attribute;
use App\Models\Customer;
use App\Models\stylistRevealsItems;
use Illuminate\Support\Facades\Auth;


use App\Models\stylistQuestionCatogaries;
use App\Models\stylistQuestions;
use App\Models\stylistQuestionsAnswers;
use App\Models\stylistQuestionSectionName;
use App\Models\StylistCustomerQuestionsAnswer;
use App\Models\StylistUserTags;
use App\Notifications\Dispute\Created;

use Illuminate\Support\Facades\File;

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
		$show_quesiton_answer_fisrt_screen = 'block';
		$show_quesiton_answer_edit_screen = 'none';		

		$cutomer_obj =  Auth::guard('customer')->user();
		$customer_id = $cutomer_obj->id;
 		$show_screen = 'questions_answer';
		//$questions = stylistQuestions::orderBy("question_catogary")->limit(10)->get();
		$questions = stylistQuestions::orderBy("question_catogary")->get();


		$merchants2_obj = Merchant::where('active',1)->get();
      $images_array =  array();
      if($merchants2_obj->isNotEmpty()){
			foreach($merchants2_obj as $merchant_obj){
				$user_id = $merchant_obj->id;
				$user_img = Image::where('imageable_id', '=', $user_id)->where('imageable_type', '=', 'App\Models\User')->first();
				if($user_img){
					$images_array[$user_id]	 = $user_img->path;
				}

			}

	   }

	   $customer_give_question_obj = StylistCustomerQuestionsAnswer::where('customer_id',$customer_id)->first();

	   if($customer_give_question_obj){
	   	$show_quesiton_answer_edit_screen = 'block';
	   	$show_quesiton_answer_fisrt_screen = 'none';
	   }

	   $customer_quesiton_obj = StylistCustomerQuestionsAnswer::where('customer_id',$customer_id)->where('question_id','all')->where('answer_ids','all')->first();
		if(isset($customer_quesiton_obj)){
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

	   $show_question_answer_screen = 'block';
		$show_booknig_screen = 'none';
		$show_booknig_review_screen = 'none';

     	$merchants_obj = $merchants2_obj;

  		$review_product_details = $this->getCustomerReviewProductsDetails();
		$feebback_html = $review_product_details['feebback_html'];
		$decline_html = $review_product_details['decline_html'];
		$buy_html = $review_product_details['buy_html'];

		return view('stylist_form.customer_question_answer',compact('questions','merchants_obj','images_array','booking_review_html','show_question_answer_screen','show_booknig_review_screen','show_booknig_screen','show_quesiton_answer_fisrt_screen','show_quesiton_answer_edit_screen','buy_html','login_cutomer_obj','customer_give_question_obj'));
	}

	function saveDataAjax(Request $request){
		$output = array();
		$method_name = $request->method_name;
		if($method_name == 'save_question_answers'){
			$data = $request->data;
			if($request->hasFile('file')){

				$this->validate($request, [
					'file' => 'required|mimes:png,jpeg,jpg | max:20000',
				]);
				$image_name = '';

				if($request->hasFile('file')){
					$file = $request->file('file');
					$file_name = $file->getClientOriginalName();
					$replace = '_'.date('dmyHms').'.';
					$search = '.';
					$file_name =  stylistHelperFileRenameWithCurrentDateTime($file_name);
					$file->move('uploads', $file_name);
					 $image_name = $file_name;
				}
				$question_id = $request->question_id;
				$data = array();

				$data[0]['answer_id'] = $image_name;
				$data[0]['question_id'] = $question_id;
				$data[0]['type'] = 'file';


			}

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
				$this->addUpdateUserTagByQuestionIdAndAnswersIds($question_id, $answer_id);

			}
			$output['msg'] = 'saved';
			$output['continue_later'] = 'Saved. You will continue later.';
			$output['success'] = 'saved';

		}else{
			$output['error'] = 'Something Wrong';
		}

		return $output;

	}

	function addUpdateUserTagByQuestionIdAndAnswersIds($question_id = 0 , $answer_ids = 0){
		$cutomer_obj =  Auth::guard('customer')->user();
		$customer_id = $cutomer_obj->id;
		$answer_ids_arr = explode(',',$answer_ids);

		$ans_obj =  stylistQuestionsAnswers::where('question_id',$question_id)->whereIn('id',$answer_ids_arr)->get();
		$assign_tag_ids = array();
		if($ans_obj->isNotEmpty()){
			foreach($ans_obj as $ans_info){
				$tag_obj =  $ans_info->tag();
				if(isset($tag_obj)){

					$tag_info = $tag_obj->first();
					if(!isset($tag_info)){
						continue;
					}

					$assign_tag_ids[] = $tag_info->id;

				}
			}
			if(count($assign_tag_ids)){
				$assign_tag_ids = implode(',',$assign_tag_ids);
				$user_tag_has = StylistUserTags::where('question_id',$question_id)->where('user_id',$customer_id)->first();
				$tag_obj_new = new StylistUserTags();
				if($user_tag_has){
					$tag_obj_new = $user_tag_has;
				}

				$tag_obj_new->user_id = $customer_id;
				$tag_obj_new->question_id = $question_id;
				$tag_obj_new->answer_id = '';
				$tag_obj_new->tag_id = $assign_tag_ids;
				$tag_obj_new->save();
			}



		}
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
					if($user_img->path != ''){
						$img	 =  url('').'/image/'.$user_img->path;
					}
				}
		   }

		   $review_product_details = $this->getCustomerReviewProductsDetails();
			$feebback_html = $review_product_details['feebback_html'];
			$decline_html = $review_product_details['decline_html'];
			$buy_html = $review_product_details['buy_html'];

			$html = '<div class="container d-flex">
            <div class="col-lg-5 col-lg-7 card  mb-5 border-0 m-auto">
               <div class="row p-md-4">
                  <div class="mb-4 dappr-text-h pt-0">
                     <h3><u>Welcome '.$name.'</u></h3>
                  </div>
                   <div class="pt-0 mb-4 dappr-text-h">
                     <h3 ><u>In Progress</u></h3>
                  </div>

                  <div class="row stylist_field_outer  product_box_wrappr m-auto">
                        <div class="style-field-checkbox-outer col-md-3 my-2 p-0">
                           <div class=" merchant_item product_box_outer">
                              <div class=" product_box  ">
                                 <div class=" my-3">
                                    <h4> You booking with '.$merchant_name.'</h4>

                                    <p>Is coming up on the '.$appointment_date.' '.$appointment_time.'</p>
                                 </div>
                                 <div class=" mb-3 product_img_box pro_img_has">
                                    <img data-qa-loaded="true" src="'.$img.'" height="200px" onclick_rename="stf_type_form_booking_form(this,3)">
                                 </div>

                              </div>
                           </div>
                        </div>

                  </div>

                  <div class="pt-2 justify-content-between botom-style-previous-rename">
                     <a href="javascript:void(0)" class="btn stf_save_btn d-block" onclick="stylist_show_change_booking_screen()">Change Your Booking</a>
                  </div>

                  <div class="pt-3 preview_reveal_info preview_sub_heading_info">
                     <div class="mb-1 dappr-text-h">
                        <h3> Previous Reveals</h3>
                     </div>
                     <p>Nothing to show here yet</p>
                  </div>
                   <div class="preview_order_info preview_sub_heading_info">
                     <div class="mb-1 dappr-text-h">
                        <h3> Previous Orders</h3>
                     </div>
                    '.$buy_html.'
                  </div>



               </div>
            </div>
         </div>';
      	}


         $output['html'] = $html;
         return $output;



	}


	function getCustomerReviewProductsDetails(){
		$cutomer_obj =  Auth::guard('customer')->user();

		$customer_id = $cutomer_obj->id;
		$client_info = StylistClientInfo::where('customer_id',$customer_id)->orderBy('id','desc')->get();

			$buy_product_ids = array();
			$decline_html = '';
			$decline_product = array();
			$feebback_html = '';
			if($client_info->isNotEmpty()){

				foreach($client_info as $client_info_single){
					$feedback_info_obj = StylistClientInfoDetails::where('stylist_info_id',$client_info_single->id)->get();
					if($feedback_info_obj){

						foreach($feedback_info_obj as $feedback_info_info){
                            $price = 0;
                            if(in_array($feedback_info_info->product_id,$decline_product)){
                            	continue;
                            }





							$product_obj = Product::where('active','1')->where('id',$feedback_info_info->product_id)->with('categories', 'shop.logo', 'featureImage', 'image')
           					 ->withCount('inventories')->orderBy('id', 'DESC')->first();
           					if($product_obj){
           						$decline_options = $feedback_info_info->decline_options;
           						$other_msg = '';
           						if($decline_options != ''){

           							$decline_options_arr =explode('||',$decline_options);

           							if(in_array('other',$decline_options_arr)){

           								$other_msg = $feedback_info_info->other_msg;
           								$other_msg = '<p>Comment: '.$other_msg.'</p>';
           							}
           							$decline_options = "<p><b style='font-size: 17px;
    color: black;'>Reason for decline with:</b> ".implode(', ',$decline_options_arr).'<p>';
           							$feebback_html .= '<div class="card img-product shadow">

									 <span class="img-product-pad"><h3>'.$product_obj->name.'</h3>
										'.$decline_options.$other_msg.'
									 </span>
								  </div>';

           						}






           						$decline_product[] =  	$product_obj->id;
  								   $img_src  = '';
									$inventory = Inventory::where('product_id', $product_obj->id)->first();
									$sale_price = 0;
									if($inventory){

										$qty = $inventory->stock_quantity;
										$sale_price = $inventory->sale_price;
										foreach($inventory->images as $img){
											$img_src  = url('').'/image/'.$img->path;
											break;
										}
									}

									$price = get_formated_price($sale_price, config('system_settings.decimals', 2));

									if($img_src == '' ){
										foreach($product_obj->images as $img){
											$img_src  = url('').'/image/'.$img->path;
											break;
										}
									}
									if($img_src == '' ){
											$img_src   = url('images/stylist/product-placeholder.jpg');
									}

									$decline_html .= '<div class="col-md-4 img-product-1 ">
   												<div class="rounded">
      										<img src="'.$img_src.'" alt=""  style="width: 100%;">
   											</div>
   											<div class="articles-two">
								   		  <h3>'.$product_obj->name.'</h3>
											      <h3>'.$price.'</h3>
											   </div>
											</div>';
							}
						}
					}
					$selected_product_ids = $client_info_single->selected_product_ids;
					if($selected_product_ids != ''){
						$selected_product_ids =explode('||',$selected_product_ids);
						$buy_product_ids = array_merge($buy_product_ids,$selected_product_ids);
					}
				}

			}


			$buy_product_ids = array_unique($buy_product_ids);
			$buy_products = $this->getProductDetails($buy_product_ids);


			$buy_html = '';
			$buy_product_img_src = url('images/stylist/product-placeholder.jpg');
			if(is_array($buy_products) && count($buy_products)){
				foreach($buy_products as $buy_product_info){
					$buy_product_obj = $buy_product_info['product_obj'];
					$buy_inventory_obj = $buy_product_info['inventory_obj'];
					$price = 0;
					if($buy_inventory_obj){
					 	$price =  $buy_inventory_obj->current_sale_price();
						foreach($buy_inventory_obj->images as $img){
                 	 	$buy_product_img_src  = url('').'/image/'.$img->path;
                 	 	break;
       				}
       			}
    				if($buy_product_img_src == ''){
                  foreach($buy_product_obj->images as $img){
                    $buy_product_img_src  = url('').'/image/'.$img->path;
                    break;
                  }
    				}
    				 $price =  get_formated_price($price, config('system_settings.decimals', 2));


    				$buy_html .= '<div class="col-md-4 img-product-1 ">
										<div class="rounded">
										<img src="'.$buy_product_img_src.'" alt=""  style="width: 100%;">
									</div>
									<div class="articles-two">
								     <h4>'.$buy_product_obj->name.'</h4>
								      <h5>'.$price.'</h5>
								   </div>
								</div>';
				}

			}else{
				$buy_html = "<p>No orders to show here yet</p>";
			}

		$return = array();
		$return['decline_html'] =  $decline_html;
		$return['feebback_html'] = $feebback_html;
		$return['buy_html'] = $buy_html;
		return $return;
	}

    public function contactus()
    {
        return view;
    }



}



