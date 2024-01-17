<style>
#content-wrapper {
    min-height: 680px;
}
.order_text
{
    color: #6DBCD4 ;
}
</style>
@if ($orders->count() > 0)
<table class="table" id="buyer-order-table">
    <thead>
        <tr>
            <th colspan="3">@lang('theme.your_order_history')</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($orders as $order)
            <tr class="order-info-head">
                <td width="40%">
                    {{-- <h5 class="mb-2"> --}}
                        <span style="color: #6DBCD4 ;">@lang('theme.order_id'): </span>
                        <a class="btn-link" href="{{ route('order.detail', $order) }}">{{ $order->order_number }}</a>
                        {{-- @if ($order->hasPendingCancellationRequest()) --}}
                            {{-- <span class="label label-warning indent10 text-uppercase">
                                {{ trans('theme.' . $order->cancellation->request_type . '_requested') }}
                            </span> --}}
                            {{-- <span class="label label-warning indent10 text-uppercase">RETURN REQUESTED</span> --}}
                        {{-- @elseif($order->hasClosedCancellationRequest())
                            <span class="indent10" style="color: #6DBCD4 ;">
                                {{ trans('theme.' . $order->cancellation->request_type) }}
                            </span>
                            {!! $order->cancellation->statusName() !!}
                        @elseif($order->isCanceled())
                            <span class="indent10">{!! $order->orderStatus() !!}</span>
                        @endif

                        @if ($order->dispute)
                            <span class="label label-danger indent10 text-uppercase">@lang('theme.disputed')</span>
                        @endif
                    </h5> --}}
                    <h5><span  style="color: #6DBCD4 ;">@lang('theme.order_time_date'): </span>{{ $order->created_at->toDayDateTimeString() }}</h5>
                </td>
                <td width="40%" class="store-info">
                    <h5>
                        <span  style="color: #6DBCD4 ;">@lang('theme.status')</span>
                        {!! $order->orderStatus(true) . ' &nbsp; ' . $order->paymentStatusName() !!}
                    </h5>
                </td>
                <td width="20%" class="order-amount">
                    <h5 class="mb-2" ><span  style="color: #6DBCD4 ;">@lang('theme.order_amount'): </span>${{ number_format($order->grand_total, 2 ,'.', '') }}</h5>
                    {{-- <h5 class="mb-2"><span>@lang('theme.order_amount'): </span>{{ get_formated_currency($order->grand_total,true, 2) }}</h5> --}}
                </td>
            </tr> <!-- /.order-info-head -->

            @foreach ($order->inventories as $item)
                <?php
                    $item_data = $item->pivot->item_description;
                    // dd($item_data);
                    $convert_item_data ='';
                    $title ='';
                    $size = '';
                    if(isset($item_data)){
                        $convert_item_data = explode(",", $item_data);
                        // dd($convert_item_data);
                    }

                    foreach ($convert_item_data as $key => $convert_item_data_value) {
                        if(isset($convert_item_data[1]))
                        {
                            $title = $convert_item_data[1];
                        }
                        if(isset($convert_item_data[4]))
                        {
                            $size = $convert_item_data[4]  ;
                        }
                    }
                    $item_inventory_ids = $item->id;
                    ?>
                <tr class="order-body">
                    <td colspan="2">
                        <?php
                        $product_image_html = " ";
                        if ($item->id  == optional($item->image)->imageable_id && optional($item->image)->imageable_type == 'App\Models\Inventory'){
                            $product_image_html = "<img src='".get_storage_file_url(optional($item->image)->path, 'small')."' alt='".$item->slug."' title='".$item->slug."' />";
                        }
                        elseif($item->product_id  == optional($item->product->image)->imageable_id && optional($item->product->image)->imageable_type == 'App\Models\Product'){
                            $product_image_html = "<img src='".get_storage_file_url(optional($item->product->image)->path, 'small')."' alt='".$item->slug."' title='".$item->slug."' />";
                    }

                    ?>
                        <div class="product-img-wrap">
                            {!!$product_image_html!!}
                            {{-- <img src="{{ get_storage_file_url(optional($item->image)->path, 'small') }}" alt="{{ $item->slug }}" title="{{ $item->slug }}" /> --}}
                        </div>
                        <div class="product-info">
                            {{-- <a href="{{ route('show.product', $item->slug) }}" class="product-info-title" style="display: inline;">{{ $item->title }}</a> --}}
                            {{-- <a href="{{ route('show.product', $item->slug) }}" class="product-info-title" style="display: inline;">{{ $item->pivot->item_description }}</a> --}}
                            <?php
                                $html ='';
                                $html_status ='';
                                if(isset($order->cancellation))
                                {
                                    $item_inventory_ids ."<br>";
                                    // $arr2 = [];
                                    $arr1 =json_decode($order->cancellation->exchnage_return_option, true);
                                    foreach ($arr1 as $key => $value) {

                                        if($key == $item_inventory_ids)
                                        {
                                            // echo $arr1[$key];
                                            $html .= "<span class='label label-danger indent10' style='margin-left: 0 !important; margin-right:10px;'>".strtoupper($arr1[$key])." REQUESTED </span>";

                                            // if($order->hasPendingCancellationRequest())
                                            // {
                                            //     $html_status ='';
                                            // }
                                            // elseif($order->hasClosedCancellationRequest())
                                            // {
                                            //     $html_status = $order->cancellation->statusName();
                                            // }
                                            // elseif($order->isCanceled())
                                            // {
                                            //     $html_status = $order->orderStatus();
                                            // }


                                        }

                                    }


                                    $approve_items =explode(',',$order->cancellation->approve_items);
                                    $decline_items =explode(',',$order->cancellation->decline_item);
                                    if(in_array($item_inventory_ids,$approve_items))
                                    {
                                        $html_status .=  "<span class='label label-primary indent10' style='margin-left: 0 !important; margin-right:10px;'>APPROVED</span>";
                                    }
                                    else if(in_array($item_inventory_ids,$decline_items)){
                                        $html_status .=  "<span class='label label-danger indent10' style='margin-left: 0 !important; margin-right:10px;background:#337ab7 ;' >DECLINED</span>";
                                    }
                                }

                                ?>
                                {{-- <span class="label label-danger indent10">RETURN REQUESTED</span> --}}
                                {!!$html!!}
                                {!!$html_status!!}
                                <br>



                            @if ($order->cancellation && $order->cancellation->isItemInRequest($item->id))
                            @endif
                            {{-- <a href="{{ route('show.product', $item->slug) }}" class="product-info-title" style="display: inline; margin-top:5px !important; ">{{ $title }}</a>
                            <br>
                            <a href="{{ route('show.product', $item->slug) }}" class="product-info-title" style="display: inline;">{{ $size }}</a>
                            <br>
                            <a href="{{ route('show.product', $item->slug) }}" class="product-info-title" style="display: inline;">{{ $item->brand }}</a> --}}
                            <span class="product-info-title" style="display: inline; margin-top:5px !important; ">{{  $item->brand }}</span >
                            <br>
                            <span class="product-info-title" style="display: inline; margin-top:5px !important; ">{{  $title }}</span>
                            <br>
                            <span class="product-info-title" style="display: inline; margin-top:5px !important; ">{{  $size }}</span>
                            <br>



                            <div class="order-info-amount">
                                {{-- <span>{{ get_formated_currency($item->pivot->unit_price, true, 2) }} x {{ $item->pivot->quantity}}</span> --}}
                                <span>${{ number_format($item->pivot->unit_price, 2, '.','') }} x {{ $item->pivot->quantity}}</span>
                            </div>
                        </div>
                    </td>

                    @if ($loop->first)

                        <td rowspan="{{ $loop->count }}" class="order-actions">
                            {{-- <a href="{{ route('cancellation.form', ['order' => $order, 'action' => 'cancel']) }}"
                                        class="modalAction btn btn-default btn-sm btn-block flat">@lang('theme.button.Exchange_Return')</a> --}}
                            <a href="{{ url('stylist/order/cancel') }}" class="btn btn-default btn-sm btn-block flat">@lang('theme.button.Exchange_Return')</a>
                            <a href="{{ route('order.invoice', $order) }}" class="btn btn-default btn-sm btn-block flat"> <i class="fas fa-cloud-download"></i> @lang('theme.invoice')</a>
                            @unless($order->isCanceled())
                                @if ($order->canBeCanceled())
                                    {!! Form::model($order, ['method' => 'PUT', 'route' => ['order.cancel', $order]]) !!}
                                    {!! Form::button('<i class="fas fa-times-circle-o"></i> ' . trans('theme.cancel_order'), ['type' =>'submit', 'class' => 'confirm btn btn-default btn-block flat', 'data-confirm' =>trans('theme.confirm_action.cant_undo')]) !!}
                                    {!! Form::close() !!}
                                    @if ($order->canTrack())
                                        <a href="{{ route('order.track', $order) }}" class="btn btn-black btn-sm btn-block flat"><i class="fas fa-map-marker"></i> @lang('theme.button.track_order')</a>

                                    @endif
                                    @if ($order->isFulfilled())

                                        @if ($order->canRequestReturn())

                                            {{-- <a href="{{ route('cancellation.form', ['order' => $order, 'action' => 'return']) }}" class="modalAction btn btn-default btn-sm btn-block flat"> --}}
                                                {{-- <i class="fas fa-undo"></i> --}}{{-- @lang('theme.return_items') --}}
                                                {{-- Exchange/Return</a> --}}
                                            <a href="{{ route('cancellation.form', ['order' => $order, 'action' => 'return']) }}" class="modalAction btn btn-default btn-sm btn-block flat">
                                                {{-- <i class="fas fa-undo"></i> --}}{{-- @lang('theme.return_items') --}}
                                                Exchange/Return</a>
                                        @endif
                                        @unless($order->goods_received)
                                            {!! Form::model($order, ['method' => 'PUT', 'route' => ['goods.received', $order]]) !!}
                                            {!! Form::button(trans('theme.button.confirm_goods_received'), ['type' => 'submit', 'class' => 'confirm btn btn-primary btn-block flat', 'data-confirm' => trans('theme.confirm_action.goods_received')]) !!}
                                            {!! Form::close() !!}
                                        @endunless
                                    @endif
                                @endif
                            @endunless
                        </td>
                    @endif
                </tr> <!-- /.order-body -->
            @endforeach
            @if ($order->message_to_customer)
                <tr class="message_from_seller">
                    <td colspan="3">
                        <p>
                            <strong>@lang('theme.message_from_seller'): </strong> {{ $order->message_to_customer }}
                        </p>
                    </td>
                </tr>
            @endif
            @if ($order->buyer_note)
            <tr class="order-info-footer">
                <td colspan="3">
                    <p class="order-detail-buyer-note">
                        <span>@lang('theme.note'): </span> {{ $order->buyer_note }}
                    </p>
                </td>
            </tr>
            @endif
        @endforeach
    </tbody>
</table>
{{-- <div class="sep"></div> --}}
@else
<div class="clearfix space50"></div>
<p class="lead text-center space50">
    @lang('theme.no_order_history')
    {{-- <br /> --}}
    {{-- <a href="{{ url('/') }}" class="btn btn-primary btn-sm flat">@lang('theme.button.shop_now')</a> --}}
</p>
@endif

<div class="row pagenav-wrapper">
    {{ $orders->links('theme::layouts.pagination') }}
</div><!-- /.row .pagenav-wrapper -->
<div class="clearfix space20"></div>
