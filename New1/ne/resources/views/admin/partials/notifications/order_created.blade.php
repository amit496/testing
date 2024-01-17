{{-- <a href=""  >
  <i class="fa fa-bell-o text-aqua"></i>&nbsp;{{ trans('messages.order_created')  }}
</a> --}}

{{-- $customer_datavalue->id --}}
{{-- <a href="javascript:void(0)" data-link="{{ route('admin.order.order.show' ) }}" class="ajax-modal-btn modal-btn"><i class="fa fa-bell-o text-aqua"></i>&nbsp;{{ trans('messages.order_created')  }}</a> --}}

{{-- order/order/479/order_details --}}
{{-- admin/order/order/479/order_details --}}
{{-- order//order_details --}}
{{-- admin/order/order/{$customer_datavalue->id}/order_details

admin.order.order. "'..'" --}}
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
           {{-- <a href="javascript:void(0)" data-link="{{ route('admin.admin.customer.show', $customer_datavalue->id) }}" class="ajax-modal-btn modal-btn"><i class="fa fa-bell-o text-aqua"></i>&nbsp;New Client</a> --}}
           <a href="javascript:void(0)" data-link="{{ url('admin/order/order/order_details/'.$customer_datavalue->id ) }}" class="ajax-modal-btn modal-btn"><i class="fa fa-bell-o text-aqua"></i>&nbsp;{{ trans('messages.order_created')  }}</a>
        <?php
      }
    }
    }

?>