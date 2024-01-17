<style>
    table.dataTable thead .sorting_asc:after,table.dataTable thead .sorting_desc:after{top:24px!important;font-size:15px!important}.dt-buttons{position:relative;float:left;display:none!important}
</style>
@extends('admin.layouts.master')
@section('content')
    @if(session('success'))
        <div class="alert {{ Session::get('alert-class', 'alert-info') }} alert-dismissible fade show">{{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert {{ Session::get('alert-class', 'alert-info') }} alert-danger  fade show"> {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
    @endif
    <div class="box stf_outer_body stf_outer_page_load" style="display:none">
        <div class="row " style="display: flex; margin-left: 0;">
            <div class="" style="width: 96%; ">
                <div class="box-header with-border">
                    <form action="{{ url('admin/stylist/customer_request') }}" method="get">
                        @php
                            $revela_status = '';
                            $action_status = '';
                            $page_no = 1;
                            $search_booking_status = '';
                            $search_company_id = 0;
                            $search_box_input = '';
                            $search_company_label = 'Company';
                            $search_app_date_label = 'Date';
                            $revel_status_label = 'Reveal Status';
                            $action_status_label = 'Action';
                            if (isset($_GET['page']))
                            {
                                $page_no = $_GET['page'];
                            }
                            if (isset($filter_values['search_company_name']))
                            {
                                $search_company_label = $filter_values['search_company_name'];
                                $company_id = $filter_values['search_company_id'];
                            }
                            if (isset($filter_values['search_app_date_ids']))
                            {
                                $search_app_date_label = $filter_values['search_app_date_text'];
                            }
                            if (isset($filter_values['search_reveal_status_text']))
                            {
                                $revel_status_label = $filter_values['search_reveal_status_text'];
                            }
                            if (isset($filter_values['search_box_text']))
                            {
                                $search_box_input = $filter_values['search_box_text'];
                            }
                            if (isset($filter_values['action_status_text']))
                            {
                                $action_status_label = $filter_values['action_status_text'];
                            }
                        @endphp
                        <input type="hidden" name="page" value="{{ $page_no }} ">
                        <input type="hidden" name="company_id" value="{{ $search_company_id }} ">
                        <input type="hidden" name="reveal_status" value="{{ $revela_status }} ">
                        <input type="hidden" name="action_status" value="{{ $action_status }} ">
                        <div class="d-flex justify-content-center align-items-center">
                            <div class="col-md-6 stf_outer_body-input ">
                                <div class="form">
                                    <i class="fa fa-search" style="top: 15px;"></i>
                                    <input type="text" class="form-control form-input-1" name="search_box" value="{{ $search_box_input }}" style="/*border-radius: 7px !important;*/">
                                </div>
                            </div>
                        </div>
                        <div class="stf_dropdown_with_submenu">
                            <div class="dropdown1 dropdown">
                                <button type="button" onclick="stfTopSubMenuShowHide(this)" class="dropbtn reveal_status_label">{{ $revel_status_label }} <i class="fa fa-angle-down" aria-hidden="true" style="font-size:14px; margin-left:5px;"></i></button>
                                <div class="dropdown-content style_cr_filter_drop_down">
                                    <a href="javascript:void(0)"
                                        onclick="stfCustomerRequestFilter(this,'reveal_status','','All')">All</a>
                                    <a href="javascript:void(0)"
                                        onclick="stfCustomerRequestFilter(this,'reveal_status','Not started','Not started')">Not
                                        started</a>
                                    <a href="javascript:void(0)"
                                        onclick="stfCustomerRequestFilter(this,'reveal_status','Call Upcoming','Call Upcoming')">Call Upcoming</a>
                                    <a href="javascript:void(0)"
                                        onclick="stfCustomerRequestFilter(this,'reveal_status','Delivered','Delivered')">Delivered</a>
                                    <a href="javascript:void(0)"
                                        onclick="stfCustomerRequestFilter(this,'reveal_status','Awaiting Delivery','Awaiting Delivery')">Awaiting delivery</a>
                                    <a href="javascript:void(0)"
                                        onclick="stfCustomerRequestFilter(this,'reveal_status','Draft','Draft')">Draft</a>
                                    <a href="javascript:void(0)"
                                        onclick="stfCustomerRequestFilter(this,'reveal_status','Awaiting response','Awaiting response')">Awaiting
                                        response</a>
                                    <a href="javascript:void(0)"
                                        onclick="stfCustomerRequestFilter(this,'reveal_status','Preparing order','Preparing order')">Preparing
                                        order</a>
                                    <a href="javascript:void(0)"
                                        onclick="stfCustomerRequestFilter(this,'reveal_status','Dispatched','Dispatched')">Dispatched</a>
                                    <a href="javascript:void(0)"
                                        onclick="stfCustomerRequestFilter(this,'reveal_status','Return Initiated','Return Initiated')">Return
                                        Initiated</a>
                                </div>
                            </div>
                            <div class="dropdown">
                                <button type="button" onclick="stfTopSubMenuShowHide(this)" class="dropbtn action_status_label"> {{ $action_status_label }}<i class="fa fa-angle-down" aria-hidden="true" style="font-size:14px; margin-left:5px;"></i></button>
                                <div class="dropdown-content myDropdown  style_cr_filter_drop_down">
                                    <a href="javascript:void(0)"
                                        onclick="stfCustomerRequestFilter(this,'action_status','','All')">All</a>
                                    <a href="javascript:void(0)"
                                        onclick="stfCustomerRequestFilter(this,'action_status','Call Upcoming','Call Upcoming')">
                                        Call Upcoming</a>
                                    <a href="javascript:void(0)"
                                        onclick="stfCustomerRequestFilter(this,'action_status','Create Reveal','Create Reveal')">
                                        Create Reveal</a>
                                    <a href="javascript:void(0)"
                                        onclick="stfCustomerRequestFilter(this,'action_status','Urgent Reveal','Urgent Reveal')">
                                        Urgent Reveal</a>
                                    <a href="javascript:void(0)"
                                        onclick="stfCustomerRequestFilter(this,'action_status','Relax','Relax')"> Relax</a>
                                    <a href="javascript:void(0)"
                                        onclick="stfCustomerRequestFilter(this,'action_status','Get Reveal Ready','Get Reveal Ready')">
                                        Get Reveal Ready</a>
                                </div>
                            </div>
                            <div class="dropdown myDropdown">
                                <button type="button" onclick="stfTopSubMenuShowHide(this)" class="dropbtn company_id_label">{{ $search_company_label }} <i class="fa fa-angle-down" aria-hidden="true" style="font-size:14px; margin-left:5px;"></i></button>
                                <div class="dropdown-content style_cr_filter_drop_down">
                                    @php
                                        $html_company_list = '';
                                        $html_company_list .= '<a href="javascript:void(0)" onclick="stfCustomerRequestFilter(this,\'company_id\',0,\'All\')">All</a>';
                                        if ($employerOnboarding)
                                        {
                                            foreach ($employerOnboarding as $employerOnboarding_info)
                                            {
                                            $company_name = $employerOnboarding_info['company_name'];
                                            $company_id = $employerOnboarding_info['id'];
                                            $html_company_list .= '<a href="javascript:void(0)" onclick="stfCustomerRequestFilter(this,\'company_id\',\'' . $company_id . '\',\'' . $company_name . '\')">'. $company_name . '</a>';
                                            }
                                        }
                                        echo $html_company_list;
                                    @endphp
                                </div>
                            </div>
                            <button class="dropbtn ">Search</button>
                        </div>
                    </form>
                </div> <!-- /.box-header -->
                <div class="box-body stf_table_hide_serarch_bar">
                    <table class="table table-hover table-no-sort text-center" id="stf_request_list">
                        <thead>
                            <tr class="stf_outer_body_table_style articles">
                                <th class="c-text-center"><h3>Profile</h3></th>
                                <th class="c-text-center"><h3>Name</h3></th>
                                <th class="c-text-center"><h3>Company</h3></th>
                                <th class="c-text-center"><h3>Task Due</h3></th>
                                <th class="c-text-center"><h3>Reveal Status</h3></th>
                                <th class="c-text-center"><h3>Days Left</h3></th>
                                <th class="c-text-center"><h3>Action Status</h3></th>
                                <th class="c-text-center"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($list->count() > 0)
                                @foreach($list as $key => $info)
                                    @php
                                        $todays_dates = date('d-m-Y');
                                        $reveal_status_button = '';
                                        $reveal_status = 'not_started';
                                        $reveal_status = $info->status;
                                        $booking_creat_date = date('d-m-Y', strtotime($info->created_at));
                                        $booking_creat_12_date = date('d-m-Y', strtotime($info->created_at. '+12 days'));
                                        $booking_creat_14_date = date('d-m-Y', strtotime($info->created_at. '+14 days'));
                                        $appointment_create_date_add_14_days = date('d-m-Y', strtotime($info->created_at. '+14 days'));
                                        $reveal_list = $info->reveal()->get();
                                        $get_reveal = '';
                                        $actual_reveal_status = '';
                                        $reveal_has_draft ='';
                                        $get_order_data ='';
                                        $cancel_info ='';
                                        $reveal_create_14_days ='';
                                        $reveal_create_date_3month ='';
                                        if ($reveal_list->isNotEmpty())
                                        {
                                            $reveal_has_draft = $info->reveal()->where('status','=','draft')->latest()->first();
                                            $get_reveal = $info->reveal()->first();
                                            if(isset($get_reveal))
                                            {
                                                $reveal_sentdate = $get_reveal->updated_at->format('d-m-Y');
                                                $reveal_create_date_3month = date('d-m-Y', strtotime($reveal_sentdate . "+ 90 days"));
                                                $reveal_create_76_days = date("d-m-Y",strtotime($reveal_create_date_3month." -76 days"));
                                                $reveal_create_45_days = date("d-m-Y",strtotime($reveal_create_date_3month." -45 days"));
                                                $reveal_create_14_days = date("d-m-Y",strtotime($reveal_create_date_3month." -14 days"));
                                            }
                                        }
                                        $reveal_status_text_new = ucwords(str_replace('_', ' ', $reveal_status));
                                        $reveals_info = $info->listJoinWithRevealsItems()->first();
                                        $stylist_call_complete = $info->statusHistory()->where('status', '=', 'call_complete')->first();
                                        $stylistUser = $info->stylistUser()->first();
                                        $company_name = '';
                                        if (isset($stylistUser))
                                        {
                                            $company_obj = $info->stylistUser->company()->first();
                                            if (isset($company_obj))
                                            {
                                                $company_name = $company_obj->company_name;
                                            }
                                        }
                                        $name = '';
                                        $profile_img_url = url('images/stylist/dummy-profile-pic.png');
                                        $customer_obj = $info->customer()->first();
                                        if (isset($customer_obj))
                                        {
                                            $name = $customer_obj->name . ' ' . $customer_obj->last_name;
                                            $customer_image_obj = $info->customerImage()->first();
                                            if (isset($customer_image_obj))
                                            {
                                                $profile_img_url = url('image/' . $customer_image_obj->path);
                                            }
                                        }
                                        $get_order_data = $info->customer->orders()->latest()->first();
                                        if(isset($get_order_data))
                                        {
                                            $update_date = $get_order_data->updated_at->format('d-m-Y');
                                            $update_date_14_days = date('d-m-Y', strtotime($update_date.'+14 days'));
                                            $cancel_info = $info->cancellation()->latest()->first();
                                        }
                                        $reveal_action_color = '';
                                        $reveal_action_btn = '';
                                        $reveal_status_button_class = '';
                                        $reveal_status_button_text = '';
                                        $reveal_action_status_text = '';
                                        $reveal_action_btn = '<a href="' . url('admin/stylist/customer_request/' . $info->id) . '" title="Manage" class="custom-manage-reveal-btn">Manage <a>';
                                        if(isset($reveal_has_draft) && ($todays_dates >= $reveal_create_14_days) && ($todays_dates <= $reveal_create_date_3month))
                                        {
                                            $reveal_status_button_text='NOT STARTED' ;
                                            $reveal_status_button_class='text-warning-style-two_4' ; }
                                        else if(!is_array($reveal_has_draft) && !empty($reveal_has_draft) && isset($reveal_has_draft) && ($reveal_has_draft->status == 'draft') && ( strtotime($todays_dates) >= strtotime($reveal_create_14_days)) && ( strtotime($todays_dates) <= strtotime($reveal_create_date_3month)))
                                        {
                                            $reveal_status_button_text='NOT STARTED' ;
                                            $reveal_status_button_class='text-warning-style-two_4' ;
                                        }
                                        else if(!is_array($get_reveal) && !empty($get_reveal) && ($reveal_status=='dispatched' ) && (isset($get_order_data)) && (($get_order_data->order_status_id == 6) || ($get_order_data->order_status_id != 6)) && !isset($cancel_info) && (strtotime($todays_dates) >= strtotime($update_date_14_days)) && ( strtotime($todays_dates) <= strtotime($reveal_create_76_days)))
                                        {
                                            $reveal_status_button_text='NOT STARTED' ;
                                            $reveal_status_button_class='text-warning-style-two_4' ;
                                        }
                                        else if(!is_array($get_reveal) && !empty($get_reveal) && ($get_reveal->status == 'return_initiated') && $reveal_status == 'return_initiated' && isset($cancel_info) &&($cancel_info->status == 6 ) && (strtotime($todays_dates) <= strtotime($update_date_14_days)) )
                                        {
                                            $reveal_status_button_text='NOT STARTED' ;
                                            $reveal_status_button_class='text-warning-style-two_4' ;
                                        }
                                        else if(!is_array($get_reveal) && !empty($get_reveal) && ($get_reveal->status == 'refunded') && isset($cancel_info) &&($cancel_info->status == 6 ) && (strtotime($todays_dates) <= strtotime($update_date_14_days)) )
                                        {
                                            $reveal_status_button_text='NOT STARTED' ;
                                            $reveal_status_button_class='text-warning-style-two_4' ;
                                        }
                                        else if(!is_array($get_reveal) && !empty($get_reveal) && ($get_reveal->status == 'return_initiated') && $reveal_status == 'return_initiated' && isset($cancel_info) && ($cancel_info->status == 1 ) && (strtotime($todays_dates) <= strtotime($update_date_14_days)) )
                                        {
                                            $reveal_status_button_text='RETURN INITIATED' ;
                                            $reveal_status_button_class='text-warning-style-two_5' ;
                                        }
                                        else if(!is_array($get_reveal) && !empty($get_reveal) && ($get_reveal->status == 'delivered') && ($reveal_status == 'dispatched'|| $reveal_status == 'delivered') && (isset($get_order_data) && $get_order_data->order_status_id == 6) )
                                        {
                                            $reveal_status_button_text = 'DELIVERED';
                                            $reveal_status_button_class = 'text-warning-style-two_2';
                                        }
                                        else if(!is_array($get_reveal) && !empty($get_reveal) && ($get_reveal->status == 'awaiting_delivery') && (isset($get_order_data) && $get_order_data->order_status_id == 5) )
                                        {
                                            $reveal_status_button_text = 'Awaiting Delivery';
                                            $reveal_status_button_class = 'text-warning-style-two_2';
                                        }
                                        else if(!is_array($get_reveal) && !empty($get_reveal) && ($get_reveal->status == 'dispatched') && ($reveal_status == 'dispatched'))
                                        {
                                            $reveal_status_button_text = 'DISPATCHED';
                                            $reveal_status_button_class = 'text-warning-style-two_1';
                                        }
                                        else if(!is_array($get_reveal) && !empty($get_reveal) && ($get_reveal->status == 'preparing_order') && $reveal_status == 'preparing_order')
                                        {
                                            $reveal_status_button_text = 'PREPARING ORDER';
                                            $reveal_status_button_class = 'text-warning-style-two_1';
                                        }
                                        else if(!is_array($get_reveal) && !empty($get_reveal) && ($get_reveal->status == 'awaiting_response' || $get_reveal->status == 'in_progress') && ($reveal_status == 'awaiting_response') )
                                        {
                                            $reveal_status_button_text = 'AWAITING RESPONSE';
                                            $reveal_status_button_class = 'text-warning-style-two_3';
                                        }
                                        else if(!is_array($reveal_has_draft) && !empty($reveal_has_draft) && ($reveal_has_draft->status == 'draft') && ($reveal_status == 'not_started') && ($todays_dates > $booking_creat_12_date) && ($todays_dates <= $booking_creat_14_date) )
                                        {
                                            $reveal_status_button_text='DRAFT' ;
                                            $reveal_status_button_class='text-warning-style-two' ;
                                        }
                                        else if(!is_array($reveal_has_draft) && !empty($reveal_has_draft) && ($reveal_has_draft->status == 'draft') && ($reveal_status == 'not_started') && (strtotime($todays_dates) < strtotime($booking_creat_12_date)) )
                                        {
                                            $reveal_status_button_text='DRAFT' ;
                                            $reveal_status_button_class='text-warning-style-two' ;
                                            // $reveal_action_status_text='Call Upcoming' ;
                                        }
                                        else if($reveal_status=='not_started' && isset($stylist_call_complete) )
                                        {
                                            $reveal_status_button_text='Not Started' ;
                                            $reveal_status_button_class='text-warning-style-two_4' ;
                                            // $reveal_action_status_text='Call Upcoming' ;
                                        }
                                        else if($reveal_status=='not_started' )
                                        {
                                            $reveal_status_button_text='Call Upcoming' ;
                                            $reveal_status_button_class='text-warning-style-two' ; //
                                            // $reveal_action_status_text='Call Upcoming' ;
                                        }


                                        $reveal_status_button .=' <td class="c-text-left"><span class="badge badge-pill badge-warning  text-warning-style ' . $reveal_status . '_status_btn  ' . $reveal_status_button_class . '">' . $reveal_status_button_text . '</span></td>' ;
                                        $days_left='' ;
                                        $after_days1='' ;
                                        $crrunt_date=date('d/m');

                                        if(isset($stylist_call_complete))
                                        {
                                            $reveal_list=$info->reveal()->get();
                                            if ($reveal_list->isNotEmpty())
                                            {
                                                $reveal_has_not_draft = $info->reveal()->where('status', '!=', 'draft')->first();
                                                if (isset($reveal_has_not_draft))
                                                {

                                                }
                                                else
                                                {
                                                    $reveal_status_button_text = 'draft';
                                                    $after_days1 = date('d/m', strtotime($stylist_call_complete->created_at . '+14 days'));
                                                    $fdate = date('Y-m-d', strtotime($stylist_call_complete->created_at . '+14 days'));
                                                    $tdate = date('Y-m-d');
                                                    $datetime1 = new DateTime($fdate);
                                                    $datetime2 = new DateTime($tdate);
                                                    $interval = $datetime1->diff($datetime2);
                                                    $days_left = $interval->format('%a');
                                                }
                                            }
                                            else
                                            {
                                                $after_days1 = date('d/m', strtotime($stylist_call_complete->created_at . '+14 days'));
                                                $fdate = date('Y-m-d', strtotime($stylist_call_complete->created_at . '+14 days'));
                                                $tdate = date('Y-m-d');
                                                $datetime1 = new DateTime($fdate);
                                                $datetime2 = new DateTime($tdate);
                                                $interval = $datetime1->diff($datetime2);
                                                $days_left = $interval->format('%a');
                                            }
                                        }
                                        else
                                        {
                                            $reveal_status_button_text = 'Not started';
                                            $reveal_action_status_text = 'Call Upcoming';
                                            $reveal_status_button_text = $reveal_status_text_new;
                                            $reveal_action_color = 'text-green';
                                        }

                                        $create_date = '';
                                        $create_date_14days = '';
                                        $month = '';
                                        $month_date = '';
                                        $create_date_14days_exp = '';
                                        // ---------------------------------------------------------------------------------
                                        $action_status ='';
                                        $action_status_info = '';
                                        $style_para = '';
                                        $appointment_date_action_status =$info->appointment_date;
                                        $appointment_create_date_action_status = date('d-m-Y', strtotime($info->created_at));
                                        $appointment_create_date_add_12_days = date('d-m-Y', strtotime($info->created_at. '+12 days'));
                                        $appointment_create_date_add_14_days = date('d-m-Y', strtotime($info->created_at. '+14 days'));
                                        $appointment_create_date_add_2_m = date('d-m-Y', strtotime($info->created_at. '+2 months'));
                                        $appointment_create_date_add_2_m_17_d = date('d-m-Y', strtotime($appointment_create_date_add_2_m. '17 days'));
                                        $appointment_create_date_add_27_days = date('d-m-Y', strtotime($appointment_create_date_add_2_m_17_d. '10 days'));
                                        $appointment_create_date_add_last_3_days = date('d-m-Y', strtotime($appointment_create_date_add_27_days. '3days'));
                                        // -----------------------get order details----------------------------------------
                                        $booking_customer_id = $info->customer_id;
                                        $get_order_data =
                                        $info->customer->orders()->latest()->first();
                                        $order_update_date = '';
                                        $order_status_id_info = '';
                                        $cancel_data = '';
                                        if($get_order_data)
                                        {
                                            $order_update_date = $get_order_data->updated_at->format('d-m-Y');
                                            $order_update_date_14_days = date('d-m-Y', strtotime($order_update_date. '+14 days'));
                                            $order_update_date_7_weeks = date('d-m-Y', strtotime($get_order_data->updated_at. '+7 weeks'));
                                            $order_status_id_info = $get_order_data->order_status_id;
                                            $cancel_data = $info->cancellation()->latest()->first();
                                            $cancel_create_date = '';
                                            if($cancel_data)
                                            {
                                                $cancel_create_date =$cancel_data->created_at;
                                            }
                                        }

                                        if(isset($get_order_data) && ($get_order_data->order_status_id == 6) && !isset($cancel_data) && isset($reveals_info) && ($reveals_info->status != 'return_initiated') && ($reveals_info->status == 'dispatched') && (strtotime($todays_dates) >= strtotime($order_update_date_14_days)))
                                        {
                                            $action_status_info = 'RELAX' ;
                                            $style_para = 'style="color: #6893ce
                                            !important; font-weight:900;"';
                                        }
                                        else if(isset($get_order_data) && (($get_order_data->order_status_id == 7) ) && isset($cancel_data) && ($cancel_data->status == 6) && isset($reveals_info) && ($reveals_info->status == 'refunded') && (strtotime($todays_dates) <= strtotime($order_update_date_14_days)))
                                        {
                                            $action_status_info='RELAX' ;
                                            $style_para='style="color: #6893ce !important; font-weight:900;"' ;
                                        }
                                        else if(isset($get_order_data) && (($get_order_data->order_status_id == 6) || $get_order_data->order_status_id != 6) && isset($cancel_data) && ($cancel_data->status == 6) && isset($reveals_info) && ($reveals_info->status == 'return_initiated') && (strtotime($todays_dates) <= strtotime($order_update_date_14_days)))
                                        {
                                            $action_status_info='RELAX' ;
                                            $style_para='style="color: #6893ce !important; font-weight:900;"' ;
                                        }
                                        else if(isset($stylist_call_complete) && isset($reveals_info) && ($reveals_info-> status == 'draft') && (strtotime($todays_dates) >= strtotime($appointment_create_date_add_12_days)) && (strtotime($todays_dates) <= strtotime($appointment_create_date_add_14_days)))
                                        {
                                            $action_status_info='URGENT REVEAL';
                                            $style_para='style="color: red !important; font-weight:900;"';
                                        }
                                        else if(isset($stylist_call_complete) && !isset($reveals_info) && (strtotime($todays_dates)>= strtotime($appointment_create_date_add_12_days)) && (strtotime($todays_dates) <= strtotime($appointment_create_date_add_14_days)))
                                        {
                                            $action_status_info='URGENT REVEAL';
                                            $style_para='style="color: red !important; font-weight:900;"';
                                        }
                                        else if(isset($stylist_call_complete) && isset($reveals_info) && ($reveals_info->status == 'draft') && (strtotime($todays_dates) < strtotime($appointment_create_date_add_12_days)))
                                        {
                                            $action_status_info='CREATE REVEAL';
                                            $style_para='style="color: Green !important; font-weight:900;"';
                                        }
                                        else if(isset($stylist_call_complete) && ($info->status == 'not_started') && !isset($reveals_info) && (strtotime($todays_dates) < strtotime($appointment_create_date_add_12_days)))
                                        {
                                            $action_status_info='CREATE REVEAL' ;
                                            $style_para='style="color: Green !important; font-weight:900;"';
                                        }
                                        elseif(!isset($stylist_call_complete) && ($info->status == 'not_started') && !isset($reveals_info))
                                        {
                                            $action_status_info = 'CALL UPCOMING';
                                            $style_para = 'style="color: Green !important; font-weight:900;"';
                                        }
                                        else
                                        {
                                            $action_status_info ='';
                                            $style_para = '';
                                        }
                                        $action_status.='<p '.$style_para.'>'.$action_status_info.'</p>';
                                        // ------------------------------------------------------------------------------
                                        // task Due Date
                                        $task_due_date_info = '';
                                        $task_due_date_new = '';
                                        $daysleft_info = '';
                                        $daysleft_new  ='';
                                        $call_complete_date = '';
                                        $call_complete_td_14days = '';
                                        $call_complete_days_difference  ='';
                                        $reveal_list_td ='';
                                        $revel_date_id = '';
                                        $revela_date_14_days_obj ='';
                                        // Call Not Complete Task Due Date
                                        $today_date_td = date('d/m'); // Assuming '10/09' or your desired date format
                                        $appointment_date = $info->appointment_date; // Assuming $info->created_at is a valid date
                                        $appointment_date_td = date('d/m', strtotime($appointment_date));
                                        $appointment_date_td_14days = date('d/m', strtotime($appointment_date . ' +14 days'));
                                        $today_date_obj = DateTime::createFromFormat('d/m', $today_date_td);
                                        $appointment_date_obj = DateTime::createFromFormat('d/m', $appointment_date_td);
                                        $interval = $today_date_obj->diff($appointment_date_obj);
                                        $days_difference = $interval->days;

                                        // call complete
                                        $call_complete_created_at = $info->created_at; // Assuming $info->created_at is a valid date
                                        $call_complete_date_td = date('d/m', strtotime($call_complete_created_at));
                                        $call_complete_td_14days = date('d/m', strtotime($call_complete_created_at . ' +14 days'));
                                        $call_completetoday_date_obj = DateTime::createFromFormat('d/m', $today_date_td);
                                        $call_complete_date_obj = DateTime::createFromFormat('d/m', $call_complete_td_14days);
                                        $call_complete_interval = $call_completetoday_date_obj->diff($call_complete_date_obj);
                                        $call_complete_days_difference = $call_complete_interval->days;

                                        if(!isset($stylist_call_complete) && ($info->status == 'not_started') && !isset($reveals_info))
                                        {
                                            $task_due_date_new  = $appointment_date_td ;
                                            $daysleft_new  = $days_difference. ' Days';
                                        }
                                        else if(isset($stylist_call_complete) && ($info->status == 'not_started') && !isset($reveals_info))
                                        {

                                            $task_due_date_new  = $call_complete_td_14days ;
                                            $daysleft_new  = $call_complete_days_difference . ' Days ';
                                        }
                                        else if(isset($stylist_call_complete) && ($info->status == 'not_started') && isset($reveals_info) && ($reveals_info->status== 'draft'))
                                        {
                                            $task_due_date_new  = $call_complete_td_14days;
                                            $daysleft_new  = $call_complete_days_difference . ' Days';
                                        }

                                        else if(isset($stylist_call_complete))
                                        {
                                            $reveal_list_td = $info->reveal()->first();
                                            if(isset($reveal_list_td) && ($reveal_list_td->status != 'draft'))
                                            {
                                                $revel_date_id = $reveal_list_td->created_at;
                                                $revela_date = date('d/m', strtotime($revel_date_id));
                                                $revela_date_td_14days = date('d/m', strtotime($revel_date_id . ' +90 days'));
                                                $revela_today_date_obj = DateTime::createFromFormat('d/m', $today_date_td);
                                                $revela_date_obj = DateTime::createFromFormat('d/m', $revela_date);
                                                $revela_date_14_days_obj = DateTime::createFromFormat('d/m', $revela_date_td_14days);
                                                $interval = $revela_today_date_obj->diff($revela_date_14_days_obj);
                                                $revela_days_difference = $interval->days;
                                                $task_due_date_new  = $revela_date_td_14days ;
                                                $daysleft_new  = $revela_days_difference . ' Days';
                                            }
                                        }
                                        $task_due_date_info.='<p class="text-center">'.$task_due_date_new.'</p>';
                                        $daysleft_info.='<p class="text-center">'.$daysleft_new.'</p>';
                                        // task Due Date
                                    @endphp
                                    <tr class="stf_outer_body_table_style">
                                        <td><div class="stf_outer_body_img"> <img src="{{ $profile_img_url }}" alt="" style="border-radius:500%"></div></td>
                                        <td class="c-text-left"> {{ $name }} </td>
                                        <td class="c-text-left"> {{ $company_name }} </td>
                                        <td class="c-text-left">
                                            {{-- @if( ($reveal_status == 'not_started') && ($reveal_action_status_text == 'Create reveal'))
                                                {{ $task_due_date }}
                                            @elseif(($reveal_status == 'not_started') )
                                                {{ $task_due_date }}
                                            @elseif((($reveal_status == 'not_started') && ($reveal_action_status_text == 'Create reveal') && ($reveal_status_button_text == 'draft')))
                                            {{ $task_due_date }}
                                            @else
                                                {{ ' ' }}
                                            @endif --}}
                                            {!!$task_due_date_info!!}
                                        </td>
                                        {!! $reveal_status_button !!}
                                        <td class="c-text-left">
                                            {{-- @if( ($reveal_status == 'not_started') || ($reveal_action_status_text == 'Create reveal') || $crrunt_date == $after_days1 || ($reveal_status_button_text == 'draft'))
                                                {{ $days_left . ' Days' }}
                                            @else
                                                {{ '0 Days' }}
                                            @endif --}}
                                            {!!$daysleft_info!!}
                                        </td>
                                        <td class="c-text-left">
                                            {!!$action_status!!}
                                        </td>
                                        <td>
                                            @php echo
                                                $reveal_action_btn;
                                            @endphp
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                            @endif
                        </tbody>
                    </table>
                    {{ $list->links() }}
                </div> <!-- /.box-body -->
            </div> <!-- /.box -->
        </div>
    </div>
@endsection
@section('page-style')
<style>
    #DataTables_Table_0 .c-text-left {
        text-align: left !important
    }

    #DataTables_Table_0 .c-text-center {
        text-align: center !important
    }
</style>
@section('page-script')
@include('admin.stylist_form.common')
<script>
    jQuery(document).ready(function() {

        });

        function stf_select_stylist_form(obj) {
            console.log(jQuery(obj).val());
        }
</script>
@endsection
