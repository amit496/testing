<style>
    table.dataTable thead .sorting_asc:after,table.dataTable thead .sorting_desc:after{top:24px!important;font-size:15px!important}.dt-buttons{position:relative;float:left;display:none!important}.c-text-center{text-align: center !important;}
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
                    <table class="table table-hover table-no-sort text-center table-responsive text-center" id="stf_request_list">
                        <thead>
                            <tr class="stf_outer_body_table_style articles ">
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
                                        // $todays_dates = '11-10-2023';
                                        $customer_name = '';
                                        $company_name = '';
                                        $company_obj ='';
                                        $reveal_status_button_text ='';
                                        $reveal_status_button_class = '';
                                        $reveal_status_button ='';
                                        $task_due_date_new = '';
                                        $daysleft_new = '';
                                        $task_due_date_info ='';
                                        $daysleft_info ='';
                                        $action_status_info = '';
                                        $style_para = '';
                                        $action_status = '';
                                        $reveal_send_data = '';
                                        $reveal_create_date_3month = '';
                                        $reveal_create_76_days = '';
                                        $reveal_create_45_days = '';
                                        $reveal_create_14_days = '';
                                        $action_complete_created_at = '';
                                        $action_complete_date_td = '';
                                        $action_complete_td_14days = '';
                                        $action_completetoday_date_obj = '';
                                        $action_complete_date_obj = '';
                                        $action_complete_interval = '';
                                        $action_complete_days_difference = '';
                                        $order_deliver_date = '';
                                        $order_deliver_date_14_days ='';
                                        $revela_date_90days ='';
                                        $revela_date_90days_new ='';
                                        $booking_staus = $info->status;
                                        $reveal_booking_status = ['awaiting_response', 'preparing_order', 'dispatched', 'return_initiated', 'awaiting_delivery', 'refunded', 'delivered'];
                                        $profile_img_url = url('images/stylist/dummy-profile-pic.png');
                                        $stylist_call_complete = $info->statusHistory()->where('status', '=', 'call_complete')->first();
                                        if($stylist_call_complete)
                                        {
                                            $action_complete_created_at = $info->created_at;
                                            $action_complete_date_td = date('d-m-Y', strtotime($action_complete_created_at));
                                            $action_complete_td_14days = date('d-m-Y', strtotime($action_complete_created_at . ' +14 days'));
                                            $action_complete_td_12days = date('d-m-Y', strtotime($action_complete_created_at . ' +12 days'));
                                            $action_completetoday_date_obj = DateTime::createFromFormat('d-m-Y', $todays_dates);
                                            $action_complete_date_obj = DateTime::createFromFormat('d-m-Y', $action_complete_td_14days);
                                            $action_complete_interval = $action_completetoday_date_obj->diff($action_complete_date_obj);
                                            $action_complete_days_difference = $action_complete_interval->days;
                                            $order_deliver_date = $stylist_call_complete->order_delivery_date;
                                            $order_deliver_date_14_days = date('d-m-Y', strtotime($order_deliver_date));
                                        }
                                        $filter_statusdata = $info->filterstatus()->latest()->first();
                                        $reveal_has_draft = $info->reveal()->where('status','=','draft')->latest()->take(2)->first();

                                        // Compnay Details
                                        $stylistUser = $info->stylistUser()->first();
                                        if (isset($stylistUser))
                                        {
                                            $company_obj = $info->stylistUser->company()->first();
                                            if (isset($company_obj))
                                            {
                                                $company_name = $company_obj->company_name;
                                            }
                                        }
                                        // Cunstomer Info
                                        $customer_obj = $info->customer()->first();
                                        if (isset($customer_obj))
                                        {
                                            $customer_name = $customer_obj->name . ' ' . $customer_obj->last_name;
                                            $customer_image_obj = $info->customerImage()->first();
                                            if (isset($customer_image_obj))
                                            {
                                                $profile_img_url = url('image/' . $customer_image_obj->path);
                                            }
                                        }
                                        $reveal_action_btn = '<a href="' . url('admin/stylist/customer_request/' . $info->id) . '" title="Manage" class="custom-manage-reveal-btn">Manage <a>';

                                        // Task Due Date
                                        // Call Not Complete Task Due Date
                                        $today_date_td = date('d/m');
                                        $appointment_date = $info->appointment_date;
                                        $appointment_date_td = date('d/m', strtotime($appointment_date));
                                        $appointment_date_td_14days = date('d/m', strtotime($appointment_date . ' +14 days'));
                                        $today_date_obj = DateTime::createFromFormat('d/m', $today_date_td);
                                        $appointment_date_obj = DateTime::createFromFormat('d/m', $appointment_date_td);
                                        $interval = $today_date_obj->diff($appointment_date_obj);
                                        $days_difference = $interval->days;

                                        // call complete
                                        $call_complete_created_at = $info->created_at;
                                        $call_complete_date_td = date('d/m', strtotime($call_complete_created_at));
                                        $call_complete_td_14days = date('d/m', strtotime($call_complete_created_at . ' +14 days'));
                                        $call_completetoday_date_obj = DateTime::createFromFormat('d/m', $today_date_td);
                                        $call_complete_date_obj = DateTime::createFromFormat('d/m', $call_complete_td_14days);
                                        $call_complete_interval = $call_completetoday_date_obj->diff($call_complete_date_obj);
                                        $call_complete_days_difference = $call_complete_interval->days;

                                        // use in reveal status
                                        $reveal_call_complete_date_td = date('d-m-Y', strtotime($call_complete_created_at));
                                        $reveal_call_complete_td_12days = date('d-m-Y', strtotime($call_complete_created_at . ' +12 days'));
                                        $reveal_call_complete_td_14days = date('d-m-Y', strtotime($call_complete_created_at . ' +14 days'));
                                        if(!isset($stylist_call_complete) && ($booking_staus == 'not_started') && (isset($filter_statusdata)))
                                        {
                                            $task_due_date_new  = $appointment_date_td ;
                                            $daysleft_new  = $days_difference. ' Days';
                                        }
                                        else if(isset($stylist_call_complete) && ($booking_staus == 'not_started') && isset($filter_statusdata) && ($info->id == $filter_statusdata->booking_id ))
                                        {
                                            $task_due_date_new  = $call_complete_td_14days;
                                            $daysleft_new  = $call_complete_days_difference . ' Days';
                                        }
                                        else if(isset($stylist_call_complete) && (in_array($booking_staus,$reveal_booking_status )) && isset($filter_statusdata) && ($info->id == $filter_statusdata->booking_id ) && (!empty($filter_statusdata->reveal_id)) && (($filter_statusdata->reveal_status == 'return_initiated') || ($filter_statusdata->reveal_status == 'refunded')))
                                        {
                                            $current_date =date('d-m-Y');
                                            $reveal_send_data = $filter_statusdata->reveal_send_date;
                                            $reveal_date = date('d/m', strtotime($reveal_send_data));
                                            $revela_date_90days = date('d/m', strtotime($reveal_send_data . ' +90 days'));

                                            $reveal_date_left = date('d-m-Y', strtotime($reveal_send_data));
                                            $revela_date_90days_new  = date('d-m-Y', strtotime($reveal_date_left . ' +90 days'));
                                            $revela_today_date_obj = date('d-m-Y', strtotime($current_date));
                                            $interval = strtotime($revela_date_90days_new ) - strtotime($revela_today_date_obj);
                                            $revela_days_difference = round($interval / (60*60*24));
                                            $task_due_date_new  = $revela_date_90days;
                                            $daysleft_new  = $revela_days_difference . ' Days';
                                        }
                                        $task_due_date_info.='<p class="text-center">'.$task_due_date_new.'</p>';
                                        $daysleft_info.='<p class="text-center">'.$daysleft_new.'</p>';
                                        // end Task Due Date


                                        // reveal status

                                        if(isset($filter_statusdata))
                                        {
                                            $reveal_send_data = $filter_statusdata->reveal_send_date;
                                            $reveal_date = date('d-m-Y', strtotime($reveal_send_data));
                                            $reveal_create_date_3month = date('d-m-Y', strtotime($reveal_date . "+ 90 days"));
                                            $reveal_create_76_days = date("d-m-Y",strtotime($reveal_create_date_3month." -76 days"));
                                            $reveal_create_45_days = date("d-m-Y",strtotime($reveal_create_date_3month." -45 days"));
                                            $reveal_create_14_days = date("d-m-Y",strtotime($reveal_create_date_3month." -14 days"));
                                        }

                                        if((strtotime($todays_dates) <= strtotime($reveal_create_date_3month)) && (strtotime($todays_dates) >= strtotime($reveal_create_date_3month)))
                                        {
                                            $reveal_status_button_text='NOT STARTED' ;
                                            $reveal_status_button_class='text-warning-style-two_4' ;
                                        }
                                        else if( ((in_array($booking_staus,$reveal_booking_status))) && isset($filter_statusdata) && (!empty($filter_statusdata->reveal_id)) && ( ($filter_statusdata->reveal_status == 'refunded') || $filter_statusdata->reveal_status == 'return_initiated') && ($filter_statusdata->cancellation_status == 6))
                                        {
                                            $reveal_status_button_text='NOT STARTED' ;
                                            $reveal_status_button_class='text-warning-style-two_4' ;
                                        }
                                        else if( ((in_array($booking_staus,$reveal_booking_status))) && isset($filter_statusdata) && (!empty($filter_statusdata->reveal_id)) && ($filter_statusdata->reveal_status == 'return_initiated') && (($filter_statusdata->cancellation_status == 1)))
                                        {
                                            $reveal_status_button_text='RETURN INITIATED' ;
                                            $reveal_status_button_class='text-warning-style-two_5' ;
                                        }
                                        else if( ((in_array($booking_staus,$reveal_booking_status))) && isset($filter_statusdata) && (!empty($filter_statusdata->reveal_id)) && ($filter_statusdata->reveal_status == 'delivered'))
                                        {
                                            $reveal_status_button_text = 'DELIVERED';
                                            $reveal_status_button_class = 'text-warning-style-two_2';
                                        }
                                        else if( ((in_array($booking_staus,$reveal_booking_status))) && isset($filter_statusdata) && (!empty($filter_statusdata->reveal_id)) && ($filter_statusdata->reveal_status == 'awaiting_delivery'))
                                        {
                                            $reveal_status_button_text = 'Awaiting Delivery';
                                            $reveal_status_button_class = 'text-warning-style-two_2';
                                        }
                                        else if( ((in_array($booking_staus,$reveal_booking_status))) && isset($filter_statusdata) && (!empty($filter_statusdata->reveal_id)) && ($filter_statusdata->reveal_status == 'dispatched'))
                                        {
                                            $reveal_status_button_text = 'DISPATCHED';
                                            $reveal_status_button_class = 'text-warning-style-two_1';
                                        }
                                        else if( ((in_array($booking_staus,$reveal_booking_status))) && isset($filter_statusdata) && (!empty($filter_statusdata->reveal_id)) && ($filter_statusdata->reveal_status == 'preparing_order'))
                                        {
                                            $reveal_status_button_text = 'PREPARING ORDER';
                                            $reveal_status_button_class = 'text-warning-style-two_1';
                                        }
                                        else if( ((in_array($booking_staus,$reveal_booking_status))) && isset($filter_statusdata) && (!empty($filter_statusdata->reveal_id)) && ($filter_statusdata->reveal_status == 'awaiting_response'))
                                        {
                                            $reveal_status_button_text = 'AWAITING RESPONSE';
                                            $reveal_status_button_class = 'text-warning-style-two_3';
                                        }
                                        else if( ((in_array($booking_staus,$reveal_booking_status))) && isset($filter_statusdata) && (!empty($filter_statusdata->reveal_id)) && ($filter_statusdata->reveal_status == 'awaiting_response'))
                                        {
                                            $reveal_status_button_text = 'AWAITING RESPONSE';
                                            $reveal_status_button_class = 'text-warning-style-two_3';
                                        }
                                        else if(isset($reveal_has_draft)&& ($reveal_has_draft->status == 'draft') && ($booking_staus == 'not_started') && isset($filter_statusdata) && (empty($filter_statusdata->reveal_id)) && (strtotime($todays_dates) >= strtotime($reveal_call_complete_td_12days)) && (strtotime($todays_dates) >= strtotime($reveal_call_complete_td_14days)))
                                        {
                                            $reveal_status_button_text='DRAFT' ;
                                            $reveal_status_button_class='text-warning-style-two' ;
                                        }
                                        else if(isset($reveal_has_draft)&& ($reveal_has_draft->status == 'draft') && ($booking_staus == 'not_started') && isset($filter_statusdata) && (empty($filter_statusdata->reveal_id)) && (strtotime($todays_dates) >= strtotime($reveal_call_complete_td_12days)) && (strtotime($todays_dates) <= strtotime($reveal_call_complete_td_14days)))
                                        {
                                            $reveal_status_button_text='DRAFT' ;
                                            $reveal_status_button_class='text-warning-style-two' ;
                                            // $reveal_action_status_text='Call Upcoming' ;
                                        }
                                        else if(isset($reveal_has_draft)&& ($reveal_has_draft->status == 'draft') && ($booking_staus == 'not_started') && isset($filter_statusdata) && (empty($filter_statusdata->reveal_id)) &&(strtotime($todays_dates) < strtotime($reveal_call_complete_td_12days)))
                                        {
                                            $reveal_status_button_text='DRAFT' ;
                                            $reveal_status_button_class='text-warning-style-two' ;
                                            // $reveal_action_status_text='Call Upcoming' ;
                                        }
                                        else if(isset($stylist_call_complete) && ($booking_staus=='not_started') )
                                        {
                                            $reveal_status_button_text='Not Started' ;
                                            $reveal_status_button_class='text-warning-style-two_4' ;
                                        }
                                        else if(!isset($stylist_call_complete) && ($booking_staus=='not_started') )
                                        {
                                            $reveal_status_button_text='Call Upcoming' ;
                                            $reveal_status_button_class='text-warning-style-two' ; //
                                            // $reveal_action_status_text='Call Upcoming' ;
                                        }
                                        $reveal_status_button .='<span class="badge badge-pill badge-warning  text-warning-style ' . $booking_staus . '_status_btn  ' . $reveal_status_button_class . '">' . $reveal_status_button_text . '</span>' ;
                                        //end revela status


                                        // Ation Status
                                        // $action_complete_td_14days
                                        // $action_complete_td_12days
                                        // $todays_dates
                                        // $reveal_has_draft
                                        // $filter_statusdata
                                        // $order_deliver_date
                                        // $order_deliver_date_14_days
                                        if (isset($filter_statusdata) && empty($filter_statusdata->cancel_id) &&  (strtotime($todays_dates > strtotime($order_deliver_date_14_days))))
                                        {
                                            $action_status_info='RELAX' ;
                                            $style_para='style="color: #6893ce !important; font-weight:900;"' ;
                                        }
                                        else if(isset($filter_statusdata) && !empty($filter_statusdata->cancel_id) &&  ($filter_statusdata->cancellation_status == 6))
                                        {
                                            $action_status_info='RELAX' ;
                                            $style_para='style="color: #6893ce !important; font-weight:900;"' ;
                                        }

                                        if(isset($stylist_call_complete) && ($booking_staus == 'not_started') && (strtotime($todays_dates) >= strtotime($action_complete_td_12days)) && ((strtotime($todays_dates) <= strtotime($action_complete_td_14days)) || strtotime($todays_dates) >= strtotime($action_complete_td_14days)) && isset($reveal_has_draft) && ($reveal_has_draft->status == 'draft'))
                                        {
                                            $action_status_info='URGENT REVEAL';
                                            $style_para='style="color: red !important; font-weight:900;"';
                                        }
                                        else if(isset($stylist_call_complete) && ($booking_staus == 'not_started')  && (strtotime($todays_dates) <= strtotime($action_complete_td_12days)) && (strtotime($todays_dates) <= strtotime($action_complete_td_14days)) && isset($reveal_has_draft) && ($reveal_has_draft->status == 'draft'))
                                        {
                                            $action_status_info='CREATE REVEAL';
                                            $style_para='style="color: Green !important; font-weight:900;"';
                                        }
                                        else if(isset($stylist_call_complete) && ($booking_staus == 'not_started') && (strtotime($todays_dates) >= strtotime($action_complete_td_12days)) && ((strtotime($todays_dates) <= strtotime($action_complete_td_14days)) || strtotime($todays_dates) >= strtotime($action_complete_td_14days)))
                                        {
                                            $action_status_info='URGENT REVEAL';
                                            $style_para='style="color: red !important; font-weight:900;"';
                                        }
                                        else if(isset($stylist_call_complete) && ($booking_staus == 'not_started')  && (strtotime($todays_dates) <= strtotime($action_complete_td_12days)) && (strtotime($todays_dates) <= strtotime($action_complete_td_14days)))
                                        {
                                            $action_status_info='CREATE REVEAL' ;
                                            $style_para='style="color: Green !important; font-weight:900;"';
                                        }
                                        if(!isset($stylist_call_complete) && ($booking_staus == 'not_started'))
                                        {
                                            $action_status_info = 'CALL UPCOMING';
                                            $style_para = 'style="color: Green !important; font-weight:900;"';
                                        }
                                        $action_status.='<p '.$style_para.'>'.$action_status_info.'</p>';
                                        // end Ation Status



                                    @endphp
                                    <tr class="stf_outer_body_table_style">
                                        <td class="stf_outer_body_img"><div class="stf_outer_body_img"> <img src="{{ $profile_img_url }}" alt="" style="border-radius:500%"></div></td>
                                        <td class="c-text-left">{{$customer_name}}</td>
                                        <td class="c-text-left">{{$company_name}}</td>
                                        <td class="c-text-left">{!!$task_due_date_info!!}</td>
                                        <td class="c-text-left">{!!$reveal_status_button!!}</td>
                                        <td class="c-text-left">{!!$daysleft_info!!}</td>
                                        <td class="c-text-left">{!!$action_status!!}</td>
                                        <td class="c-text-left">{!!$reveal_action_btn!!}</td>
                                    </tr>
                                @endforeach
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
