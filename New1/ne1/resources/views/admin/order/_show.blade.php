<div class="modal-dialog modal-md">
  <div class="modal-content">
    <div class="modal-body" style="padding: 0px;">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true"
        style="position: absolute; top: 5px; right: 10px; z-index: 9;">×</button>
      <div class="box-widget widget-user">
        <div class="widget-user-header bg-aqua-active card-background">
          <h3 class="widget-user-username">{{$customer_name}}</h3>
          <h5 class="widget-user-desc">
            {{ $customer_status }}
          </h5>
        </div>
        {{-- <div class="widget-user-image">
          <img src="{{ get_avatar_src($customer, 'small') }}" class="img-circle" alt="{{ trans('app.avatar') }}">
        </div> --}}
        <div class="spacer10"></div>
        <div class="row">

          <div class="col-sm-4">
            <div class="description-block">
              <h5 class="description-header">Order Number</h5>
              <span class="description-text">{{ $order->order_number }}</span>
            </div>
          </div>

          <div class="col-sm-4 border-right">
            <div class="description-block">
              <h5 class="description-header">Total Amount</h5>
              <span class="description-text">{{number_format($order->grand_total,2)}}</span>
            </div>
          </div>

          {{-- <div class="col-sm-4 border-right">
            <div class="description-block">
              <h5 class="description-header">&nbsp;</h5>
              <span class="description-text small">{{ trans('app.member_since') }}: {{
                $customer->created_at->diffForHumans() }}</span>
            </div>
          </div> --}}
          <div class="col-sm-4">
            <div class="description-block">
              <h5 class="description-header">
                <?php
                  if($order->payment_status == 1)
                  {
                    echo '<h5 class="description-header">Payment Status</h5><span class="description-text" style="background-color: #d73925; padding:2px; color:#fff; border-radius:5px;" >Unpaid</span>';
                  }
                  else if($order->payment_status == 3)
                  {
                    echo '<h5 class="description-header">Payment Status</h5><span class="description-text bg-primary" style="padding:2px; color:#fff;border-radius:5px;" >Paid</span>';
                  }
                ?>
              </h5>
              {{-- <span class="description-text">#{{ trans('app.orders') }}</span> --}}
            </div>
          </div>

          
        </div>
        <!-- /.row -->
        <div class="spacer10"></div>
      </div>
      <!-- /.widget-user -->

      <!-- Custom Tabs -->
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs nav-justified">
          <li class="active"><a href="#basic_info_tab" data-toggle="tab">{{ trans('app.basic_info') }}</a></li>
          <li><a href="#address_tab" data-toggle="tab">Billing Address</a></li>
          <li><a href="#latest_orders_tab" data-toggle="tab">Shipping Address</a></li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane active" id="basic_info_tab">
            <table class="table">
              <tr>
                <th>BRAND</th>
                <th>Product Name</th>
                <th>Color</th>
                <th>Size</th>
                <th>Price</th>
              </tr>
              <?php 
                foreach ($orderitems_info as $key => $orderitems_val)
                { 
                  $item_des = explode(',', $orderitems_val->item_description);
                  $price  = $orderitems_val->unit_price;
                  $brans = $item_des[0];
                  $Productname  = $item_des[1];
                  $product_color = $item_des[2];
                  $product_size = $item_des[4];
                  ?>
              <tr>
                <td>{{$brans}}</td>
                <td>{{$Productname}}</td>
                <td>{{$product_color}}</td>
                <td>{{$product_size}}</td>
                <td>{{$price}}</td>
              </tr>
              <?php 
                }
              ?>
            </table>
          </div> <!-- /.tab-pane -->

          <div class="tab-pane" id="address_tab">
            <span>
              {{strip_tags($order->billing_address)}}
              {{-- {{}} --}}
              <?php 
              // $billing_add = str_replace("<br/>", ' ', $order->billing_address);
              // $billing_addexp = explode(' ',$billing_add);
              // print_r($billing_addexp);
              ?>
            </span>
          </div> <!-- /.tab-pane -->


          <div class="tab-pane" id="latest_orders_tab">
            {{-- <table class="table table-hover table-2nd-sort">
              <thead>
                <tr>
                  <th>{{ trans('app.order_number') }}</th>
                  <th>{{ trans('app.grand_total') }}</th>
                  <th>{{ trans('app.payment') }}</th>
                  <th>{{ trans('app.status') }}</th>
                  <th>{{ trans('app.order_date') }}</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($customer->latest_orders as $order)
                <tr>
                  <td>{{ $order->order_number }}</td>
                  <td>{{ get_formated_currency($order->grand_total, 2) }}</td>
                  <td>{!! $order->paymentStatusName() !!}</td>
                  <td>{!! $order->orderStatus() !!}</td>
                  <td>{{ $order->created_at->toFormattedDateString() }}</td>
                </tr>
                @endforeach
              </tbody>
            </table> --}}
           
              {{strip_tags($order->shipping_address)}}
              <?php 
                // $shipping_add = str_replace("<br/>", ' ', $order->shipping_address);
                // $shipping_add_exp = explode(' ', $shipping_add);
                // print_r($shipping_add_exp);
              ?>
              {{-- <table class="table">
              </table> --}}
              {{-- {{$order->shipping_address}} --}}
            
            
          </div> <!-- /.tab-pane -->
        </div> <!-- /.tab-content -->
      </div>
    </div>
  </div> <!-- / .modal-content -->
</div> <!-- / .modal-dialog -->