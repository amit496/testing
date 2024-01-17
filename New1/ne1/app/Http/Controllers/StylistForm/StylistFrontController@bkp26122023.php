<?php
namespace App\Http\Controllers\StylistForm;
use App\Helpers\ListHelper;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Controller;
use App\Mail\StylistNotifyMail;
use App\Models\Attribute;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\EmailTemplate;
use App\Models\employerOnboardingQuestionnaire;
use App\Models\employerOnboardingQuestionnaireValues;
use App\Models\Image;
use App\Models\Inventory;
use App\Models\Merchant;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\StylistClientBookingAppointments;
use App\Models\StylistClientInfo;
use App\Models\StylistClientInfoDetails;
use App\Models\StylistCustomerQuestionsAnswer;
use App\Models\StylistForm;
use App\Models\stylistQuestions;
use App\Models\stylistQuestionsAnswers;
use App\Models\stylistRevealsItems;
use App\Models\StylistTags;
use App\Models\stylistUsers;
use App\Models\StylistUserTags;
use App\Models\MechantAvailability;
use App\Models\stylistClientBookingAppointmentsChangeStatusHistory;
use App\Models\User;
use App\Models\StatusFilterModel;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Mail\Mailable;
use App\Http\Requests\Validations\OrderCancellationRequest;
use App\Http\Requests\Validations\OrderDetailRequest;
use App\Models\CancellationReason;
use App\Events\Order\OrderCancellationRequestCreated;
use App\Models\Cancellation;
use App\Notifications\Booking\BookingNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;


class StylistFrontController extends Controller
{
    public $stylist_form_obj = null;
    public function __construct()
    {
        $this->stylist_form_obj = new StylistForm();
    }
    public function index($booking_id = '', $reveal_id = 0)
    {
        $customer = Auth::guard('customer')->check() ? Auth::guard('customer')->user() : null;
        $customer_id = $customer->id;

        $select_product_info =  StylistClientInfo::where('customer_id', $customer_id)->latest()->first();
        $select_product_info_repalce = '';
        if(isset($select_product_info))
        {
           $select_product_info_repalce = str_replace('||',',',$select_product_info->selected_product_ids);
        }
        $name = '';
        $email = '';
        $appointment_response_id = 0;
        if ($booking_id != '')
        {
            $booking_id = $booking_id;
            $reveal_id = $reveal_id;
            $booking_info = StylistClientBookingAppointments::where('id', $booking_id)->where('customer_id', $customer_id)->first();
            if ($booking_info)
            {
                $book_ids =$booking_info->id;
                $name = $booking_info->name;
                $email = $booking_info->email;
                $reveal_info = stylistRevealsItems::find($reveal_id);
                Session::put('booking_id', $book_ids);
                Session::put('customerid', $customer_id);
                if (isset($reveal_info))
                {
                    Session::put('reveal_id', $reveal_info->id);
                    $doc_name = $reveal_info->doc_name;
                    $video_html = '';
                    if ($doc_name != '')
                    {
                        $video_url = url('uploads/' . $doc_name);
                        $video_html = '<video width="100%" controls="">';
                        $video_html .= '<source src="' . $video_url . '" type="video/mp4">';
                        $video_html .= '<source src="' . $video_url . '" type="video/ogg">';
                        $video_html .= 'Your browser does not support HTML video.';
                        $video_html .= '</video>';
                    }
                    $product_ids = $reveal_info->product_ids;
                    $alernative_product_ids = $reveal_info->alernative_product_ids;
                    $product_ids_arr = explode(',', $product_ids);
                    $alernative_product_ids_arr = explode(',', $alernative_product_ids);
                    $products_details = $this->getProductDetails($product_ids_arr, 'none');
                    $alernative_products_details = $this->getProductDetails($alernative_product_ids_arr, 'none');
                    $cart_details = DB::table('cart_items')->get();
                    $cart_items_inventory_id = array();
                    $cart_details = DB::table('cart_items')->where('id_of_customer', $customer_id)->pluck('inventory_id')->toArray();
                    if (is_array($cart_details) && count($cart_details))
                    {
                        $cart_items_inventory_id = $cart_details;
                    }
                    return view('stylist_form.reveal_details', compact('video_html', 'products_details', 'alernative_products_details', 'reveal_info', 'cart_items_inventory_id' ,  'customer_id', 'select_product_info_repalce'));
                }
            }
        }
        return abort(404);

        $stylist_info = $this->stylist_form_obj->getValueByColumn('slug', $slug_name);
        if ($stylist_info)
        {
            $product_ids = $stylist_info->product_ids;
            $product_ids_array = explode(',', $product_ids);
            if (is_array($product_ids_array) && count($product_ids_array))
            {
                $products_obj = Product::find($product_ids_array)->where('active', 1);
                if ($products_obj->isNotEmpty()) {
                    $products_obj_array = array();
                    foreach ($products_obj as $product_obj) {
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

                        $products_obj_array[] = array('product_obj' => $product_obj, 'inventory_obj' => $inventory, 'attributes' => $attributes);
                    }

                    return view('stylist_form.form', compact('stylist_info', 'products_obj', 'products_obj_array', 'name', 'email', 'booking_id', 'appointment_response_id'));
                }
            }
        }
        return abort(404);
    }

    public function getProductDetails($product_ids_array, $order_by = '')
    {
        if ($order_by == 'none') {
            $products_obj = Product::whereIn('id', $product_ids_array)->where('active', 1)->orderByRaw("field(id," . implode(',', $product_ids_array) . ")")->get();
        } else {
            $products_obj = Product::whereIn('id', $product_ids_array)->where('active', 1)->get();
        }
        $products_obj_array = array();
        if ($products_obj->isNotEmpty()) {
            foreach ($products_obj as $product_obj) {
                $inventory = Inventory::where('product_id', $product_obj->id)->first();
                if (!isset($inventory)) {
                    continue;
                }
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
                $products_obj_array[$product_obj->id] = array('product_obj' => $product_obj, 'inventory_obj' => $inventory, 'attributes' => $attributes);
            }
        }
        return $products_obj_array;
    }

    public function merchantList()
    {
        $merchants_obj = Merchant::where('active', 1)->get();
        $images_array = array();
        if ($merchants_obj->isNotEmpty()) {
            foreach ($merchants_obj as $merchant_obj) {
                $user_id = $merchant_obj->id;
                $user_img = Image::where('imageable_id', '=', $user_id)->where('imageable_type', '=', 'App\Models\User')->first();
                if ($user_img) {
                    $images_array[$user_id] = $user_img->path;
                }
            }
        }
        return view('stylist_form.merchant-list', compact('merchants_obj', 'images_array'));
    }

    public function clientSubmitProductsSelection(Request $request)
    {

        Session::get('revela_feedback', '');
        $cutomer_obj = Auth::guard('customer')->user();
        $customer_id = $cutomer_obj->id;
        $this->validate($request, [
            'merchant_id' => 'required',
            'stylist_form_id' => 'required',
        ]);
        $selected_product_ids = '';
        $cart_page_redirect = false;
        $result = DB::table('carts')->delete();
        $skip_feedback = 'N';
        if (isset($request->skip_feedback) && $request->skip_feedback == 'Y') {
            $skip_feedback = 'Y';
        }
        $product_select_val = $request->product_select;
        $get_id_for_feedback = stylistRevealsItems::where('id', $request->stylist_form_id)->latest()->first();

        if(isset($get_id_for_feedback) && !empty($get_id_for_feedback))
        {
            $product_ids_column = explode(',',$get_id_for_feedback->product_ids);
            $alter_product_ids_column = explode(',', $get_id_for_feedback->alernative_product_ids);
            $mege_data = array_merge($product_ids_column,$alter_product_ids_column);
            foreach($mege_data as $key => $mege_data_val)
            {

            }
        }

        if (isset($request->product_select)) {
            $selected_product_ids_arr = array();
            foreach ($request->product_select as $product_id => $selected) {
                $inventory = Inventory::where('product_id', $product_id)->first();
                if ($inventory) {
                    $selected_product_ids_arr[] = $product_id;
                    $cart_obj = (new CartController())->addToCart($request, $inventory->slug);
                    $cart_page_redirect = true;
                }
            }
            $cart_details = $result = DB::table('carts')->first();
            $selected_product_ids = implode('||', $selected_product_ids_arr);
            if (isset($cart_details)) {
                $this->addRevealChangeHistory($request->booking_id, $request->stylist_form_id, getRevealStatusKeyNameHelper('add_to_cart'), $comment = $selected_product_ids);
                $coupon_details = $this->createCouponForCompanyByUser($cart_details);
            }
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
        // $confimr_feebk_arr= [];
        // print_r('confimr_feebk_arr' .  $confimr_feebk_arr);
        $info_records_obj = StylistClientInfo::create($info_records_data);
        $get_data_form_select_id ='';
        if ($info_records_obj)
        {
            $reveal_status = array('status' => 'in_progress');
            $info_records_id = $info_records_obj->id;

            Session::put('stylist_reveal_product_feedback_parent_id.'.$customer_id, $info_records_id);
            // add product in cart
            // store decline product feedback
            if (isset($request->stylist_feedback))
            {
                $reveal_status = array('status' => 'in_progress');
                Session::put('stylist_reveal_product_feedback','');
                Session::put('stylist_reveal_product_feedback_other_mesg', '');
                foreach ($request->stylist_feedback as $product_id => $stylist_feedback_info) {
                    // Session::put('stylist_reveal_product_feedback','');
                    $decline_options = implode('||', $stylist_feedback_info);
                    $other_reason = '';
                    if (isset($request->stylist_feedback_other) && isset($request->stylist_feedback_other[$product_id]['other'])) {
                        $other_reason = stylistFieldValidate($request->stylist_feedback_other[$product_id]['other']);
                    }
                    $info_details_records_data = array(
                        'stylist_info_id' => $info_records_id,
                        'product_id' => $product_id,
                        'selection_type' => '',
                        'decline_options' => $decline_options,
                        'alternative_options' => '',
                        'other_msg' => $other_reason,
                    );
                    // Session::get('revela_feedback'. $customer_id ,$stylist_form_id, $product_id , $decline_options);

                    Session::put('stylist_reveal_product_feedback.'.$customer_id.'.'.$product_id, $decline_options);
                    Session::put('stylist_reveal_product_feedback_other_mesg.'.$customer_id.'.'.$product_id.'.other_reason', $other_reason);
                    // Session::put('stylist_reveal_product_feedback_other_mesg.'.$customer_id.'.'.$product_id, $other_reason);
                    // Session::forget('product_id', $product_id );

                    $info_details_records_data_obj = StylistClientInfoDetails::create($info_details_records_data);
                }
                // if((!isset($request->stylist_feedback) || empty($request->stylist_feedback) || ($request->stylist_feedback == '')))
                // {
                //     $product_ids_column = '';
                //     $product_select_val = $request->product_select;
                //     $get_id_for_feedback = stylistRevealsItems::where('id', $request->stylist_form_id)->latest()->first();
                //     if(isset($get_id_for_feedback) && !empty($get_id_for_feedback))
                //     {
                //         $product_ids_column = explode(',',$get_id_for_feedback->product_ids);
                //         $alter_product_ids_column = explode(',', $get_id_for_feedback->alernative_product_ids);
                //         $mege_data = array_merge($product_ids_column,$alter_product_ids_column);
                //         foreach($mege_data as $key => $mege_data_val)
                //         {
                //             if(!array_key_exists($mege_data_val, $product_select_val))
                //             {
                //                 $info_details_records_data = array(
                //                     'stylist_info_id' => $info_records_id,
                //                     'product_id' =>$mege_data_val,
                //                     'selection_type' => '',
                //                     'decline_options' => '',
                //                     'alternative_options' => '',
                //                     'other_msg' => '',
                //                 );

                //                 StylistClientInfoDetails::create($info_details_records_data);
                //             }
                //         }
                // Aaj dravin ka dil fadfada rha hoga. mujhse bola nahin hai
                // Deve
                //     }
                // }
            }
            else
            {
                $product_ids_column = '';
                $product_select_val = $request->product_select;
                $get_id_for_feedback = stylistRevealsItems::where('id', $request->stylist_form_id)->latest()->first();
                if(isset($get_id_for_feedback) && !empty($get_id_for_feedback))
                {
                    $product_ids_column = explode(',',$get_id_for_feedback->product_ids);
                    $alter_product_ids_column = explode(',', $get_id_for_feedback->alernative_product_ids);
                    $mege_data = array_merge($product_ids_column,$alter_product_ids_column);

                    foreach($mege_data as $key => $mege_data_val)
                    {
                        if(!array_key_exists($mege_data_val, $product_select_val))
                        {
                            // $confimr_feebk_arr = array_pop($mege_data_val);
                            // print_r('confimr_feebk_arr' .  $confimr_feebk_arr);
                            $info_details_records_data = array(
                                'stylist_info_id' => $info_records_id,
                                'product_id' =>$mege_data_val,
                                'selection_type' => '',
                                'decline_options' => '',
                                'alternative_options' => '',
                                'other_msg' => '',
                            );

                            StylistClientInfoDetails::create($info_details_records_data);
                        }
                    }
                }
            }
            $dataHasReveal = stylistRevealsItems::where('id', $request->stylist_form_id)->first();
            if ($skip_feedback == 'Y') {
                // return redirect('cart');
            }
            if ($cart_page_redirect) {
            } else {
                $reveal_status = array('status' => $this->getRevealStatusNameByKey('decline'));
            }
            if (isset($dataHasReveal)) {
                $dataHasReveal->update($reveal_status);
            }
            if ($cart_page_redirect) {
                $status_1 = getRevealStatusKeyNameHelper('preparing_order');
                //StylistClientBookingAppointments::where('id',$request->booking_id)->update(['status' => $status_1]);
                Session::put('stylist_reveal_product_order_list.' . $request->stylist_form_id, $selected_product_ids_arr);

                Session::put('stylist_reveal_booking_id.' . $request->stylist_form_id, $request->booking_id);
                $rand_code = Crypt::encryptString($request->stylist_form_id);
                $reveal_url = url("stylist/reveal/" . $request->booking_id . "/" . $request->stylist_form_id . '/' . $rand_code);
                Session::put('stylist_back_reveal_url', $reveal_url);
                return redirect('cart')->withSuccess('Your feedback has been submitted successfully');
            }
            $status_1 = $this->getRevealStatusNameByKey('decline');
            StylistClientBookingAppointments::where('id', $request->booking_id)->update(['status' => $status_1]);
            $this->addRevealChangeHistory($request->booking_id, $request->stylist_form_id, $status_1, $comment = 'user not select any product');
            return redirect()->back()->withSuccess('your feedback request is submitted successfully');
        }

        return redirect()->back()->withError('Problem in request. Please try after some time');
    }
    public function getRevealStatusNameByKey($key)
    {
        $list = $this->getRevealStatusList();
        $reveal_status_name = '';
        if (isset($list[$key])) {
            $reveal_status_name = $list[$key];
        }
        return $reveal_status_name;
    }

    public function getRevealStatusList()
    {
        $list = array();
        $list['awaiting_response'] = 'awaiting_response';
        $list['draf'] = 'draf';
        $list['draft'] = 'draft';
        $list['preparing_order'] = 'preparing_order';
        $list['dispatched'] = 'dispatched';
        $list['return_initiated'] = 'return_initiated';
        $list['not_started'] = 'not_started';
        $list['completed'] = 'completed';
        $list['decline'] = 'decline';
        return $list;
    }

    public function clientSubmitBooking(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'merchant_id' => 'required',
            'booking_appoinment_date' => 'required',

        ]);
        $cutomer_obj = Auth::guard('customer')->user();
        $customer_id = $cutomer_obj->id;

