








<?php
  
$notificationdata = $notification->data;
  $notificationcreate_adate = date('d-m-Y', strtotime($notification->created_at));
  // if($date  == $notificationcreate_adate)
  // {
    foreach ($notificationdata as $key => $value) {
    if($key == 'order')
    {
      $customer_data = DB::select('select * from orders where order_number = "'.$value.'" order by id desc');
      // print_r($customer_data);
      foreach ($customer_data as $key => $customer_datavalue) { 
        // echo $customer_datavalue->email;
        ?>
           
           <a href="javascript:void(0)" data-link="<?php echo e(url('admin/order/order/order_details/'.$customer_datavalue->id ), false); ?>" class="ajax-modal-btn modal-btn"><i class="fa fa-bell-o text-aqua"></i>&nbsp;<?php echo e(trans('messages.order_created'), false); ?></a>
        <?php
      }
    }
    }

?><?php /**PATH /home/dappr/public_html/portal.dappr.com.au/resources/views/admin/partials/notifications/order_created.blade.php ENDPATH**/ ?>