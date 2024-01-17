@extends('admin.layouts.master')
@section('content')
@php
    $loader_html = stylistGetLoader();
    $all_steps = ['gtky' => 'Getting to Know you', 'call' => '15 min call', 'reveals' => 'Reveals', 'feedback' => 'Feedback', 'return_period' => 'Return Period', 'complete' => 'Complete'];
    $completed_steps = ['gtky', 'call', 'revels', 'feedback', 'return_period', 'complete'];
    $completed_steps = ['gtky', 'call', 'revels'];
    $add_plus_img = url('images/stylist/add-plus.jpg?2');
    $revels_html_item = '';
    $revel_name = '';
    if (isset($data['revels_html_item_html']))
    {
        $revels_html_item = $data['revels_html_item_html'];
    }
    $due_date = 0;
    if (isset($data['appointments_details']['appointment_date']))
    {
        $appointment_date = $data['appointments_details']['appointment_date'];
        $due_date = 0;
        $now_time = time();
        $appointment_date = strtotime($appointment_date);
        if ($appointment_date >= $now_time)
        {
            $due_date = $appointment_date - $now_time;
            $due_date = round($due_date / (60 * 60 * 24));
        }
    }
    $dummy_price_random = get_formated_price($budget_price, config('system_settings.decimals', 2));
    $total_budget_price = $dummy_price_random;
    $user_name = '';
    $user_email = '';
    $user_dob = '';
    $newDate = '';
    if (isset($data['appointments_details']['customer']))
    {
        $user_name = $data['appointments_details']['customer']['name'];
    }
    if (isset($data['appointments_details']['customer']))
    {
        $user_email = $data['appointments_details']['customer']['email'];
    }
    if (isset($data['appointments_details']['customer']))
    {
        $user_dob = $data['appointments_details']['customer']['dob'];
        $originalDate = $user_dob;
        $newDate = date('d-m-Y', strtotime($originalDate));
    }
    $merchant_id = $data['appointments_details']['merchant_id'];
    $booking_id = $data['appointments_details']['id'];
    $user_desc = '';
    $profile_img_url = $data['profile_img_url'];
    $heading_text = '';
    if (isset($data['user_info']))
    {
        $user_desc = $data['user_info']['description'];
        $user_name = $data['user_info']['name'];
        $created_at = $data['user_info']['created_at'];
        $created_at_timestamp = strtotime($created_at);
        $created_at_new_formate = date('M-Y', $created_at_timestamp);
        $heading_text = ucwords($user_name) . ' has been a member since ' . $created_at_new_formate . ' - They have ' . $due_date . " days remaining for their reveal";
        $heading_text = "<div class='line-container'><div class='px-4 mt-5'><div class='row'><div class='col-md-12 line-heading overview_heading'><h4>" . $heading_text . "</h4></div></div></div></div>";
    }
    echo $loader_html;
@endphp