        $records_data = array(
            'name' => $request->name,
            'email' => $request->email,
            'merchant_id' => $request->merchant_id,
            'appointment_date' => $request->booking_appoinment_date,
            'customer_id' => $customer_id,
        );

        $records_obj = StylistClientBookingAppointments::create($records_data);
        if ($records_obj) {
            return redirect()->back()->withSuccess('Your Appoinment Booked Successfully');
        }
        return redirect()->back()->withError('Problem in request. Please try after some time');
    }

    public function reveal(Request $request)
    {
        return view('stylist_form.reveal');
    }

    /*
    function customerInformation(){
    $cutomer_obj =  Auth::guard('customer')->user();

    $questions_category_obj = stylistQuestionCatogaries::all();
    $questions_section_obj = stylistQuestionSectionName::all();
    $questions_obj = stylistQuestions::where('id', '!=', 0)->orderBy('question_catogary', 'desc')->get();

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

     public function customerInformation(request $request)
    {
        $add_on_click_event = '';
        $customer_give_question_get_all_ans ='';

        $url = $request->header('referer');
        $this->getquestion();
        $login_cutomer_obj = Auth::guard('customer')->user();
        $customer_id = $login_cutomer_obj->id;
        $questions_section_heading = stylistQuestions::select('section_heading', DB::raw('count(id) as t_q'))->groupBy('section_heading')->get();
        $questions_section_heading_arr = array();
        if ($questions_section_heading->isNotEmpty()) {
            foreach ($questions_section_heading as $question_section_heading_info) {
                $questions_section_heading_arr[$question_section_heading_info->section_heading] = $question_section_heading_info->t_q;
            }
            if (isset($questions_section_heading_arr[6]) && isset($questions_section_heading_arr[6])) {
                $questions_section_heading_arr[5] = $questions_section_heading_arr[6] + $questions_section_heading_arr[6];
                $questions_section_heading_arr[6] = $questions_section_heading_arr[5];
            }
        }

        $show_question_answer_screen = 'block';
        $show_booknig_screen = 'none';
        $show_booknig_review_screen = 'none';
        $show_quesiton_answer_fisrt_screen = 'block';
        $show_quesiton_answer_edit_screen = 'none';
        $hide_bottom = 'block';
        $show_footer_qa_incomplete_edit_time = 'block';
        $cutomer_obj = Auth::guard('customer')->user();
        $customer_id = $cutomer_obj->id;
        $show_screen = 'questions_answer';
        //$questions = stylistQuestions::orderBy("section_heading")->limit(10)->get();
        // For check customer id exist in queation answer table start
        // $customer_exist_qa = 0;

        // $cutomer_obj_exist_qa_test = StylistCustomerQuestionsAnswer::where('customer_id', $customer_id)->get();
        // if($cutomer_obj_exist_qa_test->isNotEmpty())
        // {
        //     $customer_exist_qa = 1;
        // }
        // For check customer id exist in queation answer table end

        $questions = stylistQuestions::orderBy("section_heading")->get();
        $questions_obj_cat_arr = array();
        $questions_women_obj = stylistQuestions::where("question_catogary", 3)->get();
        $questions_mem_obj = stylistQuestions::where("question_catogary", 4)->get();
        $questions_obj_cat_arr[3] = $questions_women_obj;
        $questions_obj_cat_arr[4] = $questions_mem_obj;
        $merchants2_obj = Merchant::where('active', 1)->get();
        $images_array = array();
        if ($merchants2_obj->isNotEmpty())
        {
            foreach ($merchants2_obj as $merchant_obj)
            {
                $user_id = $merchant_obj->id;
                $user_img = Image::where('imageable_id', '=', $user_id)->where('imageable_type', '=', 'App\Models\User')->first();
                if ($user_img)
                {
                    $images_array[$user_id] = $user_img->path;
                }
            }
        }


        $customer_give_question_get_all_ans = StylistCustomerQuestionsAnswer::where('customer_id', $customer_id)->orderby('id', 'desc')->pluck('answer_ids')->first();
        $customer_give_question_obj = StylistCustomerQuestionsAnswer::where('customer_id', $customer_id)->first();
        if ($customer_give_question_obj) {
            $show_quesiton_answer_edit_screen = 'block';
            $show_quesiton_answer_fisrt_screen = 'none';
            $show_footer_qa_incomplete_edit_time = 'none';
        }
        // $customer_quesiton_obj = StylistCustomerQuestionsAnswer::where('customer_id', $customer_id)->where('answer_ids', 'save_and_continue_later')->first();
        $customer_quesiton_obj = StylistCustomerQuestionsAnswer::where('customer_id', $customer_id)->where('question_id', 1)->where('answer_ids', '!=' ,'save_and_continue_later')->first();
        if (isset($customer_quesiton_obj)) {
            $show_question_answer_screen = 'block';
            $show_booknig_screen = 'none';
            $show_booknig_review_screen = 'none';
            $show_quesiton_answer_fisrt_screen = 'block';
            $show_quesiton_answer_edit_screen = 'none';
        }
        $stylist_question_answer_hide_form = StylistCustomerQuestionsAnswer::where('customer_id', $customer_id)->where('question_id', 0)->where('answer_ids', 'all')->first();
        if ($stylist_question_answer_hide_form) {
            $show_question_answer_screen = 'none';
            $show_booknig_screen = 'block';
            $show_booknig_review_screen = 'none';
            $show_quesiton_answer_fisrt_screen = 'none';
            $show_quesiton_answer_edit_screen = 'none';
        }
        $booking_review_arr = $this->customerBookingReviewhtml();
        $booking_review_html = '';
        if (isset($booking_review_arr['html']) && isset($booking_review_arr['data_has']) && ($booking_review_arr['data_has'] == 'Y')) {
            $booking_review_html = $booking_review_arr['html'];
            $show_question_answer_screen = 'none';
            $show_booknig_screen = 'none';
            $show_booknig_review_screen = 'block';
        }
        // show questions screen
        if ($request->has('q') && ($request->q == 'show_quesiton_answer_edit_screen')  ) {
            $show_question_answer_screen = 'block';
            $show_booknig_screen = 'none';
            $show_booknig_review_screen = 'none';
            $show_quesiton_answer_fisrt_screen = 'none';
            $show_quesiton_answer_edit_screen = 'block';
            $hide_bottom = 'none !important';
        }
        // elseif (substr(trim($url), -1)) {
        //     // $show_question_answer_screen = 'block';
        //     // $show_booknig_screen = 'none';
        //     // $show_booknig_review_screen = 'none';
        //     // $show_quesiton_answer_fisrt_screen = 'none';
        //     // $show_quesiton_answer_edit_screen = 'block';
        //     $hide_bottom = 'none';
        // }
        $merchants_obj = $merchants2_obj;
        $review_product_details = $this->getCustomerReviewProductsDetails();
        $feebback_html = $review_product_details['feebback_html'];
        $decline_html = $review_product_details['decline_html'];
        $buy_html = $review_product_details['buy_html'];
        // $buy_products = $review_product_details['buy_products'];
        $buy_products_links = $review_product_details['buy_products_links'];
        $bookingData = StylistClientBookingAppointments::select(['id'])->where('customer_id', $customer_id)->first();
        // Session::put('stylist_q_budget_cal', '');
        $bg_price = stylistUsers::where('user_id', $customer_id)->first();
        if(isset($bg_price)){
            $bg_price =$bg_price->budget_price;
        }
        else{
            $bg_price=0;
        }
        $bg_price = get_formated_price($bg_price, config('system_settings.decimals', 2));
        return view('stylist_form.customer_question_answer', compact('questions', 'merchants_obj', 'images_array', 'booking_review_html', 'show_question_answer_screen', 'show_booknig_review_screen', 'show_booknig_screen', 'show_quesiton_answer_fisrt_screen', 'show_quesiton_answer_edit_screen', 'buy_html', 'login_cutomer_obj', 'customer_give_question_obj', 'questions_obj_cat_arr', 'questions_section_heading_arr', 'hide_bottom', 'bookingData', 'show_footer_qa_incomplete_edit_time', 'bg_price', 'add_on_click_event', 'customer_give_question_get_all_ans'));
    }

    public function saveDataAjax(Request $request)
    {
        $login_cutomer_obj = Auth::guard('customer')->user();
        $customer_id = $login_cutomer_obj->id;
        $data ='';
        $get_answer_list ='';
        $question_data ='';
        $customer_question_answer ='';
        $customer_image_answer = '';
        $output = array();
        $method_name = $request->method_name;
        if ($method_name == 'save_question_answers') {
            $data = $request->data;
            if ($request->hasFile('file'))
            {
                $this->validate($request, [
                    'file' => 'required|mimes:png,jpeg,jpg,webp,heic | max:20000',
                ]);
                $image_name = '';

                if ($request->hasFile('file')) {
                    $file = $request->file('file');
                    $file_name = $file->getClientOriginalName();
                    $replace = '_' . date('dmyHms') . '.';
                    $search = '.';
                    $file_name = stylistHelperFileRenameWithCurrentDateTime($file_name);
                    $file->move('uploads', $file_name);
                    $image_name = $file_name;
                }
                $question_id = $request->question_id;
                $data = array();
                $data[0]['answer_id'] = $image_name;
                $data[0]['question_id'] = $question_id;
                $data[0]['type'] = 'file';
            }
            if (!is_array($data) && $request->date_type == 'file')
            {
                $data = array();
                $question_data = stylistQuestions::where('id' , $request->question_id)->first();
                if(isset($question_data))
                {
                    $customer_question_answer = StylistCustomerQuestionsAnswer::where('customer_id', $customer_id)->where('question_id', $request->question_id )->first();
                    if(isset($customer_question_answer))
                    {
                        $customer_image_answer =  $customer_question_answer->answer_ids;
                        if(isset($customer_image_answer) && $customer_image_answer != '')
                        {
                            $data[0]['answer_id'] = $customer_image_answer;
                            $data[0]['question_id'] = $request->question_id;
                            $data[0]['type'] = 'file';
                        }
                        else
                        {
                            $data[0]['answer_id'] = '';
                            $data[0]['question_id'] = $request->question_id;
                            $data[0]['type'] = 'file';
                        }
                    }
                }
            }
            // budget calculate
            $output1  = array();
            //$output3  = array();
            if (is_array($data))
            {
                $output1 = $this->questioninfo($data);
            }
            $output = $this->saveCustomerQuestionsAnswer($data);
            if (is_array($data))
            {
                $this->questioninfo($data);
            }
            $output =  $output+  $output1;
        }
        else if ($method_name == 'get_booking_time_list') {
            $booking_date = $request->booking_date;
            $stylist_id = $request->stylist_id;
            $dateTimestamp1 = strtotime(date("d-m-Y", strtotime($booking_date)));
            $dateTimestamp2 = strtotime(date("d-m-Y"));
            if ($dateTimestamp2 > $dateTimestamp1) {
                $output['error'] = 'Please select future date';
            } else {
                $output = $this->getBookingTimeList($stylist_id, $booking_date);
            }
        } else if ($method_name == 'save_booking_date_time') {
            $booking_date = $request->booking_date;
            $stylist_id = $request->stylist_id;
            $booking_time = $request->booking_time;
            $output = $this->saveBooking($stylist_id, $booking_date, $booking_time);
        } else {
            // $output['error'] = 'Something Wrong';
        }
        return response()->json($output);
    }

    public function saveCustomerQuestionsAnswer($data)
    {
        $output =  array();
        if (is_array($data)) {
            $cutomer_obj = Auth::guard('customer')->user();
            $customer_id = $cutomer_obj->id;
            foreach ($data as $question_ans_info)
            {
                $question_id = 0;
                $answer_id = '';
                $type = '';
                $other_ans_text = '';
                if (isset($question_ans_info['question_id'])) {
                    $question_id = $question_ans_info['question_id'];
                }
                if (isset($question_ans_info['answer_id'])) {
                    $answer_id = $question_ans_info['answer_id'];
                }
                if (isset($question_ans_info['type']))
                {
                    $type = $question_ans_info['type'];
                }
                if (isset($question_ans_info['other_ans_text'])) {
                    $other_ans_text = $question_ans_info['other_ans_text'];
                }
                $budget_calculation_status = false;
                $budget_price = 0;
                $budget_price_calculate_type = '';
                $question_obj = stylistQuestions::where('id', $question_id)->where('q_type', 'budget_calculate_price_show')->first();
                $skip_id_budget = 'stylist_1234';
                if (isset($question_obj)) {

                    $other_ans_text_data = Session::get('stylist_q_budget_cal_total.' . $question_obj->question_catogary . '.' . $skip_id_budget);
                    $budget_calculation_status = true;
                    $budget_price = $other_ans_text_data;
                    $budget_price_calculate_type = 'not manually';
                }
                else{
                    $question_obj = stylistQuestions::where('id', $question_id)->where('q_type', 'budget_calculate_price_update')->first();
                    if (isset($question_obj)) {
                        $other_ans_text_data = Session::get('stylist_q_budget_cal_total.' . $question_obj->question_catogary . '.' . $skip_id_budget);
                        $budget_calculation_status = true;
                        $budget_price = $other_ans_text_data;
                        $budget_price_calculate_type = 'not manually';
                    }
                    else{

                        $question_obj = stylistQuestions::where('id', $question_id)->where('q_type', 'budget_calculate_manual_price_update')->first();
                        if (isset($question_obj)) {
                            $budget_calculation_status = true;
                            $budget_price = $answer_id;
                            $budget_price_calculate_type = 'manually';

                        }
                    }
               }

                if(($budget_calculation_status))
                {
                    $users_obj = stylistUsers::where('user_id',$customer_id)->first();
                    if($budget_price_calculate_type == 'not manually'){
                        $budget_price = $budget_price * 5;
                    }
                    elseif($budget_price_calculate_type == 'manually'){
                        $budget_price = $budget_price;
                    }
                    $insert_recods = array();
                    if(isset($users_obj)){
                        //  $budget_price2 = $budget_price * 5;
                        $insert_recods = array('user_id' => $customer_id, 'budget_price' => $budget_price,'budget_price_calculate_type' => $budget_price_calculate_type);
                        $users_obj->update($insert_recods);
                    }
                    else{
                        $insert_recods = array('user_id' => $customer_id, 'budget_price' => $budget_price,'budget_price_calculate_type' => $budget_price_calculate_type);
                        stylistUsers::insert($insert_recods);
                    }
                }

                $records_data = array();
                $records_data['customer_id'] = $customer_id;
                $records_data['question_id'] = $question_id;
                $records_data['answer_ids'] = $answer_id;
                $records_data['type'] = $type;
                $records_data['text_ans'] = $other_ans_text;
                if ((int) $question_id == 0) {
                    $hasData = StylistCustomerQuestionsAnswer::where('customer_id', $customer_id)->where('answer_ids', $answer_id)->first();
                } else {
                    $hasData = StylistCustomerQuestionsAnswer::where('customer_id', $customer_id)->where('question_id', $question_id)->first();
                }
                if (isset($hasData))
                {
                    unset($records_data['customer_id']);
                    unset($records_data['question_id']);
                    $hasData->update($records_data);
                }
                else
                {
                    StylistCustomerQuestionsAnswer::create($records_data);
                }
                $this->addUpdateUserTagByQuestionIdAndAnswersIds($question_id, $answer_id);

            }
            $output['msg'] = 'saved';
            $output['continue_later'] = 'Saved. You will continue later.';
            $output['success'] = 'saved';

        } else {
            // $output['error'] = 'Something Wrong';
        }

        return $output;

    }

    public function addUpdateUserTagByQuestionIdAndAnswersIds($question_id = 0, $answer_ids = 0)
    {
        $cutomer_obj = Auth::guard('customer')->user();
        $customer_id = $cutomer_obj->id;
        $answer_ids_arr = explode(',', $answer_ids);

        $ans_obj = stylistQuestionsAnswers::where('question_id', $question_id)->whereIn('id', $answer_ids_arr)->get();
        $assign_tag_ids = array();
        if ($ans_obj->isNotEmpty()) {
            foreach ($ans_obj as $ans_info) {
                $tag_obj = $ans_info->tag();
                if (isset($tag_obj)) {
                    $tag_info = $tag_obj->first();
                    if (!isset($tag_info)) {
                        continue;
                    }
                    $assign_tag_ids[] = $tag_info->id;
                }
            }
            if (count($assign_tag_ids)) {
                $assign_tag_ids = implode(',', $assign_tag_ids);
                $user_tag_has = StylistUserTags::where('question_id', $question_id)->where('user_id', $customer_id)->first();
                $tag_obj_new = new StylistUserTags();
                if ($user_tag_has) {
                    $tag_obj_new = $user_tag_has;
                }
                $tag_obj_new->user_id = $customer_id;
                $tag_obj_new->question_id = $question_id;
                $tag_obj_new->answer_id = '';
                $tag_obj_new->tag_id = $assign_tag_ids;
                $tag_obj_new->save();
            }

        } else {

            $q_obj = stylistQuestions::where('id', $question_id)->first();

            if (isset($q_obj) && $q_obj->type == 'text' && $q_obj->tag_status == 'Y') {
                $tag_has = StylistTags::where('name', $answer_ids)->first();
                $tag_id = 0;
                if (isset($tag_has)) {
                    $tag_id = $tag_has->id;
                } else {
                    $obj_new = new StylistTags();
                    $obj_new->name = $answer_ids;
                    $obj_new->save();
                    $tag_id = $obj_new->id;
                }

                if ($tag_id != 0) {
                    $user_tag_has = StylistUserTags::where('question_id', $question_id)->where('user_id', $customer_id)->first();
                    $tag_obj_new = new StylistUserTags();
                    if ($user_tag_has) {
                        $tag_obj_new = $user_tag_has;
                    }
                    $tag_obj_new->user_id = $customer_id;
                    $tag_obj_new->question_id = $question_id;
                    $tag_obj_new->answer_id = '';
                    $tag_obj_new->tag_id = $tag_id;
                    $tag_obj_new->save();
                }
            }

        }
    }

    public function getBookingTimeList($stylist_id = 0, $booking_date = '')
    {
        $html = '';
        $name = '';
        $bookingdate= date_create($booking_date);
        $ddate = date_format($bookingdate,"Y-m-d");
        $S_date = date_format($bookingdate,"d-m-Y");
        $duedt = explode("-", $ddate);
        $date  = mktime(0, 0, 0, $duedt[1], $duedt[2], $duedt[0]);
        $week  = (int)date('w', $date);
        $merchant_dates = MechantAvailability::where('merchant_id', $stylist_id)->where('days',$week)->get()->toArray();
        $merchant_name = User::where('id', $stylist_id)->first();
        if(isset($merchant_name)){
            $name = $merchant_name->name;
        }
        if(isset($merchant_dates) &&  !empty($merchant_dates)){
            $time_css = false;
            foreach ($merchant_dates as $key => $value){
                if(isset($value['days'])){
                    $array_time = ['08:00am','08:30am','09:00am','09:30am','10:00am','10:30am','11:00am','11:30am','12:00pm','12:30pm','01:00pm','01:30pm','02:00pm','02:30pm','03:00pm','03:30pm','04:00pm','04:30pm','05:00pm','05:30pm','06:00pm'];
                    $key1 = array_search($value['start_time'], $array_time) ;
                    $key2= array_search($value['end_time'], $array_time) ;
                    $result = [];
                    while($key1 < $key2){
                        $result[] = [$array_time[$key1].' - '.$array_time[$key1+1]];
                        $key1++;
                    }
                    $stylist_booking_data = StylistClientBookingAppointments::where('merchant_id', $stylist_id)->where('appointment_date', $S_date)->OrderBy('id' , 'DESC')->get();
                    $already_booking_appointment_times = [];
                    if($stylist_booking_data->isNotEmpty()){
                        $already_booking_appointment_times = array_column($stylist_booking_data->toArray(), 'appointment_time');
                    }
                    foreach ($result as $result_row){
                        foreach ($result_row as $result_col){

                            if(in_array($result_col,$already_booking_appointment_times)){
                                continue;

                            }
                            $time_css = true;
                            $html .= '<div class="style-field-checkbox-outer col-md-2_rename style-field-checkbox-outer-box" >
                            <div class="product_box product_box_outer"><h6 class="text-center mt-2 product_box_single_select product_select_box">' .$result_col. ' </h6><input type="radio" class="style-field-hide style-options-checkbox stylist_field_required" name="booking_time" value="' .$result_col.'"></div></div>';
                        }
                    }
                }
                else
                {
                    $html .= '<div class="mb-1 dappr-text-h "><h3><strong> '.$name.'  has no availability on this day. Please select a different stylist or day.</strong></h3></div>';
                }
            }
            if($time_css)
            {
                $html .= '</div><div class=" py-4 booking_btn  m-auto" style="'.$time_css.'"><div  class=" mt-3 btn stf_save_btn d-block " onclick="stylist_save_booking(this)">Click to book</div>';
            }
        }
        else
        {
            $html .= '<div class="mb-1 dappr-text-h "><h3><strong>'.$name.'  has no availability on this day. Please select a different stylist or day.</strong></h3></div>';

        }

        $output = array();
        $output['booking_time_html'] = $html;
        $output['success'] = 'load';

        return $output;

    }

    public function saveBooking($stylist_id = 0, $booking_date = '', $booking_time = '')
    {
        $new_booking_data = '';
        $cutomer_obj = Auth::guard('customer')->user();
        $customer_name = $cutomer_obj->name . ' '  .$cutomer_obj->last_name;
        $customer_id = $cutomer_obj->id;
        $stylist_info = User::find($stylist_id);
        $dataHas = StylistClientBookingAppointments::where('customer_id', $customer_id)->first();
        $reveal_status = getRevealStatusKeyNameHelper('not_started');
        $date=date_create($booking_date);
        $date_format =  date_format($date,"d-m-Y");
        $filters_status_update = '';
        if (isset($dataHas))
        {
            $records_data = array(
                'name' => $customer_name,
                'email' => '',
                'merchant_id' => $stylist_id,
                'appointment_date' => $date_format,
                'appointment_time' => $booking_time,
                'status' => $reveal_status,
            );
            $dataHas->update($records_data);
            $filters_status_update = StatusFilterModel::where('booking_id', $dataHas->id)->where('customer_id', $customer_id)->latest()->first();
            if($filters_status_update)
            {
                $filters_status_update->appointment_date = $dataHas->appointment_date;
                $filters_status_update->appointment_time = $dataHas->appointment_time;
                $filters_status_update->update();
            }
            else
            {
                $filters_status_update = new StatusFilterModel();
                $filters_status_update->booking_id = $dataHas->id;
                $filters_status_update->customer_name =  $dataHas->name;
                $filters_status_update->merchant_id =  $dataHas->merchant_id;
                $filters_status_update->customer_id =  $dataHas->customer_id;
                $filters_status_update->booking_status =  $dataHas->status;
                $filters_status_update->appointment_date = $dataHas->appointment_date;
                $filters_status_update->appointment_time = $dataHas->appointment_time;
                $filters_status_update->save();
            }
        }
        else
        {
            $records_data = array(
                'name' => $customer_name,
                'email' => '',
                'merchant_id' => $stylist_id,
                'appointment_date' => $date_format,
                'customer_id' => $customer_id,
                'appointment_time' => $booking_time,
                'status' => $reveal_status,
            );
            $records_obj = StylistClientBookingAppointments::create($records_data);

            if($records_obj)
            {
                $filters_status_update = new StatusFilterModel();
                $filters_status_update->booking_id = $records_obj->id;
                $filters_status_update->customer_name =  $records_obj->name;
                $filters_status_update->merchant_id =  $records_obj->merchant_id;
                $filters_status_update->customer_id =  $records_obj->customer_id;
                $filters_status_update->booking_status =  $records_obj->status;
                $filters_status_update->appointment_date = $records_obj->appointment_date;
                $filters_status_update->appointment_time = $records_obj->appointment_time;
                $filters_status_update->save();

            }
            Notification::send($stylist_info, new BookingNotification($records_obj));
        }
        $output = array();
        // send mail to stylist and customer for booking notification

        $email_send_data_to_stylist = EmailTemplate::where('name', 'Stylist-booking-appointments-notification')->first();
        $sender_email = '';
        $stylist_info = User::find($stylist_id);

        if ($email_send_data_to_stylist && isset($stylist_info)) {

            $sender_email = $email_send_data_to_stylist->sender_email;
            $to_email = $stylist_info->email;
            $subject = $email_send_data_to_stylist->subject;
            $login_cutomer_obj = Auth::guard('customer')->user();
            $customer_email_id = $login_cutomer_obj->email;
            //$body = $email_send_data_to_stylist->body;
            $body = '<p>Hi,<br><h1>New booking is come</h1><span>Booking Date: <b>%%booking_date%%</b></span><span>Customer email id: <b>%%customer_email_id%%</b></span>Thanks</p>';
            //$body = (new EmailTemplate())->getBodyAttribute($body);
            $body = str_replace('%%booking_date%%', $booking_date, $body);
            $body = str_replace('%%customer_email_id%%', $customer_email_id, $body);

            $mail_details = array();
            $mail_details['to'] = $to_email;
            // $mail_details['from'] = $sender_email;
            $mail_details['from'] = 'contact@manipuraco.net';
            $mail_details['subject'] = $subject;
            $mail_details['body'] = $body;

            Mail::to($mail_details['to'])->send(new StylistNotifyMail($mail_details));

            if (Mail::failures()) {
            $output['mail_status'][] = 'Sorry! Please try again latter';
             } else {
            $output['mail_status'][] = 'Send successfully';

            }
            $output['mail_details'][] = $mail_details;
        }

        $email_send_data_to_customer = EmailTemplate::where('name', 'Stylist-customer-booking-appointments-notification')->first();
        $sender_email = '';
        if ($email_send_data_to_customer) {

            $sender_email = $email_send_data_to_customer->sender_email;
            $subject = $email_send_data_to_customer->subject;
            $login_cutomer_obj = Auth::guard('customer')->user();
            $customer_email_id = $login_cutomer_obj->email;

            $body = 'Thanks for booking';
            //$body = $email_send_data_to_customer->body;
            //$body = (new EmailTemplate())->getBodyAttribute($body);

            $mail_details = array();
            $mail_details['to'] = $customer_email_id;
            // $mail_details['from'] = $sender_email;
            $mail_details['from'] = 'contact@manipuraco.net';
            $mail_details['subject'] = $subject;
            $mail_details['body'] = $body;
            Mail::to($mail_details['to'])->send(new StylistNotifyMail($mail_details));

            if (Mail::failures()) {
                $output['mail_status'][] = 'Sorry! Please try again latter';
            } else {
                $output['mail_status'][] = 'Send successfully';

            }
            $output['mail_details'][] = $mail_details;
        }

        $output['success'] = 'Your Call is notified';
        $review_html = $this->customerBookingReviewhtml();
        $output['review_html'] = $review_html['html'];
        return $output;

    }

    public function customerBookingReviewhtml()
    {
        $html_booking_info = '';
        $today = date('d-m-Y');
        $cutomer_obj = Auth::guard('customer')->user();
        $customer_id = $cutomer_obj->id;
        $name = $cutomer_obj->name;
        $reveal_status = getRevealStatusKeyNameHelper('draft');
        $status_text_top = 'Booking';
        $data_obj_revel ='';
        $data_obj = StylistClientBookingAppointments::where('customer_id', $customer_id)->where('status', '!=', $reveal_status)->latest()->first();
        if(isset( $data_obj ))
        {
            $data_obj_revel = stylistClientBookingAppointmentsChangeStatusHistory::where('booking_id', $data_obj->id)->where('status', '!=', 'sent')->where('reveal_id','==', 'null')->orWhere('status', '!=', 'call_complete')->latest()->first();
            if(isset( $data_obj_revel )){
             $status_text_top = 'In Progress';
            }
            // $reveal_info_has = stylistRevealsItems::where('booking_id', $booking_obj->id)->first();
        }
        else{
            ECHO '';
        }
        $html_replace = '';
        if($data_obj == 'preparing_order')
        {
            $html_replace = '';
        }
        elseif($data_obj_revel)
        {
            $html_replace .= '<div class="pt-0 mb-4 dappr-text-h"><h3 > <strong><u>'.$status_text_top.'</u></strong> </h3></div>';
        }
        else
        {
            $html_replace .= '<div class="pt-0 mb-4 dappr-text-h"><h3 > <strong><u>'.$status_text_top.'</u></strong> </h3>
            </div>';
        }
        $html = '';
        $output = array();
        $output['data_has'] = 'N';
        if($data_obj)
        {
            $today ='';
            $filter_status_data = '';
            $rand_code ='';
            $booking_obj = '';
            $booking_obj_2_month = '';
            $booking_obj_2_month_17_days = '';
            $booking_obj_2_month_27_days = '';
            $booking_obj_3_month = '';
            $output['data_has'] = 'Y';
            $merchant_id = $data_obj->merchant_id;
            $appointment_date = $data_obj->appointment_date;
            $appointment_time = $data_obj->appointment_time;

            $merchant_obj = Merchant::where('id', $data_obj->merchant_id)->latest()->first();
            $img = url('') . '/images/stylist/dummy-profile-pic.png';
            $merchant_name = '';
            if (isset($merchant_obj)) {
                $merchant_name = $merchant_obj->name;
                $user_img = Image::where('imageable_id', '=', $merchant_obj->id)->where('imageable_type', '=', 'App\Models\User')->latest()->first();
                if ($user_img) {
                    if ($user_img->path != '') {
                        $img = url('') . '/image/' . $user_img->path;
                    }
                }
            }
            $review_product_details = $this->getCustomerReviewProductsDetails();
            $feebback_html = $review_product_details['feebback_html'];
            $decline_html = $review_product_details['decline_html'];
            $buy_html = $review_product_details['buy_html'];
            $buy_products_links = $review_product_details['buy_products_links'];
            $previous_reveal_html = $review_product_details['previous_reveal_html'];
            $booking_date = $dateTimestamp1 = strtotime(date("d-m-Y", strtotime($appointment_date)));
            $curent_date = $dateTimestamp2 = strtotime(date("d-m-Y"));
            $stylist_call_complete = $data_obj->statusHistory()->where('status', '=', 'call_complete')->latest()->first();
            // $reveal_info_draft_has = stylistRevealsItems::where('booking_id', $data_obj->id)->latest()->first();
            $reveal_info_draft_has = stylistRevealsItems::where('booking_id', $data_obj->id)->latest()->take(2)->get();
            $reveal_status_info = '';
            $reveal_status_info_arr = [];
            $array_countvalues = [];
            $reveal_hide = '';
            $reveal_show = '';
            $order_data_info = '';
            $reveal_create_date = '';
            $reveal_create_date_3month ='';
            $reveal_create_76_days ='';
            $reveal_create_45_days='';
            $reveal_create_14_days='';
            //  start customer dashboard
            $filter_status_data = StatusFilterModel::where('booking_id', $data_obj->id)->latest()->first();
            if($filter_status_data)
            {
                $order_data_info = Order::where('customer_id', $filter_status_data->customer_id)->where('reveal_id', $filter_status_data->reveal_id)->latest()->first();
                $reveal_create_date  = $filter_status_data->reveal_send_date;
                $reveal_create_date_3month  = date('d-m-Y', strtotime($reveal_create_date . "+ 90 days"));
                $reveal_create_76_days = date("d-m-Y",strtotime($reveal_create_date_3month." -76 days"));
                $reveal_create_45_days = date("d-m-Y",strtotime($reveal_create_date_3month." -45 days"));
                $reveal_create_14_days = date("d-m-Y",strtotime($reveal_create_date_3month." -14 days"));
            }
            if (!isset($stylist_call_complete))
            {
                $html = '<div class="container d-flex  reveal_booked_appointment_info"><div class="col-lg-5 col-lg-7 card  mb-5 border-0 m-auto">
                <div class=""><div class="mb-4 dappr-text-h pt-4"><h3>Welcome ' . $name . '!</h3></div><span style="border-bottom:2px solid black; font-weight:600; padding-bottom:5px;">Call Upcoming</span>';
                $html .= '<div class=" mb-3 custom_product_img_box pro_img_has  reveal_booked_appointment_info_section" style="margin-top: 30px;"><div class="reveal_booked_appointment_info_section_btn" ><a onclick="return false;">CALL UPCOMING</a></div><div class="stylist_section_backgound_img" style="background-image: url(' . url('images/stylist/questions/section/booking.jpg') . ');"></div></div>';
                $html .= '<div class="pt-0 mb-4 dappr-text-h"><p>Thanks for booking your call with '. $merchant_name . '</p></div>';
                $html .= '<div class="pt-0 mb-4 dappr-text-h"><p>Your call is confirmed for '.$appointment_time.' on the '.$appointment_date.'  </p><p class="pt-4">Need to change the call date or time?<a  onclick="stylist_show_change_booking_screen(); return false;"><b> CLICK HERE</b></a></p></div>';
            }
            else if(isset($stylist_call_complete))
            {
                $html ='';
                $html_booking_info ='';
                $html = '<div class="container d-flex reveal_booked_appointment_info" ><div class="col-lg-5 col-lg-7 card  mb-5 border-0 m-auto" style="' . $reveal_show .'">
                <div class=""><div class="mb-4 dappr-text-h pt-4"><h3>Welcome ' . $name . '!</h3></div><span style="border-bottom:1px solid black; font-weight:600; padding-bottom:5px;">In Progress</span>';
                $html_booking_info = '<div class="pt-0 mb-4 dappr-text-h" style="margin-top: 2.5rem!important;"><h6 >We are currently working on your Reveal. Stay tuned.</h6></div>';
                $html_booking_info .= '<div class=" mb-3 custom_product_img_box pro_img_has  reveal_booked_appointment_info_section"><div class="reveal_booked_appointment_info_section_btn"><a onclick="return false;">REVEAL COMING SOON</a></div><div class="stylist_section_backgound_img" style="background-image: url(' . url('images/stylist/questions/section/reveal_coming_soon.jpg') . ');"></div></div>';
                $filter_status_data = StatusFilterModel::where('booking_id', $data_obj->id)->latest()->first();

                if((isset($filter_status_data)) && ($filter_status_data->booking_status == 'awaiting_response') && ($filter_status_data->reveal_status == 'awaiting_response') )
                {
                    $rand_code = Crypt::encryptString($filter_status_data->reveal_id);
                    $html = '<div class="container d-flex  reveal_booked_appointment_info"><div class="col-lg-5 col-lg-7 card  mb-5 border-0 m-auto" ><div class=""><div class="mb-4 dappr-text-h pt-4"><h3>Welcome ' . $name . '!</h3></div><span style="border-bottom:2px solid black; font-weight:600; padding-bottom:5px;">View Your Reveal</span>';
                    $html_booking_info = '<div class="pt-0 mb-3 dappr-text-h mt-3"><h6 class="mb-0">Your reveal is ready to view. We think you\'ll love it! </h6></div>';
                    $reveal_link = url("stylist/reveal/" . $filter_status_data->booking_id . "/" . $filter_status_data->reveal_id . '/' . $rand_code);
                    $html_booking_info .= '<div class=" mb-3 custom_product_img_box pro_img_has  reveal_booked_appointment_info_section"><div class="reveal_booked_appointment_info_section_btn"><a href=' . $reveal_link . '>' . 'VIEW YOUR REVEAL' . '</a></div><div class="stylist_section_backgound_img" style="background-image: url(' . url('images/stylist/questions/section/') . '/Dappr_animal.jpg?' . rand(10, 1000) . ');"></div></div>';
                    $html_booking_info .= ' <div  class="btn stf_save_btn show_questions_screen_btn col-md-12 p-0"><a href=' . $reveal_link . ' class="btn text-light">' . 'VIEW REVEAL' . '</a></div> </div>';
                }
                else if(isset($order_data_info) &&  isset($filter_status_data) && ($filter_status_data->booking_status == 'awaiting_response') && ($filter_status_data->reveal_status == 'preparing_order'))
                {
                    $html = '<div class="container d-flex  reveal_booked_appointment_info"><div class="col-lg-5 col-lg-7 card  mb-5 border-0 m-auto"><div class=""><div class="mb-4 dappr-text-h pt-4"><h3>Welcome ' . $name . '!</h3></div><span style="border-bottom:2px solid black; font-weight:600; padding-bottom:5px;">Items Coming</span>';
                    $html_booking_info = '<div class="pt-0 mb-4 dappr-text-h" style="margin-top:1.5rem !important;"><h6>Check your order for status updates.</h6></div>';
                    $html_booking_info .= '<div class=" mb-3 custom_product_img_box pro_img_has  reveal_booked_appointment_info_section"><div class="reveal_booked_appointment_info_section_btn"><a onclick="return false;">ITEMS COMING</a>
                    </div><div class="stylist_section_backgound_img" style="background-image: url(' . url('images/stylist/questions/section/next_reveal.jpg') . ');"></div></div>';
                }
                else if(isset($order_data_info) &&  isset($filter_status_data) && ($filter_status_data->booking_status == 'dispatched') && ($filter_status_data->reveal_status == 'dispatched'))
                {
                    $html = '<div class="container d-flex  reveal_booked_appointment_info"><div class="col-lg-5 col-lg-7 card  mb-5 border-0 m-auto"><div class=""><div class="mb-4 dappr-text-h pt-4"><h3>Welcome ' . $name . '!</h3></div><span style="border-bottom:2px solid black; font-weight:600; padding-bottom:5px;">Items Coming</span>';
                    $html_booking_info = '<div class="pt-0 mb-4 dappr-text-h" style="margin-top:1.5rem !important;"><h6>Check your order for status updates.</h6></div>';
                    $html_booking_info .= '<div class=" mb-3 custom_product_img_box pro_img_has  reveal_booked_appointment_info_section"><div class="reveal_booked_appointment_info_section_btn"><a onclick="return false;">ITEMS COMING</a>
                    </div><div class="stylist_section_backgound_img" style="background-image: url(' . url('images/stylist/questions/section/next_reveal.jpg') . ');"></div></div>';
                }
                else if(isset($order_data_info) &&  isset($filter_status_data) && ($filter_status_data->booking_status == 'dispatched') && ($filter_status_data->reveal_status == 'awaiting_delivery'))
                {
                    $html = '<div class="container d-flex  reveal_booked_appointment_info"><div class="col-lg-5 col-lg-7 card  mb-5 border-0 m-auto"><div class=""><div class="mb-4 dappr-text-h pt-4"><h3>Welcome ' . $name . '!</h3></div><span style="border-bottom:2px solid black; font-weight:600; padding-bottom:5px;">Items Coming</span>';
                    $html_booking_info = '<div class="pt-0 mb-4 dappr-text-h" style="margin-top:1.5rem !important;"><h6>Check your order for status updates.</h6></div>';
                    $html_booking_info .= '
                    <div class=" mb-3 custom_product_img_box pro_img_has  reveal_booked_appointment_info_section"><div class="reveal_booked_appointment_info_section_btn"><a onclick="return false;">ITEMS COMING</a>
                    </div><div class="stylist_section_backgound_img" style="background-image: url(' . url('images/stylist/questions/section/women_colour_and_fabric_section_image.webp') . ');"></div></div>';
                }
                else if(isset($order_data_info) &&  isset($filter_status_data) && ($filter_status_data->booking_status == 'dispatched') && ($filter_status_data->reveal_status == 'delivered'))
                {
                    $html = '<div class="container d-flex  reveal_booked_appointment_info"><div class="col-lg-5 col-lg-7 card  mb-5 border-0 m-auto"><div class=""><div class="mb-4 dappr-text-h pt-4"><h3>Welcome ' . $name . '!</h3></div><span style="border-bottom:2px solid black; font-weight:600; padding-bottom:5px;">Items Delivered  </span>';
                    $html_booking_info = '<div class="pt-0 mb-4 dappr-text-h" style="margin-top:1.5rem !important;"><h6>Your items have been delivered. Enjoy your pieces!</h6></div>';
                    $html_booking_info .= '
                    <div class=" mb-3 custom_product_img_box pro_img_has  reveal_booked_appointment_info_section"><div class="reveal_booked_appointment_info_section_btn"><a onclick="return false;">ITEMS DELIVERED</a>
                    </div><div class="stylist_section_backgound_img" style="background-image: url(' . url('images/stylist/questions/section/women_colour_and_fabric_section_image.webp') . ');"></div></div>';
                }
                else if(isset($order_data_info) &&  isset($filter_status_data) && ($filter_status_data->booking_status == 'dispatched') && ($filter_status_data->reveal_status == 'return_initiated') && ($filter_status_data->cancellation_status == 1))
                {
                    $html = '<div class="container d-flex  reveal_booked_appointment_info"><div class="col-lg-5 col-lg-7 card  mb-5 border-0 m-auto"><div class=""><div class="mb-4 dappr-text-h pt-4"><h3>Welcome ' . $name . '!</h3></div><span style="border-bottom:2px solid black; font-weight:600; padding-bottom:5px;">Return being processed</span>';
                    $html_booking_info = '<div class="pt-0 mb-4 dappr-text-h" style="margin-top:1.5rem !important;"><h6>We\'ve received your return request.</h6></div>';
                    $html_booking_info .= '<div class=" mb-3 custom_product_img_box pro_img_has  reveal_booked_appointment_info_section"><div class="reveal_booked_appointment_info_section_btn"><a onclick="return false;" style="max-width: 300px;">RETURN BEING PROCESSED</a></div><div class="stylist_section_backgound_img" style="background-image: url(' . url('images/stylist/questions/section/Dappr_smart_casual.jpg') . ');"></div></div>';
                }
                else if(isset($order_data_info) &&  isset($filter_status_data) && ($filter_status_data->booking_status == 'awaiting_response') && ($filter_status_data->reveal_status == 'return_initiated') && ($filter_status_data->cancellation_status == 1))
                {
                    $html = '<div class="container d-flex  reveal_booked_appointment_info"><div class="col-lg-5 col-lg-7 card  mb-5 border-0 m-auto"><div class=""><div class="mb-4 dappr-text-h pt-4"><h3>Welcome ' . $name . '!</h3></div><span style="border-bottom:2px solid black; font-weight:600; padding-bottom:5px;">Return being processed</span>';
                    $html_booking_info = '<div class="pt-0 mb-4 dappr-text-h" style="margin-top:1.5rem !important;"><h6>We\'ve received your return request.</h6></div>';
                    $html_booking_info .= '<div class=" mb-3 custom_product_img_box pro_img_has  reveal_booked_appointment_info_section"><div class="reveal_booked_appointment_info_section_btn"><a onclick="return false;" style="max-width: 300px;">RETURN BEING PROCESSED</a></div><div class="stylist_section_backgound_img" style="background-image: url(' . url('images/stylist/questions/section/Dappr_smart_casual.jpg') . ');"></div></div>';
                }
                else if(isset($order_data_info) &&  isset($filter_status_data) && (($filter_status_data->booking_status == 'awaiting_response') || $filter_status_data->booking_status == 'dispatched') && (($filter_status_data->reveal_status == 'return_initiated') || $filter_status_data->reveal_status == 'refunded') && ($filter_status_data->cancellation_status == 6))
                {
                    $html = '<div class="container d-flex  reveal_booked_appointment_info"><div class="col-lg-5 col-lg-7 card  mb-5 border-0 m-auto"><div class=""><div class="mb-4 dappr-text-h pt-4"><h3>Welcome ' . $name .'!</h3></div><span style="border-bottom:2px solid black; font-weight:600; padding-bottom:5px;">Reveal Coming Soon</span>';
                    $html_booking_info = '<div class="pt-0 mb-4 dappr-text-h" style="margin-top:1.5rem !important;"><h6>Sit tight, you can expect your reveal in about 2 months.</h6></div>';
                    $html_booking_info .= '<div class=" mb-3 custom_product_img_box pro_img_has  reveal_booked_appointment_info_section"><div class="reveal_booked_appointment_info_section_btn"><a onclick="return false;">REVEAL COMING SOON</a></div><div class="stylist_section_backgound_img" style="background-image: url(' . url('images/stylist/questions/section/women_clothing_style_and_fit_section_image.webp') . ');"></div></div>';
                }
                else if(isset($order_data_info) &&  isset($filter_status_data) && ($filter_status_data->booking_status == 'dispatched') && ($filter_status_data->reveal_status == 'return_initiated') && ($filter_status_data->cancellation_status == 6)  && (strtotime($today) >= strtotime($reveal_create_76_days) || strtotime($today) <= strtotime($reveal_create_76_days))  && (strtotime($today) <= strtotime($reveal_create_45_days)))
                {
                    $html = '<div class="container d-flex  reveal_booked_appointment_info"><div class="col-lg-5 col-lg-7 card  mb-5 border-0 m-auto"><div class=""><div class="mb-4 dappr-text-h pt-4"><h3>Welcome ' . $name .'!</h3></div><span style="border-bottom:2px solid black; font-weight:600; padding-bottom:5px;">Reveal Coming Soon</span>';
                    $html_booking_info = '<div class="pt-0 mb-4 dappr-text-h" style="margin-top:1.5rem !important;"><h6>Sit tight, you can expect your reveal in about 2 months.</h6></div>';
                    $html_booking_info .= '<div class=" mb-3 custom_product_img_box pro_img_has  reveal_booked_appointment_info_section"><div class="reveal_booked_appointment_info_section_btn"><a onclick="return false;">REVEAL COMING SOON</a></div><div class="stylist_section_backgound_img" style="background-image: url(' . url('images/stylist/questions/section/women_clothing_style_and_fit_section_image.webp') . ');"></div></div>';
                }
                else if((strtotime($today) >= strtotime($reveal_create_45_days)) && (strtotime($today) <= strtotime($reveal_create_14_days)))
                {
                    $html = '<div class="container d-flex  reveal_booked_appointment_info"><div class="col-lg-5 col-lg-7 card  mb-5 border-0 m-auto"><div class=""><div class="mb-4 dappr-text-h pt-4"><h3>Welcome ' . $name .'!</h3></div><span style="border-bottom:2px solid black; font-weight:600; padding-bottom:5px;">New Reveal Upcoming</span>';
                    $html_booking_info = '<div class="pt-0 mb-4 dappr-text-h" style="margin-top:1.5rem !important;"><h6>Sit tight, you can expect your reveal in about 1 month.</h6></div>';
                    $html_booking_info .= '<div class=" mb-3 custom_product_img_box pro_img_has  reveal_booked_appointment_info_section"><div class="reveal_booked_appointment_info_section_btn"><a onclick="return false;">REVEAL COMING SOON</a></div><div class="stylist_section_backgound_img" style="background-image: url(' . url('images/stylist/questions/section/women_clothing_style_and_fit_section_image.webp') . ');"></div></div>';
                }
                else if((strtotime($today) >= strtotime($reveal_create_14_days)) && (strtotime($today) <= strtotime($reveal_create_date_3month)))
                {
                    $html = '<div class="container d-flex  reveal_booked_appointment_info"><div class="col-lg-5 col-lg-7 card  mb-5 border-0 m-auto"><div class=""><div class="mb-4 dappr-text-h pt-4"><h3>Welcome ' . $name .'!</h3></div><span style="border-bottom:2px solid black; font-weight:600; padding-bottom:5px;">Get Ready!</span>';
                    $html_booking_info = '<div class="pt-0 mb-4 dappr-text-h" style="margin-top:1.5rem !important;"><h6>Sit tight, you can expect your reveal in about 2 weeks.</h6></div>';
                    $html_booking_info .= '<div class=" mb-3 custom_product_img_box pro_img_has  reveal_booked_appointment_info_section"><div class="reveal_booked_appointment_info_section_btn"><a onclick="return false;">GET READY!</a></div><div class="stylist_section_backgound_img" style="background-image: url(' . url('images/stylist/questions/section/women_clothing_style_and_fit_section_image.webp') . ');"></div></div>';
                }
                else if((strtotime($today) >= strtotime($reveal_create_14_days)) && (strtotime($today) >= strtotime($reveal_create_date_3month)))
                {
                    $html = '<div class="container d-flex  reveal_booked_appointment_info"><div class="col-lg-5 col-lg-7 card  mb-5 border-0 m-auto"><div class=""><div class="mb-4 dappr-text-h pt-4"><h3>Welcome ' . $name . '!</h3></div><span style="border-bottom:1px solid black; font-weight:600; padding-bottom:5px;">In Progress</span>';
                    $html_booking_info = '<div class="pt-0 mb-4 dappr-text-h" style="margin-top: 2.5rem!important;"><h6 >We are currently working on your Reveal. Stay tuned.</h6></div>';
                    $html_booking_info .= '<div class=" mb-3 custom_product_img_box pro_img_has  reveal_booked_appointment_info_section"><div class="reveal_booked_appointment_info_section_btn"><a onclick="return false;">REVEAL COMING SOON</a></div><div class="stylist_section_backgound_img" style="background-image: url(' . url('images/stylist/questions/section/reveal_coming_soon.jpg') . ');"></div></div>';
                }
                $html .= $html_booking_info;
            }

            // End customer dashoard
            $html .= '<div class="botom-style-previous-rename ">';
            $html .= '<div class="preview_order_info preview_sub_heading_info p-0"><div class="mb-2 dappr-text-h"><span style="border-bottom:1px solid black; font-weight:600; padding-bottom:5px;">Your DAPPR Wardrobe</span></div>' . $buy_html . '</div></div></div></div>';
        }


        $output['html'] = $html;
        return $output;
    }

    // public function getCustomerReviewProductsDetails()
    // {
    //     $cutomer_obj = Auth::guard('customer')->user();
    //     $customer_id = $cutomer_obj->id;
    //     $client_info = StylistClientInfo::where('customer_id', $customer_id)->orderBy('id', 'desc')->get();
    //     $buy_product_ids = array();
    //     $decline_html = '';
    //     $decline_product = array();
    //     $feebback_html = '';
    //     if ($client_info->isNotEmpty()) {
    //         foreach ($client_info as $client_info_single) {
    //             $feedback_info_obj = StylistClientInfoDetails::where('stylist_info_id', $client_info_single->id)->get();
    //             if ($feedback_info_obj) {
    //                 foreach ($feedback_info_obj as $feedback_info_info) {
    //                     $price = 0;
    //                     if (in_array($feedback_info_info->product_id, $decline_product)) {
    //                         continue;
    //                     }
    //                     $product_obj = Product::where('active', '1')->where('id', $feedback_info_info->product_id)->with('categories', 'shop.logo', 'featureImage', 'image')
    //                         ->withCount('inventories')->orderBy('id', 'DESC')->first();
    //                     if ($product_obj) {
    //                         $decline_options = $feedback_info_info->decline_options;
    //                         $other_msg = '';
    //                         if ($decline_options != '') {
    //                             $decline_options_arr = explode('||', $decline_options);
    //                             if (in_array('other', $decline_options_arr)) {
    //                                 $other_msg = $feedback_info_info->other_msg;
    //                                 $other_msg = '<p>Comment: ' . $other_msg . '</p>';
    //                             }
    //                             $decline_options = "<p><b style='font-size: 17px; color: black;'>Reason for decline with:</b> " . implode(', ', $decline_options_arr) . '<p>';
    //                             $feebback_html .= '<div class="card img-product shadow"> <span class="img-product-pad"><h3>' . $product_obj->name . '</h3>' . $decline_options . $other_msg . '</span></div>';
    //                         }
    //                         $decline_product[] = $product_obj->id;
    //                         $img_src = '';
    //                         $inventory = Inventory::where('product_id', $product_obj->id)->first();
    //                         $sale_price = 0;
    //                         if ($inventory) {
    //                             $qty = $inventory->stock_quantity;
    //                             $sale_price = $inventory->sale_price;
    //                             foreach ($inventory->images as $img) {
    //                                 $img_src = url('') . '/image/' . $img->path;
    //                                 break;
    //                             }
    //                         }
    //                         $price = get_formated_price($sale_price, config('system_settings.decimals', 2));
    //                         if ($img_src == '') {
    //                             foreach ($product_obj->images as $img) {
    //                                 $img_src = url('') . '/image/' . $img->path;
    //                                 break;
    //                             }
    //                         }
    //                         if ($img_src == '') {
    //                             $img_src = url('images/stylist/product-placeholder.jpg');
    //                         }
    //                         $decline_html .= '<div class="col-md-4 img-product-1 "><div class="rounded"><img src="' . $img_src . '" alt=""  style="width: 100%;"></div><div class="articles-two"><h6>' . $product_obj->name . '</h6><h6>' . $price . '</h6></div></div>';
    //                     }
    //                 }
    //             }
    //             $selected_product_ids = $client_info_single->selected_product_ids;
    //             if ($selected_product_ids != '') {
    //                 $selected_product_ids = explode('||', $selected_product_ids);
    //                 $buy_product_ids = array_merge($buy_product_ids, $selected_product_ids);
    //             }
    //         }
    //     }
    //     $buy_product_ids = array_unique($buy_product_ids);
    //     $buy_product_ids = array();
    //     $order_product_ids = array();

    //     $buy_product_ids = array_unique($buy_product_ids);
    //     $item_cancel_item_hide =  '';
    //     $Cancellation_detail =  '';
    //     $order_details = Order::where('customer_id', $customer_id)->where('order_status_id', '!=', 8)->orderBydesc('id')->first();
    //     // $order_details = Order::where('customer_id', $customer_id)->where('order_status_id', '!=', 8)->where('order_status_id', '!=', 7)->orderBydesc('id')->first();
    //     if($order_details){
    //         $order_product_ids = explode(',', $order_details->reveal_products_ids);
    //         $buy_product_ids = array_unique($order_product_ids);
    //         $inventory_details = Inventory::where('product_id',$buy_product_ids)->first();
    //         if($inventory_details){
    //             $item_hide = '';
    //             $Cancellation_detail =  Cancellation::where('order_id', $order_details->id)->where('status',6)->first();
    //         }
    //     }
    //     else{
    //         $buy_product_ids = [];
    //     }
    //     $item_cancel_item_hide = $Cancellation_detail;
    //     $buy_products = $this->getProductDetails($order_product_ids);
    //     $buy_html = '';
    //     $attributes_name = '';
    //     $attributes_obj_info = '';
    //     $get_id_attribute ='';
    //     $attributeValues_data = '';
    //     $get_prduct_size = '';
    //     $buy_product_img_src = url('images/stylist/product-placeholder.jpg');
    //     if (is_array($buy_products) && count($buy_products) && isset($buy_products)) {
    //         foreach ($buy_products as $buy_product_info) {
    //             $buy_product_obj = $buy_product_info['product_obj'];
    //             $buy_inventory_obj = $buy_product_info['inventory_obj'];
    //             $attributes_obj = $buy_product_info['attributes'];


    //             if(isset($attributes_obj))
    //             {
    //                 // echo $attributes_name = $attributes_obj->name;

    //                 foreach($attributes_obj as $attributes_obj_info)
    //                 {
    //                     // echo $attributes_obj_info->name;
    //                     if($attributes_obj_info->name == 'Size')
    //                     {
    //                         $get_id_attribute  = $attributes_obj_info->attribute_type_id;
    //                         $attributeValues_data = $attributes_obj_info['attributeValues'];
    //                         if(isset($attributeValues_data));
    //                         {
    //                             // echo $attributeValues_data->value;
    //                             foreach($attributeValues_data as $attributeValues_info)
    //                             {
    //                                 $get_prduct_size =  $attributeValues_info->value;
    //                             }
    //                         }

    //                     }
    //                 }
    //             }


    //             $price = 0;
    //             if ($buy_inventory_obj) {
    //                 $price = $buy_inventory_obj->current_sale_price();
    //                 foreach ($buy_inventory_obj->images as $img) {
    //                     $buy_product_img_src = url('') . '/image/' . $img->path;
    //                     break;
    //                 }
    //             }
    //             if ($buy_product_img_src != '') {
    //                 foreach ($buy_product_obj->images as $img) {
    //                     $buy_product_img_src = url('') . '/image/' . $img->path;
    //                     break;
    //                 }
    //             }
    //             $price = get_formated_price($price, config('system_settings.decimals', 2));
    //             $cancel_item_hide = '';
    //             $force_hie = '';
    //             $approved_items = '';
    //             $decline_item = '';
    //             if (isset($item_cancel_item_hide->items) && in_array($buy_inventory_obj->id, $item_cancel_item_hide->items)) {
    //                 $exchnage_return_option = $item_cancel_item_hide->exchnage_return_option;
    //                 $exchnage_return_option_decde = json_decode($exchnage_return_option, true);
    //                 $approved_items = explode(',', $item_cancel_item_hide->approve_items);
    //                 $decline_item = explode(',', $item_cancel_item_hide->decline_item);
    //                 // print_r($approved_items);

    //                 foreach ($exchnage_return_option_decde as $key => $value) {
    //                     $force_hie = '';
    //                     if (($buy_inventory_obj->id == $key) && ($value == 'exchange')) {
    //                         $cancel_item_hide = 'display:block';
    //                     }elseif (($buy_inventory_obj->id == $key) && ($value == 'refund') && (in_array($buy_inventory_obj->id,$approved_items ))) {
    //                         $cancel_item_hide = 'display:none';
    //                     }
    //                     elseif (($buy_inventory_obj->id == $key) && ($value == 'refund') && (in_array($buy_inventory_obj->id,$decline_item ))) {
    //                         $cancel_item_hide = 'display:block';
    //                     }
    //                     else {
    //                         $force_hie = 'display:block';
    //                     }
    //                 }
    //             }
    //             // $get_prduct_size
    //             $buy_html .= '<div class="col-md-4  img-product-1 " style="'.$cancel_item_hide.'"><div class="rounded"><img src="' . $buy_product_img_src . '" alt=""  style="width: 100%;"></div><div class="articles-two"><h6>' . $buy_product_obj->brand . '</h6><h6>' . $buy_product_obj->name . '</h6></div></div>';
    //             // <h6>' . $get_prduct_size . '</h6><h6>' . $price . '</h6>
    //         }
    //     }
    //     else
    //     {
    //         $buy_html = "<p style='font-family: Arimo,sans-serif; margin-top:1.5rem !important;'>Nothing to show here yet</p>";
    //     }
    //     $previous_reveal_html = '<p>Nothing to show here yet</p>';
    //     $booking_obj = StylistClientBookingAppointments::where('customer_id', $customer_id)->first();
    //     $reveal_show_prview_day = stylistShowPreviousRevealBeforeDayHelper();
    //     if (isset($booking_obj)) {

    //         $order_reveal_ids = array();
    //         $order_details = Order::where('customer_id', $customer_id)->pluck('reveal_id')->toArray();
    //         if (is_array($order_details) && count($order_details)) {
    //             $order_reveal_ids = $order_details;
    //         }


    //         $reveal_list_obj = stylistRevealsItems::whereIn('id', $order_reveal_ids)->get();

    //         if ($reveal_list_obj->isNotEmpty()) {

    //             $previous_reveal_html = '';
    //             $img_url = 0;
    //             foreach ($reveal_list_obj as $reveal_info) {

    //                 $img_url++;
    //                 if ($img_url == 3) {
    //                     $img_url = 1;
    //                 }

    //                 $reveal_id = $reveal_info->id;
    //                 $reveal_name = $reveal_info->name;
    //                 $updated_at = $reveal_info->updated_at;
    //                 $rand_code = Crypt::encryptString($reveal_id);
    //                 $booking_id = $booking_obj->id;

    //                 if ($reveal_name == '') {
    //                     $reveal_name = 'Reveal ';
    //                 }
    //                 $updated_at = (date("d-m-Y", strtotime($updated_at)));
    //                 $reveal_name = $reveal_name . ' ' . $updated_at;

    //                 $reveal_link = url("stylist/reveal/" . $booking_id . "/" . $reveal_id . '/' . $rand_code);
    //                 $previous_reveal_html .= '<div class=" mb-3 custom_product_img_box pro_img_has  reveal_booked_appointment_info_section">
    //                                 <div class="reveal_booked_appointment_info_section_btn"><a href=' . $reveal_link . '>' . $reveal_name . '</a></div>
    //                                   <div class="stylist_section_backgound_img" style="background-image: url(' . url('images/stylist/questions/section/') . '/' . $img_url . '.jpg?' . rand(10, 1000) . ');"></div>
    //                  </div>';
    //             }
    //         }

    //     }

    //     $return = array();
    //     $return['decline_html'] = $decline_html;
    //     $return['feebback_html'] = $feebback_html;
    //     $return['buy_html'] = $buy_html;
    //     $return['previous_reveal_html'] = $previous_reveal_html;

    //     return $return;
    // }


    public function getCustomerReviewProductsDetails()
    {
        $cutomer_obj = Auth::guard('customer')->user();
        $customer_id = $cutomer_obj->id;
        $client_info = StylistClientInfo::where('customer_id', $customer_id)->orderBy('id', 'desc')->get();
        $buy_product_ids = array();
        $decline_html = '';
        $buy_html ='';
        $decline_product = array();
        $feebback_html = '';
        if ($client_info->isNotEmpty()) {
            foreach ($client_info as $client_info_single) {
                $feedback_info_obj = StylistClientInfoDetails::where('stylist_info_id', $client_info_single->id)->get();
                if ($feedback_info_obj) {
                    foreach ($feedback_info_obj as $feedback_info_info) {
                        $price = 0;
                        if (in_array($feedback_info_info->product_id, $decline_product)) {
                            continue;
                        }
                        $product_obj = Product::where('active', '1')->where('id', $feedback_info_info->product_id)->with('categories', 'shop.logo', 'featureImage', 'image')
                            ->withCount('inventories')->orderBy('id', 'DESC')->first();
                        if ($product_obj) {
                            $decline_options = $feedback_info_info->decline_options;
                            $other_msg = '';
                            if ($decline_options != '') {
                                $decline_options_arr = explode('||', $decline_options);
                                if (in_array('other', $decline_options_arr)) {
                                    $other_msg = $feedback_info_info->other_msg;
                                    $other_msg = '<p>Comment: ' . $other_msg . '</p>';
                                }
                                $decline_options = "<p><b style='font-size: 17px; color: black;'>Reason for decline with:</b> " . implode(', ', $decline_options_arr) . '<p>';
                                $feebback_html .= '<div class="card img-product shadow"> <span class="img-product-pad"><h3>' . $product_obj->name . '</h3>' . $decline_options . $other_msg . '</span></div>';
                            }
                            $decline_product[] = $product_obj->id;
                            $img_src = '';
                            $inventory = Inventory::where('product_id', $product_obj->id)->first();
                            $sale_price = 0;
                            if ($inventory) {
                                $qty = $inventory->stock_quantity;
                                $sale_price = $inventory->sale_price;
                                foreach ($inventory->images as $img) {
                                    $img_src = url('') . '/image/' . $img->path;
                                    break;
                                }
                            }
                            $price = get_formated_price($sale_price, config('system_settings.decimals', 2));
                            if ($img_src == '') {
                                foreach ($product_obj->images as $img) {
                                    $img_src = url('') . '/image/' . $img->path;
                                    break;
                                }
                            }
                            if ($img_src == '') {
                                $img_src = url('images/stylist/product-placeholder.jpg');
                            }
                            $decline_html .= '<div class="col-md-4 img-product-1 "><div class="rounded"><img src="' . $img_src . '" alt=""  style="width: 100%;"></div><div class="articles-two"><h6>' . $product_obj->name . '</h6><h6>' . $price . '</h6></div></div>';
                        }
                    }
                }
                $selected_product_ids = $client_info_single->selected_product_ids;
                if ($selected_product_ids != '') {
                    $selected_product_ids = explode('||', $selected_product_ids);
                    $buy_product_ids = array_merge($buy_product_ids, $selected_product_ids);
                }
            }
        }
        $buy_product_ids = array_unique($buy_product_ids);
        $buy_product_ids = array();
        $order_product_ids = array();

        $buy_product_ids = array_unique($buy_product_ids);
        $item_cancel_item_hide =  '';
        $Cancellation_detail =  '';
        $cancel_item_hide ='';
        $forced_hide_items = '';
        $exchange_option = '';
        $approvedids = '';
        $declienids = '';
        $json_encode_exchange_option = '';
        $json_encode_approvedids = '';
        $json_encode_declienids = '';
        $Cancellation_detail = '';
        $product_image_html = "";
        $product_brand = '';
        $product_name = '';
        $perPage = 6;
        $page = request()->input('page', 1);

        // $orders = Auth::guard('customer')
        // ->user()
        // ->orders()
        // ->when(request()->has('q'), function ($query) {
        //     $query->where('order_number', 'like', '%' . request()->input('q') . '%');
        // })
        // ->with([
        //     'shop:id,name,slug',
        //     'inventories:id,title,slug,product_id,description,brand',
        //     'inventories.image:path,imageable_id,imageable_type' => function ($query) {
        //         $query->orderBy('id');
        //     },
        //     'inventories.product.image:path,imageable_id,imageable_type',
        //     'cancellation',
        // ])
        // ->orderBy('id', 'desc')->paginate(1);
        $order_details_data = Order::where('customer_id', $customer_id)->orderBy('id', 'desc')->paginate(1);
        $buy_products_links = '';
        if($order_details_data->isNotEmpty())
        {
            foreach($order_details_data as $order_details)
            {
                $order_product_ids = explode(',', $order_details->reveal_products_ids);
                $buy_product_ids = array_unique($order_product_ids);
            }
            $Cancellation_detail =  Cancellation::where('order_id', $order_details->id)->where('status',6)->latest()->first();
        }
        else
        {
            $buy_product_ids = [];
        }
        $buy_products = $this->getbuyProductDetails($buy_product_ids);
        $buy_products_links .= '<div class="paginate_num">'.$order_details_data->links().'</div>';


        if (is_array($buy_products) && count($buy_products))
        {
            foreach ($buy_products as $buy_product_info)
            {
                $buy_product_img_src = '';
                $buy_product_obj = $buy_product_info['product_obj'];
                $buy_inventory_obj = $buy_product_info['inventory_obj'];
                $price = 0;
                // ------------------------------
                // $attributes_obj = $buy_product_info['attributes'];
                // if(isset($attributes_obj))
                // {
                //     foreach($attributes_obj as $attributes_obj_info)
                //     {
                //         if($attributes_obj_info->name == 'Size')
                //         {
                //             $get_id_attribute = $attributes_obj_info->attribute_type_id;
                //             $attributeValues_data = $attributes_obj_info['attributeValues'];
                //             if(isset($attributeValues_data));
                //             {
                //                 foreach($attributeValues_data as $attributeValues_info)
                //                 {
                //                     $get_prduct_size = $attributeValues_info->value;
                //                 }
                //             }
                //         }
                //     }
                // }
                // ------------------------------
                if ($buy_inventory_obj)
                {
                    $price = $buy_inventory_obj->current_sale_price();
                    foreach ($buy_inventory_obj->images as $img)
                    {
                        $buy_product_img_src = url('') . '/image/' . $img->path;
                        break;
                    }
                }
                if ($buy_product_img_src == '')
                {
                    foreach ($buy_product_obj->images as $img)
                    {
                        $buy_product_img_src = url('') . '/image/' . $img->path;
                        break;
                    }
                }
                if ($buy_product_img_src == '')
                {
                    $buy_product_img_src = url('images/stylist/product-placeholder.jpg');
                }
                $price = get_formated_price($price, config('system_settings.decimals', 2));
                $cancel_item_hide = '';
                $approved_refund = '';
                $declient_refund = '';
                $force_hie = '';
                $description_new = '';
                $description_new_decode = '';
                $descriptionnew = '';
                $exchange_more_option_info = '';
                $exchange_more_option_info_decode = '';
                $exchange_moreoptioninfo = '';

                if (isset($Cancellation_detail->items) && in_array($buy_inventory_obj->id,  $Cancellation_detail->items))
                {

                    $exchnage_return_option = $Cancellation_detail->exchnage_return_option;
                    $exchnage_return_option_decde = json_decode($exchnage_return_option, true);
                    $approved_refund = explode(',', $Cancellation_detail->approve_items);
                    $declient_refund = explode(',', $Cancellation_detail->decline_item);

                    if(array_key_exists($buy_inventory_obj->id, $exchnage_return_option_decde) && ($exchnage_return_option_decde[$buy_inventory_obj->id] == 'exchange') && in_array($buy_inventory_obj->id,$approved_refund ) )
                    {
                        $cancel_item_hide = 'display:block;';
                    }
                    else if(array_key_exists($buy_inventory_obj->id, $exchnage_return_option_decde) && ($exchnage_return_option_decde[$buy_inventory_obj->id] == 'exchange') && in_array($buy_inventory_obj->id,$declient_refund ) )
                    {
                        $cancel_item_hide = 'display:none;';
                    }
                    else if(array_key_exists($buy_inventory_obj->id, $exchnage_return_option_decde) && ($exchnage_return_option_decde[$buy_inventory_obj->id] == 'refund') && in_array($buy_inventory_obj->id,$approved_refund ))
                    {
                        $cancel_item_hide = 'display:none;';
                    }
                    else if(array_key_exists($buy_inventory_obj->id, $exchnage_return_option_decde) && ($exchnage_return_option_decde[$buy_inventory_obj->id] == 'refund') && in_array($buy_inventory_obj->id,$declient_refund ) )
                    {
                        $cancel_item_hide = 'display:block;';
                    }
                    else
                    {
                        $cancel_item_hide = 'display:block;';
                    }
                }
                $buy_html .= '<div class="col-md-4  img-product-1 " style="'.$cancel_item_hide.'"><div class="rounded"><img src="' . $buy_product_img_src . '" alt=""></div><div class="articles-two"><h6>'.$buy_product_obj->brand.'</h6><h6>'.$buy_product_obj->name.'</h6></div></div>';

            }
            $buy_html .= $buy_products_links;
        }



        $previous_reveal_html = '';

        $booking_obj = StylistClientBookingAppointments::where('customer_id', $customer_id)->first();
        $reveal_show_prview_day = stylistShowPreviousRevealBeforeDayHelper();
        if (isset($booking_obj)) {

            $order_reveal_ids = array();
            $order_details = Order::where('customer_id', $customer_id)->pluck('reveal_id')->toArray();
            if (is_array($order_details) && count($order_details)) {
                $order_reveal_ids = $order_details;
            }


            $reveal_list_obj = stylistRevealsItems::whereIn('id', $order_reveal_ids)->get();

            if ($reveal_list_obj->isNotEmpty()) {

                $previous_reveal_html = '';
                $img_url = 0;
                foreach ($reveal_list_obj as $reveal_info) {

                    $img_url++;
                    if ($img_url == 3) {
                        $img_url = 1;
                    }

                    $reveal_id = $reveal_info->id;
                    $reveal_name = $reveal_info->name;
                    $updated_at = $reveal_info->updated_at;
                    $rand_code = Crypt::encryptString($reveal_id);
                    $booking_id = $booking_obj->id;

                    if ($reveal_name == '') {
                        $reveal_name = 'Reveal ';
                    }
                    $updated_at = (date("d-m-Y", strtotime($updated_at)));
                    $reveal_name = $reveal_name . ' ' . $updated_at;

                    $reveal_link = url("stylist/reveal/" . $booking_id . "/" . $reveal_id . '/' . $rand_code);
                    $previous_reveal_html .= '<div class=" mb-3 custom_product_img_box pro_img_has  reveal_booked_appointment_info_section">
                                    <div class="reveal_booked_appointment_info_section_btn"><a href=' . $reveal_link . '>' . $reveal_name . '</a></div>
                                      <div class="stylist_section_backgound_img" style="background-image: url(' . url('images/stylist/questions/section/') . '/' . $img_url . '.jpg?' . rand(10, 1000) . ');"></div>
                     </div>';
                }
            }

        }

        $return = array();
        $return['decline_html'] = $decline_html;
        $return['feebback_html'] = $feebback_html;
        $return['buy_html'] = $buy_html;
        $return['previous_reveal_html'] = $previous_reveal_html;
        $return['buy_products_links'] = $buy_products_links;

        return $return;
    }


    public function getbuyProductDetails($product_ids_array)
    {

        $products_obj = Product::find($product_ids_array)->where('active', 1);
        $products_obj_array = array();
        if ($products_obj->isNotEmpty()) {

            foreach ($products_obj as $product_obj) {
                $inventory = Inventory::where('product_id', $product_obj->id)->first();

                if(isset($inventory))
                {
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
                    $products_obj_array[$product_obj->id] = array('product_obj' => $product_obj, 'inventory_obj' => $inventory, 'attributes' => $attributes);
                }



            }
        }

        return $products_obj_array;
    }
    public function createCouponForCompanyByUser($cart_details)
    {

        $discount_price = 0;
        $login_cutomer_obj = Auth::guard('customer')->user();
        $customer_id = $login_cutomer_obj->id;

        // -------------------------------------------------------
        $customer_name = $login_cutomer_obj->name;

        $stylist_Users_info = stylistUsers::Where('user_id', $customer_id)->first();

        if (isset($stylist_Users_info)) {
            $user_id = $stylist_Users_info->user_id;
            $company_id = $stylist_Users_info->company_id;
            //  $user_id ."<br>" .$stylist_Users_info ."<br>";

            $get_compnay_info = employerOnboardingQuestionnaire::Where('id', $company_id)->first();
            if (isset($get_compnay_info)) {
                $employe_company_id = $get_compnay_info->id;
                $employe_compnay_name = $get_compnay_info->company_name;
                //  $employe_company_id ."<br>" .$get_compnay_info;

                $additional_amount_status_info = employerOnboardingQuestionnaireValues::Where('name', 'additional_amount_status')->Where('employer_onboarding_questionnaires_id', $employe_company_id)->first();

                if (isset($additional_amount_status_info) && ($additional_amount_status_info->value == 1)) {
                    $additional_amount_info = employerOnboardingQuestionnaireValues::Where('name', 'additional_amount')->Where('employer_onboarding_questionnaires_id', $employe_company_id)->first();
                    if (isset($additional_amount_info)) {

                        $discount_price = (int) $additional_amount_info->value;
                    }

                }

            }

        }

        $output = array();

        if ($discount_price != 0) {
            $texr_default = 'off by company';
            $price = $discount_price / 4;
            $price = number_format((float) $price, 2, '.', ''); // Outputs -> 105.00

            $price = $price;
            $name = $price . ' ' . $texr_default;
            $code = $price . '-' . str_replace(' ', '-', $texr_default);

            $code = time() . rand(10, 1000);

            $shop_id = $cart_details->shop_id;

            //$coupon_has = Coupon::where('code',$code)->where('value',$price)->first();
            $coupon_has = Coupon::where('code', $code)->first();
            if ($coupon_has) {
                $output['code_already_has'] = 'Y';
            } else {
                $coupon_obj = new Coupon();
                $coupon_obj->name = $name;
                $coupon_obj->active = 1;
                $coupon_obj->code = $code;
                $coupon_obj->value = $price;
                $coupon_obj->type = 'amount';
                $coupon_obj->quantity = '1';
                $coupon_obj->starting_time = date('Y-m-d h:i:s a');
                $tomorrow = date("Y-m-d  h:i:s a", time() + 86400);

                $coupon_obj->ending_time = $tomorrow;
                // date("Y-m-d", time() + 86400)
                $coupon_obj->shop_id = $shop_id;
                $coupon_obj->quantity_per_customer = 100;
                $coupon_obj->save();
                $output['code_already_has'] = 'N';
            }
            $output['code'] = $code;
            $output['price'] = $price;

            $coupon = Coupon::active()->where([
                ['code', $output['code']],
                ['shop_id', $shop_id],
            ])->withCount(['orders', 'customerOrders'])->first();

            $coupon_is_apply_or_not = true;
            if (!$coupon) {

                $coupon_is_apply_or_not = false;
            }

            if (!$coupon->isLive() || !$coupon->isValidCustomer()) {
                $coupon_is_apply_or_not = false;

            }

            $zone = 1;
            if (!$coupon->isValidZone($zone)) {
                $coupon_is_apply_or_not = false;

            }

            if (!$coupon->hasQtt()) {
                $coupon_is_apply_or_not = false;

            }

            // Get the cart
            $cart = Cart::find($cart_details->id);

            if (!$cart) {
                $coupon_is_apply_or_not = false;
            }

            if ($coupon->min_order_amount && $cart->total < $coupon->min_order_amount) {
                $coupon_is_apply_or_not = false;
            }

            if ($coupon_is_apply_or_not) {

                // Set coupon_id to the cart
                $cart->coupon_id = $coupon->id;

                // Get discounted amount
                $cart->discount = $cart->get_discounted_amount();

                // When the coupon value is bigger/equal of cart total
                if ($cart->discount >= $cart->total) {
                    $cart->discount = $cart->total;
                    $coupon->value = $cart->total;
                }

                // Update cart
                $cart->grand_total = $cart->calculate_grand_total();
                $cart->save();
                $output['code_apply'] = 'Y';

            }

        }

        return $output;

    }

    public function addRevealChangeHistory($booking_id = 0, $reveal_id = 0, $status = '', $comment = '')
    {
        $obj = new stylistClientBookingAppointmentsChangeStatusHistory();
        $obj->booking_id = $booking_id;
        $obj->reveal_id = $reveal_id;
        $obj->comment = $comment;
        $obj->status = $status;
        $obj->save();
    }

    public function getquestion()
    {
        Session::put('stylist_q_budget_cal', '');
        $customer = Auth::guard('customer')->check() ? Auth::guard('customer')->user() : null;
        $customer_id = $customer->id;
        $question = StylistCustomerQuestionsAnswer::where('customer_id', $customer_id)->OrderBy('question_id')->get();

        if($question->isNotEmpty())
        {
            foreach ($question as $question_key => $question_value)
            {
                $question_id = $question_value->question_id;
                $answer_id = $question_value->answer_ids ;
                $type = $question_value->type;
                $question_obj = stylistQuestions::where('id', $question_id)->first();
                if (isset($question_obj))
                {
                    $skip_id = $question_obj->skip_id;
                    $catogary_id = $question_obj->question_catogary;
                    if ($question_obj->q_type == 'budget_calculate_q') {
                        $answer_obj = stylistQuestionsAnswers::find($answer_id);
                        if (isset($answer_obj)) {
                            Session::put('stylist_q_budget_cal.' . $catogary_id . '.' . $skip_id . '.' . $question_id, $answer_obj->value);
                        }
                    } else if ($question_obj->q_type == 'budget_calculate_depend_on_ans') {
                        $answer_obj = stylistQuestionsAnswers::find($answer_id);
                        if (isset($answer_obj)) {
                            $skip_question_id = $answer_obj->skip_question_id;
                            if ($skip_question_id != '') {
                                Session::put('stylist_q_budget_cal.' . $catogary_id . '.' . $skip_question_id, '');
                            }
                        }
                    }
                    elseif ($question_obj->q_type == 'budget_calculate_price_show')
                    {
                        $stylist_q_budget_cal = Session::get('stylist_q_budget_cal.' . $catogary_id);
                        if (isset($stylist_q_budget_cal) && is_array($stylist_q_budget_cal) && count($stylist_q_budget_cal))
                        {
                            $budget_price = 0;
                            $total_item = 0;
                            foreach ($stylist_q_budget_cal as $stylist_q_budget_info)
                            {
                                if (is_array($stylist_q_budget_info) && count($stylist_q_budget_info)==2)
                                {
                                    $values = array_values($stylist_q_budget_info);
                                    $price = 0;
                                    $qty = 1;
                                    if ($values[0]) {
                                        $price = $values[0];
                                    }
                                    if ($values[1]) {
                                        $qty = $values[1];
                                    }

                                    $total_item = $total_item + (int) $qty;

                                    $budget_price = (int) $budget_price + ((int) $price * (int) $qty);
                                }

                            }
                            if($total_item != 0)
                            {
                             $budget_price = $budget_price / $total_item;

                            }
                            $question_obj = stylistQuestions::where('question_catogary', $catogary_id)->where('q_type', 'budget_calculate_price_update')->first();

                            $skip_id = $question_obj->skip_id;
                            $name = $question_obj->name;
                            $budget_price2 = 0;
                            if ($budget_price != 0)
                            {
                                $budget_price2 = $budget_price ;
                            }
                            $skip_id_budget = 'stylist_1234';
                            Session::put('stylist_q_budget_cal_total.' . $catogary_id . '.' . $skip_id_budget, $budget_price);
                        }

                    }
                }

            }
        }

    }

    public function questioninfo($data)
    {
       $output = array();
        foreach ($data as $question_ans_info) {

            $question_id = 0;
            $answer_id = 0;
            $type = '';
            if (isset($question_ans_info['question_id'])) {
                $question_id = $question_ans_info['question_id'];
            }

            if (isset($question_ans_info['answer_id'])) {
                $answer_id = $question_ans_info['answer_id'];
            }
            $question_obj = stylistQuestions::where('id', $question_id)->first();

            if (isset($question_obj)) {
                $skip_id = $question_obj->skip_id;
                $catogary_id = $question_obj->question_catogary;
                if ($question_obj->q_type == 'budget_calculate_q') {

                    $answer_obj = stylistQuestionsAnswers::find($answer_id);
                    if (isset($answer_obj)) {

                        Session::put('stylist_q_budget_cal.' . $catogary_id . '.' . $skip_id . '.' . $question_id, $answer_obj->value);

                    }

                } else if ($question_obj->q_type == 'budget_calculate_depend_on_ans') {

                    $answer_obj = stylistQuestionsAnswers::find($answer_id);
                    if (isset($answer_obj)) {
                        $skip_question_id = $answer_obj->skip_question_id;
                        if ($skip_question_id != '') {
                            Session::put('stylist_q_budget_cal.' . $catogary_id . '.' . $skip_question_id, '');

                        }

                    }

                } else if ($question_obj->q_type == 'budget_calculate_price_show') {

                    $stylist_q_budget_cal = Session::get('stylist_q_budget_cal.' . $catogary_id);
                    if (isset($stylist_q_budget_cal) && is_array($stylist_q_budget_cal) && count($stylist_q_budget_cal)) {
                        $budget_price = 0;
                        $total_item = 0;
                        foreach ($stylist_q_budget_cal as $stylist_q_budget_info) {
                            if (is_array($stylist_q_budget_info) && count($stylist_q_budget_info)==2) {
                                $values = array_values($stylist_q_budget_info);
                                $price = 0;
                                $qty = 1;
                                if ($values[0]) {
                                    $price = $values[0];
                                }
                                if ($values[1]) {
                                    $qty = $values[1];
                                }

                                $total_item = $total_item + (int) $qty;
                                $budget_price = (int) $budget_price + ((int) $price * (int) $qty);
                            }

                        }
                        $budget_price = $budget_price / $total_item;

                        $question_obj = stylistQuestions::where('question_catogary', $catogary_id)->where('q_type', 'budget_calculate_price_update')->first();

                        $skip_id = $question_obj->skip_id;
                        $name = $question_obj->name;
                        $budget_price2 = 0;
                        if ($budget_price != 0) {
                            $budget_price2 = $budget_price * 5;
                        }
                        $skip_id_budget = 'stylist_1234';
                        Session::put('stylist_q_budget_cal_total.' . $catogary_id . '.' . $skip_id_budget, $budget_price);

                        if (isset($question_obj)) {
                            $output['budget_price'] = $budget_price;
                            $output['budget_price2'] = (int)round($budget_price2);
                            $budget_price2 = get_formated_price($budget_price2);
                            $name = str_replace('$---', $budget_price2, $name);
                            $output['budget_cal']['name'] = $name . '<span class="py-2 gett-text-pque ">*</span>';
                            $output['budget_cal']['skip_id'] = $skip_id;
                        }
                    }

                }

            }

        }
        return $output;
    }

    public function cancel_order(request $request)
    {
        $customer_id = Auth::user()->id;
        $orders = Auth::guard('customer')
        ->user()
        ->orders()
        ->when(request()->has('q'), function ($query) {
            $query->where('order_number', 'like', '%' . request()->input('q') . '%');
        })
        ->with([
            'shop:id,name,slug',
            'inventories:id,title,slug,product_id,description,brand',
            'inventories.image:path,imageable_id,imageable_type',
            'inventories.product.image:path,imageable_id,imageable_type',
            'cancellation',
        ])
        ->orderBy('id', 'desc')
        ->latest()
        ->first();


        $cancellation_info =  Cancellation::where('customer_id', $customer_id)->get();
        $items_id = '';
        $item_id_data = '';
        $items_order_id = '';
        $items_order_id_data = '';
        $heading_hmtl =  '';
        if($cancellation_info->isNotEmpty())
        {
            foreach($cancellation_info as $cancellation_data)
            {
                $items_id = $cancellation_data->items;
                $items_order_id = $cancellation_data->order_id;
            }

        }
        $item_id_data =  $items_id;
        $items_order_id_data =  $items_order_id;

        $old_data =Cancellation::where('customer_id', $customer_id)->orderby('id', 'desc')->first();
        $item_id = '';
        if(isset($old_data))
        {
            $item_id = $old_data->items;
        }
        return view('theme::cancel_item' , compact('orders', 'cancellation_info', 'item_id_data', 'items_order_id_data'));
    }


    public function order_cancel_request(request $request,  Order $order)
    {
        $customer_id = Auth::user()->id;
        $old_data =Cancellation::where('customer_id', $customer_id)->orderby('id', 'desc')->first();
        $old_item_ids = '';
        $add_item_retex ='';
        if(isset($old_data))
        {
            $old_item_ids = $old_data->items;
            $add_item_retex = json_decode($old_data->exchnage_return_option, true);
        }

        if(is_array($request->data) && count($request->data))
        {
            $shop_id = '';
            $reveal_id ='';
            $dta_merge ='';
            $cancellation_reason_id = 16;
            $order_details = array();
            foreach ($request->data as $request_info) {
                $order_id = $request_info['order_id'];
                $exchnage_return_option = $request_info['exchnage_return_option'];
                $order_id = $request_info['order_id'];
                $product_id = $request_info['product_id'];
                $description_comment = $request_info['description_comment'];
                $exchange_more_option = $request_info['exchange_more_option'];
                $return_more_option = $request_info['return_more_option'];
                $return_more_sub_option = $request_info['return_more_sub_option'];
                $order_details[ $order_id]['cancellation_reason_id'] = $cancellation_reason_id;
                $order_details[ $order_id]['items'][] = $product_id;
                $order_details[ $order_id]['description'] = $description_comment;
                $order_details[ $order_id]['description_new'][$product_id] = $description_comment;
                $order_details[ $order_id]['exchnage_return_option'][$product_id] = $exchnage_return_option;
                $order_details[ $order_id]['exchange_more_option'][$product_id] = $exchange_more_option;
                $order_details[ $order_id]['return_more_option'][$product_id] = $return_more_option;
                $order_details[ $order_id]['return_more_sub_option'][$product_id] = $return_more_sub_option;
                $order_details[ $order_id]['order_id'] = $order_id;
            }
            foreach ($order_details as $request_info) {
                $cancellation_reason_id = $request_info['cancellation_reason_id'];
                $exchnage_return_option = $request_info['exchnage_return_option'];
                $order_id = $request_info['order_id'];
                $product_id = $request_info['items'];
                $description = $request_info['description'];
                $description_new = $request_info['description_new'];
                $exchange_more_option = $request_info['exchange_more_option'];
                $return_more_option = $request_info['return_more_option'];
                $return_more_sub_option = $request_info['return_more_sub_option'];
                $data = array();
                $data['customer_id'] = $customer_id;
                $data['cancellation_reason_id'] = $cancellation_reason_id;
                $items_new =  $product_id;
                if(!empty($old_item_ids)){
                    $items_new =   array_merge($old_item_ids, $product_id);
                }
                $data['items'] = $items_new;
                $data['description'] = $description;
                $data['order_id'] = $order_id;
                $data['description_new'] = json_encode($description_new);

                if(!empty($old_item_ids)){
                    $exchnage_return_option = array_replace_recursive($add_item_retex,$exchnage_return_option);
                }

                $data['exchnage_return_option'] = json_encode($exchnage_return_option);
                $data['exchange_more_option'] = json_encode($exchange_more_option);
                $data['return_more_option'] = json_encode($return_more_option);
                $data['return_more_sub_option'] = json_encode($return_more_sub_option);
                $order = Order::where('id',$order_id)->first();
                $shop_id = $order->shop_id;
                $reveal_id = $order->reveal_id;
                $data['shop_id'] = $shop_id;
                $data['reveal_id'] = $reveal_id;
                if ($order->cancellation && isset($old_item_ids)) {
                    $order->cancellation->update($data);
                    $order->cancellation->resetStatus();
                } else {
                    $order->cancellation()->create($data);
                }
            }
        }
        event(new OrderCancellationRequestCreated($order));
        $get_booking_data =  StylistClientBookingAppointments::where('customer_id', $customer_id)->first();
        $status_1 = $this->getRevealStatusNameByKey('return_initiated');
        if($get_booking_data)
        {
            StylistClientBookingAppointments::where('customer_id', $customer_id)->update(['status' => $status_1]);
            $reveal_data = stylistRevealsItems::where('booking_id', $get_booking_data->id)->first();
            if($reveal_data)
            {
                stylistRevealsItems::where('booking_id', $get_booking_data->id)->where('status', '!=', 'draft')->update(['status' => $status_1]);
            }
        }
        $filters_status_update = '';
        $cancel_id = '';
        $cancellation_status = '';
        $cancellation_data ='';

        $cancellation_data = Cancellation::where('customer_id', $customer_id)->orderby('id', 'desc')->first();
        if(isset($cancellation_data))
        {
            $cancel_id = $cancellation_data->id;
            $cancellation_status = $cancellation_data->status;
            $filters_status_update  = StatusFilterModel::where('customer_id', $customer_id)->where('order_id', $cancellation_data->order_id)->latest()->first();
            if($filters_status_update)
            {

                $filters_status_update->cancel_id = $cancel_id;
                $filters_status_update->cancellation_status = $cancellation_status;
                $filters_status_update->reveal_status =$status_1;
                $filters_status_update->update();
            }
        }
    }
}
