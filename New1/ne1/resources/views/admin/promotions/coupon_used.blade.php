@extends('admin.layouts.master')

@section('content')
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">{{ trans('app.usedcoupons') }}</h3>
      
    </div> <!-- /.box-header -->
    <div class="box-body">
      <table class="table table-hover table-no-sort">
        <thead>
          <tr>
            @can('massDelete', \App\Models\Coupon::class)
              <th class="massActionWrapper">
                <!-- Check all button -->
                <div class="btn-group ">
                  <button type="button" class="btn btn-xs btn-default checkbox-toggle">
                    <i class="fa fa-square-o" data-toggle="tooltip" data-placement="top" title="{{ trans('app.select_all') }}"></i>
                  </button>
                  <button type="button" class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <span class="caret"></span>
                    <span class="sr-only">{{ trans('app.toggle_dropdown') }}</span>
                  </button>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="javascript:void(0)" data-link="{{ route('admin.promotion.coupon.massTrash') }}" class="massAction " data-doafter="reload"><i class="fa fa-trash"></i> {{ trans('app.trash') }}</a></li>
                    <li><a href="javascript:void(0)" data-link="{{ route('admin.promotion.coupon.massDestroy') }}" class="massAction " data-doafter="reload"><i class="fa fa-times"></i> {{ trans('app.delete_permanently') }}</a></li>
                  </ul>
                </div>
              </th>
            @endcan
            <th>{{ trans('app.name') }}</th>
            <th>{{ trans('app.code') }}</th>
            <th>{{ trans('app.value') }}</th>
            <th>{{ trans('app.customer') }}</th>     
            <th>{{ trans('app.shipping') }}</th>  
            <th>{{ trans('app.packaging') }}</th> 
            <th>{{ trans('app.handling') }}</th> 
            <th>{{ trans('app.taxes') }}</th> 
            <th>{{ trans('app.total') }}</th>                      
            <th>{{ trans('app.payment') }}</th> 
          </tr>
        </thead>
        <tbody id="massSelectArea">
            @foreach($order_all as $coupon_data)
                <?php
                    $final_details = 0;
                    $coupon_total = (float)$coupon_data->total;
                    $coupon_handling = (float)$coupon_data->handling;
                    $coupon_packaging = (float)$coupon_data->packaging;
                    $coupon_shipping = (float)$coupon_data->shipping;
                    $final_details = $coupon_total + $coupon_handling + $coupon_packaging + $final_details;
                ?>
            <tr>
                <td>{{ $coupon_data->orderCoupon->name }}</td>
            	<td>{{ $coupon_data->orderCoupon->code }}</td>
            	<td>{{ number_format($coupon_data->orderCoupon->value,2,)}}</td>
            	<td>{{ $coupon_data->couponCustomer->name }}</td>
            	<td>{{ number_format($coupon_data->shipping,2,) }}</td>
            	<td>{{ number_format($coupon_data->packaging,2,) }}</td>
            	<td>{{ number_format($coupon_data->handling,2,) }}</td>
            	<td>{{ number_format($coupon_data->taxes,2,)  }}</td>
            	<td>{{ number_format($final_details,2,) }}</td>
            	<td>{{ number_format($coupon_data->grand_total,2,); }}</td>
            </tr>
            
         
         @endforeach
        </tbody>
      </table>
    </div> <!-- /.box-body -->
  </div> <!-- /.box -->

  
@endsection
