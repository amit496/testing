@php
    $stylist_body_class = ' order_complete_place  ';
@endphp

<style>
    .rb-text-box {
        position: absolute;
        left: 35%;
        top: 30%;
        transform: translate(-35%, -30%);
    }

    .sending_message {
        margin-top: 5%;
        text-align: left;
    }


    .header {
        display: none;
    }

    .back_btn_md a {
        text-decoration: none;
        color: #212121;
        font-weight: 600;
        /* display: block; */
    }
    .order_details_button a {
        text-decoration: none;
        color: #212121;
        font-weight: 600;
        display: block;
    }
    
    .thank_you_order_btns{
        display:flex;
        
    }
    .thank_you_order_btns .btn{
        width:250px;
    }
    @media only screen and (max-width:991px) {
          .thank_you_order_btns{
            display:block;
            padding:0 20px;
            text-align: center;
            margin: auto;
        
        }
        .thank_you_order_btns .btn{
                text-align: center;
                width:80%;
                 margin-top: 20px !important;
        }
    .thank_you_order .rb-text-box {
        position: relative;
        left: inherit;
        top: inherit;
        transform: inherit;
        margin-bottom: 20px;
    }
    .thank_you_order_text{
        order:2;
        
    }
    .sending_message {
        margin-top: 0%;

    }
 
}
</style>

{{-- <section>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 pt-5">
               <div class="ml-5 back_btn_md">
                    <a href="{{ url('stylist/customer/info') }}"> <i class="fa fa-angle-left mr-2"></i> Back To Dashboard </a>
                </div>
                <div class="rb-text-box"> --}}
{{-- <p class="lead order_palce_messsage">@lang('stylist.notify.order_placed_thanks')</p> --}}
{{-- <p class="lead sending_message">@lang('stylist.notify.order_placed_address')</p> --}}
{{-- <p class="lead sending_message"><b>Thank you for your order. </b></p>
                <p class="lead sending_message">your order has been place successfully! </p> --}}
{{-- <p class="lead order_palce_address">@lang('theme.notify.order_placed_main_add')</p> --}}

{{-- @php
                $payment_instructions = null;
                if (optional($order->paymentMethod)->type == \App\Models\PaymentMethod::TYPE_MANUAL) {
                if (vendor_get_paid_directly()) {
                $payment_method = $order->shop->config->manualPaymentMethods->where('id',
                $order->payment_method_id)->first();

                $payment_instructions = optional($payment_method)->pivot->payment_instructions;
                } else {
                $payment_instructions = get_from_option_table('wallet_payment_info_' . $order->paymentMethod->code);
                }
                }
                @endphp --}}

{{-- {{$order->payment_method_id}} --}}

{{-- @if ($payment_instructions)
                <p class="text-primary space50">
                    <strong>@lang('theme.payment_instruction'): </strong>
                    {!! $payment_instructions !!}
                </p> --}}
{{-- @elseif(!$order->isPaid())
                <p class="text-danger space50">
                    <strong>@lang('theme.payment_status'): </strong> {!! $order->paymentStatusName() !!}
                </p>
                @endif --}}

{{-- @if ($order->pickup())
                @php
                $warehouseIds = [];
                @endphp

                @foreach ($order->inventories as $key => $inventory)
                @if (!empty($inventory->warehouse))
                @if (!in_array($inventory->warehouse_id, $warehouseIds))
                @php
                $warehouseIds[] = $inventory->warehouse_id;
                @endphp

                <p class="small space10" style="margin-top: 10px"><i class="fas fa-info-circle"></i>
                    {{ trans('theme.notify.business_days') }}: <em>{{ $inventory->warehouse->business_days }}</em>
                </p>
                <p class="small space10"><i class="fas fa-info-circle"></i>
                    {{ trans('theme.notify.availability') }}: <em>{{ $inventory->warehouse->opening_time }} - {{
                        $inventory->warehouse->close_time }}</em>
                </p>
                <p class="small space10"><i class="fas fa-info-circle"></i>
                    {{ trans('theme.notify.order_number') }}: <em>{{ $order->order_number }}</em>
                </p>
                <p class="small space10"><i class="fas fa-info-circle"></i>
                    {{ trans('theme.notify.pick_up_order_from') }}: <br />
                    <em>{!! address_str_to_html($inventory->warehouse->address->toString()) !!}</em>
                </p>
                @endif
                @endif
                @endforeach
                @else --}}
{{-- <p class="small space30"><i class="fas fa-info-circle"></i>
                    {{ trans('theme.notify.order_will_ship_to') }}: <em>"{!! $order->shipping_address !!}"</em>
                </p> --}}
{{-- @endif --}}

