<?php

namespace App\Http\Controllers\StylistForm;

use App\Helpers\ListHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\EmployerOnboardingQuestionnaireRequest;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Category;
use App\Models\CategoryGroup;
use App\Models\CategorySubGroup;
use App\Models\Customer;
use App\Models\EmailTemplate;
use App\Models\employerOnboardingQuestionnaire;
use App\Models\employerOnboardingQuestionnaireValues;
use App\Models\Image;
use App\Models\Inventory;
use App\Models\Manufacturer;
use App\Models\Product;
use App\Models\StylistClientBookingAppointments;
use App\Models\stylistClientBookingAppointmentsSendResponse;
use App\Models\StylistClientInfo;
use App\Models\StylistClientInfoDetails;
use App\Models\StylistCustomerQuestionsAnswer;
use App\Models\StylistForm;
use App\Models\stylistQuestionCatogaries;
use App\Models\stylistQuestions;
use App\Models\stylistQuestionsAnswers;
use App\Models\stylistRevealsItems;
use App\Models\StylistTags;
use App\Models\stylistUsers;
use App\Models\StylistUserTags;
use App\Models\stylistClientBookingAppointmentsChangeStatusHistory;
use App\Models\stylistTagCatogaries;
use App\Models\Cancellation;
use App\Models\MechantAvailability;
use Auth;
use DB;
use DOMDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Admin\OrderController;
use App\Models\Order;
use DateTime;
// use App\Models\stylistRevealsItems;
//use App\Repositories\Inventory\InventoryRepository;
use App\Models\Blog;
use App\Models\User;
use App\Models\Shop;
use App\Models\OrderItem;
use Carbon\Carbon;
use App\Models\Product_notes;
use Illuminate\Support\Arr;
// Request
use Illuminate\Support\Str;

use function Symfony\Component\String\b;

class StylistFormController extends Controller
{

    public $stylist_form_obj = null;
    public $route_base = 'admin/stylist';
    public $upload_folder = 'images/stylist/upload';

    /**
     * construct
     */

    public function __construct()
    {

        $this->middleware('auth');
        $this->stylist_form_obj = new StylistForm();
    }

    public function index()
    {
        $action_base_url = $this->route_base;

        $list = $this->stylist_form_obj->list();
        return view('admin.stylist_form.manage', compact('list', 'action_base_url',));
    }

    public function dashboard()
    {
        return view('admin.stylist_form.dashboard');
    }

    public function add(Request $request)
    {

        $products = $this->getMerchantProductsList();

        if ($request->method() == 'GET') {

            if (isset($request->id)) {
                $data = $this->stylist_form_obj->get($request->id);

                if ($data) {
                    $data_array = $data->toArray();
                    $id = $data_array['id'];
                    session()->put('_old_input', $data_array);
                }
            } else {
                // session()->put('_old_input',[]);
            }
        }
        if ($request->method() == 'POST') {

            if (isset($request->video_url)) {
                $this->validate($request, [
                    'name' => 'required',
                    'product_ids' => 'required|array|min:1',
                    'status' => 'required',
                    'slug' => 'required|unique:stylist_forms,slug,' . $request->id,
                ]);
            } else {
                $this->validate($request, [
                    'name' => 'required',
                    'response_vedio' => 'required|mimes:mp4,mov,ogg,qt | max:20000',
                    'product_ids' => 'required|array|min:1',
                    'status' => 'required',
                    'slug' => 'required|unique:stylist_forms,slug,' . $request->id,
                ]);
            }

            if ($request->hasFile('response_vedio')) {
                $file = $request->file('response_vedio');
                $file_name = date('d-m-y-H-m-s') . '_' . $file->getClientOriginalName();
                $file_name = str_replace(' ', '-', $file_name);
                $file->move('uploads', $file_name);
                $request->video_name = $file_name;
            }

            $obj_exists = $this->stylist_form_obj::where('slug', '=', $request->slug)->first();
            if (($obj_exists) && ($obj_exists->id != $request->id)) {

                return redirect()->back()->withInput($request->input())->withError('The Slug ' . $request->code . ' already used');
            }
            try {
                $output = $this->stylist_form_obj->add($request);
            } catch (Exception $e) {

                return redirect()->back()->withError('Problem in request. Please try after some time');
            }

            if ($output) {
                $msg = 'Successfully Created';
                if (isset($request->id)) {
                    $msg = 'Successfully Updated';
                }
                return redirect('admin/stylist')->withSuccess($msg);
            } else {
                return redirect()->back()->withError('Problem in request. Please try after some time');
            }
        }

        return view('admin.stylist_form.add', compact('products'));
    }

    public function update(Request $request)
    {

        $obj = $this->stylist_form_obj->udpateRowInfo($request);
        if (!isset($obj)) {

            return redirect()->back()->withError('Something Wrong. Please try after some time');
        }
        try {

            return redirect()->back()->withSuccess('Successfully Updated');
        } catch (Exception $e) {

            return redirect()->back()->withError('Problem in request. Please try after some time');
        }

        return view('admin.stylist_form.add');
    }

    public function delete($id = 0)
    {
        $obj = $this->stylist_form_obj->delete($id);
        if ($obj) {
            return redirect()->back()->withSuccess('Successfully Deleted');
        } else {
            return redirect()->back()->withError('Problem in deleting. Please try after some time');
        }
    }

    // Edit function
    public function edit($id)
    {
        $obj = $this->stylist_form_obj->edit($id);
        return view('admin.stylist_form.add');
    }
    // End Edit function

    public function customerRequestList()
    {
        // $notificatino = Auth::user()->unreadNotifications()->whereDate('created_at', date('Y-m-d'))->get();
        // dd($notificatino);
        $employerOnboarding = employerOnboardingQuestionnaire::select('company_name', 'id')->get();

        $action_base_url = $this->route_base;
        $merchant_id = Auth::id();
        $list = StylistClientBookingAppointments::where("stylist_client_booking_appointments.merchant_id", Auth::id())->where("stylist_client_booking_appointments.customer_id", '!=', null)->with(['cancellation','customer' => function ($q) {
              return  $q->with('orders');
       }, 'customerImage', 'stylistUser' => function ($q) {
              return $q->with('company');
          }]);
          if(isset($_GET['action_status']) && $_GET['action_status'] == 'Call Upcoming')
            {
                $list->whereNotExists(function($query)
                {                  
                    $query->select(DB::raw(1))
                        ->from('stylist_client_booking_appointments_change_status_histories')
                        ->whereRaw('stylist_client_booking_appointments.id = stylist_client_booking_appointments_change_status_histories.booking_id')
                        ->where('status' ,'=', 'call_complete');
                })->whereNotExists(function($query1)
                {
                    $query1->select(DB::raw(1))
                        ->from('stylist_reveals_items')
                        ->whereRaw('stylist_client_booking_appointments.id = stylist_reveals_items.booking_id');                       
                })->where('status','=','not_started');
            }

            if(isset($_GET['action_status']) && $_GET['action_status'] == 'Create Reveal')
            {
                $list->whereNotExists(function($query)
                {
                    $query->select(DB::raw(1))
                        ->from('stylist_client_booking_appointments_change_status_histories')
                        ->whereRaw('stylist_client_booking_appointments.id = stylist_client_booking_appointments_change_status_histories.booking_id')
                        ->where('status' ,'=', 'call_complete');
                })->whereExists(function($query1)
                {
                    $query1->select(DB::raw(1))
                        ->from('stylist_reveals_items')
                        ->whereRaw('stylist_client_booking_appointments.id = stylist_reveals_items.booking_id');                       
                })->where('status','=','not_started');
            }

            if(isset($_GET['action_status']) && $_GET['action_status'] == 'Urgent Reveal')
            {
                $date =  date('d-m-Y');
                $date_14_days = date('Y-m-d', strtotime($date. ' +14 days'));
                $date_16_days = date('Y-m-d', strtotime($date_14_days. ' +2 days'));
                $list->where(function($q) {
                   return  $q->where('stylist_client_booking_appointments.status', 'call_complete' )
                    ->orWhere('stylist_client_booking_appointments.status', 'not_started' );
                })->whereBetween('stylist_client_booking_appointments.created_at', [$date_16_days, $date_14_days]);
            }

            if(isset($_GET['action_status']) && $_GET['action_status'] == 'Get Reveal Ready')
            {
                
                $date =  date('d-m-Y');
                $date_2months = date('Y-m-d', strtotime($date. ' +2 months'));
                $list->where('stylist_client_booking_appointments.created_at','>=', $date_2months);
                
                
            }

            if(isset($_GET['action_status']) && $_GET['action_status'] == 'Relax')
            {
                $date =  date('d-m-Y');
                $date_14_days = date('Y-m-d', strtotime($date. ' -14 days'));
                // $list->whereNotExists(function($query)
                // {
                //     $query->select(DB::raw(1))
                //         ->from('cancellations')
                //         ->whereRaw('cancellations.booking_id = stylist_client_booking_appointments.order_id');
                // })->where('stylist_client_booking_appointments.created_at','<', $date_2months);

                $list =   $list->
                join('stylist_reveals_items', 'stylist_client_booking_appointments.id', '=', 'stylist_reveals_items.booking_id')
                ->join('orders', 'stylist_reveals_items.id', '=', 'orders.reveal_id')
                ->whereNotExists(function($query)
                {
                    $query->select(DB::raw(1))
                        ->from('cancellations')
                        ->whereRaw('cancellations.order_id = orders.id');
                })
                ->where('orders.created_at','<', $date_14_days);;
                // ->join('cancellations', 'orders.id', '=', 'cancellations.order_id')
                // ->select('cancellations.*')
                // dump($date_14_days);
                // dd($list->toSql());

            }



            $list=$list->orderBy('stylist_client_booking_appointments.updated_at', 'desc')->paginate(10);
            $filter_values = array();

        if (isset($_GET['company_id'])) {
            $serarch_obj1 = employerOnboardingQuestionnaire::find($_GET['company_id']);
            if (isset($serarch_obj1)) {
                $filter_values['search_company_id'] = $serarch_obj1->id;
                $filter_values['search_company_name'] = $serarch_obj1->company_name;
            }
        }

        if (isset($_GET['app_date']) && $_GET['app_date'] != '') {
            $_GET['app_date'] = date('Y-m-d', strtotime($_GET['app_date'])) . ' 00:00:00';
            $serarch_obj2 = StylistClientBookingAppointments::where("merchant_id", Auth::id())->where("customer_id", '!=', null)->where('created_at', '>=', $_GET['app_date'])->get();
            if ($serarch_obj2->isNotEmpty()) {
                $filter_values['search_app_date_ids'] = $serarch_obj2->pluck('id')->toArray();
                $filter_values['search_app_date_text'] = $_GET['app_date'];
            }
        }

        if (isset($_GET['reveal_status']) && $_GET['reveal_status'] != '') {
            $serarch_obj3 = StylistClientBookingAppointments::where("status",$_GET['reveal_status'])->get();
            if ($serarch_obj3->isNotEmpty()) {
                $filter_values['search_reveal_status_ids'] = $serarch_obj3->pluck('id')->toArray();
                $filter_values['search_reveal_status_text'] = $_GET['reveal_status'];
            }            
        }        
        
        if (isset($_GET['search_box']) && $_GET['search_box'] != '') { 
            $filter_values['search_box_text'] = $_GET['search_box'];

            $search_company_name4 = employerOnboardingQuestionnaire::Where('company_name', 'like', '%' . $_GET['search_box'] . '%')->get();
            if ($search_company_name4->isNotEmpty()){
                $search_box_company_name_ids_arr = $search_company_name4->pluck('id')->toArray();  
                $search_box_company_ids_customer_id_arr =  stylistUsers::whereIn("company_id",$search_box_company_name_ids_arr)->get();      
                if ($search_box_company_ids_customer_id_arr->isNotEmpty()) {
                    $filter_values['search_box_company_name_ids'] = $search_box_company_ids_customer_id_arr->pluck('user_id')->toArray();                       
                }                
            }   

            $search_name4 = Customer::Where('name', 'like', '%' . $_GET['search_box'] . '%')->get();
            if ($search_name4->isNotEmpty()) {
                $search_box_name_ids_arr = $search_name4->pluck('id')->toArray();      
                $search_box_name_ids_booking_id =  StylistClientBookingAppointments::whereIn("customer_id",$search_box_name_ids_arr)->get();      
                if ($search_box_name_ids_booking_id->isNotEmpty()) {
                    $filter_values['search_box_name_ids'] = $search_box_name_ids_booking_id->pluck('id')->toArray();   
                }            
            } 

            $search_reveal_status4 = StylistClientBookingAppointments::Where('status', 'like', '%' . $_GET['search_box'] . '%')->get();
            if ($search_reveal_status4->isNotEmpty()) {
                $filter_values['search_box_reveal_status_ids'] = $search_reveal_status4->pluck('id')->toArray();   
            }
        }
        


        // ------------------------------------------------------------------------------------------------
            // if (isset($_GET['reveal_status'])) {
            //     $serarch_obj3 = stylistRevealsItems::where("merchant_id", Auth::id())->where("booking_id", '!=', null)->orderBy('updated_at', 'desc')->groupBy('status')->get();
            //     if ($serarch_obj3->isNotEmpty()) {
            //         $filter_values['search_revela_status_id'] = $serarch_obj3->pluck('id')->toArray();
            //         $filter_values['search_revela_status_text'] = $status_data->status;
            //     }
            // }

            // if (isset($_GET['action_status'])) {
            //     $serarch_obj3 = StylistClientBookingAppointments::where("merchant_id", Auth::id())->where("customer_id", '!=', null)->where('status', $_GET['revel_status'])->get();
            //     if ($serarch_obj3->isNotEmpty()) {
            //         $filter_values['search_revela_status_id'] = $serarch_obj3->pluck('id')->toArray();
            //         $filter_values['search_revela_status_text'] = $status_data->status;
            //     }
            // }
        // ------------------------------------------------------------------------------------------------


        if (is_array($filter_values) && count($filter_values)) {

            $list = StylistClientBookingAppointments::where("merchant_id", Auth::id())->where("customer_id", '!=', null)->with(['customer', 'customerImage', 'stylistUser' => function ($q) {
                return $q->with('company');
            }])->whereHas('stylistUser', function ($q) use ($filter_values) {
                if (is_array($filter_values) && isset($filter_values['search_company_id'])) {
                    return $q->where('company_id', $filter_values['search_company_id']);
                }
                return $q;
            });
            if (is_array($filter_values) && isset($filter_values['search_app_date_ids'])) {
                $list = $list->whereIn('id', $filter_values['search_app_date_ids']);
            }
            if (is_array($filter_values) && isset($filter_values['search_status_id'])) {
                $list = $list->whereIn('id', $filter_values['search_status_id']);
            }
            if (is_array($filter_values) && isset($filter_values['search_reveal_status_ids'])) {
                $list = $list->whereIn('id', $filter_values['search_reveal_status_ids']);
            }
            if (is_array($filter_values) && isset($filter_values['search_box_company_name_ids'])) {
                $list = $list->whereIn('customer_id', $filter_values['search_box_company_name_ids']);
            }
            if (is_array($filter_values) && isset($filter_values['search_box_name_ids'])) {
                $list = $list->whereIn('id', $filter_values['search_box_name_ids']);
            }
            if (is_array($filter_values) && isset($filter_values['search_box_reveal_status_ids'])) {
                $list = $list->whereIn('id', $filter_values['search_box_reveal_status_ids']);
            }

            
            // if (is_array($filter_values) && isset($filter_values['search_revela_status_id'])) {
            //     $list = $list->whereIn('id', $filter_values['search_revela_status_id']);
            // }
            $list = $list->orderBy('updated_at', 'desc')->paginate(10);
           
        }

        $all_booking_date_list = StylistClientBookingAppointments::where("merchant_id", Auth::id())->where("customer_id", '!=', null)->orderBy('updated_at', 'desc')->groupBy('appointment_date')->get();

        $all_status  = stylistRevealsItems::where("merchant_id", Auth::id())->where("booking_id", '!=', null)->orderBy('updated_at', 'desc')->groupBy('status')->get();

        $stylist_booking_data = StylistClientBookingAppointments::where('merchant_id', $merchant_id)->get();
        $after_days = '';
        $days_left = '';
        $after_days1 = '';
        $reveal_id_info = '';
        $booking_appointments_id = '';
        $after_booking_dates = '';
        $cancel_data = '';
        if($stylist_booking_data->isNotEmpty())
        {
            foreach ($stylist_booking_data as $key => $value) {
                $booking_ids =  $value->id;
                $booking_appointment_dates =  $value->appointment_date;
                $after_booking_dates ='';
                $stylist_booking_change_history = stylistClientBookingAppointmentsChangeStatusHistory::where('booking_id', $booking_ids)->where('status', 'call_complete')->get();
                if($stylist_booking_change_history->isNotEmpty())
                {
                    foreach ($stylist_booking_change_history as $key => $values) {
                        $reveal_id_info = $values->reveal_id;
                        $booking_appointments_id= $values->id;
                        $booking_appointments_id= $values->status;
                        if($booking_appointments_id == 'call_complete')
                        {
                            $after_booking_dates  = date('d/m', strtotime($values->created_at . '+14 days' ));
                        }
                    }
                }
            }
        }
        $customer_cancel_ids  = '';
        $customer_cancel_status = '';
        if($stylist_booking_data->isnotEmpty())
        {
            foreach($stylist_booking_data as $stylist_booking_data_info)
            {
                $stylist_booking_data_info->customer_id ;
                $cancel_data = Cancellation::where('customer_id', $stylist_booking_data_info->customer_id)->get();
                if($cancel_data->isnotEmpty())
                {
                    foreach($cancel_data as $cancel_data_info)
                    {
                        $customer_cancel_ids = $cancel_data_info->customer;
                        $customer_cancel_status = $cancel_data_info->status;

                    }
                }


            }
        }
        // ---------------------------------------------------------------------------------------------------


        // $merchant_id = Auth::id();
        // print_r($merchant_id);
        // $booking_details_action_data = StylistClientBookingAppointments::where('merchant_id', $merchant_id)->with(['customerdetails' => function ($q) {
        //     return $q->select(['id', 'name', 'email']);
        // }])->get();
        $data = '';
        $data_booking = '';
        $merchant_id = Auth::id();
        $list_booking_action_details = StylistClientBookingAppointments::where('merchant_id', $merchant_id)->with(['customerdetails' => function ($q) {
            return $q->select(['id', 'name', 'email']);
        }])->get();
        $booked_list = '';
        $profile_img_url = url('images/stylist/dummy-profile-pic.png');
        $style_para = '';
        if ($list_booking_action_details->isNotEmpty())
        {
            foreach ($list_booking_action_details as $list_info)
            {
                $now = time();
                $appoint_date_info =  strtotime($list_info->appointment_date);
                $datediff = $appoint_date_info - $now ;
                $date_info_diff =  round($datediff / (60 * 60 * 24));
                $customer_id = '';
                $action_status = '';
                $change_status_history = stylistClientBookingAppointmentsChangeStatusHistory::where('booking_id', $list_info->id)->latest()->first();
                $two_month_days_gap = date("Y-m-d",strtotime($list_info->appointment_date." +8 weeks"));
                $last_two_week_sgap = date("Y-m-d",strtotime($list_info->appointment_date." +10 weeks"));
                $forteen_days_gap = date("Y-m-d",strtotime($list_info->appointment_date." +14 days"));
                $order_det =  Order::where('customer_id' , $list_info->customer_id)->latest()->first();
                if(isset($order_det))
                {
                    $add_date = date("Y-m-d",strtotime($order_det->created_at." +14 days"));
                    $cancel = Cancellation::where('order_id',$order_det->id)->where('customer_id', $order_det->customer_id)->latest()->first();

                }


                if (!empty($list_info->customer_id) && !empty($list_info->customerdetails->name))
                {
                    if(!isset($change_status_history->booking_id) && $date_info_diff <= 3 && $list_info->status === 'not_started' )
                    {
                        $action_status = 'URGENT REVEAL<br>';
                        $style_para = 'style="color: RED !important; font-weight:900;"';
                    }
                    elseif(isset($change_status_history->booking_id) &&  $date_info_diff <= 3 && $list_info->status === 'not_started' &&  $change_status_history->status ===  "call_complete")
                    {
                        $action_status = 'URGENT REVEAL<br>';
                        $style_para = 'style="color: RED !important; font-weight:900;"';
                    }
                    elseif(!isset($change_status_history->booking_id) && $list_info->status === 'not_started')
                    {
                        $action_status = 'Call Upcoming<br>';
                        $style_para = 'style="color: Green !important; font-weight:900;"';
                    }
                    elseif ($list_info->status === 'not_started' &&  $change_status_history->status ===  "call_complete" ) {
                        $action_status = 'Create Reveal<br>';
                        $style_para = 'style="color: Green !important; font-weight:900;"';
                    }
                    elseif ($list_info->status === 'awaiting_response' && isset($change_status_history->status) && $change_status_history->status ===  "sent")
                    {
                        $action_status = 'RELAX-<br>AWAITING RESPONSE<br>';
                        $style_para = 'style="color: RED !important; font-weight:900;"';
                    }
                    elseif ((isset($cancel) &&  $cancel->created_at <= $add_date) ) {
                        $action_status = 'Relex<br>';
                        $style_para = 'style="color: Teal !important; font-weight:900;"';
                    }
                    elseif (isset($order_det) &&    $add_date < date('Y-m-d') && $list_info->status == 'dispatched') {
                        $action_status = 'Relex<br>';
                        $style_para = 'style="color: Teal !important; font-weight:900;"';
                    }
                    elseif(date('Y-m-d') > $two_month_days_gap  &&  $last_two_week_sgap > date('Y-m-d') && $list_info->status == 'dispatched' && $change_status_history->status ===  "preparing_order")
                    {
                        $action_status = 'GET REVEAL READY<br>';
                        $style_para = 'style="color: Blue !important"; font-weight:900"';
                    }
                    elseif($last_two_week_sgap < date('Y-m-d') && $list_info->status == 'dispatched')
                    {
                        $action_status = 'CREATE REVEAL';
                        $style_para = 'style="color: teal !important; font-weight:900;"';
                    }
                    else
                    {
                        $action_status = '';
                    }

                    // --------------------------------------------------
                    $booked_list .= '<p ' . $style_para . '>' . $action_status . '</p';

                }
            }
        }


        // sort($booked_list);

        $data = $booked_list;
        // ---------------------------------------------------------------------------------------------------

        return view('admin.stylist_form.customer_request_list', compact('list', 'action_base_url', 'employerOnboarding', 'all_booking_date_list', 'filter_values', 'after_booking_dates', 'cancel_data', 'customer_cancel_ids', 'customer_cancel_status', 'data', 'all_status', 'booked_list'));
    }


    public function customerResponseList()
    {
        $merchant_id = Auth::id();
        $list = (new StylistClientInfo())->list();
        $html_array = array();

        if ($list->isNotEmpty()) {

            foreach ($list as $single_info) {
                $stylist_form_id = $single_info->stylist_form_id;
                $response_details = $single_info->clientDetails()->get();

                if (!isset($stylist_form_details_arr[$stylist_form_id])) {
                    $stylist_form_details = $single_info->stylistFormDetails()->first();
                    if ($stylist_form_details) {
                        $stylist_form_details_arr[$stylist_form_id] = $stylist_form_details;
                    }
                } else {
                    $stylist_form_details = $stylist_form_details_arr[$stylist_form_id];
                }
                $stylist_form_name = '';
                if ($stylist_form_details) {
                    $stylist_form_name = $stylist_form_details->name;
                }

                $html = '';
                if ($response_details->isNotEmpty()) {
                    $html .= "<div class='prod_detail_items'>";
                    $list_c = 0;
                    foreach ($response_details as $response_detail) {
                        $list_c++;
                        $product_ids = '';
                        $selection_type = '';
                        $selected_options = '';
                        $other_msg = '';
                        $product_name = '';
                        $products_obj = Product::find($response_detail->product_id)->where('active', 1)->first();

                        if ($products_obj) {
                            $product_name = $products_obj->name;
                        }
                        $selected_options_arr = array();
                        if ($response_detail->selection_type == 'alternative') {

                            $selected_options_arr = explode('||', $response_detail->alternative_options);
                        } else if ($response_detail->selection_type == 'decline') {
                            $selected_options_arr = explode('||', $response_detail->decline_options);
                        } else {
                        }

                        if (is_array($selected_options_arr) && count($selected_options_arr)) {
                            if (in_array('other', $selected_options_arr)) {
                                $other_msg = $response_detail->other_msg;
                            }

                            $selected_options = implode(',', $selected_options_arr);
                        }

                        if ($list_c == 1) {
                            $html .= "<p class='stylist_form_name'><b>Stylist Form Name:</b> " . $stylist_form_name . "</p>";
                        }

                        $html .= "<div class='prod_detail_item'>";

                        $html .= "<p><b>Product Name:</b> " . $product_name . "</p>";
                        $html .= "<p><b>Selection Type:</b> " . $response_detail->selection_type . "</p>";
                        if (is_array($selected_options_arr) && count($selected_options_arr)) {
                            $html .= "<p><b>Reason: </b>" . $selected_options . "</p>";
                            if ($other_msg != '') {

                                $html .= "<p><b>Msg:</b> " . $other_msg . "</p>";
                            }
                        }

                        $html .= "</div>";
                    }
                    $html .= "</div>";
                    $html_array[$single_info->id] = $html;
                }
            }
        }
        $action_base_url = $this->route_base;
        return view('admin.stylist_form.customer_response_list', compact('list', 'action_base_url', 'html_array'));
    }