<div class="container-fluid stf_outer_body stylist_reveals_section stf_outer_page_load" style="display:none">
    <input type="hidden" name="request_id" value="{{ $data['request_id'] }}">
    <input type="hidden" name="add_product_to_alernative_or_item" value="">
    <div class="row">
        <div class="col-lg-9">
            @php
                echo $heading_text;
            @endphp
            <div class='line-container' style="display:none">
                <div class="col-md-12 line-heading overview_heading">
                    <h4>Overview</h4>
                </div>
                <div class='progress-line'>
                    <div class='progress' style="width: 50%;"></div>
                    @php
                        $setps_html = '';
                        $current_class_status = true;
                        foreach ($all_steps as $step_info_key => $step_info)
                        {
                            $completed_class = ' ';
                            $current_class = 'current';
                            if (in_array($step_info_key, $completed_steps))
                            {
                                $completed_class = ' completed ';
                                $current_class = ' ';
                            }
                            else
                            {
                                if ($current_class_status)
                                {
                                    $current_class_status = false;
                                }
                                else
                                {
                                    $current_class = ' ';
                                }
                            }
                            $setps_html .="<div class='status'><div class='dot " . $completed_class . $current_class ."'></div><p>" . $step_info . "</p></div>";
                        }
                        echo $setps_html;
                    @endphp
                </div>
            </div>
            @if (isset($customer_question_details))
                <div class="border_bottom px-4 mt-5">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="Getting-dapp-dash d-flex m-2">
                                <span>
                                    <b>Getting to know you</b>
                                    <p class="ml-4">Completed on {{ $customer_question_details->created_at }}
                                    </p>
                                </span>
                                <div class="dash-butn text-center mt-2">
                                    <Span class="stf_anchor_btn" onclick="stfViewCustomerQuestions({{ $booking_customer_id }})">VIEW RESPONSE<i class="/*fas fa-angle-right*/"></i></Span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @if ($stylist_user_compnay_id != 0)
                <div class="border_bottom px-4 mt-5">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="Getting-dapp-dash d-flex m-2">
                                <span>
                                    <p class="ml-4"><b>Company Information<b></p>
                                </span>
                                <div class="dash-butn text-center mt-2">
                                    <Span class="stf_anchor_btn" onclick="companydetailsview({{ $stylist_user_compnay_id }})">VIEW COMPANY GUIDE<i class="/*fas fa-angle-right*/"></i></Span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                @php
                    echo '';
                @endphp
            @endif
            @if (isset($stylist_call_complete))
                <a data-link="{{ url('admin/stylist/customer_request_response/load_history/' . $booking_id) }} " class="ajax-modal-btn dash-butn text-center mt-2 stf_anchor_btn" style="cursor: pointer;margin-top:10px">Mail History</a>
                <div class="px-4 mt-5 revels_html_section">
                    <div class="line-heading-tow mb-3">
                        <div class="line-heading mb-3">
                            <h4>Reveal</h4>
                            <p class="ml-4">Create new reveals and alter draft reveals</p>
                        </div>
                        <span class="stf_hide_section "><a class="stf_add_tag_btn_item" href="javascript:void(0)" onclick="stfGetRevealItemsHtmlAjax(0)"><span><i class="fa fa-plus"></i>Add A Reveal</span></a><span>
                    </div>
                    <div class="row justify-content-md-center">
                        <div class="col-md-11 align-self-center">
                            <div class="owl-dappr-slider ">
                                <div class="owl-carousel  product-slider owl-theme stf_owl_carousel_slider_reveals"> {!! $revels_html_item !!} </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <?php
                    $stylist_call_complete_html ='<a href="' . url('admin/stylist/booking_call_complete/' . $booking_id) . '" title="Mark as Call Complete " class="custom-manage-reveal-btn">CALL COMPLETED</i><a>';
                ?>
                <div class="px-4 mt-5 revels_html_section">
                    <div class="line-heading-tow mb-3">
                        <div class="line-heading mb-3">
                            <h4>Call Not Completed</h4>
                            <p class="ml-4">Your call with client has not yet been completed, therefore you cannot complete a reveal. If you have completed the call please select 'Call Completed' to be able to create a reveal.</p>
                        </div>
                    </div>
                    <div class="row justify-content-md-center">
                        <div class="col-md-11 align-self-center">
                            <div class="" style="text-align: center; margin: 39px 0 0;">{!! $stylist_call_complete_html !!}</div>
                        </div>
                    </div>
                </div>
            @endif
            @if ($new_booking_status == 'not_started')
                {{ ' ' }}
            @else
                <div class=" px-4 mt-5">
                    <div class="line-heading mb-3"><h4>Purchase History</h4></div>
                    <div class="owl-dappr-slider">
                        <ul class="nav nav-pills" role="tablist">
                            <li class="nav-item active"><a class="nav-link " data-toggle="pill" href="#bought_section">Bought</a></li>
                            <li class="nav-item"><a class="nav-link" data-toggle="pill" href="#declined_section">Declined</a></li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content style-tab-content">
                            <div id="bought_section" class="row tab-pane active">
                                @php
                                    $buy_html = '';
                                    $attributes_name = '';
                                    $attributes_obj_info = '';
                                    $get_id_attribute ='';
                                    $attributeValues_data = '';
                                    $get_prduct_size = '';
                                    if (is_array($buy_products) && count($buy_products))
                                    {
                                        foreach ($buy_products as $buy_product_info)
                                        {
                                            $buy_product_img_src = '';
                                            $buy_product_obj = $buy_product_info['product_obj'];
                                            $buy_inventory_obj = $buy_product_info['inventory_obj'];
                                            $price = 0;
                                            // ------------------------------
                                            $attributes_obj = $buy_product_info['attributes'];
                                            if(isset($attributes_obj))
                                            {
                                                foreach($attributes_obj as $attributes_obj_info)
                                                {
                                                    if($attributes_obj_info->name == 'Size')
                                                    {
                                                        $get_id_attribute = $attributes_obj_info->attribute_type_id;
                                                        $attributeValues_data = $attributes_obj_info['attributeValues'];
                                                        if(isset($attributeValues_data));
                                                        {
                                                            foreach($attributeValues_data as $attributeValues_info)
                                                            {
                                                                $get_prduct_size = $attributeValues_info->value;
                                                            }
                                                        }
                                                    }
                                                }
                                            }
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

                                            if (isset($item_cancel_item_hide->items) && in_array($buy_inventory_obj->id,  $item_cancel_item_hide->items))
                                            {

                                                $exchnage_return_option = $item_cancel_item_hide->exchnage_return_option;
                                                $exchnage_return_option_decde = json_decode($exchnage_return_option, true);
                                                $approved_refund = explode(',', $item_cancel_item_hide->approve_items);
                                                $declient_refund = explode(',', $item_cancel_item_hide->decline_item);

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
                                                $description_new = $item_cancel_item_hide?$item_cancel_item_hide->description_new:'';
                                                $description_new_decode = json_decode($description_new, true);
                                                foreach ($description_new_decode as $key => $value)
                                                {
                                                    if ($buy_inventory_obj->id == $key)
                                                    {
                                                        $descriptionnew = $value;
                                                    }
                                                }
                                                $exchange_more_option_info = $item_cancel_item_hide->exchange_more_option;
                                                $exchange_more_option_info_decode = json_decode($exchange_more_option_info, true);
                                                foreach ($exchange_more_option_info_decode as $key => $value)
                                                {
                                                    if ($buy_inventory_obj->id == $key)
                                                    {
                                                         $exchange_moreoptioninfo = $value?ucwords(str_replace('_', ' ', $value)):'';
                                                    }
                                                }
                                            }
                                            // $buy_html = '';
                                            $buy_html .= '<div class="col-md-2 img-product-1 " style="' . $cancel_item_hide . 'width:218px !important;"><div class="card card-costom" style="padding:0px 16px 16px 0px;" ><div class="rounded"><img src="' . $buy_product_img_src . '" alt="" style="max-width: 100%;"></div><div class="articles-two"><h3>'.$buy_product_obj->brand .'</h3><h3>' .$buy_product_obj->name.'</h3><h3>'. $get_prduct_size .'</h3><h3>' .$price .'</h3><h3>' .$descriptionnew .'</h3><h3>' .$exchange_moreoptioninfo.'</h3></div></div></div>';
                                        }
                                    }
                                    echo $buy_html;
                                    echo $buy_products_links;
                                @endphp
                            </div>
                            <div id="declined_section" class="row tab-pane fade">
                                @php
                                    $buy_html = '';
                                    $attributes_name = '';
                                    $attributes_obj_info = '';
                                    $get_id_attribute ='';
                                    $attributeValues_data = '';
                                    $get_prduct_size = '';
                                    if (is_array($buy_products) && count($buy_products))
                                    {
                                        foreach ($buy_products as $buy_product_info)
                                        {
                                            $buy_product_img_src = '';
                                            $buy_product_obj = $buy_product_info['product_obj'];
                                            $buy_inventory_obj = $buy_product_info['inventory_obj'];
                                            // --------------------------
                                            $attributes_obj = $buy_product_info['attributes'];
                                            if(isset($attributes_obj))
                                            {
                                                foreach($attributes_obj as $attributes_obj_info)
                                                {
                                                    if($attributes_obj_info->name == 'Size')
                                                    {
                                                        $get_id_attribute = $attributes_obj_info->attribute_type_id;
                                                        $attributeValues_data = $attributes_obj_info['attributeValues'];
                                                        if(isset($attributeValues_data));
                                                        {
                                                            foreach($attributeValues_data as $attributeValues_info)
                                                            {
                                                                $get_prduct_size = $attributeValues_info->value;
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                            // --------------------------
                                            $price = 0;
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
                                            $force_hie = '';
                                            $decline_refund ='';
                                            $descrpint_new_info = '';
                                            $descrpint_new_info_decode = '';
                                            $description ='';
                                            $return_more_option_info = '';
                                            $return_more_option_info_decode = '';
                                            $return_moreoption = '';
                                            $return_more_sub_option_info ='';
                                            $return_more_sub_option_info_decode = '';
                                            $return_more_suboption = '';
                                            $hide_reason = '';
                                            $exchange_more_option_info;
                                            $exchange_more_option_info_decode;
                                            $exchange_value = '';
                                            $return_boolean = false;
                                            $exchnage_declined_test= '';
                                            if (isset($item_cancel_item_hide->items) && in_array($buy_inventory_obj->id, $item_cancel_item_hide->items))
                                            {
                                                $exchnage_return_option = $item_cancel_item_hide->exchnage_return_option;
                                                $exchnage_return_option_decde = json_decode($exchnage_return_option, true);
                                                $approved_refund = explode(',', $item_cancel_item_hide->approve_items);
                                                $declient_refund = explode(',', $item_cancel_item_hide->decline_item);

                                                if(array_key_exists($buy_inventory_obj->id, $exchnage_return_option_decde) && ($exchnage_return_option_decde[$buy_inventory_obj->id] == 'exchange') && in_array($buy_inventory_obj->id,$approved_refund ) )
                                                {
                                                    $cancel_item_hide = 'display:none;';
                                                }
                                                else if(array_key_exists($buy_inventory_obj->id, $exchnage_return_option_decde) && ($exchnage_return_option_decde[$buy_inventory_obj->id] == 'exchange') && in_array($buy_inventory_obj->id,$declient_refund ) )
                                                {
                                                    $cancel_item_hide = 'display:block;';
                                                    $exchnage_declined_test = 'Unfulfilled Exchange';
                                                }
                                                else if(array_key_exists($buy_inventory_obj->id, $exchnage_return_option_decde) && ($exchnage_return_option_decde[$buy_inventory_obj->id] == 'refund') && in_array($buy_inventory_obj->id,$approved_refund ))
                                                {
                                                    $cancel_item_hide = 'display:block;';
                                                }
                                                else if(array_key_exists($buy_inventory_obj->id, $exchnage_return_option_decde) && ($exchnage_return_option_decde[$buy_inventory_obj->id] == 'refund') && in_array($buy_inventory_obj->id,$declient_refund ) )
                                                {
                                                    $cancel_item_hide = 'display:none;';
                                                }
                                                else
                                                {
                                                    $cancel_item_hide = 'display:none;';
                                                }
                                            }
                                            else {
                                                $cancel_item_hide = 'display:none;';

                                            }
                                            $descrpint_new_info = $item_cancel_item_hide?$item_cancel_item_hide->description_new:'';
                                            $descrpint_new_info_decode = json_decode($descrpint_new_info, true);
                                            if(is_array($descrpint_new_info_decode))
                                            {
                                                foreach ($descrpint_new_info_decode as $key => $value)
                                                {
                                                    if($buy_inventory_obj->id == $key)
                                                    {
                                                        $description = $value;
                                                    }
                                                }
                                            }
                                            $return_more_option_info = $item_cancel_item_hide->return_more_option??'';
                                            $return_more_option_info_decode = json_decode($return_more_option_info, true);
                                            if(is_array($return_more_option_info_decode))
                                            {
                                                foreach ($return_more_option_info_decode as $key => $value)
                                                {
                                                    if($buy_inventory_obj->id == $key)
                                                    {
                                                        $return_more_suboption = ucwords(str_replace('_', ' ', $value));
                                                    }
                                                    // if($buy_inventory_obj->id == $key && $value == 'i_do_not_like_it')
                                                    if(($buy_inventory_obj->id == $key) && ($value == 'i_do_not_like_it'))
                                                    {
                                                        $return_more_sub_option_info = $item_cancel_item_hide->return_more_sub_option;
                                                        $return_more_sub_option_info_decode = json_decode($return_more_sub_option_info, true);
                                                        foreach ($return_more_sub_option_info_decode as $key => $value)
                                                        {
                                                            if($buy_inventory_obj->id == $key)
                                                            {
                                                                $return_more_suboption = $value;
                                                            }
                                                        }
                                                    }
                                                }
                                            }

                                            $exchange_more_option_info = $item_cancel_item_hide->exchange_more_option??'';
                                            $exchange_more_option_info_decode = json_decode($exchange_more_option_info, true);
                                            if(is_array($exchange_more_option_info_decode))
                                            {
                                                foreach ($exchange_more_option_info_decode as $key => $value)
                                                {
                                                    if($buy_inventory_obj->id == $key)
                                                    {
                                                        $exchange_value = $value?ucwords(str_replace('_', ' ', $value)):'';
                                                    }
                                                }
                                            }

                                            $buy_html .= '<div class="col-md-2 img-product-1" style ="' . $cancel_item_hide . 'width:202px !important;"><div class="rounded "><img src="' . $buy_product_img_src . '" alt="" style="max-width: 100%;"></div><div class="articles-two"><h3>' . $buy_product_obj->name . '</h3><h3>' . $product_brand_name . '</h3><h3>' . $price . '</h3><h3>' . $get_prduct_size . '</h3><h3>' . $description . '</h3><h3>' . $exchange_value . '</h3><h3 style='.$hide_reason.'>' . $return_more_suboption . '</h3><h3>' . $exchnage_declined_test . '</h3></div><div></div></div>';
                                        }
                                        // $decline_html .= '<div class="paginate_num">'.$buy_product_info->links().'</div>';
                                    }
                                @endphp
                                {!! $buy_html !!}
                                {!! $decline_html !!}
                            </div>
                            {{-- <div id="feedback_section" class="row tab-pane fade">
                                {!! $feebback_html !!}
                            </div> --}}
                        </div>
                    </div>
                </div>
            @endif
        </div>
        <div class="col-lg-3 pr-0 ">
            <div class="dappr-box  align-items-center">
                <div class="card align-card-dappr-box">
                    <div class="card-dappr">
                        <div class="row">
                            <div class=" col-md-6 dappr-img-dash"><img src="{{ url($profile_img_url) }}" alt=""></div>
                            <div class="col-md-12  person-info mb-2 articles">
                                <h3>{{ $user_name }} </h3>
                                <h3 style="line-height: 20px;">{{ $employe_onboarding_company_name }}</h3>
                                <h3>{{ $newDate }}</h3>
                                <h3 style="line-height: 20px;">{{ $user_email }}</h3>
                                <br>
                                @if (!empty($booking_customer_id) && !empty($customer_details) && $booking_customer_id == $customer_details->id)
                                    @if ($customer_details->starrating > 0)
                                        @for ($i = 1; $i < 6; $i++)
                                            <span class="rating_starcount" starnum="{{ $i }}" cust_id="{{ $customer_details->id }}"><i class="far fa-star  @if ($i <= $customer_details->starrating) {{ 'fa-solid' }} @endif "></i></span>
                                        @endfor
                                    @elseif($customer_details->starrating == 0)
                                        @for ($i = 1; $i < 6; $i++)
                                            <span class="rating_starcount" starnum="{{ $i }}" cust_id="{{ $customer_details->id }}"><i class="far fa-star"></i></span>
                                        @endfor
                                    @endif
                                @endif
                            </div>
                            <p></p>
                        </div>
                        <div class="button-drapp">
                            <!-- <Span>{{ 'Budget: ' . $total_budget_price }}</Span> -->
                            <Span>{{ 'Budget: ' . '$ ' . number_format(round($budget_price)) }}</Span>
                        </div>
                        <p></p>
                        <div class="mt-2"><p>{{ $user_desc }}</p></div>
                        <div class="stf_close_btn user_tag_list_ul">{!! $user_tag_list_html !!}</div>
                        <div class="stf_add_tag_btn">
                            <a><i class="fa fa-plus" onclick="stfAddTagToUser({{ $booking_customer_id }},'this')"></i><input type="text" placeholder="Add a tag" name="add_tag_to_user"></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="align-card-dappr-box-s card">
                <div class="card-dappr">
                    <div class="line-heading-box-s articles"><h3>Additional Notes</h3><h3>{{ $user_name }}</h3></div>
                    <div class="text-justify mt-2">
                        @foreach ($note as $key => $note_value)
                            <h5>{{ $note_value->notes }}</h5>
                        @endforeach
                    </div>
                    <div class="stf_add_tag_btn">
                        <a><i class="fa fa-plus" onclick="stfAddNoteToUser({{ $booking_customer_id }},{{ $merchant_id }},{{ $booking_id }},'this')"></i>Add Notes<input type="text" placeholder="Add a Note" name="add_note_to_user"></a>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="stf_outer_body container mar-top-body reveal_add_items_section stf_product_window_hide_class"style="display:none"></div>
<div class="stf_outer_body container  stf_products_list_section stf_product_window_show_class" style="display:none"></div>
@endsection
@section('page-style')
    <link rel="stylesheet" href="//use.fontawesome.com/releases/v5.6.3/css/all.css" />
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
@endsection
@section('page-script')
    @include('admin.stylist_form.common');
    <script src="//cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script>
        stfOWLCarouselSliderCall('stf_owl_carousel_slider_reveals');

            $(".rating_starcount").on('click', function() {
                starnum = $(this).attr('starnum');
                cust_id = $(this).attr('cust_id');
                var token = '{{ csrf_token() }}';
                if (starnum != '' && cust_id != '') {
                    $.ajax({
                        url: '{{ url('admin/stylist/customer_request/ratings') }}',
                        method: 'POST',
                        data: {
                            starnum: starnum,
                            cust_id: cust_id,
                            CSRF: token
                        },
                        dataType: 'html',
                        success: function(response) {
                            if (response == 1) {
                                console.log('rating upated successfully');
                                location.reload();
                            } else {
                                console.log('rating not upated successfully');
                            }
                        },
                        error: function(response) {
                            alert('Error: ' + response);
                        }
                    });
                }

            });

            function stfAddNoteToUser(customerid, merchantid, bookingid, obj) {
                var note_name = jQuery('input[name="add_note_to_user"]').val();
                var token = '{{ csrf_token() }}';
                if (note_name == '') {
                    return false;
                }
                $.ajax({
                    url: '{{ url('admin/stylist/customer_request/addnote') }}',
                    method: 'POST',
                    data: {
                        customerid: customerid,
                        merchantid: merchantid,
                        bookingid: bookingid,
                        note_name: note_name,
                        CSRF: token
                    },
                    dataType: 'html',
                    success: function(response) {
                        if (response == 1) {
                            console.log('Product note upated successfully');
                            jQuery('input[name="add_note_to_user"]').val('');
                            location.reload();
                        } else {
                            console.log('Product note not upated successfully');
                        }
                    },
                    error: function(response) {
                        alert('Error: ' + response);
                    }
                });
            }
    </script>
@endsection