{{-- <p class="lead d-block space50 order_complete_button_section"> --}}
{{-- @php
                    $stylist_back_reveal_url = Session::get('stylist_back_reveal_url');
                    if(isset($stylist_back_reveal_url) && $stylist_back_reveal_url != '')
                    {
                    echo '<a href="'.$stylist_back_reveal_url.'"
                        class="btn btn-black flat dashboard_button">'.trans('stylist.button.stylist_back_to_dashboard').'</a>';
                    // echo <a class="btn btn-primary flat " href="{{ url('/') }}"></a>
                    }

                    @endphp --}}
<!-- <a class="btn btn-default flat  order_details_button" style="width: 225px;
                                {{-- " href="{{ url('stylist/customer/info') }}">Back To Dashboard</a> --> --}}


                    {{-- @if (\Auth::guard('customer')->check()) --}}
                    <a class="btn btn-default flat  order_details_button" style="width: 225px;
                        {{-- " href="{{ route('order.detail', $order) }}">@lang('stylist.button.order_detail')</a> --}}
                    {{-- @endif --}}
                </p>
                </div>
            </div>

            <div class="col-md-6 p-0">
                <div class="rb-bg-img">
                    {{-- <img src="{{asset('images/stylist/questions/section/212122.jpg')}}" width="100%"> --}}
                </div>
            </div>
        </div><!-- /.row -->
{{-- @include('theme::nav.footer') --}}
{{-- </div> <!-- /.container -->
</section> --}}



{{-- -------------------------------------------------------------------------------------------- --}}
<section>
    <div class="container-fluid">
        <div class="row thank_you_order" >
            <div class="col-lg-6 pt-5 thank_you_order_text">
                <div class="rb-text-box">
                    <p class="lead sending_message"><b>Thank you for your order. </b></p>
                    <p class="lead sending_message">We'll get packing and get your order to you as soon as possible!</p>
                    @php
                        $payment_instructions = null;
                        if (optional($order->paymentMethod)->type == \App\Models\PaymentMethod::TYPE_MANUAL) {
                            if (vendor_get_paid_directly()) {
                                $payment_method = $order->shop->config->manualPaymentMethods->where('id', $order->payment_method_id)->first();
                        
                                $payment_instructions = optional($payment_method)->pivot->payment_instructions;
                            } else {
                                $payment_instructions = get_from_option_table('wallet_payment_info_' . $order->paymentMethod->code);
                            }
                        }
                    @endphp

                    
                    <p class="lead d-block space50 order_complete_button_section">
                        {{-- @php
                    $stylist_back_reveal_url = Session::get('stylist_back_reveal_url');
                    if(isset($stylist_back_reveal_url) && $stylist_back_reveal_url != '')
                    {
                    echo '<a href="'.$stylist_back_reveal_url.'"
                        class="btn btn-black flat dashboard_button">'.trans('stylist.button.stylist_back_to_dashboard').'</a>';
                    // echo <a class="btn btn-primary flat " href="{{ url('/') }}"></a>
                    }

                    @endphp --}}
                      
                       <div class="link thank_you_order_btns">
                        @if (\Auth::guard('customer')->check())
                        <a class="btn btn-default flat  order_details_button" style="" href="{{ route('order.detail', $order) }}">VIEW ORDER</a>
                    @endif
                    <a class="btn btn-default flat  order_details_button" style="" href="{{ url('stylist/customer/info') }}">DASHBOARD</a>
                       </div>
                    </p>
                </div>
            </div>
            <div class="col-lg-6 p-0">
                <div class="rb-bg-img">
                    <img src="{{ asset('images/stylist/questions/section/2121222.jpg') }}" width="100%">
                </div>
            </div>
        </div><!-- /.row -->
        {{-- @include('theme::nav.footer') --}}
    </div> <!-- /.container -->
</section>