    public function customerRequestResponseEmailTemplateload($booking_id = 0, $reveal_id = 0)
    {

        $email_template_list = EmailTemplate::select('name', 'id')->get();

        $stylist_form = ''; //$this->stylist_form_obj->list();

        return view('admin.stylist_form.email-template.customer_request_response', compact('stylist_form', 'email_template_list', 'booking_id', 'reveal_id'));
    }

    public function customerRequestResponseEmailTemplateloadById($id = 0)
    {

        $data = EmailTemplate::where('id', $id)->first();

        $output = array();
        if ($data) {
            $output['success'] = $data;
            $output['id'] = $id;
            $html = '<label for="body" class="with-help">Body*</label><i class="fa fa-question-circle" data-toggle="tooltip" data-placement="right" title="Add ** bothside of important keyword to highlight"></i><textarea class="form-control summernote-long" placeholder="Enter email body" rows="2" required="" name="body" cols="50" id="body">' . $data->body . '</textarea><div class="help-block with-errors"></div>';
            $output['html'] = $html;
        } else {
            $output['error'] = "Something Wrong";
        }

        echo json_encode($output);
    }

    public function customerRequestResponseSendMail(Request $request)
    {

        $output = array();
        $this->validate($request, [
            'selected_email_template' => 'required',
            'subject' => 'required',
            'booking_id' => 'required',
            'reveal_id' => 'required',
            'body' => 'required',
        ]);

        $merchant_id = Auth::id();
        $email_data = EmailTemplate::where('id', $request->selected_email_template)->first();

        $sender_email = '';
        if ($email_data) {
            $sender_email = $email_data->sender_email;
            $subject = $request->subject;

            $body = (new EmailTemplate())->getBodyAttribute($request->body);
            //$decoded_id = Crypt::encryptString($request->booking_id);
            //$reveal_id = Crypt::encryptString($request->reveal_id);
            $rand_code = Crypt::encryptString($request->reveal_id);

            $decoded_id = $request->booking_id;
            $reveal_id = $request->reveal_id;

            $style_tf_url = url("stylist/reveal/" . $decoded_id . "/" . $reveal_id . '/' . $rand_code);
            $body = str_replace("{STYLIST_TYPE_FORM_PAGE_URL}", $style_tf_url, $body);
            $body = str_replace("STYLIST_TYPE_FORM_PAGE_URL", $style_tf_url, $body);

            $mail_details = array();
            $booking_details = (new StylistClientBookingAppointments)->where('id', $request->booking_id)->first();

            $mail_details['to'] = '';
            if ($booking_details) {

                $customer_obj = $booking_details->customer()->first();
                if (isset($customer_obj)) {
                    $mail_details['to'] = $customer_obj->email;
                }
            }
            $mail_details['from'] = $email_data->sender_email;
            $mail_details['subject'] = $subject;
            $mail_details['body'] = $body;

            Mail::to($mail_details['to'])->send(new \App\Mail\NotifyMailStylistClientbookingResponse($mail_details));
            if (Mail::failures()) {
                $output['error'] = 'Sorry! Please try again latter';
            } else {

                $info_records_data = array(
                    'email_template_id' => $request->selected_email_template,
                    'reveal_id' => $request->reveal_id,
                    'booking_id' => $request->booking_id,
                    'merchant_id' => $merchant_id,
                    'subject' => $subject,
                    'body' => $body,
                );
                $info_records_obj = stylistClientBookingAppointmentsSendResponse::create($info_records_data);
                if ($info_records_obj) {
                    $output['success'] = 'Reveal send successfully';
                    $reveal_status = $this->getRevealStatusNameByKey('awaiting_response');
                    $this->changeStatusOfRevealItem($request->reveal_id, $reveal_status);

                    $booking_details = (new StylistClientBookingAppointments)->where('id', $request->booking_id)->first()->update(array('status' => $reveal_status));
                    $this->addRevealChangeHistory($request->booking_id, $request->reveal_id, getRevealStatusKeyNameHelper('sent'));
                }
            }
        } else {
            $output['error'] = "Something Wrong. Please try after some time";
        }

        //return redirect()->back()->withError('Problem in request. Please try after some time');
        return response()->json($output);
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

    public function getRevealStatusList()
    {

        $list = array();
        $list['awaiting_response'] = 'awaiting_response';
        $list['draf'] = 'draf';
        $list['draft'] = 'draft';
        $list['draft'] = 'draft';
        $list['preparing_order'] = 'preparing_order';
        $list['dispatched'] = 'dispatched';
        $list['return_initiated'] = 'return_initiated';
        $list['not_started'] = 'not_started';
        $list['completed'] = 'completed';
        $list['decline'] = 'decline';
        return $list;
    }

    public function getRevealStatusNameHeadingFormate($status = '')
    {

        $status = str_replace('_', ' ', $status);
        $status = str_replace('-', ' ', $status);
        $status = ucfirst($status);
        return $status;
    }

    public function getRevealStatusNametextFormate($status = '')
    {
        $status = strtolower($status);
        $status = str_replace(' ', '_', $status);
        return $status;
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

    public function customerRequestResponseloadHistory($booking_id = 0)
    {

        $history = stylistClientBookingAppointmentsSendResponse::where('booking_id', '=', $booking_id)->orderBy('updated_at', 'desc')->get();

        return view('admin.stylist_form.customer_request_history', compact('history'));
    }

    public function drapperStylistDesign()
    {
        $action_base_url = $this->route_base;
        $list = $this->stylist_form_obj->list();
        return view('admin.stylist_form.drapper_stylist_design', compact('list', 'action_base_url'));
    }

    public function sendmail()
    {

        $mail_details = array();
    }

    public function getMerchantProductsList()
    {

        $products = Product::where('active', '1')->with('categories', 'shop.logo', 'featureImage', 'image')
            ->withCount('inventories')->orderBy('id', 'DESC');
        // When accessing by a merchent user
        if (Auth::user()->isFromMerchant()) {
            $products->mine();
        }
        return $products = $products->get();
    }

    public function productDetailsAjax($product_id = 0)
    {

        $product = Product::where('id', $product_id)->where('active', '1')->with('categories', 'shop.logo', 'featureImage', 'image')
            ->withCount('inventories');
        // When accessing by a merchent user
        if (Auth::user()->isFromMerchant()) {
            $product->mine();
        }

        $output = array();
        $product_details = array();

        $product_obj = $product->first();
        $img_src = url('images/stylist/product-placeholder.jpg');
        $img_html = '';
        if ($product_obj) {
            $output['scuccess'] = "Successfullyl";

            $qty = 0;
            $sale_price = 0;

            $product_details['name'] = $product_obj->name;
            $product_details['inventories_count'] = $product_obj->inventories_count;
            $inventory = Inventory::where('product_id', $product_obj->id)->first();

            $prodcut_attr_details_html = '';
            if (isset($inventory)) {

                $qty = $inventory->stock_quantity;
                $sale_price = $inventory->sale_price;
                foreach ($inventory->images as $img) {
                    $img_src = url('') . '/image/' . $img->path;
                }

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

                if ($attributes->isNotEmpty()) {
                    foreach ($attributes as $attribute) {

                        $attribute_name = $attribute->name;

                        $attribute_value_arr = array();
                        $attribute_arr = $attribute->toArray();

                        if (isset($attribute_arr['attribute_values']) && count($attribute_arr['attribute_values'])) {
                            $attribute_values = $attribute_arr['attribute_values'];
                            foreach ($attribute_values as $attribute_value) {
                                $attribute_value_arr[] = $attribute_value['value'];
                            }
                        }
                        $attribute_value_text = implode(',', $attribute_value_arr);

                        $prodcut_attr_details_html .= '<div class="form-group">';
                        $prodcut_attr_details_html .= '<label >' . $attribute_name . '</label>';
                        $prodcut_attr_details_html .= '<div class="form-group-input-text">';
                        $prodcut_attr_details_html .= '<p>' . $attribute_value_text . '</p>';
                        $prodcut_attr_details_html .= '</div>';
                        $prodcut_attr_details_html .= '</div>';
                    }
                }
            }
            $product_details['sale_price'] = get_formated_price($sale_price, config('system_settings.decimals', 2));
            if ($img_html == '') {
                foreach ($product_obj->images as $img) {
                    $img_src = url('') . '/image/' . $img->path;
                }
            }

            $img_src = str_replace('/images\\', '/images/', $img_src);

            $img_html = "<img src='" . $img_src . "'  style='width: 100%; '>";

            $prodcut_details_html = '<div class="modal-dialog add_product_popup" role="document">';
            $prodcut_details_html .= '<div class="modal-content">';
            $prodcut_details_html .= '<div class="modal-header">';
            $prodcut_details_html .= '<h4 class="modal-title" id="exampleModalLabel">Add Product</h4>';
            $prodcut_details_html .= '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
            $prodcut_details_html .= '<span aria-hidden="true">&times;</span>';
            $prodcut_details_html .= '</button>';
            $prodcut_details_html .= '</div>';
            $prodcut_details_html .= '<div class="modal-body">';
            $prodcut_details_html .= '<div class="row shadow px-4">';
            $prodcut_details_html .= '<div class="col-md-4">';
            $prodcut_details_html .= '<div class="img-product-2 shadow rounded">';
            //$prodcut_details_html .= '<img src="'.url('images/stylist/delete-2.jpg').'" alt=""  style="width: 100%; ">';
            $prodcut_details_html .= $img_html;
            $prodcut_details_html .= '</div>';
            $prodcut_details_html .= '<div style="padding: 15px 0px;">';
            $prodcut_details_html .= '<button class="stf-save-btn-2 stf-save-btn" onclick="stfRevealItemAdd(\'' . $img_src . '\',\'' . $product_obj->id . '\',\'' . $product_details['name'] . '\',\'' . $product_details['sale_price'] . '\')">Add</button>';
            //$prodcut_details_html .= '<button class="" style="float: right;">Cancel</button>';
            $prodcut_details_html .= '<button type="button" class="stf-save-btn-3" data-dismiss="modal" style="float: right;">Cancel</button>';
            $prodcut_details_html .= '</div>';
            $prodcut_details_html .= '</div>';
            $prodcut_details_html .= '<div class="col-md-8">';
            $prodcut_details_html .= '<form>';
            $prodcut_details_html .= '<div class="form-group">';
            $prodcut_details_html .= '<label for="exampleInputEmail1">Title</label>';
            $prodcut_details_html .= '<div class="form-group-input-text">';
            $prodcut_details_html .= '<p>' . $product_details['name'] . '</p>';
            $prodcut_details_html .= '</div>';
            $prodcut_details_html .= '</div>';

            if ($product_details['sale_price'] != '') {

                $prodcut_details_html .= '<div class="form-group">';
                $prodcut_details_html .= '<label >Price</label>';
                $prodcut_details_html .= '<div class="form-group-input-text">';
                $prodcut_details_html .= '<p>' . $product_details['sale_price'] . '</p>';
                $prodcut_details_html .= '</div>';
                $prodcut_details_html .= '</div>';
            }
            if ($product_obj->brand != '') {

                $prodcut_details_html .= '<div class="form-group">';
                $prodcut_details_html .= '<label >Brand</label>';
                $prodcut_details_html .= '<div class="form-group-input-text">';
                $prodcut_details_html .= '<p>' . $product_obj->brand . '</p>';
                $prodcut_details_html .= '</div>';
                $prodcut_details_html .= '</div>';
            }
            if ($product_obj->model_number != '') {
                $prodcut_details_html .= '<div class="form-group">';
                $prodcut_details_html .= '<label >Model Number</label>';
                $prodcut_details_html .= '<div class="form-group-input-text">';
                $prodcut_details_html .= '<p>' . $product_obj->model_number . '</p>';
                $prodcut_details_html .= '</div>';
                $prodcut_details_html .= '</div>';
            }
            if ($product_obj->mpn != '') {

                $prodcut_details_html .= '<div class="form-group">';
                $prodcut_details_html .= '<label >MPN</label>';
                $prodcut_details_html .= '<div class="form-group-input-text">';
                $prodcut_details_html .= '<p>' . $product_obj->mpn . '</p>';
                $prodcut_details_html .= '</div>';
                $prodcut_details_html .= '</div>';
            }

            if ($product_obj->gtin != '') {

                $prodcut_details_html .= '<div class="form-group">';
                $prodcut_details_html .= '<label >GTIN</label>';
                $prodcut_details_html .= '<div class="form-group-input-text">';
                $prodcut_details_html .= '<p>' . $product_obj->gtin . '</p>';
                $prodcut_details_html .= '</div>';
                $prodcut_details_html .= '</div>';
            }

            $prodcut_details_html .= $prodcut_attr_details_html;
            $prodcut_details_html .= '</form>';
            $prodcut_details_html .= '</div>';
            $prodcut_details_html .= '</div>';
            $prodcut_details_html .= '</div >';
            $prodcut_details_html .= '</div>';
            $prodcut_details_html .= '</div>';
            $product_details['id'] = $product_obj->id;
            $product_details['qty'] = $qty;
            $product_details['img_src'] = $img_src;
            $product_details['img_html'] = $img_html;

            $product_details['prodcut_details_html'] = $prodcut_details_html;
        } else {
            $output['error'] = "Something Wrong";
        }
        $output['product_details'] = $product_details;

        return response()->json($output);
    }

    public function customerRequestTypeFormDetails($id = 0)
    {

        $list = StylistClientBookingAppointments::where('id', $id)->where("customer_id", '!=', null)->with(['customer', 'customerImage', 'stylistUser'])->first();
            $customer_id = $list->customer_id;
            $new_booking_status = $list->status;
            // print_r($new_booking_status);
        $customer_details = Customer::where('id', $list->customer_id)->first();

        $note = Product_notes::where('customer_id', $list->customer_id)->where('booking_id', $list->id)
            ->where('merchant_id', $list->merchant_id)->take(3)->latest()->get();

        $data = array();
        if ($list) {
            $booking_id = $id;
            $data['appointments_details'] = $list->toArray();
            $booking_customer_id = $data['appointments_details']['customer_id'];

            $budget_price = $this->getCustomerBudgetPrice($booking_customer_id);
            $user_tag_list_html = $this->getUserTagListHtml($booking_customer_id);

            $profile_img_url = url('images/stylist/dummy-profile-pic.png');
            $customer_image_obj = $list->customerImage()->first();
            if (isset($customer_image_obj)) {
                $profile_img_url = url('image/' . $customer_image_obj->path);
            }
            $data['profile_img_url'] = $profile_img_url;
            $data['request_id'] = $id;
            $revels_html_item_html = $this->getRevealList($id);
            $data['revels_html_item_html'] = $revels_html_item_html;
            $client_info = StylistClientInfo::where('booking_id', $id)->orderBy('id', 'desc')->get();
            $buy_product_ids = array();
            $decline_html = '';
            $decline_product = array();
            $feebback_html = '';
            $brand_name = '';
            if ($client_info) {
                foreach ($client_info as $client_info_single) {
                    $feedback_info_obj = StylistClientInfoDetails::where('stylist_info_id', $client_info_single->id)->get();
                    if ($feedback_info_obj){
                        foreach ($feedback_info_obj as $feedback_info_info) {
                            $price = 0;
                            if (in_array($feedback_info_info->product_id, $decline_product)) {
                                continue;
                            }
                            $product_obj = Product::where('active', '1')->where('id', $feedback_info_info->product_id)->with('categories', 'shop.logo', 'featureImage', 'image')
                                ->withCount('inventories')->orderBy('id', 'DESC')->first();
                            if ($product_obj) {

                                $img_src = '';

                                $inventory_obj = Inventory::where('product_id', $product_obj->id)->first();
                                if ($inventory_obj) {
                                    foreach ($inventory_obj->images as $img) {
                                        $img_src = url('') . '/image/' . $img->path;
                                        break;
                                    }
                                }
                                if ($img_src == '') {
                                    foreach ($product_obj->images as $img) {
                                        $img_src = url('') . '/image/' . $img->path;
                                        break;
                                    }
                                }
                                if ($img_src == '') {
                                    $img_src = url('images/stylist/product-placeholder.jpg');
                                }
                                $decline_options = $feedback_info_info->decline_options;
                                $other_msg = '';
                                if ($decline_options != '') {

                                    $decline_options_arr = explode('||', $decline_options);

                                    if (in_array('other', $decline_options_arr)) {

                                        $other_msg = $feedback_info_info->other_msg;
                                        $other_msg = '<p>Comment: ' . $other_msg . '</p>';
                                    }
                                    $decline_options = "<p><b style='font-size: 17px;
                                    color: black;'></b> " . ucwords(str_replace('_', ' ', implode(', ', $decline_options_arr))) . '<p>';
                                    $feebback_html .= '<div class="card img-product shadow">

									 <span class="img-product-pad"><h3>' . $product_obj->name . '</h3>

										' . $decline_options . $other_msg . '
										<div class="col-md-12 img-product-1 ">
									 <div class="rounded">
      										<img src="' . $img_src . '" alt="" style="width: 100%;">
   											</div>

   											</div>
									 </span>
								  </div>';
                                }

                                // if($product_id =)

                                $decline_product[] = $product_obj->id;
                                $img_src = '';
                                $brand_name = '';
                                $inventory = Inventory::where('product_id', $product_obj->id)->first();
                                $sale_price = 0;
                                if ($inventory) {
                                    $brand_name = $inventory->brand;
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
                                $decline_options_data = '';
                                if(isset($decline_options))
                                {
                                    $decline_options_data = $decline_options;
                                }
                                else
                                {
                                    $decline_options_data = 'NA';
                                }
                                $decline_html .= '<div class="column-custom"><div class="card card-costom">
                                <div class=" img-product-1 "><div class="rounded "><img src="' . $img_src . '" alt=""  style="width: 100%;"></div><div class="articles-two"><h3>' . $product_obj->name . '</h3><h3>' . $brand_name . '</h3><h3>' . $price . '</h3><h3>' . $decline_options_data. '</h3></div><div>' . $other_msg . '</div></div>
                                </div></div>';
                               
                                

                                // $decline_html .= '<div class="row mt-4"><div class="col-md-2 img-product-1 "><div class="rounded "><img src="' . $img_src . '" alt=""  style="width: 100%;"></div></div> <div class="col-md-5 img-product-1 "><div class="rounded "><h4>' . $decline_options . $other_msg .  '</h4></div></div></div> <div class="row"><div class="col-md-4 articles-two"><h3>' . $product_obj->name . '</h3><h3>' . $price . '</h3></div></div>';
                                // $decline_options . $other_msg
                                // $cancel .= '<div class="row mt-4"><div class="col-md-2 img-product-1 "><div class="rounded "><img src="' . $img_src . '" alt=""  style="width: 100%;"></div></div> <div class="col-md-5 img-product-1 "><div class="rounded "><h4>' . $decline_options . $other_msg .  '</h4></div></div></div> <div class="row"><div class="col-md-4 articles-two"><h3>' . $product_obj->name . '</h3><h3>' . $price . '</h3></div></div>';
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

            //code by S
            $item_cancel_item_hide =  '';
            $Cancellation_detail = '';
            $order_details = Order::where('customer_id', $customer_id)->where('order_status_id', '!=', 8)->where('order_status_id', '!=', 7)->orderBydesc('id')->first();

            if($order_details){

                $order_product_ids = explode(',', $order_details->reveal_products_ids);
                $buy_product_ids = array_unique($order_product_ids);
                // var_dump($order_product_ids);
                $inventory_details = Inventory::where('product_id',$buy_product_ids)->first();


                if($inventory_details)
                {
                    $item_hide = '';
                    $Cancellation_detail =  Cancellation::where('order_id', $order_details->id)->where('status',3)->first();
                }
            }else{
                $buy_product_ids = [];
            }

            $buy_products = $this->getProductDetails($buy_product_ids);

            $customer_question_details = StylistCustomerQuestionsAnswer::where('customer_id', $booking_customer_id)->orderBy('question_id')->orderBy('id', 'DESC')->first();
            $stylist_call_complete = $list->statusHistory()->where('status', '=', 'call_complete')->first();
            $employe_onboarding_company_name = '';
            $stylist_user_compnay_id = 0;
            $stylist_user_deatils = stylistUsers::where('user_id', $customer_id)->first();

            if (isset($stylist_user_deatils)) {
                $stylist_user_compnay_id = $stylist_user_deatils->company_id;
                $employe_onboarding_company_deatils = employerOnboardingQuestionnaire::where('id', $stylist_user_compnay_id)->first();
                if (isset($employe_onboarding_company_deatils)) {
                    $employe_onboarding_company_name = $employe_onboarding_company_deatils->company_name;

                }
            }

            $product_brand_name = $brand_name;
            $item_cancel_item_hide = $Cancellation_detail;
            return view('admin.stylist_form.customer_request_type_form_details', compact('data', 'buy_products', 'decline_html', 'feebback_html', 'user_tag_list_html', 'booking_customer_id', 'customer_question_details', 'budget_price', 'stylist_call_complete', 'booking_id', 'employe_onboarding_company_name', 'stylist_user_compnay_id', 'customer_details', 'note','new_booking_status', 'item_cancel_item_hide', 'product_brand_name'));
        }
    }

    public function customerRequestTypeFormDetailsForRatings(Request $request)
    {
        if ($request->cust_id != '' && $request->starnum != '') {
            DB::table('customers')->where('id', $request->cust_id)->update(['starrating' => $request->starnum]);
            return 1;
        } else {
            return 0;
        }
    }

    public function customerRequestTypeFormDetailsForAddNote(Request $request)
    {
        $model = new Product_notes();
        $model->customer_id = $request->customerid;
        $model->merchant_id = $request->merchantid;
        $model->booking_id = $request->bookingid;
        $model->notes = $request->note_name;

        if ($model->save()) {
            return 1;
        } else {
            return 0;
        }
        // DB::table('product_notes')->insert(['customer_id' => $request->customerid,'merchant_id' => $request->merchantid,'booking_id' => $request->bookingid,'notes' => $request->note_name]);

    }

    public function getCustomerBudgetPrice($user_id = 0)
    {
        $budget_price = 0;
        $users_obj = stylistUsers::where('user_id',$user_id)->first();


            if(isset($users_obj))
            {
                $budget_price = $users_obj->budget_price;
            }
        return $budget_price;
    }

    public function getUserTagListHtml($user_id = 0)
    {

        $user_tag_list = StylistUserTags::where('user_id', $user_id)->get();
        $html = '';
        $user_tag_ids_arr = array();

        if ($user_tag_list->isNotEmpty()) {
            foreach ($user_tag_list as $user_tag_info) {

                $tag_explode = explode(',', $user_tag_info->tag_id);

                foreach($tag_explode as $tag_id)
                {
                    $user_tag_ids_arr[] = $tag_id;
                    $question_obj = stylistQuestions::find($user_tag_info->question_id);

                    if (isset($question_obj)) {

                        if (isset($question_obj->tagCategory)) {
                            $user_tag_question_ids_arr[$tag_id] = $question_obj->tagCategory->name;

                        }
                    }
                }



            }
        }
        if (count($user_tag_ids_arr)) {
            $tags_obj = StylistTags::whereIn('id', $user_tag_ids_arr)->get();
            if ($tags_obj->isNotEmpty()) {
                foreach ($tags_obj as $tag_info) {
                    $tag_category_name = '';
                    if (isset($user_tag_question_ids_arr[$tag_info->id])) {
                        $tag_category_name = $user_tag_question_ids_arr[$tag_info->id] . ': ';
                    }

                    $html .= '<button class="btn user_tag_info"><i class="fa fa-close" onclick="stfDeleteUserTagById(' . $user_id . ',' . $tag_info->id . ',\'this\')"></i>' . $tag_category_name . $tag_info->name . '</button>';
                }
            }
        }

        return $html;
    }

    public function getProductDetails($product_ids_array)
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

    public function getRevealList($booking_id = 0)
    {

        $revels_html_item_html = '';
        $merchant_id = Auth::id();
        $reveals_count = 1;
        $reveal_items_list = stylistRevealsItems::where('merchant_id', $merchant_id)->where('booking_id', $booking_id)->get();
        $booking_details = StylistClientBookingAppointments::where('id', $booking_id)->first();

        $user_details = array();
        $user_details['name'] = '';
        if ($booking_details) {
            $user_details['name'] = $booking_details->name;
        }

        if ($reveal_items_list->isNotEmpty()) {
            foreach ($reveal_items_list as $reveal_item) {

                $revels_html_item_html .= $this->getRevealDetails($reveal_item, $reveals_count, $user_details);
                $reveals_count++;
            }
        }

        $add_plus_img = url('images/stylist/add-plus.jpg?3');
        $reveal_id = 0;
        $button_html = '';
        for ($i = $reveals_count; $i < 6; $i++) {
            $revels_html_item_html .= '<div class="item reveal_section_empty stf_anchor_mouse_over_effect stf_owl_carousel_slider_item reveal_section_list "  onclick="stfGetRevealItemsHtmlAjax(' . $reveal_id . ',this)">';
            $revels_html_item_html .= '<div class="img-product">';
            $revels_html_item_html .= '<img src="' . $add_plus_img . '" alt=""  style="width: 100%;">';
            $revels_html_item_html .= '</div>';
            $revels_html_item_html .= '<div class="text-center button-slider ">' . $button_html . '</div></div>';
        }

        return $revels_html_item_html;
    }

    public function getRevealDetails($reveal_item = null, $reveals_count = 1, $user_details = array())
    {

        $revels_html_item_html = '';
        $merchant_id = Auth::id();
        $reveals_count = '';
        $add_plus_img = url('images/stylist/add-plus.jpg');

        $revel_name = '';

        /*if(is_array($user_details)  && isset($user_details['name'])){
        $revel_name = $user_details['name'];
        }*/

        $date = '';
        if ($reveal_item) {
            $reveal_id = $reveal_item->id;
            $revel_name = $reveal_item->name;
            $product_ids = $reveal_item->product_ids;
            $date = $reveal_item->updated_at;
            $date = date('Y-m-d', strtotime($date));
            $status = $reveal_item->status;

            $product_ids_arr = explode(',', $product_ids);
            $product_id = 0;

            if (is_array($product_ids_arr) && count($product_ids_arr)) {
                foreach ($product_ids_arr as $product_id_selected) {

                    $product_info = $this->getProductDetailsById($product_id_selected);

                    if ($product_info) {
                        $product_id = $product_id_selected;
                        $add_plus_img = $product_info['img_src'];
                        break;
                    }
                }
            }
            $button_status = '';
            $button_html= '';
            $status_text = $this->getRevealStatusNameHeadingFormate($status);
            $status_text_class = $this->getRevealStatusNametextFormate($status);

            if ($status == 'not_started') {
                //$status_text = 'NOT STARTED';
            } else if ($status == 'sent') {
                //$status_text = 'Sent';
            } else if ($status == 'complete') {
                //$status_text = 'Complete';
            } else if ($status == 'awaiting_response') {
            }
            $status_text_class = 'text-warning-style- ' . $status_text_class;


            // $button_status = '<div class="col  button-drapps_rename text-right " style="margin-top:10px;"><span class=text-nowrap ' . $status_text_class . '"> ' . $status_text . '</span></div>';
            $button_status .= '<div class="col  button-drapps_rename text-right " style="margin-top:10px;"> <span class=text-nowrap ' . $status_text_class . '"> ' . $status_text . '</span></div>';

            $button_html .= '<div class="row  button-slider">
                          <div class="col  articles-two product-slider-text-d">
                             <h3>' . $revel_name . '</h3>

                          </div>
                          ' . $button_status . '
                       </div>';
            $revels_html_item_html .= '<div class="item  reveal_section_list stf_anchor_mouse_over_effect stf_owl_carousel_slider_item" onclick="stfGetRevealItemsHtmlAjax(' . $reveal_id . ',this)" >';
            $revels_html_item_html .= '<div class="img-product rounded img-product-custom">';
            $revels_html_item_html .= '<img src="' . $add_plus_img . '" alt=""  style="width: 100%;">';

            $revels_delete_item = '<div class="overlay"><a href_rename="javascript:void(0)" class="btn btn-light padding-0 stf_anchor_btn stf_reveal_delete_btn" onclick="stf_reveal_delete(this,' . $reveal_id . ');return false;"><i class="fa fa-trash"></i></a></div>';

            $revels_html_item_html .= $revels_delete_item;
            $revels_html_item_html .= '</div>';
            $revels_html_item_html .= $button_html;
            $revels_html_item_html .= '</div>';
        }

        return $revels_html_item_html;
    }

    public function getRevealItemslist($reveal_id = 0)
    {

        $reveal_alertnative_items_html = '';
        $reveal_items_html = '';
        $merchant_id = Auth::id();
        $revels_html_item_html = '';
        $pro_count = 1;
        $alernative_pro_count = 1;

        $reveal_info = stylistRevealsItems::where('merchant_id', $merchant_id)->where('id', $reveal_id)->first();

        $product_ids_arr = array(0, 0, 0, 0, 0);
        $alernative_product_ids_arr = array(0, 0, 0, 0, 0);
        $reveal_name = '';
        $reveal_status = '';
        if ($reveal_info) {
            $product_ids = $reveal_info->product_ids;
            $reveal_status = $reveal_info->status;
            $reveal_name = $reveal_info->name;
            $alernative_product_ids = $reveal_info->alernative_product_ids;
            $status = $reveal_info->status;
            $product_ids_arr = explode(',', $product_ids);
            $alernative_product_ids_arr = explode(',', $alernative_product_ids);
        }

        $button_text1 = 'Save ';
        $revel_name = '';

        $product_id = 0;
        $i = 0;
        $add_prod_img_src = url('images/stylist/add-plus.jpg');
        $products_info_array = array();

        foreach ($product_ids_arr as $product_id) {

            $product_info = $this->getProductDetailsById($product_id);
            $prod_img_src = $add_prod_img_src;
            $sale_price = get_formated_price(0, config('system_settings.decimals', 2));

            $product_name = '';
            $product_has = false;
            $more_class = " stf_reveal_item_empty ";
            $img_src2_has_class = '';
            $img_src2_html = '';
            if ($product_info) {

                $inventory = Inventory::where('product_id', $product_id)->first();
                $qtr = 0;
                if ($inventory) {
                    $qty = $inventory->stock_quantity;
                }
                $products_info_array[] = array('product_id' => $product_id, 'qty' => $qty, 'name' => $product_info['name']);
                $product_has = true;
                $more_class = "  ";
                $prod_img_src = $product_info['img_src'];
                $product_name = $product_info['name'];
                $sale_price = $product_info['sale_price'];
                $img_src2 = $product_info['img_src2'];
                if ($img_src2 != '') {
                    $img_src2_html = '<img class="stf_default-img-hover-show" src="' . $img_src2 . '" alt="" style="width: 100%;">';
                    $img_src2_has_class = " has_prod_hover_images  ";
                }
            } else {
                //continue;
            }
            $pro_count++;
            $i++;

            $reveal_items_html .= '<div class="col_with  reveal_item_details stf_anchor_mouse_over_effect ' . $more_class . '">';
            $reveal_items_html .= '<div class="line-heading mb-3" attr-product-id="' . $product_id . '">';
            $reveal_items_html .= '<input type="hidden" name="revel_item_prodcut_id" value="' . $product_id . '">';
            $reveal_items_html .= '<h4 class="item_no">Item <span> ' . $i . '</span> </h4>';
            $reveal_items_html .= '</div>';
            $reveal_items_html .= '<div class="img-product stf_delete_edit_product ' . $img_src2_has_class . '">';

            if ($product_has) {
                $reveal_items_html .= '<img class="stf_default-img" src="' . $prod_img_src . '" alt="' . $product_name . '"  style="width: 100%;" >';
                $reveal_items_html .= $img_src2_html;
                $reveal_items_html .= '<a href_rename="javascript:void(0)" onclick="stf_reveal_edit_item(this);return false;" class="stf_anchor_btn"><div class="overlay-edit-btn"><p> EDIT PRODUCT</p></div></a>';
                $reveal_items_html .= '<div class="overlay">';
                $reveal_items_html .= '<a href_rename="javascript:void(0)" class="btn btn-light padding-0 stf_anchor_btn" onclick="stf_reveal_delete_item(this);return false;">';
                $reveal_items_html .= '<i class="fa fa-trash"></i>';
                $reveal_items_html .= '</a>';

                $reveal_items_html .= '<a href_rename="javascript:void(0)" class="btn btn-light padding-0 shadow stf_hide_section stf_anchor_btn" onclick="stf_reveal_edit_item(this);return false;">';
                $reveal_items_html .= '<i class="fa fa-edit"></i>';
                $reveal_items_html .= '</a>';
                $reveal_items_html .= '</div>';
            } else {
                $reveal_items_html .= '<img src="' . $prod_img_src . '" alt="Add Product" title="Add Product"  style="width: 100%;" onclick="stf_reveal_edit_item(this)">';
            }

            $reveal_items_html .= '</div>';
            $reveal_items_html .= '<div class="line-heading-1">';
            if ($product_has) {
                $reveal_items_html .= '<h4>' . $product_name . '</h4>';
                $reveal_items_html .= '<span class=" ">';
                $reveal_items_html .= '<p><strong>Price</strong> ' . $sale_price . '</p>';
                $reveal_items_html .= '</span>';
            }

            $reveal_items_html .= '</div>';
            $reveal_items_html .= '</div>';
        }

        $reveal_alertnative_items_html = '';
        $i = 0;
        foreach ($alernative_product_ids_arr as $product_id) {

            $product_info = $this->getProductDetailsById($product_id);
            $prod_img_src = $add_prod_img_src;
            $sale_price = get_formated_price(0, config('system_settings.decimals', 2));

            $product_name = '';
            $product_has = false;
            $more_class = " stf_reveal_item_empty ";
            $img_src2_has_class = '';
            $img_src2_html = '';
            if ($product_info) {

                $inventory = Inventory::where('product_id', $product_id)->first();
                $qtr = 0;
                if ($inventory) {
                    $qty = $inventory->stock_quantity;
                }
                $products_info_array[] = array('product_id' => $product_id, 'qty' => $qty, 'name' => $product_info['name']);
                $product_has = true;
                $more_class = "  ";
                $prod_img_src = $product_info['img_src'];
                $product_name = $product_info['name'];
                $sale_price = $product_info['sale_price'];
                $img_src2 = $product_info['img_src2'];
                if ($img_src2 != '') {
                    $img_src2_html = '<img class="stf_default-img-hover-show" src="' . $img_src2 . '" alt="" style="width: 100%;">';
                    $img_src2_has_class = " has_prod_hover_images  ";
                }
            } else {
                //continue;
            }
            $alernative_pro_count++;
            $i++;

            $reveal_alertnative_items_html .= '<div class="col_with  reveal_item_details stf_anchor_mouse_over_effect ' . $more_class . '">';
            $reveal_alertnative_items_html .= '<div class="line-heading mb-3" attr-product-id="' . $product_id . '">';
            $reveal_alertnative_items_html .= '<input type="hidden" name="revel_item_prodcut_id" value="' . $product_id . '">';
            $reveal_alertnative_items_html .= '<h4 class="item_no">Alternative item <span> ' . $i . '</span> </h4>';
            $reveal_alertnative_items_html .= '</div>';
            $reveal_alertnative_items_html .= '<div class="img-product rounded img-product-custom-2 stf_delete_edit_product ' . $img_src2_has_class . '">';

            if ($product_has) {
                $reveal_alertnative_items_html .= '<img class="stf_default-img" src="' . $prod_img_src . '" alt="' . $product_name . '"  style="width: 100%;" >';
                $reveal_alertnative_items_html .= $img_src2_html;

                $reveal_alertnative_items_html .= '<a href_rename="javascript:void(0)" onclick="stf_reveal_edit_item(this);return false;" class="stf_anchor_btn"><div class="overlay-edit-btn"><p> EDIT PRODUCT</p></div></a>';

                $reveal_alertnative_items_html .= '<div class="overlay">';
                $reveal_alertnative_items_html .= '<a href_rename="javascript:void(0)" class="stf_anchor_btn btn btn-light padding-0 " onclick="stf_reveal_delete_item(this);return false;">';
                $reveal_alertnative_items_html .= '<i class="fa fa-trash"></i>';
                $reveal_alertnative_items_html .= '</a>';

                $reveal_alertnative_items_html .= '<a href_rename="javascript:void(0)" class="btn btn-light padding-0 shadow stf_hide_section stf_anchor_btn" onclick="stf_reveal_edit_item(this);return false;">';
                $reveal_alertnative_items_html .= '<i class="fa fa-edit"></i>';
                $reveal_alertnative_items_html .= '</a>';

                $reveal_alertnative_items_html .= '</div>';
            } else {
                $reveal_alertnative_items_html .= '<img src="' . $prod_img_src . '" alt="Add Product" title="Add Product"  style="width: 100%;" onclick="stf_reveal_edit_item(this)">';
            }

            $reveal_alertnative_items_html .= '</div>';
            $reveal_alertnative_items_html .= '<div class="line-heading-1 ">';
            if ($product_has) {
                $reveal_alertnative_items_html .= '<h4>' . $product_name . '</h4>';
                $reveal_alertnative_items_html .= '<span class=" ">';
                $reveal_alertnative_items_html .= '<p><strong>Price</strong> ' . $sale_price . '</p>';
                $reveal_alertnative_items_html .= '</span>';
            }

            $reveal_alertnative_items_html .= '</div>';
            $reveal_alertnative_items_html .= '</div>';
        }

        $output = array();
        $output['reveal_alertnative_items_html'] = $reveal_alertnative_items_html;
        $output['reveal_items_html'] = $reveal_items_html;
        $output['reveal_name'] = $reveal_name;
        $output['reveal_status'] = $reveal_status;
        $output['products_info_array'] = $products_info_array;

        return $output;
    }

    public function getRevealInfomationHtmlAjax(Request $request)
    {

        $reveal_id = $request->reveal_id;
        $booking_id = $request->booking_id;
        $booking_details = StylistClientBookingAppointments::where('id', $booking_id)->first();
        $client_name = '';
        if (isset($booking_details)) {

            /*$users_info = Customer::where('id',$booking_details->customer_id )->first();
        if(isset($users_info)){
        $users_info->name = str_replace(',', '', $users_info->name);
        $client_name = '( '.$users_info->name.' )';
        }*/
        }

        $revels_html_item_html = '';

        $merchant_id = Auth::id();
        $revel_item_html = '';
        $add_plus_img = url('images/stylist/add-plus.jpg?3');
        $reveal_items_html = '';
        $reveal_alertnative_items_html = '';
        $pro_count = 1;
        $alernative_pro_count = 1;

        $button_text1 = 'Save & continue later';
        $button_text2 = 'Save & continue later';
        $button_text3 = 'Save & Send to (user first name)';

        $item_and_alernative_html_array = $this->getRevealItemslist($reveal_id);

        $reveal_name = '';
        $reveal_items_html = '';
        $reveal_alertnative_items_html = '';
        $reveal_status = '';
        $reveal_status_msg = '';
        $stock_error_msg = '';
        if (is_array($item_and_alernative_html_array)) {
            if (isset($item_and_alernative_html_array['reveal_items_html'])) {
                $reveal_items_html = $item_and_alernative_html_array['reveal_items_html'];
            }
            if (isset($item_and_alernative_html_array['reveal_alertnative_items_html'])) {
                $reveal_alertnative_items_html = $item_and_alernative_html_array['reveal_alertnative_items_html'];
            }

            if (isset($item_and_alernative_html_array['products_info_array'])) {

                $outofstock_products_name = array();
                $products_info_array = $item_and_alernative_html_array['products_info_array'];
                if (is_array($products_info_array)) {
                    foreach ($products_info_array as $product_info) {
                        if ($product_info['qty'] == 0) {
                            $outofstock_products_name[] = $product_info['name'];
                        }
                    }
                }

                if (count($outofstock_products_name)) {
                    $outofstock_products_name_text = implode(',', $outofstock_products_name);
                    $stock_item_msg = 'item\'s';
                    if (count($outofstock_products_name) == 1) {
                        $stock_item_msg = 'item';
                    }
                    $stock_error_msg = "<div class='reveal_item_stock_error'> Check ( " . $outofstock_products_name_text . " ) " . $stock_item_msg . " stock availability with retailer and adjust quantity</div>";
                }
            }

            if (isset($item_and_alernative_html_array['reveal_name'])) {
                $reveal_name = $item_and_alernative_html_array['reveal_name'];
            }
            if (isset($item_and_alernative_html_array['reveal_status'])) {
                $reveal_status_db = $item_and_alernative_html_array['reveal_status'];
                if ($reveal_status_db == 'awaiting_response') {

                    $reveal_send_details = stylistClientBookingAppointmentsSendResponse::where('reveal_id', $reveal_id)->first();

                    if (isset($reveal_send_details)) {

                        $reveal_status_msg = "<div class='reveal_not_editable'>
						 This reveal was sent on <b>(" . $reveal_send_details->created_at->format('d F') . ")</b> and is <b>" . strtoupper($this->getRevealStatusNameHeadingFormate($reveal_status_db)) . "</b>. You cannot edit.
						</div>";
                    }
                }
                $reveal_status = 'reveal_status_' . $reveal_status_db;
            }
        }

        $revel_form_html = '<div class="col-lg-12  products_items_section reveals_items_section_pop "  >';

        $revel_form_html .= ' <input type="hidden" name="reveal_id" value="' . $reveal_id . '" >';
        $revel_form_html .= ' <div class=" ">';
        $revel_form_html .= '<div class="line-heading-tow mb-3 articles ">';
        $revel_form_html .= '<h3></h3>';
        $revel_form_html .= '<span class="stf_hide_section ">
                  <button class="stf-save-btn-1" onclick="stfShowRevealsPage(this)"><i class="fa fa-arrow-left padding-right-2" aria-hidden="true"></i> Back</button>
                  <a class="stf_add_tag_btn_item stf_anchor_btn" href_rename="javascript:void(0);" onclick="stf_reveal_edit_item(this);return false;" >
                  <span><i class="fa fa-plus"></i>Add a Item</span>
                     </a>
            </span>';

        $revel_form_html .= '</div>';

        $revel_form_html .= '<div class="row disply_flex_div">';
        $revel_form_html .= '<div class="col-md-12 ">';
        $revel_form_html .= '<div class="row just_content_space">';
        $revel_form_html .= $reveal_items_html;
        //$revel_form_html  .= '</div>';

        $revel_form_html .= '</div>';
        $revel_form_html .= '</div>';
        $revel_form_html .= '</div>';
        $revel_form_html .= '</div>';
        $revel_form_html .= '</div>';

        $reveal_alertnative_form_html = '';
        $reveal_alertnative_form_html = '';
        $reveal_alertnative_form_html = '<div class="col-lg-12  products_items_section reveals_alertnative_items_section_pop">';
        $reveal_alertnative_form_html .= ' <div class="">';

        $reveal_alertnative_form_html .= '<div class="line-heading mb-3 articles">';
        $reveal_alertnative_form_html .= '<h3></h3>';
        $reveal_alertnative_form_html .= '</div>';

        $reveal_alertnative_form_html .= '<div class="row disply_flex_div">';
        $reveal_alertnative_form_html .= '<div class="col-md-12 ">';
        $reveal_alertnative_form_html .= '<div class="row just_content_space ">';
        $reveal_alertnative_form_html .= $reveal_alertnative_items_html;
        $reveal_alertnative_form_html .= '</div>';

        $reveal_alertnative_form_html .= '</div>';
        $reveal_alertnative_form_html .= '</div>';
        $reveal_alertnative_form_html .= '</div>';
        $reveal_alertnative_form_html .= '</div>';

        $save_btn = '<div class="col-md-12 stf_btn_action_section" style="display:none">';
        $save_btn .= '<button class="stf-save-btn-1" onclick="stfShowRevealsPage(this)"><i class="fa fa-arrow-left padding-right-2" aria-hidden="true"></i> Back</button>';
        $save_btn .= '<span style="float: right;">';
        $save_btn .= '<button class="stf-save-btn stf-save-draf-btn  button stf-save-btn-transparent" onclick="stfSaveRevealsForm(this,\'draft\')">' . $button_text1 . '</button>';
        //$reveal_alertnative_form_html  .= '<button class="stf-save-btn"onclick="stfSaveRevealsForm(this,\'save\')">Save</button>';
        //$reveal_alertnative_form_html  .= '<button class="stf-save-btn btn-info" onclick="stfSaveRevealsForm(this,\'save_send\')">Save & Send</button>';
        $save_btn .= '</span>';
        $save_btn .= '</div>';
        $save_btn .= '<div class=" stf_outer_body "><div class="action_btn_section_bottom"><div class=""><a  onclick="stfSaveRevealsForm(this,\'draft\',\'reload_page\');return false;" href_rename="javascript:void(0)"  class="stf_anchor_btn action_btn_section-two">SAVE AS DRAFT ' . $client_name . '</a></div></div></div>';
        $msg_div = '<div class="save_reveals_item_msg_wrapper"><div class="save_reveals_item_msg stf_eorr_success_msg col-lg-12"></div></div>';

        $next_step_button = '<div class="position-absolute-style top-0 end-0">
                   <a href_rename="javascript:void(0)" onclick="stfSaveRevealsForm(this,\'draft\');return false;" onclick_rename="stfGetRevealItemsStepHtml(this,2,\'yes\')"  class="stf_anchor_btn btn-dark-outline"></i><span><strong>STEP 2 </strong>UPLOAD VIDEO > </span></a></div>
                   <div class="position-absolute-styles-2 top-0 end-0 border-btn">
               		<a href_rename="javascript:void(0)" onclick="stfShowRevealsPage(this);return false;" class="stf_anchor_btn btn-dark-outline">
              		 <span> < Back </a> </span>

           		  </div>';

        $step1_html = '';
        $step1_html .= $stock_error_msg;
        $step1_html .= $reveal_status_msg;
        //  <a href="#" class="btn btn-dark-outline">< Back    </a>
        $step1_html .= '<div class="col-lg-12 reveal_fields_wrappr ' . $reveal_status . '"><input type="text" name="reveal_name" value="' . $reveal_name . '" placeholder="             Enter Reveal Name             " ></div>';
        $step1_html .= '<div class="revel_save_steps revel_save_steps_1 ' . $reveal_status . '"><div class="">' . $msg_div . $revel_form_html . $reveal_alertnative_form_html . $msg_div . $save_btn . '</div>' . $next_step_button . "</div>";

        $step_progress_bar_html = ' <div class="line-container-t reveal_item_save_progress_section">
                                    <div class="progress-line-i">

                                       <div class="status reveal_item_save_progress_section_setp_1" onclick="stfGetRevealItemsStepHtml(this,1,\'no\')">
                                          <div class="dot current ">
                                          </div>
                                          <p class="text-nowrap" >  <span style="font-weight: 600;"> STEP 1 </span>ADD PRODUCTS</p>
                                       </div>
                                       <div class="status reveal_item_save_progress_section_setp_2" onclick="stfGetRevealItemsStepHtml(this,2,\'yes\')">
                                          <div class="dot completed">
                                          </div>
                                          <p class="text-nowrap" >  <span style="font-weight: 600;"> STEP 2 </span>UPLOAD VIDEO </p>
                                       </div>
                                       <div class="status reveal_item_save_progress_section_setp_3" onclick="stfGetRevealItemsStepHtml(this,3,\'yes\')">
                                          <div class="dot completed">
                                          </div>
                                          <p class="text-nowrap" >  <span style="font-weight: 600;"> STEP 3 </span>REVIEW AND SUBMIT</p>
                                       </div>
                                    </div>
                                 </div>
                                ';

        $step2_html = '<div class="revel_save_steps revel_save_steps_2  ' . $reveal_status . '" style="display:none">';
        $step2_html .= $reveal_status_msg;
        $step2_html .= $this->getRevealItemStep2Html($reveal_id, $booking_id);
        $step2_html .= '</div>';

        $step3_html = '<div class="revel_save_steps revel_save_steps_3  ' . $reveal_status . '" style="display:none">';
        $step3_html .= $reveal_status_msg;
        $step3_html .= $this->getRevealItemStep3Html($booking_id, $reveal_id);
        $step3_html .= '</div>';

        $html = $step_progress_bar_html . $step1_html . $step2_html . $step3_html;

        return response()->json(['success' => 1, 'message' => 'Data Successfully Fetched', 'data' => $html]);
    }

    public function getRevealItemVideoHtml($reveal_id = 0, $booking_id = 0, $page_type = '')
    {

        $merchant_id = Auth::id();
        $reveal_info = stylistRevealsItems::where('merchant_id', $merchant_id)->where('id', $reveal_id)->first();
        $has_video = false;
        $video_url = '';
        $show_video_player = 'none';
        $show_upload_video = 'block';
        if (isset($reveal_info)) {

            if ($reveal_info->doc_name != '') {
                $show_video_player = 'block';
                $show_upload_video = 'none';
                $has_video = true;

                $video_url = url('uploads/' . $reveal_info->doc_name);
            }
        }

        $class = " col-md-4  ";
        $html_file = '';
        $html_file2 = '';
        if ($page_type != 'review_page') {
            $html_file2 = '
			<div class="offset-sm-3">
						  <div class="form-group stf_video_btn_wrapper  ">
						  <input type="file" name="reveal_video_update"  class=" form-control-file font-weight-bold" id="reveal_video_update_btn"  data-title="UPLOAD VIDEO">
						  </div>
  						</div>';

            $html_file = '
			<div class="offset-sm-3">
						  <div class="form-group stf_video_btn_wrapper  ">
						  <input type="file" name="reveal_video_update"  class=" form-control-file font-weight-bold" id="reveal_video_update_btn"  data-title="REUPLOAD VIDEO">
						  </div>
  						</div>';
        } else if ($page_type == 'review_page') {
            $class = " col-md-3  ";
        }
        $video_html = '';

        if ($video_url != '') {
            $video_html = '<video width="100%" controls="">
                           <source src="' . $video_url . '" type="video/mp4">
                           <source src="' . $video_url . '" type="video/ogg">
                           Your browser does not support HTML video.
                        </video>';
        }

        $html = '<div class=" view_reveal_id_' . $reveal_id . '  ' . $class . '  my-5 stf_video_uploaded_section" style="display:' . $show_video_player . '">

                     <div class="stf_delete_edit_product-video1">
                        ' . $video_html . '



                        </div>
                        <div class="stf_outer_body ">

                       ' . $html_file . '


                           <div class="stf_hide_section" >
                              <a href_rename="javascript:void(0)" onclick="strTriggerByInputName(\'reveal_video_update\');return false;" class="reveal_video_upload_btn stf_anchor_btn action_btn_section-two">REUPLOAD VIDEO</a>
                           </div>
                        </div>
                        </div>

 						<div class=" ' . $class . ' stf_video_upload_btn_section" style="display:' . $show_upload_video . '">
                        <div class="stf_delete_edit_product-video">
                        	' . $html_file2 . '
                           <a href_rename="javascript:void(0)" onclick="strTriggerByInputName(\'reveal_video_update\');return false;" class="stf_hide_section reveal_video_upload_btn stf_anchor_btn">
                              <p>UPLOAD VIDEO</p>
                           </a>
                        </div>
                     </div>

               ';

        $output['html'] = $html;
        return $output;
    }

    public function getRevealItemStep2Html($reveal_id = 0, $booking_id = 0)
    {

        $merchant_id = Auth::id();
        $revels_html_item_html = '';

        $msg_div = '<div class="save_reveals_item_msg_wrapper"><div class="save_reveals_item_msg stf_eorr_success_msg col-lg-12"></div></div>';
        $button_text2 = 'Save & continue later';
        $step2_html = '';
        $video_html_arr = $this->getRevealItemVideoHtml($reveal_id, $booking_id);
        if (isset($video_html_arr['html'])) {
            $step2_html .= '<div class="row disply_flex_div">';
            $step2_html .= '<div class="col-md-12 m-auto">';
            $step2_html .= '<div class="row just_content_space-t ">';
            $step2_html .= $video_html_arr['html'];
            $step2_html .= '</div>';
            $step2_html .= '</div>';
            $step2_html .= '</div>';
        }

        $step2_html .= '<div class="position-absolute-styles top-0 end-0">
               <a href_rename="javascript:void(0)" onclick="stfGetRevealItemsStepHtml(this,3,\'yes\');return false;"  class="stf_anchor_btn btn-dark-outline">

               <span>
               <strong>STEP 3 </strong> REVIEW & SUBMIT >
               </span></a>
            </div>';
        $step2_html .= '<div class="position-absolute-styles-2 top-0 end-0">
               <a href_rename="javascript:void(0)"  onclick="stfGetRevealItemsStepHtml(this,1,\'no\');return false;"  class="stf_anchor_btn btn-dark-outline">

               <span>
               <strong> < STEP 1 </strong> ADD PRODUCT</span></a>
            </div>';

        $step2_html .= $msg_div;

        $step2_html .= '<div class="stf_outer_body "> <div class="action_btn_section_bottom"><div class=""><a href_rename="javascript:void(0)" onclick="stfSaveRevealsFormVideo(this,\'draft\',\'reload_page\');return false;" class="stf_anchor_btn action_btn_section-two">SAVE AS DRAFT </a></div></div></div>';

        return $step2_html;
    }

    public function getRevealItemStep3Html($booking_id = 0, $reveal_id = 0)
    {

        $booking_details = StylistClientBookingAppointments::where('id', $booking_id)->first();

        $user_details = array();
        $user_details['name'] = '';
        if ($booking_details) {
            $user_details['name'] = $booking_details->name;
        }

        $msg_div = '<div class="save_reveals_item_msg_wrapper"><div class="save_reveals_item_msg stf_eorr_success_msg col-lg-12"></div></div>';

        $reveal_items_html = '';
        $reveal_alertnative_items_html = '';
        $item_and_alernative_html_array = $this->getRevealItemslist($reveal_id);
        if (is_array($item_and_alernative_html_array)) {
            if (isset($item_and_alernative_html_array['reveal_items_html'])) {
                $reveal_items_html = $item_and_alernative_html_array['reveal_items_html'];
            }
            if (isset($item_and_alernative_html_array['reveal_alertnative_items_html'])) {
                $reveal_alertnative_items_html = $item_and_alernative_html_array['reveal_alertnative_items_html'];
            }
        }
        $step3_html = $msg_div;

        $vedio_html = '';
        $video_html_arr = $this->getRevealItemVideoHtml($reveal_id, $booking_id, 'review_page');
        if (isset($video_html_arr['html'])) {
            $vedio_html = $video_html_arr['html'];
        }
        $step3_html .= '<div class="row disply_flex_div">
						   <div class="col-md-12 m-auto">
						      <div class="row " style="margin: 40px 0px;">
						         <div class="col-md-9 ">
						            <div class="row just_content_space ">
						            ' . $reveal_items_html . '
						            </div>
						            <div class="row just_content_space ">
						             ' . $reveal_alertnative_items_html . '
						            </div>
						         </div>



						            ' . $vedio_html . '

						      </div>
						   </div>
						</div>';

        $booking_details = StylistClientBookingAppointments::where('id', $booking_id)->first();
        $client_name = '';

        $show_send_notification_btn = $this->showRevealSendNotificationBtn($reveal_id, $booking_id);

        if (isset($booking_details)) {

            $users_info = Customer::where('id', $booking_details->customer_id)->first();
            if (isset($users_info)) {
                $users_info->name = str_replace(',', '', $users_info->name);
                $client_name = $users_info->name;
            }
        }

        $step3_html .= '  <div class=""><a onclick_rename="return false;" href_rename="javascript:void(0)" class="stf_anchor_btn action_btn_section-two" onclick="stfReloadPage(\'reload_page\');return false;">SAVE AS DRAFT</a></div>';

        $step3_html .= '<div class="position-absolute-styles-2 top-0 end-0">
               <a href_rename="javascript:void(0)" onclick="stfGetRevealItemsStepHtml(this,2,\'yes\');return false;" class="stf_anchor_btn btn-dark-outline">
               <span>
               <strong> < STEP 2 </strong>UPLOAD VIDEO
               </span></a>
            </div>';

        if ($show_send_notification_btn == 'Y') {
            $step3_html .= '<div class="position-absolute-styles top-0 end-0 btn_send_user_notification">
              	<a data-link="' . url('') . '/admin/stylist/customer_request_response/load_email_template/' . $booking_id . '/' . $reveal_id . '" class="ajax-modal-btn " style="cursor: pointer;">SEND TO  ' . $client_name . '</a>
            </div>';
        }

        return $step3_html;
    }

    public function showRevealSendNotificationBtn($current_reveal_id = 0, $booking_id = 0)
    {

        $merchant_id = Auth::id();
        $show = 'Y';
        $booking_details = StylistClientBookingAppointments::where('id', $booking_id)->first();
        if (isset($booking_details)) {
            if ($booking_details->status == getRevealStatusKeyNameHelper('completed')) {
                $show = 'Y';
            } else if (0 && $booking_details->status == getRevealStatusKeyNameHelper('in_progress')) {
                $show = 'Y';
            } else if ($booking_details->status == getRevealStatusKeyNameHelper('not_started')) {
                $show = 'Y';
            } else if ($booking_details->status == getRevealStatusKeyNameHelper('decline')) {
                $show = 'Y';
            } else if ($booking_details->status == getRevealStatusKeyNameHelper('return_initiated')) {
                $show = 'Y';
            } else {
                $reveal_status = $this->getRevealStatusNameByKey('draft');
                $reveal_status2 = $this->getRevealStatusNameByKey('not_started');
                $reveals_info = stylistRevealsItems::where('merchant_id', $merchant_id)->where('booking_id', $booking_id)->where('status', '!=', $reveal_status)->where('status', '!=', $reveal_status2)->get();

                if ($reveals_info->isNotEmpty()) {
                    if (0 && count($reveals_info) == 1) {
                        $show = 'Y';
                    } else {
                        // loloollollololololololol
                        $reveal_status = '';
                        $updated_at = '';
                        $show = 'N';
                        foreach ($reveals_info as $reveal_info_key => $reveal_info) {

                            if ($reveal_info->id == $current_reveal_id) {

                                continue;
                            }
                            $reveal_status = strtolower($reveal_info->status);
                            $updated_at = $reveal_info->updated_at;
                        }

                        if ($reveal_status == 'decline') {
                            $show = 'Y';
                        } else if ($updated_at != '') {

                            // if previous reveal is upated before 47 days
                            $now = time(); // or your date as well
                            $your_date = strtotime($updated_at);
                            $datediff = $now - $your_date;
                            $day = round($datediff / (60 * 60 * 24));
                            if ($day > stylistShowSendMailNextRevealBeforeDayHelper()) {
                                $show = 'Y';
                            }
                        }
                    }
                }
            }
        }
        return $show;
    }

    public function changeStatusOfRevealItem($reveal_id = 0, $status = '')
    {
        $records = array('status' => $status);

        $dataHas = stylistRevealsItems::where('id', $reveal_id)->first();

        if (isset($dataHas)) {
            if ($dataHas->update($records)) {
            }
        }
    }
    public function getRevealItemStepLoadHtml(Request $request)
    {
        $this->validate($request, [
            'booking_id' => 'required',
            'reveal_id' => 'required',
            'step_no' => 'required',
        ]);
        $booking_id = $request->booking_id;
        $reveal_id = $request->reveal_id;
        $output = array();
        $html = '';
        if ($request->step_no == 3) {
            $html = $this->getRevealItemStep3Html($booking_id, $reveal_id);
            //$output['success'] = 'Something is Wrong';
        } else if ($request->step_no == 1) {
            //$html = $this->getRevealItemStep2Html($booking_id, $reveal_id);
        } else if ($request->step_no == 2) {
            $html = $this->getRevealItemStep2Html($reveal_id, $booking_id);
            //$output['success'] = 'Something is Wrong';
        } else {
            $output['error'] = 'Something is Wrong';
        }

        $output['html'] = $html;
        return response()->json($output);
    }

    public function productsListAjax(Request $request)
    {

        //$products = $this->getMerchantProductsList();
        $products_infoArr = $this->getProductsWithFilter($request);

        $all_categories = $products_infoArr['all_categories'];
        $products = $products_infoArr['product'];

        $product_list_html = '';
        /*$product_list_html = '<div class="modal-dialog" role="document">';
        $product_list_html .= '<div class="modal-content">';
        $product_list_html .= '<div class="modal-header">';
        $product_list_html .= '<h4 class="modal-title" >Select Product';
        $product_list_html .= '<span class="btn " onclick="stfGetImportProductModaltmlAjax(this)" >Import Product</span></h4>';
        $product_list_html .= '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
        $product_list_html .= '<span aria-hidden="true">&times;</span>';
        $product_list_html .= '</button>';
        $product_list_html .= '</div>';
        $product_list_html .= '<div class="modal-body">';
        $product_list_html .= '<div class="search__container">    ';
        $product_list_html .= '<input class="search__input" type="text" placeholder="Search Product" onkeyup="stfSearchProductByName(this)" >';
        $product_list_html .= '</div>';
        $product_list_html .= '</div>';
        $product_list_html .= '<div class="search__container_body">';
         */
        $filter_prouct = false;
        if (isset($request['filter_values'])) {
            $filter_prouct = true;
        }

        $pagination_html = '';
        if (isset($products)) {
            $pagination_html = $products->links() . '';
        }

        $top_bar = '<div class="sidenav_heading_top_bar "><div class="col-sm-6 sidenav_heading ">Dappr Store</div> <div class="col-sm-6 paginate_html">' . $pagination_html . '</div></div>';
        $attributes_html = '';
        $shop_id = Auth::user()->merchantId();
        if (!$filter_prouct) {
            $product_list_html = '<div class="main">';
            $attributes = Attribute::select('id', 'name', 'attribute_type_id', 'order')->whereIn('name', $this->getProductAttributeList())
                ->orderBy('order')->get();

            /*$attributes_value = AttributeValue::select('*')->where('shop_id',$shop_id )->orderBy('order')->get();*/
            $attributes_value = AttributeValue::select('*')->orderBy('order')->get();

            $attribute_value_info_arr = array();
            if ($attributes_value) {

                foreach ($attributes_value as $attribute_value_info) {

                    $attribute_value_info_arr[$attribute_value_info->attribute_id][] = $attribute_value_info;
                    //'<a href="javascript:void(0)" >'.$attribute_value_info->value.'</a>';
                }
            }

            $brands = ListHelper::get_unique_brand_names_from_linstings(Product::where('active', '1'));

            $attributes_html = '
	 		 <div class="sidenav sidenav_padding-store"> <div class="custom-filter">FILTER</div>';
            //$category_list = Category::where('active',1)->get();

            // $product=Product::where()

            $group_category_list = CategoryGroup::where('active', 1)->with('categories')->get();

            if ($group_category_list) {
                $attributes_html .= '<button type="button" class="btn  dropdown-btn" data-toggle="collapse" data-target="#stf_product_filter_cat_filter">Category<i class="fa fa-caret-down"></i></button>
					  	<div id="stf_product_filter_cat_filter" class="collapse stf_product_filter_value_list" filter-name="category">
					 	 ';
                $first = 0;
                // $attributes_html .= '<a href_rename="javascript:void(0)" class="prod_filter_checkbox_outer  stf_anchor_btn prod_filter_active stf_hide_section_class " onclick="return false;" ><input checked type="radio" class="prod_filter_checkbox" name="category_filter" value="all_categories">All category sdsdfsdfsdfsd </a>';


                $attributes_html .= '<div class="group_categories_filter">';
                foreach ($group_category_list as $group_category_info) {

                    $first++;
                    /*if($first == 1){
                    $attributes_html .= '<a href_rename="javascript:void(0)" class="prod_filter_checkbox_outer  stf_anchor_btn" onclick="return false;" ><input  type="radio" class="prod_filter_checkbox" name="category_filter" value="'.$group_category_info->slug.'">'.$group_category_info->name.'</a>';
                    }else{

                    $attributes_html .= '<a href_href="javascript:void(0)" onclick="return false;" class="prod_filter_checkbox_outer stf_anchor_btn" ><input  type="radio" class="prod_filter_checkbox" name="category_filter" value="'.$group_category_info->slug.'">'.$group_category_info->name.'</a>';

                    }*/

                    // if($group_category_info->slug == 'menswear'  || $group_category_info->slug == 'womenswear')
                    // $group_category_list = CategorySubGroup::where('active', 1)->with('categories')->get();
                    $attributes_html .= '<button type="button" class="btn prod_filter_checkbox_outer  prod_filter_group_filter stf_product_filter_value_list dropdown-btn product_filter_cat_filter_' . $group_category_info->id . '" data-toggle="collapse" data-target="#stf_product_filter_cat_filter_' . $group_category_info->id . '" filter-name="category">' . $group_category_info->name . '<i class="fa fa-caret-down"></i>
                    <input type="radio" name="' . $group_category_info->slug . '_filter"  class="prod_filter_checkbox" value="' . $group_category_info->slug. '"></button>
					  	<div id="stf_product_filter_cat_filter_' . $group_category_info->id . '" class="collapse stf_product_filter_value_list" filter-name="category">';

                    $category_subgroup_list = $group_category_info->subGroups()->get();
                    // print_r($category_subgroup_list);
                    if ($category_subgroup_list) {
                        foreach ($category_subgroup_list as $category_subgroup_list_info) {
                            $attributes_html .= '<a href_href="javascript:void(0)" onclick="return false;" class="prod_filter_checkbox_outer stf_anchor_btn" data-toggle="collapse"  data-target="#stf_product_filter_cat_supgroup_filter_' . $category_subgroup_list_info->id . '" ><input  type="radio" class="prod_filter_checkbox" name="category_filter" value="' . $category_subgroup_list_info->slug . '">' . $category_subgroup_list_info->name . '</a>';

                            $category_subgroup_cat_list = $category_subgroup_list_info->categories()->get();
                            if ($category_subgroup_cat_list) {
                                $attributes_html .= ' <div id="stf_product_filter_cat_supgroup_filter_' . $category_subgroup_list_info->id . '" class="collapse stf_product_filter_value_list stf_product_filter_cat_supgroup_filter_outer" filter-name="category">';

                                foreach ($category_subgroup_cat_list as $category_subgroup_cat_list_info) {

                                    $attributes_html .= '<a href_href="javascript:void(0)" onclick="return false;" class="prod_filter_checkbox_outer stf_anchor_btn" ><input  type="radio" class="prod_filter_checkbox" name="category_filter" value="' . $category_subgroup_cat_list_info->slug . '">' . $category_subgroup_cat_list_info->name . '</a>';

                                    //$attributes_html .= $category_subgroup_cat_list_info->name;
                                }
                                $attributes_html .= '</div>';
                            }
                        }
                    }
                    $attributes_html .= '</div>';
                }

                $attributes_html .= '</div>';
                $attributes_html .= '</div>';
            }

            if ($brands->isNotEmpty()) {
                $attributes_html .= '<button type="button" class="btn  dropdown-btn" data-toggle="collapse" data-target="#stf_product_filter_brand">Brand<i class="fa fa-caret-down"></i></button>
						  	<div id="stf_product_filter_brand" class="collapse stf_product_filter_value_list" filter-name="brand">

						 	 ';
                foreach ($brands as $brand_name) {

                    $attributes_html .= '<a href_rename="javascript:void(0)" class="prod_filter_checkbox_outer stf_anchor_btn" onclick="return false;" ><input type="radio" name="brand_filter"  class="prod_filter_checkbox" value="' . $brand_name . '">' . $brand_name . '</a>';
                }
                $attributes_html .= '</div>';
            }

            if ($attributes) {
                $attributes_name_has = $this->getProductAttributeList();
                foreach ($attributes as $attribute_info) {
                    $cat_name = $attribute_info['name'];
                    if (!in_array(strtolower($cat_name), $attributes_name_has)) {
                        continue;
                    }

                    if (isset($attribute_value_info_arr[$attribute_info->id])) {
                        $attributes_html .= '<button type="button" class="btn  dropdown-btn" data-toggle="collapse" data-target="#stf_product_filter_' . $attribute_info->id . '">' . $attribute_info->name . '<i class="fa fa-caret-down"></i></button>
						  	<div id="stf_product_filter_' . $attribute_info->id . '" class="collapse stf_product_filter_value_list" filter-name="' . $cat_name . '">

						 	 ';

                        foreach ($attribute_value_info_arr[$attribute_info->id] as $attr_value) {

                            $attributes_html .= '<a href_rename="javascript:void(0)" class="prod_filter_checkbox_outer stf_anchor_btn"  onclick="return false;"><input type="radio" name="' . $cat_name . '_filter"  class="prod_filter_checkbox" value="' . $attr_value->value . '">' . $attr_value->value . '</a>';
                        }

                        $attributes_html .= '</div>';
                    }
                }
            }

            $attributes_html .= '</div>';

            $product_list_html .= '<div class="container">';
            $product_list_html .= '<div class="row ">';
            $product_list_html .= '<div class="col-md-12 custom-top-bar-style">';
            $product_list_html .= $top_bar  ;
            $product_list_html .= '</div>';
            $product_list_html .= '<div class="col-md-3 ">';
            $product_list_html .= $attributes_html;
            $product_list_html .= '</div>';

            $product_list_html .= '<div class="col-md-9  stf-add-new-product">';
        }

        $product_list_html .= '<div class="row">';
        $add_plus_img = url('images/stylist/add-plus.jpg?3');
        $product_list = '';
        $product_list = '<div class="col-md-3 px-2">
				               <div class="img-product shadow round-style stf_delete_edit_product" onclick="stfGetImportProductModaltmlAjax(this)" style="cursor: pointer;">
				                  <img src="' . $add_plus_img . '" alt="Add Product" style="width: 100%;">
				               </div>
				               <div class="line-heading-1">
				                  <h4 class="text-center">Add new product</h4>
				               </div>
				            </div>';
        if (isset($products)) {
            //$product_list .= ' <ul class="list-group   stf_products_list_ul">';

            foreach ($products as $product) {

                if ($all_categories == 'Y') {
                    $product_id = $product->id;
                } else {
                    $product_id = $product->product_id;
                }

                $product = Product::where('active', '1')->where('id', $product_id)->with('categories', 'shop.logo', 'featureImage', 'image')
                    ->withCount('inventories')->orderBy('id', 'DESC')->first();

                /*$html = '<li class="list-group-item d-flex justify-content-between align-items-center"  for="select_prod_li_'.$product->id.'" data-prod-id="'.$product->id.'" onclick="stfSelectProdut('.$product->id.')" data-product-name="'.strtolower($product->name).'" >'.$product->name.'</li>';
                echo $html;*/

                $img_src = url('images/stylist/product-placeholder.jpg');
                $img_src2_has_class = '';
                $img_src2_html = '';
                $inventory = Inventory::where('product_id', $product_id)->first();
                $img_html = '';
                $sale_price = 0;
                $img_src2 = '';
                $qty = 0;

                $sale_price = get_formated_price($sale_price, config('system_settings.decimals', 2));

                if (isset($product)) {
                    $im = 0;
                    foreach ($product->images as $img) {
                        $im++;
                        if ($im == 1) {
                            $img_src = url('') . '/image/' . $img->path;
                        }
                        if ($im == 2) {
                            $img_src2 = url('') . '/image/' . $img->path;
                            $img_src2_html = '<img class="stf_default-img-hover-show" src="' . $img_src2 . '" alt="" style="width: 100%;">';
                            $img_src2_has_class = " has_prod_hover_images  ";

                            break;
                        }
                    }
                }

                if ($inventory) {
                    $qty = $inventory->stock_quantity;
                    $sale_price = $inventory->sale_price;
                    $sale_price = get_formated_price($sale_price, config('system_settings.decimals', 2));
                    $im = 0;

                    foreach ($inventory->images as $img) {
                        $im++;

                        if ($im == 1) {
                            $img_src = url('') . '/image/' . $img->path;
                        }
                        if ($im == 2) {
                            $img_src2 = url('') . '/image/' . $img->path;
                            $img_src2_html = '<img class="stf_default-img-hover-show" src="' . $img_src2 . '" alt="" style="width: 100%;">';
                            $img_src2_has_class = " has_prod_hover_images  ";

                            break;
                        }
                    }
                }

                /*$product_list .= '<li class="list-group-item d-flex justify-content-between align-items-center stf_anchor_mouse_over_effect"  for="select_prod_li_'.$product->id.'" data-prod-id="'.$product->id.'" onclick="stfGetProductDetailsHtmlAjax('.$product->id.')" data-product-name="'.strtolower($product->name).'" >';
                $product_list .= '<div class="row search__container_hover" style="margin: 0px 19px;" >';
                $product_list .= '<div class="col-md-2 search__container_text">';
                $product_list .= '<img src="'.$img_src.'" style="width: 100%;" alt="">';
                $product_list .= '</div>';
                $product_list .= '<div class="col-md-10 ">';
                $product_list .= '<h4>'.$product->name.'</h4>';
                $product_list .= '</div>';
                $product_list .= '</div>';
                $product_list .= '</li>';
                 */

                $img_src = str_replace('/images\\', '/images/', $img_src);
                $product_list .= '<div class="col-md-3 px-2 stf_product_info_modal_single"  data-product-id="' . $product->id . '">
						               <div class="img-product shadow round-style stf_delete_edit_product  ' . $img_src2_has_class . '" >
						                  <img class="stf_default-img" src="' . $img_src . '" alt="" style="width: 100%;">
						                  ' . $img_src2_html . '
						                     <a href_rename="javascript:void(0)" onclick = "stfEditProductModalShowById(this,' . $product->id . ');return false;" class="stf_anchor_btn">
						                        <div class="overlay-add-new-btn">
						                           <p > EDIT PRODUCT</p>
						                        </div>
						                     </a>
						               </div>
						               <div class="line-heading-1">
						                  <div class="row">
						                     <div class="col-md-9">
						                        <h4 title="' . $product->name . '" class="stf_pro_name_text">' . $product->name . '</h4>
						                           <span class="text-dark ">
						                              <p><strong>Price</strong> ' . $sale_price . '</p>
						                           </span>
						                     </div>
						                     <div class="col-md-3" >
						                     <a href_rename="javascript:void(0)" class="stf_anchor_btn stf-add-new-product-plus-btn" onclick="return false;"><i class="fa fa-plus" aria-hidden="true" 4545 onclick_rename="stfGetProductDetailsHtmlAjax(' . $product->id . ')" data-product-name="' . strtolower($product->name) . '" onclick="stfRevealItemAdd(\'' . $img_src . '\',\'' . $product->id . '\',\'' . $product->name . '\',\'' . $sale_price . '\',\'' . $img_src2 . '\',\'' . $qty . '\')"></i></a>
						                     </div>
						                  </div>
						               </div>
						            </div>';
            }

            //$product_list .= ' </ul>';
        } else {
            $product_list .= '<span>No Product</span>';
        }

        $product_list_html .= $product_list;

        $product_list_html .= '</div>';
        $product_list_html .= $pagination_html;

        if (!$filter_prouct) {
            $product_list_html .= '</div>';
            $product_list_html .= '</div>';

            $product_list_html .= '</div>';
            $product_list_html .= '</div>';
        }
        /*$product_list_html .= '</div>';

        $product_list_html .= ' <div class="modal-footer">';

        $product_list_html .= '<button type="button" class="btn btn-secondary stf-modal-close-btn stf-save-btn-transparent" data-dismiss="modal">Close</button>';
        $product_list_html .= '</div>';
        $product_list_html .= '</div>';
        $product_list_html .= '</div>';
         */
        // \\192.168.1.8\www\hype-dappr\resources\views\admin\stylist_form\.blade.php
        $output = array();

        $output['pagination_html'] = $pagination_html;
        $output['product_list_html'] = $product_list_html;
        if ($filter_prouct) {
            $output['product_list_filter_html'] = $product_list_html;
        }
        return $output;
    }

    public function saveRevealItems()
    {

        $output = array();
        if (isset($_POST['booking_id']) && isset($_POST['reveal_id']) && isset($_POST['save_action'])) {
            $booking_id = $_POST['booking_id'];
            $reveal_id = $_POST['reveal_id'];
            $reveal_name = $_POST['reveal_name'];
            $save_action = $_POST['save_action'];
            $merchant_id = Auth::id();
            $product_ids = '';
            if (isset($_POST['product_ids']) && is_array($_POST['product_ids']) && count($_POST['product_ids'])) {

                $product_ids = implode(',', $_POST['product_ids']);
            }

            $alernative_product_ids = '';
            if (isset($_POST['alernative_product_ids']) && is_array($_POST['alernative_product_ids']) && count($_POST['alernative_product_ids'])) {

                $alernative_product_ids = implode(',', $_POST['alernative_product_ids']);
            }

            $records = array('booking_id' => $booking_id, 'product_ids' => $product_ids, 'merchant_id' => $merchant_id, 'alernative_product_ids' => $alernative_product_ids, 'name' => $reveal_name);

            if ($save_action != '') {
                $records['status'] = $save_action;
            }

            $dataHas = stylistRevealsItems::where('id', $reveal_id)->first();
            $obj = new stylistRevealsItems();

            if (isset($dataHas)) {

                if ($dataHas->update($records)) {
                    $records['id'] = $reveal_id;
                    $output['records'] = $dataHas->toArray();
                    $output['success'] = 'Updated Successfully';
                }
            } else {
                $output['success'] = 'Save Successfully';
                $records['reveal_id'] = $reveal_id;
                $records = $obj->create($records);
                $output['records'] = $records;
            }
            $reveal_item = stylistRevealsItems::where('merchant_id', $merchant_id)->where('id', $records['id'])->first();
            $output['reveal_html_item'] = $this->getRevealDetails($reveal_item);
            $output['reveal_item_upload_step_html'] = $this->getRevealItemStep2Html($reveal_id);
        } else {
            $output['error'] = 'Something Wrong';
        }
        return response()->json($output);
    }

    public function sendRevealItemToClient(Request $request)
    {

        $output = array();

        if (isset($request->booking_id) && isset($request->reveal_id) && isset($request->save_action)) {
            $booking_id = $request->booking_id;
            $reveal_id = $request->reveal_id;
            $save_action = $request->save_action;
            $merchant_id = Auth::id();

            $dataHas = stylistRevealsItems::where('id', $reveal_id)->first();

            if (isset($dataHas)) {
            } else {
                $output['error'] = 'Something Wrong';
            }
        } else {
            $output['error'] = 'Please select required field';
        }
        return response()->json($output);
    }

    public function saveRevealItemAddVideo(Request $request)
    {
        //$file =  $request->file('file');

        $this->validate($request, [
            'file' => 'required|mimetypes:video/mp4,video/x-matroska,video/avi,video/mpeg,video/quicktime|max:100000',

        ]);
        /*$this->validate($request, [
        'file' => 'required|mimes:mp4,mov,ogg,qt | max:20000',
        ]);*/
        $output = array();

        if (isset($request->booking_id) && isset($request->reveal_id)) {
            $booking_id = $request->booking_id;
            $reveal_id = $request->reveal_id;
            $save_action = $request->save_action;
            $merchant_id = Auth::id();

            $dataHas = stylistRevealsItems::where('id', $reveal_id)->first();

            if (isset($dataHas)) {
                $video_name = '';
                if ($request->hasFile('file')) {
                    $file = $request->file('file');
                    $file_name = $file->getClientOriginalName();
                    $replace = '_' . date('dmyHms') . '.';
                    $search = '.';
                    $old_video_name = $dataHas->doc_name;

                    if ($old_video_name != '' && File::exists(public_path('uploads/' . $old_video_name))) {
                        File::delete(public_path('uploads/' . $old_video_name));
                    }

                    $file_name = stylistHelperFileRenameWithCurrentDateTime($file_name);
                    $file->move('uploads', $file_name);
                    $video_name = $file_name;
                }
                if ($video_name != '') {
                    $records = array('doc_name' => $video_name);
                    if ($dataHas->update($records)) {
                        $records['id'] = $reveal_id;
                        $output['records'] = $dataHas->toArray();
                        $output['success'] = 'Save Successfully';

                        $video_url = url('uploads/' . $video_name);
                        $video_html = '<video width="100%" controls="">
						   <source src="' . $video_url . '" type="video/mp4">
						   <source src="' . $video_url . '" type="video/ogg">
						   Your browser does not support HTML video.
						</video>';

                        $output['video_html'] = $video_html;
                    }
                } else {
                    $output['error'] = 'Something Wrong';
                }
            } else {
                $output['error'] = 'Please save reveal step-1';
            }
        } else {
            $output['error'] = 'Please select Video';
        }
        return response()->json($output);
    }

    public function getProductDetailsById($product_id = 0)
    {
        $product = Product::where('id', $product_id)->where('active', '1')->with('categories', 'shop.logo', 'featureImage', 'image')
            ->withCount('inventories');

        if (Auth::user()->isFromMerchant()) {
            //$product->mine();
        }

        $product_obj = $product->first();
        $img_src = url('images/stylist/product-placeholder.jpg');
        $img_html = '';

        $img_src2 = '';

        if ($product_obj) {
            $product_details = array();
            $qty = 0;
            $sale_price = 0;
            $product_details['name'] = $product_obj->name;
            $product_details['inventories_count'] = $product_obj->inventories_count;
            $inventory = Inventory::where('product_id', $product_obj->id)->first();
            $prodcut_attr_details_html = '';
            if ($img_html == '') {
                $im = 0;
                foreach ($product_obj->images as $img) {
                    $im++;
                    if ($im == 1) {
                        $img_src = url('') . '/image/' . $img->path;
                    }
                    if ($im == 2) {
                        $img_src2 = url('') . '/image/' . $img->path;
                        $img_src2_html = '<img class="stf_default-img-hover-show" src="' . $img_src2 . '" alt="" style="width: 100%;">';
                        $img_src2_has_class = " has_prod_hover_images  ";

                        break;
                    }
                }
            }
            if ($inventory) {
                $im = 0;
                $qty = $inventory->stock_quantity;
                $sale_price = $inventory->sale_price;
                $total_iamge = count($inventory->images);
                foreach ($inventory->images as $img) {
                    $im++;
                    if ($im == 1) {
                        $img_src = url('') . '/image/' . $img->path;
                    }
                    if ($im == 2) {
                        $img_src2 = url('') . '/image/' . $img->path;
                        $img_src2_html = '<img class="stf_default-img-hover-show" src="' . $img_src2 . '" alt="" style="width: 100%;">';
                        $img_src2_has_class = " has_prod_hover_images  ";

                        break;
                    }
                }

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

                if ($attributes->isNotEmpty()) {
                    foreach ($attributes as $attribute) {

                        $attribute_name = $attribute->name;

                        $attribute_value_arr = array();
                        $attribute_arr = $attribute->toArray();

                        if (isset($attribute_arr['attribute_values']) && count($attribute_arr['attribute_values'])) {
                            $attribute_values = $attribute_arr['attribute_values'];
                            foreach ($attribute_values as $attribute_value) {
                                $attribute_value_arr[] = $attribute_value['value'];
                            }
                        }
                    }
                }
            }

            $product_details['sale_price'] = get_formated_price($sale_price, config('system_settings.decimals', 2));

            $img_src = str_replace('/images\\', '/images/', $img_src);
            $product_details['img_src'] = $img_src;
            $product_details['id'] = $product_obj->id;
            $product_details['qty'] = $qty;
            $product_details['img_src'] = $img_src;
            $product_details['img_src2'] = $img_src2;

            $product_details['reveal_add_btn'] = '<i class="fa fa-plus" aria-hidden="true" 4545 onclick_rename="stfGetProductDetailsHtmlAjax(' . $product_obj->id . ')" data-product-name="' . strtolower($product_obj->name) . '" onclick="stfRevealItemAdd(\'' . $img_src . '\',\'' . $product_obj->id . '\',\'' . $product_obj->name . '\',\'' . $product_details['sale_price'] . '\',\'' . $img_src2 . '\',\'' . $qty . '\')"></i>';
        } else {
            $product_details = null;
        }

        return $product_details;
    }

    public function ShowBookingDates()
    {
        // elseif ($change_status_history->status == 'call_complete') {
                    //     $action_status = 'Create';
                    //     $style_border = 'style="border-left:4px solid teal;"';
                    //     $style_para = 'style="color: teal !important; font-weight:900;"';
                    // }
                    // elseif ($list_info->status == 'decline') {
                    //     $style_border = 'style="border-left:4px solid red;"';
                    //     $style_para = 'style="color: red !important; font-weight:900;"';
                    // }

                    // elseif ($list_info->status == 'awaiting_response') {
                    //     $style_border = 'style="border-left:4px solid rgb(255 107 0);"';
                    //     $style_para = 'style="color: rgb(255 107 0) !important; font-weight:900;"';
                    // }
                    // elseif ($list_info->status == 'in_progress') {
                    //     $style_border = 'style="border-left:4px solid purple;"';
                    //     $style_para = 'style="color: purple !important; font-weight:900;"';
                    // }

                    // elseif ($list_info->status == 'not_started') {
                    //     $action_status = 'Call Upcoming';
                    //     $style_border = 'style="border-left:4px solid teal;"';
                    //     $style_para = 'style="color: teal !important; font-weight:900;"';
                    // }

                    // elseif ($list_info->status == 'preparing_order') {
                    //     $style_border = 'style="border-left:4px solid #0420e5;"';
                    //     $style_para = 'style="color: #0420e5 !important; font-weight:900;"';
                    // }
                    // elseif ($list_info->status == 'return_initiated') {
                    //     $style_border = 'style="border-left:4px solid #0420e5;"';
                    //     $style_para = 'style="color: #0420e5 !important; font-weight:900;"';
                    // }
                    // else {
                    //     $style_border = 'style="border-left:4px solid black;"';
                    //     $style_para = 'style="color: black !important; font-weight:900;"';
                    // }

                    // if ($list_info->status == 'not_started') {
                    //     $action_status = 'Call Upcoming';
                    //     $style_border = 'style="border-left:4px solid teal;"';
                    //     $style_para = 'style="color: teal !important; font-weight:900;"';
                    // }

        $data = array();
        $data_booking = array();
        $merchant_id = Auth::id();
        $list = StylistClientBookingAppointments::where('merchant_id', $merchant_id)->with(['customerdetails' => function ($q) {
            return $q->select(['id', 'name', 'email']);
        }])->get();
        $booked_list = array();
        $profile_img_url = url('images/stylist/dummy-profile-pic.png');
        $style_border = '';
        $style_para = '';
        if ($list->isNotEmpty())
        {
            foreach ($list as $list_info)
            {

                $now = time();
                $appoint_date_info =  strtotime($list_info->appointment_date);
                $appoint_time_info =  $list_info->appointment_time;
                // echo $appoint_time_info ;
                $datediff = $appoint_date_info - $now ;
                $date_info_diff =  round($datediff / (60 * 60 * 24));
                $customer_id = '';
                $action_status = '';
                $change_status_history = stylistClientBookingAppointmentsChangeStatusHistory::where('booking_id', $list_info->id)->latest()->first();
                $two_month_days_gap = date("Y-m-d",strtotime($list_info->appointment_date." +8 weeks"));
                $last_two_week_sgap = date("Y-m-d",strtotime($list_info->appointment_date." +10 weeks"));
                $forteen_days_gap = date("Y-m-d",strtotime($list_info->appointment_date." +14 days"));
                $order_det =  Order::where('customer_id' , $list_info->customer_id)->latest()->first();
                if(isset($order_det))
                {
                    $add_date = date("Y-m-d",strtotime($order_det->created_at." +14 days"));
                    $cancel = Cancellation::where('order_id',$order_det->id)->where('customer_id', $order_det->customer_id)->latest()->first();

                }
                // appoint_time_info


                if (!empty($list_info->customer_id) && !empty($list_info->customerdetails->name))
                {
                    if(!isset($change_status_history->booking_id) && $date_info_diff <= 3 && $list_info->status === 'not_started' )
                    {
                        $action_status = 'URGENT REVEAL<br>' . 'Date:- '.date('d-m-Y',strtotime($list_info->appointment_date)) . '<br>Appoint time:- ' . $appoint_time_info ;
                        $style_border = 'style="border-left:4px solid RED"';
                        $style_para = 'style="color: RED !important; font-weight:900;"';
                    }
                    elseif(isset($change_status_history->booking_id) &&  $date_info_diff <= 3 && $list_info->status === 'not_started' &&  $change_status_history->status ===  "call_complete")
                    {
                        $action_status = 'URGENT REVEAL<br>' . 'Date:- '.date('d-m-Y',strtotime($list_info->appointment_date)). '<br>Appoint time:- <br>' . $appoint_time_info;
                        $style_border = 'style="border-left:4px solid RED"';
                        $style_para = 'style="color: RED !important; font-weight:900;"';
                    }
                    elseif(!isset($change_status_history->booking_id) && $list_info->status === 'not_started')
                    {
                        $action_status = 'Call Upcoming<br>' . 'Date:- '.date('d-m-Y', strtotime($list_info->appointment_date)). '<br>Appoint time:- <br>' . $appoint_time_info;
                        $style_border = 'style="border-left:4px solid Green"';
                        $style_para = 'style="color: Green !important; font-weight:900;"';
                    }
                    elseif ($list_info->status === 'not_started' &&  $change_status_history->status ===  "call_complete" ) {
                        $action_status = 'Create Reveal<br>' . 'Date:- '.date('d-m-Y', strtotime($list_info->appointment_date)) . '<br>Appoint time:- <br>' . $appoint_time_info;
                        $style_border = 'style="border-left:4px solid Green"';
                        $style_para = 'style="color: Green !important; font-weight:900;"';
                    }
                    elseif ($list_info->status === 'awaiting_response' && isset($change_status_history->status) && $change_status_history->status ===  "sent")
                    {
                        $action_status = 'RELAX-<br>AWAITING RESPONSE<br>' . 'Date:- '.date('d-m-Y', strtotime($list_info->appointment_date)) . '<br>Appoint time:- <br>' . $appoint_time_info;
                        $style_border = 'style="border-left:4px solid RED"';
                        $style_para = 'style="color: RED !important; font-weight:900;"';
                    }
                    elseif ((isset($cancel) &&  $cancel->created_at <= $add_date) ) {
                        $action_status = '<br>' . 'Date:- '.$list_info->appointment_date . '<br>Appoint time:- <br>' . $appoint_time_info;
                        $style_border = 'style="border-left:4px solid Green"';
                        $style_para = 'style="color: Green !important; font-weight:900;"';
                    }
                    elseif (isset($order_det) &&    $add_date < date('Y-m-d') && $list_info->status == 'dispatched') {
                        $action_status = 'Relex<br>' . 'Date:- '.date('d-m-Y', strtotime($list_info->appointment_date)). '<br>Appoint time:- <br>' . $appoint_time_info;
                        $style_border = 'style="border-left:4px solid Teal"';
                        $style_para = 'style="color: Teal !important; font-weight:900;"';
                    }
                    elseif(date('Y-m-d') > $two_month_days_gap  &&  $last_two_week_sgap > date('Y-m-d') && $list_info->status == 'dispatched' && $change_status_history->status ===  "preparing_order")
                    {
                        $action_status = 'GET REVEAL READY<br>' . 'Date:- '.date('d-m-Y', strtotime($list_info->appointment_date)). '<br>Appoint time:- <br>' . $appoint_time_info;
                        $style_border = 'style="border-left:4px solid Blue"';
                        $style_para = 'style="color: Blue !important"; font-weight:900"';
                    }
                    else if($last_two_week_sgap < date('Y-m-d') && $list_info->status == 'dispatched')
                    {
                        $action_status = 'CREATE REVEAL <br>'. 'Date:- '.date('d-m-Y', strtotime($list_info->appointment_date)). '<br>Appoint time:- <br>' . $appoint_time_info;
                        $style_border = 'style="border-left:4px solid teal;"';
                        $style_para = 'style="color: teal !important; font-weight:900;"';
                    }
                    else
                    {
                        $action_status = 'Date:- '.date('d-m-Y', strtotime($list_info->appointment_date)) ;
                        $style_border = 'style="border-left:4px solid Green"';
                        $style_para = 'style="color: Green !important; font-weight:900;"';
                    }

                    // --------------------------------------------------
                    $appoint_date = date("Y-m-d", strtotime($list_info->appointment_date));
                    $booked_list[] = array(
                        'title' => '<div class="user_booking_info" ' . $style_border . '> <div class="stf-content-style "> <div class="user_booking_info_two"> <div class="user-img-box"> <img style="width:100%" src="' . $profile_img_url . '"> </div></div><div class="user-articles"> <h4>' . $list_info->customerdetails->name . '</h4></div></div><div class="stf-content-style-p-costom" ><p ' . $style_para . '>' . $action_status . '</p></div></div>',
                        'start' => $appoint_date
                    );

                }
            }
        }


        sort($booked_list);

        $data['booked_list'] = $booked_list;


        return view('admin.stylist_form.customer_request_booking_dates_details', compact('data'));
    }



    public function importProductModalAjax()
    {

        $html = '<div class="modal-dialog"><div class=" modal-content">
	      <div class="modal-header">

	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">×</span>
	        </button>
	      </div>
	      <div class="modal-body modal-body-style">
	      <h5 class="modal-title text-center" >UPLOAD NEW PRODUCT</h5>

	         <div class="row my-5">
	            <div class="col-md-6 text-center modal-dialog-font-siz my-5">
	            <a href_rename="javascript:void(0)" onclick_rename="stfShowModalProductImportBy(this,\'stf_product_import_by_img_modal\');return false;" onclick="stfImportProductModalShow(this,\'img_upload\');return false;" class="stf_anchor_btn"> <img src="' . url('') . '/images/stylist/Manual Upload.png" alt="" style="width: 20%;"> </a>
	               <h4>Manual <br>Upload</h4>
	            </div>
	            <div class="col-md-6 text-center modal-dialog-font-siz my-5">
	            <a href_rename="javascript:void(0)" onclick="stfShowModalProductImportBy(this,\'stf_product_import_by_url_modal\');return false;" class="stf_anchor_btn"> <img src="' . url('') . '/images/stylist/Upload VIA URL.png" alt="" style="width: 20%;"> </a>
	               <h4>Upload by<br>URL</h4>
	            </div>
	         </div>
	      </div>

	    <div class="modal-body modal-body-style stf_product_import_by_img_modal" style="display:none">
      		<h5 class="modal-title text-center" >UPLOAD YOUR IMAGE</h5>

	      <div class="row my-5">

	         <div class="col-md-12 text-center modal-dialog-font-siz stf_import_img_btn" onclick="stfImportProductModalShow(this,\'img_upload\')">
	            <h5>PNG and JPEG files allowed</h5>
	         </div>
	      </div>
     	</div>
     	<div class="modal-body modal-body-style stf_product_import_by_url_modal" style="display:none" id="stf_product_import_by_url_modal_id">
      		<h5 class="modal-title text-center" >UPLOAD A IMAGE VIA URL</h5>
      		<h6 class="">Enter URL below</h6>
	      <div class="row my-5">
	      	<div class="enter_url_style add-pro-input">
	      	 <input type="text" name="upload_img_url[]"  multiple Placeholder="Enter URL" add_prod_required" error-msg="Please enter url" class="form-control add_prod_required upload_image_by_url">
	      	 <span class="btn" onclick="stfGetProuctsDetailById(this)">Click to create</span>
	      	 </div>
	      </div>
     	</div>

     	</div>
	     </div>';
        $output = array();
        $output['html'] = $html;
        return response()->json($output);
    }

    public function getDataAjax(Request $request)
    {
        $output = array();
        $method_name = $request->method_name;
        if ($method_name == 'get_import_product_html') {

            $output = $this->getProductImportHtmlModal($request);
        } else if ($method_name == 'save_product_by_modal') {
            $output = $this->saveProductByModal($request);
        } else if ($method_name == 'edit_product_by_id_modal') {
            $output = $this->editProductDetailsByIdModal($request);
        } else if ($method_name == 'get_import_product_by_url') {

            $output = $this->getProductDetailsByExternalURL($request);
        } else if ($method_name == 'products_list_with_filter_values') {

            $output = $this->productsListAjax($request);
        } else if ($method_name == 'products_list_with_filter') {

            $output = $this->productsListAjax($request);
        } else if ($method_name == 'get_product_info_by_id') {

            $output = $this->getProductDetailsById($request->product_id);
        } else if ($method_name == 'customer_questions_answers_view') {

            $output = $this->customerQuestionsAnswersView($request);
        } else if ($method_name == 'delete_user_tag_by_id') {

            $output = $this->deleteUserTagByUserIdAndTagId($request);
        } else if ($method_name == 'delete_reveal_by_id') {

            $output = $this->deleteRevealByid($request);
        } else if ($method_name == 'create_tag_add_tag_to_user') {

            $output = $this->CreateTagAndAddToUser($request);
        } else if ($method_name == 'company_add_users_modal') {

            $output = $this->addUsersToCompanyModal($request);
        } else if ($method_name == 'company_add_users') {

            $output = $this->addUsersToCompany($request);
        } else if ($method_name == 'udpate_question_text_html') {

            $output = $this->UdpateQuestionTextHtml($request);
        } else if ($method_name == 'udpate_question_info_update') {

            $output = $this->udpateQuestionInfoUpdate($request);
        } else if ($method_name == 'compnay_details_view') {

            $output = $this->companydetailsview($request);
        } else {
            $output['error'] = 'Something Wrong';
        }

        return response()->json($output);
    }

    public function addUsersToCompany($request)
    {
        $company_id = $request->company_id;

         $selected_users_ids = $request->selected_users_ids;
        $output = array();
        $output['company_id'] = $company_id;
        $output['selected_users_ids'] = $selected_users_ids;

        if (is_array($selected_users_ids) && count($selected_users_ids)) {
            $has_data = stylistUsers::where('company_id', $company_id)->get();
            if ($has_data->isNotEmpty()) {
                stylistUsers::where('company_id', $company_id)->update(['company_id' => '']);
            }

            $insert_recods = array();
            $user_has_data = array();

            $has_data = stylistUsers::whereIn('user_id', $selected_users_ids)->get();

            if ($has_data->isNotEmpty()) {
                $user_has_data = $has_data->pluck('user_id')->toArray();
            }

            foreach ($selected_users_ids as $users_id) {
                if (!in_array($users_id, $user_has_data)) {
                    $insert_recods[] = array('user_id' => $users_id, 'company_id' => $company_id);
                }
            }

            if (is_array($user_has_data) && count($user_has_data)) {
               $update_stylist_users = stylistUsers::whereIn('user_id', $user_has_data)->update(['company_id' => $company_id]);

            }

            if (is_array($insert_recods) && count($insert_recods)) {
                $update_stylist_users_info = stylistUsers::insert($insert_recods);

            }
        }

        $output['success'] = 'Updated Successfully';
        return $output;
    }

    public function addUsersToCompanyModal($request)
    {
        $company_id = $request->company_id;
        $employ_data = employerOnboardingQuestionnaire::find($company_id);
        $output = array();
        if (isset($employ_data)) {

            $html = '';
            $html = '<div class="modal-dialog modal-dialog-centered modal-dialog-style" role="document">
		    <div class=" col-md-11 col-sm-12 m-auto modal-content">
		      <div class="modal-header">

		        <button type="button" class="close close-b-style" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">×</span>
		        </button>
		      </div>
		      <div class="modal-body modal-body-style">


		      <div class="row company_add_user_modal">
		         <h5 class="modal-title modal-title-add-pro" >Manage company (' . $employ_data->company_name . ') customers</h5>';

            $html .= '<div class="alert alert-warning" role="alert">Note: Only one user will connect one company. So if you add user in this company and the user is already connected with other company then user will loose connection from previour company.</div>';

            $users_info = Customer::all();
            $company_obj = stylistUsers::where('company_id', $company_id)->get();
            $already_connected_user_ids = array();
            if ($company_obj->isNotEmpty()) {
                $already_connected_user_ids = $company_obj->pluck('user_id')->toArray();
            }

            if ($users_info->isNotEmpty()) {
                $html .= '<div class="members_list">';
                foreach ($users_info as $user_info) {
                    $user_id = $user_info->id;

                    $checked = '';
                    if (in_array($user_id, $already_connected_user_ids)) {
                        $checked = 'checked="checked"';
                    }
                    $user_name = $user_info->name;
                    $html .= '<div class="member_list">';
                    $html .= '<input name="company_user_id" class="form-control_rename" type="checkbox" ' . $checked . ' value="' . $user_id . '"><label class="form-label">' . $user_name . '</label>';
                    $html .= '</div>';
                }
                $html .= '</div>';
                $html .= '<div class="row my-5 modal-message">';
                $html .= '</div>';
                $html .= '<div class="row my-5 modal-content-between">
                  <button type="button" class="btn btn-primary add-btn-prod" onclick="stfModalAddUsertoCustomer(this,' . $company_id . ')">SAVE</button>
                  <button type="button" class="btn btn-primary add-btn-prod" data-dismiss="modal" aria-label="Close">CANCEL</button>
                  </div>';
            }

            $html .= '</div>';
            $html .= '</div>';
            $html .= '</div>';
            $html .= '</div>';

            $output['html'] = $html;
            $output['success'] = 'data load';
        } else {
            $output['error'] = 'Something Wrong.';
        }

        return $output;
    }

    public function deleteRevealByid($request)
    {

        $reveal_id = $request->reveal_id;
        $reveal_items_list = stylistRevealsItems::where('id', $reveal_id)->delete();
        $output = array('success' => 'Deleted');
        return $output;
    }

    public function CreateTagAndAddToUser($request)
    {

        $user_id = $request->user_id;
        $tag_name = trim($request->tag_name);
        $tag_has = StylistTags::where('name', $tag_name)->first();
        $tag_id = 0;
        if ($tag_has) {
            $tag_id = $tag_has->id;
        } else {
            $tag_new_obj = new StylistTags();
            $tag_new_obj->name = $tag_name;
            $tag_new_obj->save();
            $tag_id = $tag_new_obj->id;
        }

        $user_tag_has = StylistUserTags::where('user_id', $user_id)->where('tag_id', $tag_id)->first();
        if ($user_tag_has) {
        } else {
            $user_tag_new_obj = new StylistUserTags();
            $user_tag_new_obj->user_id = $user_id;
            $user_tag_new_obj->tag_id = $tag_id;
            $user_tag_new_obj->save();
        }

        $list_tag = $this->getUserTagListHtml($user_id);
        $output = array('success' => 'Created and add to user', 'list_tag' => $list_tag);
        return $output;
    }

    public function deleteUserTagByUserIdAndTagId($request)
    {

        $user_id = $request->user_id;
        $tag_id = $request->tag_id;
        StylistUserTags::where('user_id', $user_id)->where('tag_id', $tag_id)->delete();
        $list_tag = $this->getUserTagListHtml($user_id);
        $output = array('success' => 'Deleted', 'list_tag' => $list_tag);
        return $output;
    }

    public function getProductImportHtmlModal($request)
    {
        $type = '';
        $image_url = url('') . '/images/stylist/add-plus.jpg';
        $brand = '';
        $price = '';
        $description = '';
        $colour_description = '';
        $currency = '';
        $name = '';
        $slug = '';
        $image_url2 = '';
        $quantity = '';
        $product_id = 0;
        $pro_group = '';
        $pro_sub_group = '';
        // $categories = '';
        $show_modal = true;
        $output = array();
        $v1 = trans('app.form.images');
        $v2 = trans('help.product_images');
        $v3 = trans('help.multi_img_upload_instruction', ['size' => getAllowedMaxImgSize(), 'number' => getMaxNumberOfImgsForInventory()]);

        $show_edit_img_btn = 'd-none';
        $preview = null;

        $image_parametor = '<fieldset>
         					 		<legend>
            					' . $v1 . '
            <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="' . $v2 . '"></i>
          </legend>
          <div class="form-group">
            <div class="file-loading">
              <input id="dropzone-input" name="images[]" type="file" accept="image/*" multiple>
            </div>
            <span class="small"><i class="fa fa-info-circle"></i>' . $v3 . '</span>
          </div>
        </fieldset>';

        $attribute_show_hide = "none";
        $attribute_list_html = "";

        $category_list_selected = array();
        $product_status_is_new = 'Y';

        $inventory_id = 0;

        $pro_group_cat_selected_id = 0;
        $pro_sub_group_cat_selected_id = 0;
        $product_obj_pro_group = '';
        $product_obj_pro_sub_group = '';
        $product_obj_categories = '';

        if (is_array($request) && isset($request['call_by']) && ($request['call_by'] == 'product_upload_by_url')) {
            $show_edit_img_btn = ' ';
            $image_parametor = '';
            $type = $request['type'];
            $image_url = $request['imageURL'];
            $image_url2 = $image_url;
            $brand = $request['brand'];
            $price = floatval(ltrim($request['price'], '$'));

            $description = $request['description'];
            $currency = $request['currency'];
            $name = $request['name'];
            $slug = str_replace(' ', '-', $name);
        } else if (isset($request['method_name']) && ($request['method_name'] == 'edit_product_by_id_modal')) {

            $product_status_is_new = 'N';
            $product_id = $request->product_id;
            $product_obj = Product::find($product_id);

            if ($product_obj) {

                //$product_obj_pro_group = $product_obj->pro_group;
               // $product_obj_pro_sub_group = $product_obj->pro_sub_group;
               // $product_obj_categories = $product_obj->categories;
                $preview = $product_obj->previewImages();


                $type = 'Product';
                $brand = $product_obj->brand;
                $category_list_selected_obj = $product_obj->categories;
                if(isset($category_list_selected_obj) && $category_list_selected_obj){
                    foreach($category_list_selected_obj as  $category_list_selected_obj_info){
                        $category_list_selected[] = $category_list_selected_obj_info->slug;
                        $pro_sub_group_cat_selected_id = $category_list_selected_obj_info->category_sub_group_id;
                        $sub_group_list_selected_obj = CategorySubGroup::where('active', 1)->where('id',$pro_sub_group_cat_selected_id)->first();



                        if(isset($sub_group_list_selected_obj))
                        {
                             $pro_group_cat_selected_id = $sub_group_list_selected_obj->category_group_id;
                        }



                    }
                }






                $description = $product_obj->description;
                $colour_description = $product_obj->colour_description;
                $name = $product_obj->name;
                $slug = $product_obj->slug;
                //$pro_group_cat_selected_id = $product_obj->pro_group;

              //  $categories = $product_obj->categories;




                $inventory = Inventory::where('product_id', $product_obj->id)->first();
                $prodcut_attr_details_html = '';
                foreach ($product_obj->images as $img) {
                    $image_url = url('') . '/image/' . $img->path;
                    break;
                }

                if ($inventory) {
                    $preview = $inventory->previewImages();
                    $inventory_id = $inventory->id;
                    $quantity = $inventory->stock_quantity;
                    $price = ($inventory->sale_price);
                    $price = number_format((float) $price, 2, '.', '');
                }
            } else {
                $show_modal = false;
                $output['error'] = "Product info is missing";
            }
        }
        if ($show_modal) {

            if (is_array($request) && isset($request['call_by']) && ($request['call_by'] == 'product_upload_by_url')) {
            } else {
                $image_parametor .= view('plugins.dropzone-upload-stylist', compact('preview'))->render();
            }
            $categorySubGroup_option ='';
            $CategoryGroup_options ='';
            $category_sub_group_div= '';
            $subgroup_category = '';
            $subgroup_category_option = '';
            $sub_group_categories_div = '';
            $CategorySubGroup_info = '';
            $category_groups = CategoryGroup::where('active', 1)->get();
            if($category_groups->isNotEmpty() &&  $category_groups->count() > 0)
            {
                foreach($category_groups as $category_groups_keys => $category_groups_info)
                {
                    // group list
                    $CategoryGroup_cat_selected = '';
                    if($category_groups_info->slug == 'menswear'  || $category_groups_info->slug == 'womenswear')
                    {

                        if ($pro_group_cat_selected_id == $category_groups_info->id) {
                            $CategoryGroup_cat_selected = 'selected';
                        }
                        $CategoryGroup_options .= '<option value="'.$category_groups_info->id.'" '.$CategoryGroup_cat_selected.'>'.$category_groups_info->name.'</option>';
                    }else{
                        continue;
                    }
                    $CategorySubGroup = CategorySubGroup::where('active', 1)->where('category_group_id',$category_groups_info->id )->get();
                    if($CategorySubGroup->isNotEmpty() && $CategorySubGroup->count() > 0)
                    {
                        $categorySubGroup_option = '';

                         // sub group list
                        $categorySubGroup_cat_selected = '';

                        foreach($CategorySubGroup as $CategorySubGroup_keys => $CategorySubGroup_info)
                        {
                            $categorySubGroup_cat_selected = '';
                            if ($pro_sub_group_cat_selected_id == $CategorySubGroup_info->id) {
                                $categorySubGroup_cat_selected = 'selected';
                            }
                            $categorySubGroup_option .= '<option value="'.$CategorySubGroup_info->id.'" '.$categorySubGroup_cat_selected.' >'.$CategorySubGroup_info->name.'</option>';

                             $subgroup_category = Category::where('active', 1)->where('category_sub_group_id',$CategorySubGroup_info->id )->get();
                               $subgroup_category_option = '';
                                if($subgroup_category->isNotEmpty() && $subgroup_category->count() > 0)
                                {    // sub group - category list

                                    foreach($subgroup_category as $subgroup_category_key => $subgroup_category_info)
                                    {
                                         $cat_selected = '';
                                             if (is_array($category_list_selected) && in_array($subgroup_category_info->slug, $category_list_selected)){
                                           // if ($product_obj_categories == $subgroup_category_info->id){
                                                $cat_selected = 'selected';
                                            }
                                        $subgroup_category_option .= '<option value="'.$subgroup_category_info->slug.'" '. $cat_selected.' >'.$subgroup_category_info->name.'</option>';
                                    }
                                }
                                 $display_cat1 = 'none';
                                if($categorySubGroup_cat_selected == 'selected'){
                                    $display_cat1 = 'block';
                                }
                               $sub_group_categories_div .='<div class="my-3 add-pro-input col-md-4 sub_category_group_list sub_category_group_list_id_'.$CategorySubGroup_info->id.'" style="display:'.$display_cat1.'"><label  class="form-label">Category</label><select class="form-control add_prod_required sub_cotegory_group_options"   name="categories" error-msg="Please select category" multiple ><option value="" disabled>Select Group Category</option>' . $subgroup_category_option . '</select></div>';
                        }
                        $display_cat0 = 'none';
                        if($CategoryGroup_cat_selected == 'selected'){
                            $display_cat0 = 'block';
                        }
                        $category_sub_group_div .='<div class="my-3 add-pro-input col-md-4 sub_group_list sub_group_list_id_'.$category_groups_info->id.'" style="display:'.$display_cat0.'">
                          <label  class="form-label">SUBGROUP</label>
                             <select class="form-control add_prod_required sub_group_options"  name="pro_sub_group" error-msg="Please select category" onchange="sub_category_group_select(this);" >
                             <option value="">Select Category</option>
                             ' . $categorySubGroup_option . '
                             </select>
                        </div>';

                    }
                }
            }

            $category_list_option = '';
            $category_list = Category::where('active', 1)->get();
            if ($category_list) {
                foreach ($category_list as $category_info) {
                    $cat_selected = '';
                    if (is_array($category_list_selected) && in_array($category_info->id, $category_list_selected)) {
                        $cat_selected = 'selected';
                    }
                    $category_list_option .= '<option value="' . $category_info->slug . '" ' . $cat_selected . '>' . $category_info->name . '</option>';
                }
            }

            $attributesArr = $this->getProductAttributesListHtml($product_id, $inventory_id);

            if (isset($attributesArr['html'])) {
                $attribute_show_hide = "block";
                $attribute_list_html = $attributesArr['html'];
            }
            $style_nul = '';
            // if($quantity == 0 || $quantity < 0)
            // {
            //     $style_nul = 'style = "pointer-events:none !important ;"';
            // }
            $booking_id = 0;
            if(isset($request['booking_id'])){
                $booking_id = $request['booking_id'];
            }
            $html = '<script> var booking_id='.$booking_id.'</script><div class="modal-dialog modal-dialog-centered modal-dialog-style" role="document">
		    <div class=" col-md-11 col-sm-12 m-auto modal-content">
		      <div class="modal-header">

		        <!-- <h5 class="modal-title" id="exampleModalLongTitle">UPLOAD NEW PRODUCT</h5> -->
		        <button type="button" class="close close-b-style" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">×</span>
		        </button>
		      </div>
		      <div class="modal-body modal-body-style">


		      <div class="row ">
		         <h5 class="modal-title modal-title-add-pro" >ADD PRODUCT</h5>
		            <div class="col-md-4 text-center modal-dialog-img-style  my-5">
		            ' . $image_parametor . '
		               <input type="file" name="addProductImage" style="display:none" onchange="stfUploadfileShow(\'addProductImage\',\'addProductImage_preview\')">

		               <img src="' . $image_url . '" class="addProductImage_preview ' . $show_edit_img_btn . '" alt="" style="width: 100%;">
		               <a href="#"  class="' . $show_edit_img_btn . '">
		                  <div class="overlay-edit-btn " onclick="stfTriggerImageButton(\'addProductImage\')">
		                     <p> EDIT Image</p>
		                  </div>
		               </a>
		            </div>
		            <div class="col-md-8  add_prod_model_fields_outer" id="add_prod_model_fields_outer">
		             	  <input type="hidden" name="pro_img_url" value="' . $image_url2 . '">
		             	  <input type="hidden" name="pro_id" value="' . $product_id . '">
		             	  <input type="hidden" name="inventory_id" value="' . $inventory_id . '">

		                  <div class="mb-md-3 my-sm-3 add-pro-input">
		                     <label class="form-label">Title</label>
		                        <input type="text" class="form-control add_prod_required" name="pro_name" error-msg="Please enter name" value="' . $name . '" >
		                  </div>
		                  <div class="my-3 add-pro-input">
		                     <label  class="form-label">Slug</label>
		                        <input type="text" class="form-control add_prod_required" name="pro_slug" error-msg="Please enter slug" value="' . $slug . '">
		                  </div>
                        <div class="row">
                            <div class="my-3 col-md-4 add-pro-input">
                                <label  class="form-label">GROUP</label>
		                        <select class="form-control add_prod_required category_group_option"  name="pro_group" error-msg="Please select category" onchange="groupoption();"  >
		                        <option value="" >Select Category</option>
		                        ' . $CategoryGroup_options . '
		                        </select>
                            </div>
                            '.$category_sub_group_div.'
                            '.$sub_group_categories_div.'
		                </div>




                        <div class="row">
                            <div class="my-3 add-pro-input col-sm-6">
                                <label  class="form-label">Brand</label>
                                <input type="text" class="form-control " name="pro_brand"  value="' . $brand . '">
                            </div>
                            <div class="my-3 add-pro-input col-md-3">
                                <label  class="form-label">Price</label>
                                <input type="nubmer" class="form-control add_prod_required" name= "pro_price" error-msg="Please enter price"  value="' . $price . '">
                            </div>
                            <div class="my-3 add-pro-input  col-md-3">
                                <label  class="form-label">Quantity</label>
                                <input type="nubmer" class="form-control add_prod_required" oninput="qty_check(this,\'save-prod-btn\');" name="pro_quantity" error-msg="Please enter quantity"  value="' . $quantity . '">
                            </div>
                        </div>


		                  <div class="my-3 add-pro-input">
		                     <label class="form-label">Description</label>
                              <div class="pro_description_text" style="display:none"></div>
		                        <textarea class="form-control  sft_pro_summernote" name= "pro_description" rows="3" error-msg="Please enter description"   id="product_description"  >'
                . $description . '</textarea>
		                  </div>

		                  <div class="my-3 add-pro-input">
		                     <label class="form-label">Colour Description</label>
		                        <textarea class="form-control  sft_pro_summernote_rename" name= "pro_colour_description" rows="3" error-msg="Please enter description">'
                . $colour_description . '</textarea>
		                  </div>



		                 <div class="my-3 add-pro-input product_attribute_wrapper" style="display:' . $attribute_show_hide . '" >
		                 ' . $attribute_list_html . '
		                 </div>
		                  <div class="my-3 add-pro-input product_add_message" style="display:none" >
		                 </div>
		                 <input type="hidden"value="" name="product_status_in_modal">
		                 <input type="hidden"value="' . $product_status_is_new . '" name="product_status_is_new">



		                  <div class="row my-5 modal-content-between">
		                  <button type="button" class="btn btn-primary add-btn-prod" onclick="stfModalAddProductdb(this)" id="save-prod-btn" >SAVE PRODUCT</button>
		                  <button type="button" class="btn btn-primary add-btn-prod" data-dismiss="modal" aria-label="Close">CANCEL</button>
		                  </div>

		            </div>
		         </div>
		      </div>
		    </div>
		  </div>';
            $output = array('html' => $html, 'success' => 'Data is loaded');
        }
        return $output;
    }

    public function getProductDetailsByExternalURL($request)
    {
        $output = array();
        $url = $request->upload_product_link_url;

        if ($url != '') {
            //$url = 'https://drive.google.com/file/d/1R36bAkcIpKDHDGN6ZzOm-O3HQXYtfcpv/view';
            $resp[] = $url;

           header("Content-Type: image/jpeg");
            // echo "+++++++++++++2++++++++++++++"; die;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            // curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $data = curl_exec($ch);
            curl_close($ch);
            if ($data) {
                // Load HTML to DOM Object
                $dom = new DOMDocument();
                @$dom->loadHTML($data);

                // $xpath = new DomXpath($dom);
                // $img   = $xpath->query('//*[@class="q6DClP"]');
                // var_dump($img);

                // Parse DOM to get Title
                $nodes = $dom->getElementsByTagName('title');
                $title = '';
                if ($nodes->length > 0) {
                    $title = $nodes->item(0)->nodeValue;
                }
                // Parse DOM to get Meta Description
                $metas = $dom->getElementsByTagName('meta');
                $description = "";
                $imageURL = "";
                $brand = '';
                $price = 0;
                $currency = '';
                $type = '';
                $name = '';
                for ($i = 0; $i < $metas->length; $i++) {
                    $meta = $metas->item($i);
                    if ($meta->getAttribute('property') == 'og:description') {
                        $description = $meta->getAttribute('content');
                    }
                    if ($meta->getAttribute('property') == 'og:image:url') {
                        $imageURL = $meta->getAttribute('content');
                    } elseif ($meta->getAttribute('property') == 'og:image') {
                        $imageURL = $meta->getAttribute('content');
                    }

                    if ($meta->getAttribute('property') == 'og:type') {
                        $type = $meta->getAttribute('content');
                    }
                    if ($meta->getAttribute('property') == 'og:title') {
                        $name = $meta->getAttribute('content');
                    }

                    if ($meta->getAttribute('name') == 'product:brand') {
                        $brand = $meta->getAttribute('content');
                    }

                    if ($meta->getAttribute('name') == 'product:price:amount') {
                        $price = $meta->getAttribute('content');
                    }

                    if ($meta->getAttribute('name') == 'product:price:currency') {
                        $currency = $meta->getAttribute('content');
                    }
                }

                $output['imageURL'] = $imageURL;
                $output['brand'] = $brand;
                $output['price'] = $price;
                $output['description'] = $description;
                $output['currency'] = $currency;
                $output['type'] = $type;
                $output['success'] = 'Data loaded';
                $output['name'] = $name;
                $output['call_by'] = "product_upload_by_url";

                $output = $this->getProductImportHtmlModal($output);

            } else {

                $output['error'] = 'Please enter valid url';
            }
        } else {
            $output['error'] = 'Enter Product URL';
        }

        return $output;
    }

    public function saveProductByModal(request $request)
    {

        $name = $request->name;
        if (isset($name)) {
            $data['image_link'] = '';
            $product_id = $request->pro_id;
            $categories = $request->categories;
            // $pro_sub_group = $request->pro_sub_group;
            // $pro_group = $request->pro_group;
            // print_r($categories);
            $product_obj_has = Product::find($product_id);
            $this->authorize('create', Product::class); // Check permission
            $shop_id = Auth::user()->merchantId();

            $data['name'] = $request->name;
            $data['slug'] = $request->slug;
            $data['active'] = 'TRUE';
            $data['categories'] = $categories;
            $data['gtin'] = '';
            $data['gtin_type'] = '';
            $data['model_number'] = '';
            $data['brand'] = $request->brand;
            $data['mpn'] = '';
            $data['description'] = $request->description;
            //$data['manufacturer'] = 'ACME';
            $data['origin_country'] = 'US';
            $data['requires_shipping'] = 'FALSE'; //'TRUE';
            $data['minimum_price'] = '';

            $data['maximum_price'] = '';

        //    $data['categories'] = $request->categories;
        //     $data['pro_group'] = $request->pro_group;
        //     $data['pro_sub_group'] = $request->pro_sub_group;

            $data['tags'] = ''; //'Tag1,Tag2';
            $data['shop_id'] = $shop_id;
            $data['price'] = (float) $request->price;

            $data['stock_quantity'] = $request->quantity;
            $data['colour_description'] = $request->colour_description;

            // If the slug is not given the make it

            //---------------------------------------------------------------------------------------------------------
                // if(isset($data['image_link']))
                // {

                // }


                if ($request->hasFile('file')) {
                    $this->validate($request, [
                        'file' => 'required|mimes:jpeg,jpg,png| max:10000',
                    ]);
                    $file = $request->file('file');
                    $file_name = $file->getClientOriginalName();
                    $file_name = stylistHelperFileRenameWithCurrentDateTime($file_name);

                    $file->move($this->upload_folder, $file_name);
                    $data['image_link'] = url('') . "/" . $this->upload_folder . "/" . $file_name;

                } else if (isset($request->img_url) && ($request->img_url != '')) {
                    $image_link_1_url = $request->img_url;
                    $image_link_1_url_arr = explode('?', $image_link_1_url);
                    $image_link_1_url = $image_link_1_url_arr[0];
                    // <!-- print_r($image_link_1_url);
                    // die; -->

                    $allowed_extension = array("jpg", "png", "jpeg", "webp");
                    $url_array = explode("/", $image_link_1_url);
                    $image_name = end($url_array);
                    $image_array = explode(".", $image_name);
                    $extension = end($image_array);
                    if (in_array($extension, $allowed_extension)) {

                        $image_data = file_get_contents($image_link_1_url);
                        $new_image_path = public_path() . "/" . $this->upload_folder . "/test/test-product." . $extension;
                        file_put_contents($new_image_path, $image_data);
                        $data['image_link'] = url('') . "/" . $this->upload_folder . "/test/test-product." . $extension;

                    }
                }

            //---------------------------------------------------------------------------------------------------------



            if (!$data['slug']) {
                $data['slug'] = convertToSlugString($data['name'], $data['gtin']);
            }

            // Ignore if the slug is exist in the database
            if ($prop_slug_info = Product::select('slug', 'id')->where('slug', $data['slug'])->where('id', '!=', $product_id)->withTrashed()->first()) {

                $output['error'] = trans('help.slug_already_exist');
                // $output['prop_slug_info'] = $prop_slug_info;
                return $output;
            }

            if (isset($data['categories'])) {
                $data['category_list'] = Category::whereIn('slug', explode(',', $data['categories']))->pluck('id')->toArray();
            }

            // if (isset($data['group'])) {
            //     $data['category_list'] = Category::whereIn('slug', explode(',', $data['categories']))->pluck('id')->toArray();
            // }

            // if (isset($data['sub_group'])) {
            //     $data['category_list'] = Category::whereIn('slug', explode(',', $data['categories']))->pluck('id')->toArray();
            // }

            if ($data['origin_country']) {
                $origin_country = DB::table('countries')->select('id')->where('iso_code', strtoupper($data['origin_country']))->first();
            }

            if (isset($data['manufacturer'])) {
                $manufacturer = Manufacturer::firstOrCreate(
                    ['name' => $data['manufacturer']],
                    ['slug' => Str::slug($data['manufacturer'])]
                );
            }

            $pro_data = array(
                'shop_id' => $data['shop_id'],
                'name' => $data['name'],
                'slug' => $data['slug'],
                'model_number' => $data['model_number'],
                'description' => $data['description'],
                'colour_description' => $data['colour_description'],
                'gtin' => $data['gtin'],
                'gtin_type' => $data['gtin_type'],
                'mpn' => $data['mpn'],
                'brand' => $data['brand'],
                'origin_country' => isset($origin_country) ? $origin_country->id : null,
                'manufacturer_id' => isset($manufacturer) ? $manufacturer->id : null,
                'min_price' => ($data['minimum_price'] && $data['minimum_price'] > 0) ? $data['minimum_price'] : 0,
                'max_price' => ($data['maximum_price'] && $data['maximum_price'] > $data['minimum_price']) ? $data['maximum_price'] : null,
                'requires_shipping' => strtoupper($data['requires_shipping']) == 'TRUE' ? 1 : 0,
                'active' => strtoupper($data['active']) == 'TRUE' ? 1 : 0,
              // 'categories' =>$data['categories'],
                // 'pro_group' =>$data['pro_group'],
                // 'pro_sub_group' =>$data['pro_sub_group'] ,
            );

            $msg = "Product has been created successfully!";
            // Create the product
            $product = null;
            if ($product_obj_has) {
                $product_upate = $product_obj_has->update($pro_data);
                if ($product_upate) {
                    $product = Product::find($product_id);
                    $output['upload_update'] = "Product update funciton is call ";
                    $output['product_updated'] = "Product update funciton is call ";
                    $msg = "Product has been updated successfully!";
                } else {
                    $output['error'] = "Product update error  ";
                    return $output;
                }
            } else if ($product_id != 0) {
                $output['error'] = "Product is missing";
                return $output;
            } else {
                $product = Product::create($pro_data);
            }

            // Sync categories
           if (isset($data['category_list'])) {
                $product->categories()->sync($data['category_list']);
            }

            // if ($data['category_list']) {
            //     $product->group()->sync($data['category_list']);
            // }

            // if ($data['category_list']) {
            //     $product->sub_group()->sync($data['category_list']);
            // }

            // Upload featured image
            if ($data['image_link']) {
                $product->saveImageFromUrl( $data['image_link'], 'feature');
            }

            // Sync tags
            if ($data['tags']) {
                $product->syncTags($product, explode(',', $data['tags']));
            }

            if (!$product) {
                $output['error'] = trans('help.input_error');
            } else {
                $output['success'] = 'Product has been created successfully!';
            }
        } else {
            $output['error'] = 'Something Wrong';
        }

        $output['product'] = $product;

        $varients = array();
        $request->attr_varients = json_decode($request->attr_varients);
        if (is_array($request->attr_varients)) {
            foreach ($request->attr_varients as $attr_varients) {
                if ($attr_varients->attr_val != '' && $attr_varients->attr_val != 0) {
                    $varients[$attr_varients->attr_id] = ['attribute_value_id' => $attr_varients->attr_val];
                }
            }
        }
        $data['varients'] = $varients;

        $output['inventory'] = $this->createInventoryNew($data, $product);
        $attributesArr = $this->getProductAttributesListHtml($output['product']->id, $output['inventory']->id);

        if (isset($attributesArr['html'])) {
            $output['attr_html'] = $attributesArr['html'];
        } else {
            $output['attr_html'] = '';
        }
        $output['msg'] = $msg;

        return $output;
    }

    public function getProductAttributesListHtml($product_id = 0, $inventory_id = 0)
    {

        $html = '';
        $inventory = Inventory::find($inventory_id);
        $attributes_list = Attribute::select('id', 'name', 'attribute_type_id', 'order')->whereIn('name', $this->getProductAttributeList())
            ->orderBy('order')->get();

        if ($attributes_list->isNotEmpty()) {
            $html .= '<fieldset class="">';
            $html .= '<legend>' . trans('app.attributes') . '</legend>';
            $html .= '<div class="row">';

            foreach ($attributes_list as $attribute_info) {
                $attributeValues = $attribute_info->attributeValues()->get();
                $html .= '<div class="col-sm-4">';
                $html .= '<div class="form-group">';
                $html .= '<label>' . $attribute_info->name . '</label>';
                $html .= '<select class="form-control select2 stf_field_prod_attribute add_prod_required" attr-id="' . $attribute_info->id . '" id="' . $attribute_info->name . '" name="variants[' . $attribute_info->id . ']" placeholder=' . trans('app.placeholder.select') . ' error-msg="Field is required.">';

                $html .= '<option value="">' . trans('app.placeholder.select') . '</option>';
                if ($attributeValues->isNotEmpty()) {
                    foreach ($attributeValues as $attributeValue) {

                        $selected = '';
                        if (isset($inventory) && count($inventory->attributes) && in_array($attributeValue->id, $inventory->attributeValues->pluck('id')->toArray())) {
                            $selected = 'selected';
                        }
                        $html .= '<option value="' . $attributeValue->id . '" ' . $selected . '>';
                        $html .= $attributeValue->value;
                        $html .= '</option>';
                    }
                }
                $html .= '</select>';
                $html .= '</div>';
                $html .= '</div>';
            }
            $html .= '</div>';
        }

        $output = array();
        $output['html'] = $html;
        return $output;
    }

    public function saveProductByModal_rename($request)
    {

        $name = $request->name;
        if (isset($name)) {
            $data['image_link'] = '';
            if ($request->hasFile('file')) {

                $this->validate($request, [
                    'file' => 'required|mimes:jpeg,jpg,png,webp| max:10000',
                ]);
                $file = $request->file('file');
                $file_name = $file->getClientOriginalName();
                $file_name = stylistHelperFileRenameWithCurrentDateTime($file_name);
                $file->move($this->upload_folder, $file_name);
                $data['image_link'] = url('') . "/" . $this->upload_folder . "/" . $file_name;
            } else if (isset($request->img_url) && ($request->img_url != '')) {
                $image_link_1_url = $request->img_url;
                $image_link_1_url_arr = explode('?', $image_link_1_url);
                $image_link_1_url = $image_link_1_url_arr[0];

                $allowed_extension = array("jpg", "png", "jpeg", "webp");
                $url_array = explode("/", $image_link_1_url);
                $image_name = end($url_array);
                $image_array = explode(".", $image_name);
                $extension = end($image_array);
                if (in_array($extension, $allowed_extension)) {

                    $image_data = file_get_contents($image_link_1_url);
                    $new_image_path = public_path() . "/" . $this->upload_folder . "/test/test-product." . $extension;
                    file_put_contents($new_image_path, $image_data);
                    $data['image_link'] = url('') . "/" . $this->upload_folder . "/test/test-product." . $extension;
                }
            }
            $product_id = $request->pro_id;
            $categories = $request->categories;

            $product_obj_has = Product::find($product_id);

            $this->authorize('create', Product::class); // Check permission
            $shop_id = Auth::user()->merchantId();

            $data['name'] = $request->name;
            $data['slug'] = $request->slug;
            $data['active'] = 'TRUE';
            $data['categories'] = $categories;
            $data['gtin'] = '';
            $data['gtin_type'] = '';
            $data['model_number'] = '';
            $data['brand'] = $request->brand;
            $data['mpn'] = '';
            $data['description'] = $request->description;
            //$data['manufacturer'] = 'ACME';
            $data['origin_country'] = 'US';
            $data['requires_shipping'] = 'FALSE'; //'TRUE';
            $data['minimum_price'] = '';
            $data['maximum_price'] = '';

            $data['tags'] = ''; //'Tag1,Tag2';
            $data['shop_id'] = $shop_id;
            $data['price'] = $request->price;
            $data['stock_quantity'] = $request->quantity;

            // If the slug is not given the make it
            if (!$data['slug']) {
                $data['slug'] = convertToSlugString($data['name'], $data['gtin']);
            }

            // Ignore if the slug is exist in the database
            if ($prop_slug_info = Product::select('slug', 'id')->where('slug', $data['slug'])->where('id', '!=', $product_id)->withTrashed()->first()) {

                $output['error'] = trans('help.slug_already_exist');
                // $output['prop_slug_info'] = $prop_slug_info;
                return $output;
            }

            if (isset($data['categories'])) {
                $data['category_list'] = Category::whereIn('slug', explode(',', $data['categories']))->pluck('id')->toArray();
            }
            if ($data['origin_country']) {
                $origin_country = DB::table('countries')->select('id')->where('iso_code', strtoupper($data['origin_country']))->first();
            }

            if (isset($data['manufacturer'])) {
                $manufacturer = Manufacturer::firstOrCreate(
                    ['name' => $data['manufacturer']],
                    ['slug' => Str::slug($data['manufacturer'])]
                );
            }

            $pro_data = array(
                'shop_id' => $data['shop_id'],
                'name' => $data['name'],
                'slug' => $data['slug'],
                'model_number' => $data['model_number'],
                'description' => $data['description'],
                'gtin' => $data['gtin'],
                'gtin_type' => $data['gtin_type'],
                'mpn' => $data['mpn'],
                'brand' => $data['brand'],
                'origin_country' => isset($origin_country) ? $origin_country->id : null,
                'manufacturer_id' => isset($manufacturer) ? $manufacturer->id : null,
                'min_price' => ($data['minimum_price'] && $data['minimum_price'] > 0) ? $data['minimum_price'] : 0,
                'max_price' => ($data['maximum_price'] && $data['maximum_price'] > $data['minimum_price']) ? $data['maximum_price'] : null,
                'requires_shipping' => strtoupper($data['requires_shipping']) == 'TRUE' ? 1 : 0,
                'active' => strtoupper($data['active']) == 'TRUE' ? 1 : 0,
            );


            // Create the product
            $product = null;
            if ($product_obj_has) {
                $product_upate = $product_obj_has->update($pro_data);
                if ($product_upate) {
                    $product = Product::find($product_id);
                    $output['upload_update'] = "Product update funciton is call ";
                } else {
                    $output['error'] = "Product udate error  ";
                    return $output;
                }
            } else if ($product_id != 0) {
                $output['error'] = "Product is missing";
                return $output;
            } else {
                $product = Product::create($pro_data);
            }

            // Sync categories
            if ($data['category_list']) {
                $product->categories()->sync($data['category_list']);
            }

            // Upload featured image
            if ($data['image_link']) {
                $product->saveImageFromUrl($data['image_link'], 'feature');
            }

            // Sync tags
            if ($data['tags']) {
                $product->syncTags($product, explode(',', $data['tags']));
            }

            if (!$product) {
                $output['error'] = trans('help.input_error');
            } else {
                $output['success'] = 'Product has been created successfully!';
            }
        } else {
            $output['error'] = 'Something Wrong';
        }

        $output['product'] = $product;

        $output['inventory'] = $this->createInventoryNew($data, $product);
        return $output;
    }

    private function createInventoryNew($data, $product)
    {

        // $product = Product::where('id', $product_id);
        $inventory_has_obj = Inventory::where('product_id', $product->id)->first();
        $key_features = array_filter($data, function ($key) {
            return strpos($key, 'key_feature_') === 0;
        }, ARRAY_FILTER_USE_KEY);

        /*if ($data['linked_items']) {
        $temp_arr = explode(',', $data['linked_items']);
        $linked_items = Inventory::select('id')->mine()->whereIn('sku', $temp_arr)->pluck('id')->toArray();
        }*/
        $price = 0;
        if (isset($data['price'])) {
            $price = $data['price'];
        }
        $stock_quantity = 0;
        if (isset($data['stock_quantity'])) {
            $stock_quantity = $data['stock_quantity'];
        }
        $data['meta_title'] = $data['name'];
        $data['meta_description'] = $data['description'];
        $data['shipping_weight'] = '';
        $data['warehouse_id'] = '';
        $data['supplier_id'] = '';
        $data['available_from'] = date('Y-m-d');

        $data['purchase_price'] = $price;
        $data['price'] = $price;

        $data['condition'] = '';
        $data['condition_note'] = '';
        $data['stock_quantity'] = $stock_quantity;
        $data['min_order_quantity'] = '';
        $data['sku'] = '';
        $data['offer_price'] = '';
        $data['offer_starts'] = '';
        $data['offer_ends'] = '';
        $data['free_shipping'] = '';
        $shop_id = Auth::user()->merchantId();
        if (isset($shop_id)) {
        } else {

            $shop_id = Auth::user()->isSuperAdmin();
        }

        $user_id = Auth::user()->id;

        $inventory_data = [
            'shop_id' => $shop_id,
            'title' => $data['name'],
            'slug' => $data['slug'],
            'sku' => $data['sku'],
            'condition' => $data['condition'],
            'condition_note' => $data['condition_note'],
            'description' => $data['description'],
            'product_id' => $product->id,
            'stock_quantity' => $data['stock_quantity'],
            'min_order_quantity' => $data['min_order_quantity'],
            'key_features' => $key_features,
            'brand' => $data['brand'],
            'user_id' => $user_id,
            'sale_price' => $data['price'],
            'offer_price' => $data['offer_price'] ?: null,
            'offer_start' => $data['offer_starts'] ? date('Y-m-d h:i a', strtotime($data['offer_starts'])) : null,
            'offer_end' => $data['offer_ends'] ? date('Y-m-d h:i a', strtotime($data['offer_ends'])) : null,
            'purchase_price' => $data['purchase_price'],
            'linked_items' => isset($linked_items) ? $linked_items : null,
            'meta_title' => $data['meta_title'],
            'meta_description' => $data['meta_description'],
            'free_shipping' => strtoupper($data['free_shipping']) == 'TRUE' ? 1 : 0,
            'shipping_weight' => $data['shipping_weight'],
            'available_from' => date('Y-m-d h:i a', strtotime($data['available_from'])),
            'warehouse_id' => $data['warehouse_id'],
            'supplier_id' => $data['supplier_id'],
            'active' => strtoupper($data['active']) == 'TRUE' ? 1 : 0,
        ];

        if ($inventory_has_obj) {
            $inventory_data = array();
            $inventory_data['stock_quantity'] = $stock_quantity;
            $inventory_data['purchase_price'] = $price;

            $inventory_data['sale_price'] = $price;
            $inventory_has_obj->update($inventory_data);
            if ($inventory_has_obj) {
                $inventory = Inventory::where('product_id', $product->id)->first();
            } else {
                $inventory = null;
            }
        } else {
            $inventory = Inventory::create($inventory_data);
        }

        // Set attributes
        $attributes = [];


        if (isset($data['varients'])) {

            $inventory->attributes()->sync($data['varients']);
        }

        if (!empty($attributes)) {

            //  $this->setAttributes($inventory, $attributes); // Sync the attributes with the inventory

        }



        // Sync tags
        if (isset($inventory) && isset($data['tags'])) {
            $inventory->syncTags($inventory, explode(',', $data['tags']));
        }

        return $inventory;
    }

    public function editProductDetailsByIdModal($request)
    {

        $output = array();
        if ($request->product_id) {
            $output = $this->getProductImportHtmlModal($request);
            //$output['succes'] = "products load";

        } else {
            $output['error'] = "Something is Wrong";
        }

        return $output;
    }

    public function getProductsWithFilter($request)
    {


        $slug = '';
        if (isset($request['category'])) {
            foreach ($request['category'] as $cat_slug => $cat_slug_status) {
                $slug = $cat_slug;
                if ($slug == 'all_categories') {
                    $slug = '';
                }
            }
        }

        // Array ( [brand] => Array ( [Harris-Rolfson] => on ) )
        $filter_values = array();
        $brand_filter_values = array();
        $all_data_in_arr = $request->all();
        if (is_array($all_data_in_arr) && count($all_data_in_arr)) {
            foreach ($all_data_in_arr as $all_data_info_key => $all_data_info) {
                if (in_array(strtolower($all_data_info_key), array('color', 'size', 'material', 'gender'))) {
                    if (is_array($all_data_info)) {
                        $filter_values[] = array_key_first($all_data_info);
                    }
                }

                if (in_array(strtolower($all_data_info_key), array('brand'))) {
                    if (is_array($brand_filter_values)) {
                        $brand_filter_values[] = array_key_first($all_data_info);
                    }
                }
            }
        }


        //$slug = 'mobile-accessories';
        $all_categories = 'N';
        $products = null;

        $is_sub_group_cat_selected = false;
        $is_group_cat_selected = false;
        if ($slug == '') {
            $all_categories = 'Y';

            $products = Product::where('active', '1');

            if (is_array($brand_filter_values) && count($brand_filter_values)) {
                $products->where('brand', $brand_filter_values[0]);
            }

            $products->with(['inventories' => function ($q) {
                return $q->with('attributeValues');
            }]);
            if (is_array($filter_values) && count($filter_values)) {

                $products = $products->whereHas('inventories.attributeValues', function ($q) use ($filter_values) {

                    /* foreach($filter_values as $filter_value){
                    $q->where('value',$filter_value);
                    }*/
                    $q->whereIn('value', $filter_values);
                    return $q;
                });
            }

            $products->orderBy('id', 'DESC');



        } else {
            $category = Category::where('slug', $slug)
                ->with([
                    'subGroup' => function ($q) {
                        $q->select(['id', 'slug', 'name', 'category_group_id'])->active();
                    },
                    'subGroup.group' => function ($q) {
                        $q->select(['id', 'slug', 'name'])->active();
                    },
                    'attrsList' => function ($q) {
                        $q->with('attributeValues');
                        //$q->with('attributeValues')->where('attributes.value','sunt');
                    },
                ]);


            $category = $category->active()->first();
            if ($category) {

                if (is_array($filter_values) && count($filter_values)) {
                    $products = $category->listings()->whereHas('attributeValues', function ($q) use ($filter_values) {
                        if (is_array($filter_values) && count($filter_values)) {
                            return $q->whereIn('value', $filter_values);
                        }
                    })->available()->filter($request->all())->orderBy('id', 'DESC');
                } else {
                    $products = $category->listings()->available()->filter($request->all())->orderBy('id', 'DESC');
                }
            }else{

                $categorySubGroup = CategorySubGroup::where('slug', $slug)->with([
                        'categories' => function ($q) {
                            $q->select(['id', 'slug', 'category_sub_group_id', 'name'])->whereHas('listings')->active();
                        },
                        'categories.listings' => function ($q) use ($request) {
                            $q->available()->filter($request->all())
                                ->withCount([
                                    'orders' => function ($query) {
                                        $query->where('order_items.created_at', '>=', Carbon::now()->subHours(config('system.popular.hot_item.period', 24)));
                                    },
                                ])
                                ->with([
                                    'avgFeedback:rating,count,feedbackable_id,feedbackable_type',
                                    'shop:id,slug,name,id_verified,phone_verified,address_verified',
                                    'images:path,imageable_id,imageable_type',
                                ])->get();
                        },
                    ])->active()->first();
                if ($categorySubGroup) {
                    $is_sub_group_cat_selected = true;
                    $products = prepareFilteredListingsNew($request, $categorySubGroup->categories);
                }else{


                    $categoryGroup = CategoryGroup::where('slug', $slug)->with([
                         'categories' => function ($q) {
                             $q->select(['categories.id', 'categories.slug', 'categories.category_sub_group_id', 'categories.name'])
                                ->where('categories.active', 1)->whereHas('listings')->withCount('listings');
                         },

                        'categories.listings' => function ($q) use ($request) {
                            $q->available()->filter($request->all())
                                ->withCount([
                                    'orders' => function ($query) {
                                        $query->where('order_items.created_at', '>=', Carbon::now()->subHours(config('system.popular.hot_item.period', 24)));
                                    },
                                ])
                                ->with([
                                    'avgFeedback:rating,count,feedbackable_id,feedbackable_type',
                                    'shop:id,slug,name,id_verified,phone_verified,address_verified',
                                    'images:path,imageable_id,imageable_type',
                                ])->get();
                        },
                    ])->active()->first();

                    if($categoryGroup)
                    {
                        $is_group_cat_selected = true;
                        $products = prepareFilteredListingsNew($request, $categoryGroup->categories);
                    }
                }
                // ----------------------------------------------------------------------------------------
            }
        }

        $pageNumber = 1;
        if (isset($products)) {

            if (Auth::user()->isFromMerchant()) {
                //    $products->mine();
            }

            if (isset($request['filter_page_no'])) {
                $pageNumber = $request['filter_page_no'];
            }

            $output = array();
            $paginate_html = '';



            if($is_sub_group_cat_selected || $is_group_cat_selected){
                 $products = $products->paginate(config('system.view_listing_per_page', 16))
                 ->appends($request->except('page'));
            }else{
                $products = $products->paginate(11, ['*'], 'page', $pageNumber);

            }


        }

        $output['product'] = $products;
        $output['all_categories'] = $all_categories;
        $output['filter_values'] = $filter_values;
        $output['filter_values'] = $filter_values;

        return $output;
    }

    public function showCustomerList()
    {

        $action_base_url = $this->route_base;
        $merchant_id = Auth::id();
        $list = (new StylistClientBookingAppointments)->list();

        $list_data = array();

        $ids_array = array();
        foreach ($list as $key => $info) {
            if (is_numeric($info->customer_id)) {
                $ids_array[] = $info->customer_id;
            }
        }

        $ids_array = array_unique($ids_array);
        $users_info = Customer::whereIn('id', $ids_array)->get();

        $user_info_array = array();

        if ($users_info->isNotEmpty()) {
            foreach ($users_info as $user_info) {
                $user_id = $user_info->id;
                $profile_img_url = url('images/stylist/dummy-profile-pic.png');
                $user_img = Image::where('imageable_id', '=', $user_id)->where('imageable_type', '=', 'App\Models\Customer')->first();
                if ($user_img) {

                    $profile_img_url = url('image/' . $user_img->path);
                }
                $user_info_array[$user_id] = array('name' => $user_info->name, 'image_url' => $profile_img_url, 'email' => '');
            }
        }

        return view('admin.stylist_form.customer_list', compact('list', 'action_base_url', 'user_info_array'));
    }

    public function customerQuestionsAnswersView(Request $request)
    {

        $output = array();
        $customer_id = 0;
        if (isset($request['customer_id'])) {
            $customer_id = $request['customer_id'];
            $questions_details = array();
            $questions = stylistQuestions::all();
            if ($questions->isNotEmpty()) {
                foreach ($questions as $question_info) {
                    $questions_details[$question_info->id] = $question_info->toArray();
                }
            }

            $answers_details = array();
            $answers = stylistQuestionsAnswers::all();
            if ($answers->isNotEmpty()) {
                foreach ($answers as $answer_info) {
                    $answers_details[$answer_info->id] = $answer_info->toArray();
                }
            }

            $details = StylistCustomerQuestionsAnswer::where('customer_id', $customer_id)->orderBy('question_id')->get();
            $html = '';
            $html = '<div class="modal-dialog modal-dialog-centered modal-dialog-style" role="document">
		    <div class=" col-md-11 col-sm-12 m-auto modal-content">
		      <div class="modal-header">

		        <button type="button" class="close close-b-style" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">×</span>
		        </button>
		      </div>
		      <div class="modal-body modal-body-style">


		      <div class="row questions_ansers_modal">
		         <h5 class="modal-title modal-title-add-pro" >Customer Questions & answers details</h5>';

            if ($details) {
                $card_id_parent = 'stf_parent_cqv_' . rand(10, 100);

                $question_no = 1;
                foreach ($details as $detail_info) {

                    $question_name = '';
                    $question_id = $detail_info->question_id;
                    $answer_ids = $detail_info->answer_ids;
                    $other_text_ans = $detail_info->text_ans;
                    $answer_ids_arr = explode(',', $answer_ids);
                    $question_anwer_type = '';
                    $anwer_type = '';
                    $q_type = '';
                    if (isset($questions_details[$question_id])) {
                        $q_type = $questions_details[$question_id]['q_type'];
                        if ($q_type == 'budget_calculate_price_update' && $other_text_ans != '') {
                            $other_text_ans = (int) $other_text_ans;
                            $questions_details[$detail_info->question_id]['name'] = str_replace('$---', '$' . $other_text_ans, $questions_details[$detail_info->question_id]['name']);
                        }

                        $question_name = "<b style='color: #000;'>Q" . $question_no++ . ": </b>  " . $questions_details[$detail_info->question_id]['name'];
                        $question_anwer_type = $questions_details[$detail_info->question_id]['anwer_type'];
                    }
                    $answer_name_html = '';
                    foreach ($answer_ids_arr as $answer_id) {
                        if ($detail_info->type == 'text' || $detail_info->type == 'textarea') {
                            $answer_name_html .= '<p class="mb-n2">' . $detail_info->answer_ids . '</p>';
                        } else if ($detail_info->type == 'file') {
                            $alredy_naswer_img_html = '';

                            if ($detail_info->answer_ids != '') {
                                $alredy_naswer_img = url('uploads/' . $detail_info->answer_ids);
                                $alredy_naswer_img_html = "<img src='" . $alredy_naswer_img . "' height='200px'>";
                            }
                            $answer_name_html .= '<p class="mb-n2">' . $alredy_naswer_img_html . '</p>';
                        } else if (isset($answers_details[$answer_id])) {
                            $answer_name = $answers_details[$answer_id]['name'];
                            $image_name = $answers_details[$answer_id]['image_name'];
                            $has_logn_text_ans = $answers_details[$answer_id]['has_logn_text_ans'];
                            if ($question_anwer_type == 'img') {
                                if ($image_name == '') {
                                    $image_name = $answer_name;
                                }
                                $img_url = url('') . '/images/stylist/questions/' . $image_name;
                                $answer_name_html .= '<img src="' . $img_url . '" height="200px">';
                            }

                            if ($has_logn_text_ans == 'Y' && $other_text_ans != '') {
                                $answer_name = $answer_name . '  (' . $other_text_ans . ')';
                            }
                            $answer_name_html .= '<p class="mb-n2">' . $answer_name . '</p>';
                        }
                    }
                    $card_id = 'stf_cqv_' . $detail_info->id . '_' . $question_id . '_' . rand(10, 100);
                    $html .= '<button type="button" class="btn dropdown-btn" data-toggle="collapse" data-target="#' . $card_id . '" aria-expanded="true">' . $question_name . '<i class="fa fa-caret-down"></i></button>';

                    $html .= '<div id="' . $card_id . '" class="stf_product_filter_value_list collapse in"  aria-expanded="true" style="">' . $answer_name_html . '</div>';
                }
            }
            $html .= '</div>';
            $html .= '</div>';
            $html .= '</div>';
            $html .= '</div>';
            $output['html'] = $html;
            $output['success'] = 'data load';
        } else {
            $output['error'] = 'Something Wrong';
        }

        return $output;
    }

    // function stf_edit_employer_onboarding_questionnaire($id){

    //     $stylistForm = DB::table('employer_onboarding_questionnaires')->find($id);
    //     return view('admin.stylist_form.edit_employer_onboarding_questionnaire',['stylistForm'=>$stylistForm]);
    // }

    public function stf_edit_employer_onboarding_questionnaire(request $request)
    {

        if (Auth::user()->isSuperAdmin()) {

            $send_data = array();
            $db_data = employerOnboardingQuestionnaire::Where('id', $request->id)->first();
            $field_data = array();
            $edit_id = 0;

            if (isset($db_data)) {
                $sub_data = employerOnboardingQuestionnaireValues::Where('employer_onboarding_questionnaires_id', $db_data->id)->get();

                foreach ($sub_data as $ky => $vl) {
                    if (in_array($vl->name, array('team_members_wear_internally_arr', 'client_facing_team_members_roles_arr'))) {
                        $vl->value = explode(',', $vl->value);
                    }
                    $field_data[$vl->name] = $vl->value;
                }
            }

            $edit_id = $request->id;

            return view('admin.stylist_form.employer_onboarding_questionnaire', compact('db_data', 'field_data', 'edit_id'));
        }
    }

    public function UpdateEmployerOnboardingQuestionnaire(EmployerOnboardingQuestionnaireRequest $request)
    {



        DB::beginTransaction();

        try {

            $has_records = false;
            $newRecord = new employerOnboardingQuestionnaire;
            if (isset($request->edit_id)) {
                $recordHas = employerOnboardingQuestionnaire::find($request->edit_id);

                if (isset($recordHas)) {
                    $has_records = true;
                    $newRecord = $recordHas;
                }
            }

            $newRecord->company_name = $request->company_name;

            $newRecord->physical_address = $request->physical_address;

            $newRecord->primary_contact = $request->primary_contact;
            $newRecord->primary_email = $request->primary_email;
            $newRecord->primary_direct_phone_number = $request->primary_direct_phone_number;

            $newRecord->secondary_contact = $request->secondary_phone_number;
            $newRecord->secondary_email = $request->secondary_email;
            $newRecord->secondary_direct_phone_number = $request->secondary_direct_phone_number;
            $newRecord->save();

            $arrayKeyCheck = ['_token', 'company_name', 'physical_address', 'primary_contact', 'primary_email', 'primary_direct_phone_number', 'secondary_contact', 'secondary_email', 'secondary_direct_phone_number'];

            foreach ($request->all() as $key => $value) {
                if (!in_array($key, $arrayKeyCheck)) {
                    if (!$request->hasFile($key)) {
                        if (in_array($key, array('team_members_wear_internally_arr', 'client_facing_team_members_roles_arr'))) {
                            $value = implode(',', $value);
                        }
                        $values_recods_has = employerOnboardingQuestionnaireValues::where('name', $key)->where('employer_onboarding_questionnaires_id', $request->edit_id)->first();
                        if (isset($values_recods_has)) {

                            $values_recods_has->value = $value;
                            $values_recods_has->update();
                        } else {
                            $newRecord->empOnboardQuestions()->create([
                                'name' => $key,
                                'value' => $value,
                            ]);
                        }
                    } else {
                        $file = $request->file($key);
                        $filename = time() . $file->getClientOriginalName();
                        $destinationPath = public_path('uploads/stylist/');
                        $file->move($destinationPath, $filename);
                        $values_recods_has = employerOnboardingQuestionnaireValues::where('name', $key)->where('employer_onboarding_questionnaires_id', $request->edit_id)->first();
                        if (isset($values_recods_has)) {

                            $values_recods_has->value = $filename;
                            $values_recods_has->update();
                        } else {
                            $newRecord->empOnboardQuestions()->create([
                                'name' => $key,
                                'value' => $filename,
                            ]);
                        }
                    }
                }
            }
            DB::commit();
            return redirect('admin/employer_onboarding_questionnaire')->withSuccess('Successfully Updated');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withError($e->getMessage());
        }
    }

    public function getProductAttributeList()
    {

        return array('color', 'brand', 'size', 'material', 'gender');
    }

    public function deleteEmployerOnboardingQuestionnaire(request $request)
    {

        employerOnboardingQuestionnaire::find($request->id)->delete();
        employerOnboardingQuestionnaireValues::Where('employer_onboarding_questionnaires_id', $request->id)->delete();
        return redirect('admin/employer_onboarding_questionnaire')->with('success', 'Record has been deleted successfully');
    }

    public function employerOnboardingQuestionnaire()
    {
        $employerOnboarding = employerOnboardingQuestionnaire::select('id', 'company_name', 'primary_email', 'primary_direct_phone_number')->get();

        return view('admin.stylist_form.employer_onboarding_questionnaire', compact('employerOnboarding'));
    }

    public function saveEmployerOnboardingQuestionnaire_rename(EmployerOnboardingQuestionnaireRequest $request)
    {

        DB::beginTransaction();
        try {
            $newRecord = new employerOnboardingQuestionnaire;
            $newRecord->company_name = $request->company_name;
            $newRecord->physical_address = $request->physical_address;

            $newRecord->primary_contact = $request->primary_contact;
            $newRecord->primary_email = $request->primary_email;
            $newRecord->primary_direct_phone_number = $request->primary_direct_phone_number;

            $newRecord->secondary_contact = $request->secondary_phone_number;
            $newRecord->secondary_email = $request->secondary_email;
            $newRecord->secondary_direct_phone_number = $request->secondary_direct_phone_number;

            $newRecord->save();
            $arrayKeyCheck = ['_token', 'company_name', 'physical_address', 'primary_contact', 'primary_email', 'primary_direct_phone_number', 'secondary_contact', 'secondary_email', 'secondary_direct_phone_number'];
            foreach ($request->all() as $key => $value) {
                if (!in_array($key, $arrayKeyCheck)) {
                    if (!$request->hasFile($key)) {

                        $newRecord->empOnboardQuestions()->create([
                            'name' => $key,
                            'value' => $value,
                        ]);
                    } else {
                        $file = $request->file($key);
                        $filename = time() . $file->getClientOriginalName();
                        $destinationPath = public_path('uploads/stylist/');
                        $file->move($destinationPath, $filename);
                        $newRecord->empOnboardQuestions()->create([
                            'name' => $key,
                            'value' => $filename,
                        ]);
                    }
                }
            }
            DB::commit();
            return redirect('admin/employer_onboarding_questionnaire')->withSuccess('Successfully Save');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withError($e->getMessage());
        }
    }

    public function superAdminManageProduct(Request $request)
    {

        $data = $this->productsListAjax($request);

        return view('admin.stylist_form.manage_products', compact('data'));
    }

    public function StylistAndCustomerBookingCallComplete(Request $request)
    {
        $booking_id = $request->id;

        $has_data = stylistClientBookingAppointmentsChangeStatusHistory::where('booking_id', '=', $booking_id)->where('status', '=', 'call_complete')->first();

        if (isset($has_data)) {
        } else {
            $obj = new stylistClientBookingAppointmentsChangeStatusHistory();

            $obj->booking_id = $booking_id;
            $obj->status = 'call_complete';

            $obj->save();
        }

        return redirect('admin/stylist/customer_request/' . $booking_id)->withSuccess('Successfully Done');
    }

    // 1-11-2022

    public function updateQuestionAnswerinfo()
    {

        $question_catogaries_list = stylistQuestionCatogaries::get();
        $question_list = stylistQuestions::get();
        return view('admin.stylist_form/update_question_answer_text', compact('question_catogaries_list', 'question_list'));
    }

    public function UdpateQuestionTextHtml($request)
    {
        $q_id = $request->q_id;
        $output = array();
        $question_info = stylistQuestions::find($q_id);

        $html = '';
        if ($question_info) {

            $html = '';
            $html = '<div class="modal-dialog modal-dialog-centered modal-dialog-style update_question_info_modal" role="document">
		    <div class=" col-md-11 col-sm-12 m-auto modal-content">
		      <div class="modal-header">

		        <button type="button" class="close close-b-style" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">×</span>
		        </button>
		      </div>
		      <div class="modal-body modal-body-style">


		      <div class="row company_add_user_modal">
		         <h5 class="modal-title modal-title-add-pro" >Update Question Text</h5>';

            $html .= '<div class="response_msg"></div>';
            $html .= '<input type="hidden" class="q_id" name = "q_id" value = "' . $question_info->id . '">';

            $html .= '<textarea class="form-control  sft_pro_summernote" name= "question_text" rows="3" error-msg="Please enter description">'
                . $question_info->name . '</textarea>';

            $html .= '<button type="button" class="btn btn-dark" onclick="question_update_text_by_id(this)" style="background:black; color:#fff; border-radius:5px;">Update</button>';
            $html .= '</div>';
            $html .= '</div>';
            $html .= '</div>';
            $html .= '</div>';

            $output['success'] = 'Updated Successfully';
            //$html = $question_info->name;
        } else {
            $output['error'] = 'Something is Wrong';
        }

        $output['html'] = $html;

        return $output;
    }

    public function udpateQuestionInfoUpdate($request)
    {

        $q_id = $request->q_id;
        $q_text = $request->q_text;
        $output = array();
        $dataHas = stylistQuestions::find($q_id);
        if (isset($dataHas)) {
            $dataHas->name = $q_text;
            $dataHas->save();
            $output['success'] = 'Updated Successfully';
            $output['msg'] = '<div class="alert alert-success" role="alert"> Updated Successfully</div>';
        } else {
            $output['error'] = 'Something is Wrong';
        }
        return $output;
    }

    public function companydetailsview(request $request)
    {

        $output = array();
        $company_id = $request->company_id;


        $employe_onboarding_company_deatils = employerOnboardingQuestionnaire::where('id', $company_id)->first();


        $employe_onboarding_deatils_value = employerOnboardingQuestionnaireValues::where('employer_onboarding_questionnaires_id',$company_id )->whereIn('name', ['vision_statement_file','additional_info_description', 'additional_info_file', 'additional_info', 'additional_amount', 'client_facing_team_members_roles_arr','team_members_wear_internally_arr', 'impression_description', 'vision_statement_file', 'vision_statement_description', 'more_casual_status', 'vision_statement', 'additional_info', 'additional_info_description', 'Additional Amount', 'additional_amount_status'] )->get();
        $additional_info = '';


        $field_data = array();

        if (isset($employe_onboarding_deatils_value)) {
            $sub_data = $employe_onboarding_deatils_value;

            foreach ($employe_onboarding_deatils_value as $ky => $vl) {
                if (in_array($vl->name, array('team_members_wear_internally_arr', 'client_facing_team_members_roles_arr'))) {
                    $vl->value = explode(',', $vl->value);
                }
                $field_data[$vl->name] = $vl->value;
            }
            if(isset($field_data['client_facing_team_members_roles_arr']))
            {    $imglink  = '';
                foreach($field_data['client_facing_team_members_roles_arr'] as $img_link){
                    $imglink.='<img src="'.url('images/stylist/questions/'.$img_link.".jpg").'" style="width:100px; height:100px;" alt="'.$img_link.'" />&nbsp;';
                }
                $additional_info .=  '<tr><td scope="col">Client Facing</td><td>'.$imglink.'</td></tr>';
            }
            if(isset($field_data['impression_description']))
                {
                    $additional_info .=  '<tr><td scope="col"> Team Impression</td><td scope="col">' .$field_data['impression_description']. '</td></tr>';
                }
            if(isset($field_data['more_casual_status']) && $field_data['more_casual_status']==1)
            {
                if(isset($field_data['team_members_wear_internally_arr']))
                {    $imglinkcasual  = '';
                    foreach($field_data['team_members_wear_internally_arr'] as $img_link){
                        $imglinkcasual.='<img src="'.url('images/stylist/questions/'.$img_link.".jpg").'" style="width:100px; height:100px;" alt="'.$img_link.'" />&nbsp;';
                    }
                    $additional_info .=  '<tr><td scope="col">Internal Style</td><td>'.$imglinkcasual.'</td></tr>';
                }

            }
            if(isset($field_data['vision_statement']) && $field_data['vision_statement']==1)
            {   $imglinkstatement = '';
                if(isset($field_data['vision_statement_file']))
                {

                    $imglinkstatement.='<img src="'.url('uploads/stylist/'.$field_data['vision_statement_file']."").'" style="width:100px; height:100px;" alt="'.$field_data['vision_statement_file'].'" />&nbsp;';
                    $additional_info .=  '<tr><td scope="col">Vision Statement</td><td>'.$imglinkstatement.'</td></tr>';
                }
                else
                {
                    $additional_info .=  '<tr><td scope="col">Vision Statement</td><td>' .$field_data['additional_info_description']. '</td></tr>';
                }


            }
            if(isset($field_data['additional_info']) && $field_data['additional_info']==1)
            {   $imglinkstatement = '';
                if(isset($field_data['additional_info_file']))
                {
                    $imglinkstatement.='<img src="'.url('uploads/stylist/'.$field_data['additional_info_file']."").'" style="width:100px; height:100px;" alt="'.$field_data['additional_info_file'].'" />&nbsp;';
                    $additional_info .=  '<tr><td scope="col">Additional File</td><td>'.$imglinkstatement.'</td></tr>';
                }
                else
                {
                    $additional_info .=  '<tr><td scope="col">Team Vision</td><td>' .$field_data['vision_statement_description']. '</td></tr>';
                }

            }
            if(isset($field_data['additional_amount_status']) && $field_data['additional_amount_status']==1)
            {
                if(isset($field_data['additional_amount']))
                {
                    $additional_info .=  '<tr><td scope="col">Company purchase contribution per annum</td><td scope="col">' .'$ '. number_format($field_data['additional_amount']) . '</td></tr>';
                }
                else
                {
                    $additional_info .=  '<tr><td scope="col">Additional Amount</td><td scope="col">$ 0.00  </td></tr>';
                }

            }



        }



        if (isset($employe_onboarding_company_deatils)) {


            $company_name = $employe_onboarding_company_deatils->company_name;
            $company_name;
            $physical_address = $employe_onboarding_company_deatils->physical_address;
            $physical_address;
            $primary_contact = $employe_onboarding_company_deatils->primary_contact;
            $primary_contact;
            $primary_email = $employe_onboarding_company_deatils->primary_email;
            $primary_email;
            $primary_direct_phone_number = $employe_onboarding_company_deatils->primary_direct_phone_number;
            $primary_direct_phone_number;

            $secondary_contact = $employe_onboarding_company_deatils->secondary_contact;
            $secondary_contact;

            $secondary_email = $employe_onboarding_company_deatils->secondary_email;
            $secondary_email;

            $secondary_direct_phone_number = $employe_onboarding_company_deatils->secondary_direct_phone_number;
            $secondary_direct_phone_number;



            $html = '';

            $html = '<div class="modal-dialog modal-dialog-centered modal-dialog-style" role="document">
		    <div class=" col-md-11 col-sm-12 m-auto modal-content">
		      <div class="modal-header">

		        <button type="button" class="close close-b-style" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">×</span>
		        </button>
		      </div>
		      <div class="modal-body modal-body-style">


		      <div class="row questions_ansers_modal container-fluid px-5  stf_add_employer_onboarding ">
		        <h5 class="modal-title modal-title-add-pro" >Company details</h5>

	<table class="table table-responsive">
		<tbody>
			<tr><td scope="col">Company Name</td><td scope="col">' . $company_name . '</td></tr>
			' . $additional_info . '


		</tbody>
	</table>' .


                $html .= '</div>';
            $html .= '</div>';
            $html .= '</div>';
            $html .= '</div>';
            $output['html'] = $html;
            $output['success'] = 'data load';
        } else {
            $output['error'] = 'Something Wrong';
        }
    /*<tr><td scope="col">Physical Address</td><td scope="col">' . $physical_address . '</td></tr>
			<tr><td scope="col">Primary Contact</td><td scope="col">' . $primary_contact . '</td></tr>
			<tr><td scope="col">Primary Email</td><td scope="col">' . $primary_email . '</td></tr>
			<tr><td scope="col">Primary Direct Phone Number</td><td scope="col">' . $primary_direct_phone_number . '</td></tr>
			<tr><td scope="col">Secondary Contact</td><td scope="col">' . $secondary_contact . '</td></tr>
			<tr><td scope="col">Secondary Email</td><td scope="col">' . $secondary_email . '</td></tr>
			<tr><td scope="col">Secondary Direct Phone Number</td><td scope="col">' . $secondary_direct_phone_number . '</td></tr>

*/
        return $output;
    }

    public function postdetails(request $request)
    {
        /*  if (Auth::user()->isSuperAdmin() ){
        return redirect('/')->withError('You not have permission for this page');

        }*/

        $stylist_id = $request->user()->id;

        $stylist_name = $request->user()->name;
        $after_booking_dates = '';
        $product_price = '';
        $order_reveal_ids = stylistRevealsItems::where('merchant_id', $stylist_id)->pluck('id')->toArray();


        // complete Order List
        $order_list = order::whereIn('reveal_id', $order_reveal_ids)->where('reveal_status', '=', 'completed')->pluck('id')->toArray();
        $status_comelete = count($order_list);

        // new clients
        $client_number = StylistClientBookingAppointments::where('merchant_id', $stylist_id)->pluck('customer_id')->toArray();
        $client_number_value = count($client_number);

        // blog dara;
        $blog_user_info = Blog::all();
        $revels_details_info = Shop::where('owner_id', $stylist_id)->first();
        $shop_id = $revels_details_info->id;

        $reveal_status = getRevealStatusKeyNameHelper('completed');

        $order_reveal_obj = order::whereIn('reveal_id', $order_reveal_ids)->where('reveal_status', '=', $reveal_status)->where('reveal_id', '!=', 0)->get();


        $order_item_inventory_ids = OrderItem::whereIN('order_id', $order_list)->pluck('inventory_id', 'unit_price')->all();
        // if($order_item_inventory_ids->isNotEmpty())
        // {

                foreach ($order_item_inventory_ids as $price => $order_item_inventoryids) {

                    $inventoryids = $order_item_inventoryids;
                    $product_price = $price;
                }


            // }
            $inventory_obj = Inventory::whereIN('id', $order_item_inventory_ids)->get();




        return view('admin.stylist_form/post_details_dashboard', compact('stylist_name', 'status_comelete', 'client_number_value', 'blog_user_info', 'inventory_obj', 'product_price'));
    }

    public function merchantAvailability(Request $request)
    {

        $id = Auth::user()->id;
        $merchantAvailability  = MechantAvailability::where('merchant_id', $id)->get()->toArray();
        //    var_dump($merchantAvailability_data->days);
        $arr = [];
        $merchantAvailability_data = [];

        foreach($merchantAvailability as $key => $val)
        {
            if($val['days'] != 0)
            {
                $arr1 = array('start' => $val['start_time'], 'end' => $val['end_time'] );
                $arr = array_merge($arr, array($val['id'] => $arr1));
                $merchantAvailability_data[$val['days']][$val['id']] = $arr1;
            }

        }


        return view('admin.stylist_form.merchant_availability', compact('id', 'merchantAvailability_data' ,'merchantAvailability'));
    }


    public function  save_merchant_availability(Request $request)
    {
        $id = Auth::user()->id;
        $days_array  = $request->dayscheckbox;
        $days_array_exo = (explode(',',$request->dayscheckbox));
        $new_adding_time ='';
        if(in_array(1,$days_array_exo))
        {
            foreach( $request->monday_start as $index => $mstart )
            {
                $monday_edit_id =isset( $request->monday_edit_id[$index])?  $request->monday_edit_id[$index]: '';
                $has_record = MechantAvailability::where('id', $monday_edit_id)->first();
                if($has_record)
                {
                        $has_record->start_time = $mstart;
                        $has_record->end_time = isset($request->monday_end[$index])?$request->monday_end[$index]:'';
                        $has_record_time = json_encode(['start'=>$has_record->start_time , 'end'=>$has_record->end_time , 'status'=>0]);
                        $has_record->full_time_availability =  $has_record_time;
                        $has_record->update();
                }
                else
                {
                    $merchant_time = new MechantAvailability;
                    $merchant_time->merchant_id = $request->get('merchant_ids');
                    $merchant_time->Days = 1;
                    $merchant_time->start_time = $mstart;
                    $merchant_time->end_time = isset($request->monday_end[$index])?$request->monday_end[$index]:'';
                    $new_adding_time = json_encode(['start'=>$merchant_time->start_time , 'end'=>$merchant_time->end_time , 'status'=>0]);
                    $merchant_time->full_time_availability =  $new_adding_time;
                    $merchant_time->save();
                }
            }

        }
        if(in_array(2,$days_array_exo))
        {
            foreach( $request->tuesday_start as $index => $tstart )
            {
                $tuesday_edit_id = isset($request->tuesday_edit_id[$index])?$request->tuesday_edit_id[$index]:'';
                $has_record = MechantAvailability::where('id', $tuesday_edit_id)->first();
                if($has_record)
                {
                    $has_record->start_time = $tstart;
                    $has_record->end_time = isset($request->tuesday_end[$index])? $request->tuesday_end[$index] : '';
                    $has_record_time = json_encode(['start'=>$has_record->start_time , 'end'=>$has_record->end_time , 'status'=>0]);
                    $has_record->full_time_availability =  $has_record_time;
                    $has_record->update();
                }
                else
                {
                    $merchant_time = new MechantAvailability;
                    $merchant_time->merchant_id = $request->get('merchant_ids');
                    $merchant_time->Days = 2;
                    $merchant_time->start_time = $tstart;
                    $merchant_time->end_time = isset($request->tuesday_end[$index])? $request->tuesday_end[$index] : '';
                    $new_adding_time = json_encode(['start'=>$merchant_time->start_time , 'end'=>$merchant_time->end_time , 'status'=>0]);
                    $merchant_time->full_time_availability =  $new_adding_time;
                    $merchant_time->save();
                }
            }
        }
        if(in_array(3,$days_array_exo)){
            foreach( $request->wednesday_start as $index => $wstart ) {


                $wednesday_edit_id = isset($request->wednesday_edit_id[$index])? $request->wednesday_edit_id[$index]: '';
                $has_record = MechantAvailability::where('id', $wednesday_edit_id)->first();
                if($has_record)
                {
                    $has_record->start_time = $wstart;
                    $has_record->end_time = isset($request->wednesday_end[$index])? $request->wednesday_end[$index] : '';
                    $has_record_time = json_encode(['start'=>$has_record->start_time , 'end'=>$has_record->end_time , 'status'=>0]);
                    $has_record->full_time_availability =  $new_adding_time;
                    $has_record->update();
                }
                else
                {
                    $merchant_time = new MechantAvailability;
                    $merchant_time->merchant_id = $request->get('merchant_ids');
                    $merchant_time->Days = 3;
                    $merchant_time->start_time = $wstart;
                    $merchant_time->end_time = isset($request->wednesday_end[$index])? $request->wednesday_end[$index] : '';
                    $new_adding_time = json_encode(['start'=>$merchant_time->start_time , 'end'=>$merchant_time->end_time , 'status'=>0]);
                    $merchant_time->full_time_availability =  $new_adding_time;
                    $merchant_time->save();
                }

            }
        }
        if(in_array(4,$days_array_exo)){
            foreach( $request->thursday_start as $index => $thstart ) {
                $thursday_edit_id = isset($request->thursday_edit_id[$index])?$request->thursday_edit_id[$index]:'';
                $has_record = MechantAvailability::where('id', $thursday_edit_id)->first();
                if($has_record)
                {
                    $has_record->start_time = $thstart;
                    $has_record->end_time = isset($request->thursday_end[$index])?$request->thursday_end[$index]:'';
                    $has_record_time = json_encode(['start'=>$has_record->start_time , 'end'=>$has_record->end_time , 'status'=>0]);
                    $has_record->full_time_availability =  $new_adding_time;
                    $has_record->update();
                }
                else
                {
                    $merchant_time = new MechantAvailability;
                    $merchant_time->merchant_id = $request->get('merchant_ids');
                    $merchant_time->Days = 4;
                    $merchant_time->start_time = $thstart;
                    $merchant_time->end_time = isset($request->thursday_end[$index])?$request->thursday_end[$index]:'';
                    $new_adding_time = json_encode(['start'=>$merchant_time->start_time , 'end'=>$merchant_time->end_time , 'status'=>0]);
                    $merchant_time->full_time_availability =  $new_adding_time;
                    $merchant_time->save();
                }





            }
        }
        if(in_array(5,$days_array_exo)){
            foreach( $request->friday_start as $index => $fstart ) {
                $friday_edit_id = isset($request->friday_edit_id[$index])?$request->friday_edit_id[$index]:'';
                $has_record = MechantAvailability::where('id', $friday_edit_id)->first();
                if($has_record)
                {
                    $has_record->start_time = $fstart;
                    $has_record->end_time = isset($request->friday_end[$index])?$request->friday_end[$index]:'';
                    $has_record_time = json_encode(['start'=>$has_record->start_time , 'end'=>$has_record->end_time , 'status'=>0]);
                    $has_record->full_time_availability =  $new_adding_time;
                    $has_record->update();
                }
                else
                {
                    $merchant_time = new MechantAvailability;
                    $merchant_time->merchant_id = $request->get('merchant_ids');
                    $merchant_time->Days = 5;
                    $merchant_time->start_time = $fstart;
                    $merchant_time->end_time = isset($request->friday_end[$index])? $request->friday_end[$index] :'';
                    $new_adding_time = json_encode(['start'=>$merchant_time->start_time , 'end'=>$merchant_time->end_time , 'status'=>0]);
                    $merchant_time->full_time_availability =  $new_adding_time;
                    $merchant_time->save();
                }
            }
        }
        return redirect('admin/stylist/availability');

    }



    public function deleteavailability($id)
    {


        $id = MechantAvailability::find($id)->delete();
        return redirect()->back();

    }





}
