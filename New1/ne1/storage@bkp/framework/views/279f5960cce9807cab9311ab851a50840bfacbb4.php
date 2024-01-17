<div class="modal-dialog modal-md">
  <div class="modal-content">
    <div class="modal-body" style="padding: 0px;">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true"
        style="position: absolute; top: 5px; right: 10px; z-index: 9;">×</button>
      <div class="box-widget widget-user">
        <div class="widget-user-header bg-aqua-active card-background">
          <h3 class="widget-user-username"><?php echo e($customer_name, false); ?></h3>
          <h5 class="widget-user-desc">
            <?php echo e($customer_status, false); ?>

          </h5>
        </div>
        
        <div class="spacer10"></div>
        <div class="row">

          <div class="col-sm-4">
            <div class="description-block">
              <h5 class="description-header">Order Number</h5>
              <span class="description-text"><?php echo e($order->order_number, false); ?></span>
            </div>
          </div>

          <div class="col-sm-4 border-right">
            <div class="description-block">
              <h5 class="description-header">Total Amount</h5>
              <span class="description-text"><?php echo e(number_format($order->grand_total,2), false); ?></span>
            </div>
          </div>

          
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
          <li class="active"><a href="#basic_info_tab" data-toggle="tab"><?php echo e(trans('app.basic_info'), false); ?></a></li>
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
                <td><?php echo e($brans, false); ?></td>
                <td><?php echo e($Productname, false); ?></td>
                <td><?php echo e($product_color, false); ?></td>
                <td><?php echo e($product_size, false); ?></td>
                <td><?php echo e($price, false); ?></td>
              </tr>
              <?php 
                }
              ?>
            </table>
          </div> <!-- /.tab-pane -->

          <div class="tab-pane" id="address_tab">
            <span>
              <?php echo e(strip_tags($order->billing_address), false); ?>

              
              <?php 
              // $billing_add = str_replace("<br/>", ' ', $order->billing_address);
              // $billing_addexp = explode(' ',$billing_add);
              // print_r($billing_addexp);
              ?>
            </span>
          </div> <!-- /.tab-pane -->


          <div class="tab-pane" id="latest_orders_tab">
            
           
              <?php echo e(strip_tags($order->shipping_address), false); ?>

              <?php 
                // $shipping_add = str_replace("<br/>", ' ', $order->shipping_address);
                // $shipping_add_exp = explode(' ', $shipping_add);
                // print_r($shipping_add_exp);
              ?>
              
              
            
            
          </div> <!-- /.tab-pane -->
        </div> <!-- /.tab-content -->
      </div>
    </div>
  </div> <!-- / .modal-content -->
</div> <!-- / .modal-dialog --><?php /**PATH /home/dappr/public_html/test.dappr.com.au/resources/views/admin/order/_show.blade.php ENDPATH**/ ?>