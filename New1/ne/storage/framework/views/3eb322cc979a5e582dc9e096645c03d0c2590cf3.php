<!-- CONTENT SECTION -->
<section id="payment-detail-section" name="payment-detail-section" class="space20 order_details_page" >
  <div class="container">
    <div class="row">
      <div class="col-md-12 nopadding">
        <table class="table" id="buyer-payment-detail-table">
          <thead>
            <tr>
              <th colspan="6"><?php echo app('translator')->get('theme.payment_detail'); ?></th>
            </tr>
          </thead>
          <tbody>
            <tr class="buyer-payment-info-head" style="background: #6DBCD4;">
              
              <td><?php echo app('translator')->get('theme.total_amount'); ?></td>
              <td><?php echo app('translator')->get('theme.company_contribution'); ?></td>
              <td><?php echo app('translator')->get('theme.subtotal'); ?></td>
              <td colspan="2"><?php echo app('translator')->get('theme.gst'); ?></td>
              <td><?php echo app('translator')->get('theme.shipping'); ?></td>
              
              
              
              
            </tr>
              <?php
                // $gst_amount = number_format($order->total - ($order->total * 100)/(100 + config('app.gst_percentage')),2);
                // $sub_total = $order->total - $gst_amount;
                // $contribution_amount =  $order->total - $order->discount;        
                // $gst_amount = number_format($order->total - ($order->total * 100)/(100 + config('app.gst_percentage')),2);
                // $sub_total = $order->total - $gst_amount;
                // if($order->discount > 0){
                //     $gst_amount = number_format((($sub_total-$order->discount)*10)/100,2);
                //     $contribution_amount =  $sub_total - $order->discount + $gst_amount;
                // }else{
                //     $contribution_amount =  $order->total - $order->discount;
                // }

                $sub_total_1 = $order->total - $order->discount;
                $gst_amount = number_format($sub_total_1 - ($sub_total_1 * 100)/(100 + config('app.gst_percentage')),2);
                $sub_total_2 = $sub_total_1 - $gst_amount;
                $order_total =  $sub_total_1;
            ?>

            <tr class="buyer-payment-info-body">
              <td>$ <?php echo e(number_format($order->total,  2 , '.', ''), false); ?></td>
              <td>$<?php echo e(number_format($order->discount,  2 , '.', ''), false); ?></td>
              <td>$<?php echo e(number_format($sub_total_2,  2 , '.', ''), false); ?></td>
              <td colspan="2">$<?php echo e(number_format($gst_amount,  2 , '.', ''), false); ?></td>
              <td>Free</td>
              
              
              

          
              
              
              
              
              

            </tr>
                <!--<td><?php echo e(get_formated_currency($order->grand_total, true, 2), false); ?></td> --}}-->
            <tr>
              <td colspan="6"></td>
            </tr>

            <tr class="buyer-payment-info-head" style=" background: #6DBCD4;">
              <td colspan="2"><?php echo app('translator')->get('theme.order_amount'); ?></td>
              <td colspan=""><?php echo app('translator')->get('theme.payment_method'); ?></td>
              <td colspan="3"><?php echo app('translator')->get('theme.status'); ?></td>
            </tr>

            <tr class="buyer-payment-info-body">
              
              <td colspan="2">$<?php echo e(number_format($order_total,  2 , '.', ''), false); ?></td>
              <td colspan=""><?php echo e($order->paymentMethod->name, false); ?></td>
              <td colspan="3"><?php echo $order->paymentStatusName(); ?></td>
            </tr>
          </tbody>
        </table>
      </div><!-- /.col-md-12 -->
    </div><!-- /.row -->
  </div><!-- /.container -->
</section>

<?php if($order->refunds->count()): ?>
  <section id="refund-detail-section" name="refund-detail-section" class="space20">
    <div class="container">
      <div class="row">
        <div class="col-md-12 nopadding">
          <table class="table" id="buyer-payment-detail-table">
            <thead>
              <tr>
                <th colspan="6"><?php echo app('translator')->get('theme.refunds'); ?></th>
              </tr>
            </thead>
            <tbody>
              <tr class="buyer-payment-info-head">
                <td><?php echo e(trans('theme.return_goods'), false); ?></td>
                <td><?php echo e(trans('theme.amount'), false); ?></td>
                <td><?php echo e(trans('theme.status'), false); ?></td>
                <td><?php echo e(trans('theme.created_at'), false); ?></td>
                <td><?php echo e(trans('theme.updated_at'), false); ?></td>
              </tr>

              <?php $__currentLoopData = $order->refunds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $refund): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class="buyer-payment-info-body">
                  <td><?php echo get_yes_or_no($refund->return_goods); ?></td>
                  <td><?php echo e(get_formated_currency($refund->amount, true, 2), false); ?></td>
                  <td><?php echo $refund->statusName(); ?></td>
                  <td><?php echo e($refund->created_at->diffForHumans(), false); ?></td>
                  <td><?php echo e($refund->updated_at->diffForHumans(), false); ?></td>
                </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
          </table>
        </div><!-- /.col-md-12 -->
      </div><!-- /.row -->
    </div><!-- /.container -->
  </section>
<?php endif; ?>

<section id="order-detail-section" name="order-detail-section" class="order_details_page">
  <div class="container">
    <div class="row">
      <div class="col-md-12 nopadding">
        <table class="table" id="buyer-order-table" name="buyer-order-table">
          <thead>
            <tr>
              <th colspan="3"><?php echo app('translator')->get('theme.order_detail'); ?></th>
            </tr>
          </thead>
          <tbody>
            <tr class="buyer-payment-info-head">
              <td><?php echo app('translator')->get('theme.shipping_address'); ?>:</td>
              <td colspan="2"><?php echo app('translator')->get('theme.billing_address'); ?>:</td>
            </tr>
            <tr>
              <td><?php echo $order->shipping_address; ?></td>
              <td colspan="2"><?php echo $order->billing_address; ?></td>
            </tr>
            <tr class="order-info-head">
              <td width="40%">
                <h5 class="my-1">
                  <span style="color:#6DBCD4;"><?php echo app('translator')->get('theme.order_id'); ?>: </span>
                  <?php echo e($order->order_number, false); ?>


                  <?php if($order->hasPendingCancellationRequest()): ?>
                    <span class="label label-warning indent10 text-uppercase">
                      <?php echo e(trans('theme.' . $order->cancellation->request_type . '_requested'), false); ?>

                    </span>
                  <?php elseif($order->hasClosedCancellationRequest()): ?>
                    <span class="indent10" style="color:#6DBCD4;">
                      <?php echo e(trans('theme.' . $order->cancellation->request_type), false); ?> 
                    </span>
                    <?php echo $order->cancellation->statusName(); ?>

                  <?php elseif($order->isCanceled()): ?>
                    <span class="indent10"><?php echo $order->orderStatus(); ?></span>
                  <?php endif; ?>
                  <?php if($order->dispute): ?>
                    <span class="label label-danger indent10 text-uppercase"><?php echo app('translator')->get('theme.disputed'); ?></span>
                  <?php endif; ?>
                </h5>
                <h5 class="mt-2">
                  <span style="color:#6DBCD4;"><?php echo app('translator')->get('theme.order_time_date'); ?>: </span><?php echo e($order->created_at->toDayDateTimeString(), false); ?>

                </h5>
              </td>
              <td width="40%" class="store-info">
                <h5 class="my-1">
                  
                  <?php if($order->shop->slug): ?>
                    
                  <?php else: ?>
                    <?php echo app('translator')->get('theme.store_not_available'); ?>
                  <?php endif; ?>
                </h5>
                <h5 class="mt-2">
                  <span  style="color:#6DBCD4;"><?php echo app('translator')->get('theme.status'); ?></span>
                  <?php echo $order->orderStatus(true) . ' &nbsp; ' . $order->paymentStatusName(); ?>

                </h5>
              </td>
              <td width="20%" class="order-amount">
                <h5 class="my-1">
                  
                  <span  style="color:#6DBCD4;"><?php echo app('translator')->get('theme.order_amount'); ?>: </span><?php echo e('$'.number_format($order_total, 2 ,'.', ''), false); ?>

                </h5>
              </td>
            </tr> <!-- /.order-info-head -->
            <?php
              // dd($order->cancellation);
            ?>
            <?php $__currentLoopData = $order->inventories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php 
              $item_data = $item->pivot->item_description;
              $convert_item_data ='';
              $title ='';
              $size = ''; 
              if(isset($item_data))
              {
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
                  $size = $convert_item_data[4];
                }
              }
            ?>
              <tr class="order-body">
                <td colspan="2">
                  <div class="product-img-wrap">
                    <img src="<?php echo e(get_storage_file_url(optional($item->image)->path, 'small'), false); ?>" alt="<?php echo e($item->slug, false); ?>" title="<?php echo e($item->slug, false); ?>" />
                  </div>
                  <div class="product-info">
                    
                    
                    <?php echo e($item->brand, false); ?>

                    <br>
                    <?php echo e($title, false); ?>

                    <br>
                    
                    
                    
                    
                    <?php echo e($size, false); ?>



                    <?php if($order->cancellation && $order->cancellation->isItemInRequest($item->id)): ?>
                      <?php
                        // print_r();
                        $cancel_exchange_retunr_option = '';
                        $exchange_return_option = '';
                        $cancel_exchange_retunr_option = json_decode($order->cancellation->exchnage_return_option, true);
                        foreach ($cancel_exchange_retunr_option as $key => $values)
                        {
                            if(($item->id == $key) && ($values == 'exchange'))
                            {
                              $exchange_return_option = 'Exchange';
                            }
                            else if(($item->id == $key) && ($values == 'refund')){
                              $exchange_return_option = 'Refund';
                            }
                        }

                      ?>
                      <span class="label label-danger indent10">
                        <?php echo e($exchange_return_option . ' Requested', false); ?>

                      </span>
                    <?php endif; ?>

                    <div class="order-info-amount">
                      
                      <span>$<?php echo e(number_format($item->pivot->unit_price, 2, '.',''), false); ?> x <?php echo e($item->pivot->quantity, false); ?></span>
                    </div>
                    
                  </div>
                </td>
                <?php if($loop->first): ?>
                  <td rowspan="<?php echo e($loop->count, false); ?>" class="order-actions">
                    <a href="<?php echo e(url('stylist/order/cancel'), false); ?>" style="display:block; width:100%; padding:5px 10px; font-size:12px; line-height:1.5;    color: #333; text-align: center;background:#fff; border:1px solid #ccc; margin-bottom:5px">Exchange/Return</a>

                    <!-- <a href="<?php echo e(route('order.again', $order), false); ?>" class="btn btn-default btn-sm btn-block flat">
                      <i class="fas fa-shopping-cart"></i> <?php echo app('translator')->get('theme.order_again'); ?>
                    </a> -->
                    
                   
                    <?php if (! ($order->isCanceled())): ?>
                      <a href="<?php echo e(route('order.invoice', $order), false); ?>" class="btn btn-default btn-sm btn-block flat">
                        <i class="fas fa-cloud-download"></i> <?php echo app('translator')->get('theme.invoice'); ?>
                      </a>

                      <?php if($order->canBeCanceled()): ?>

                        <?php echo Form::model($order, ['method' => 'PUT', 'route' => ['order.cancel', $order]]); ?>

                        <?php echo Form::button('<i class="fas fa-times-circle-o"></i> ' . trans('theme.cancel_order'), ['type' => 'submit', 'class' => 'confirm btn btn-default d-none btn-block flat', 'data-confirm' => trans('theme.confirm_action.cant_undo')]); ?>

                        <?php echo Form::close(); ?>


                      <?php elseif($order->canRequestCancellation()): ?>

                        <a href="<?php echo e(route('cancellation.form', ['order' => $order, 'action' => 'cancel']), false); ?>" class="modalAction btn btn-default btn-sm d-none btn-block flat"><i class="fas fa-times"></i> <?php echo app('translator')->get('theme.cancel_items'); ?></a>

                      <?php endif; ?>

                      <?php if($order->canTrack()): ?>
                        <a href="<?php echo e(route('order.track', $order), false); ?>" class="btn btn-black btn-sm btn-block flat d-none">
                          <i class="fas fa-map-marker"></i> <?php echo app('translator')->get('theme.button.track_order'); ?>
                        </a>
                      <?php endif; ?>

                      <?php if($order->canEvaluate()): ?>
                        <a href="<?php echo e(route('order.feedback', $order), false); ?>" class="btn btn-primary btn-sm btn-block flat d-none">
                          <?php echo app('translator')->get('theme.button.give_feedback'); ?>
                        </a>
                      <?php endif; ?>

                      <?php if($order->isFulfilled()): ?>
                        <?php if($order->canRequestReturn()): ?>
                          <a href="<?php echo e(route('cancellation.form', ['order' => $order, 'action' => 'return']), false); ?>" class="modalAction btn btn-default btn-sm btn-block flat d-none"><i class="fas fa-undo"></i> <?php echo app('translator')->get('theme.return_items'); ?></a>
                        <?php endif; ?>

                        <?php if (! ($order->goods_received)): ?>
                          <?php echo Form::model($order, ['method' => 'PUT', 'route' => ['goods.received', $order]]); ?>

                          <?php echo Form::button(trans('theme.button.confirm_goods_received'), ['type' => 'submit', 'class' => 'confirm btn btn-primary btn-block flat d-none', 'data-confirm' => trans('theme.confirm_action.goods_received')]); ?>

                          <?php echo Form::close(); ?>

                        <?php endif; ?>
                      <?php endif; ?>

                    <?php endif; ?>

                    <!-- <?php if($order->dispute): ?>
                      <a href="<?php echo e(route('dispute.open', $order), false); ?>" class="btn btn-link btn-block" data-confirm="<?php echo app('translator')->get('theme.confirm_action.open_a_dispute'); ?>"><?php echo app('translator')->get('theme.dispute_detail'); ?></a>
                    <?php else: ?>
                      <a href="<?php echo e(route('dispute.open', $order), false); ?>" class="confirm btn btn-link btn-block" data-confirm="<?php echo app('translator')->get('theme.confirm_action.open_a_dispute'); ?>"><?php echo app('translator')->get('theme.button.open_dispute'); ?></a>
                    <?php endif; ?> -->
                  </td>
                <?php endif; ?>
              </tr> <!-- /.order-body -->
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <?php if($order->message_to_customer): ?>
              <tr class="message_from_seller">
                <td colspan="3">
                  <p>
                    <strong><?php echo app('translator')->get('theme.message_from_seller'); ?>: </strong> <?php echo $order->message_to_customer; ?>

                  </p>
                </td>
              </tr>
            <?php endif; ?>

            <?php if($order->buyer_note): ?>
              <tr class="order-info-footer">
                <td colspan="3">
                  <p class="order-detail-buyer-note">
                    <strong><?php echo app('translator')->get('theme.note'); ?>: </strong> <?php echo $order->buyer_note; ?>

                  </p>
                </td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div><!-- /.col-md-12 -->
    </div><!-- /.row -->
  </div><!-- /.container -->
</section>

<section id="message-section" name="message-section" style="display: none">
  <div class="container">
    <div class="section-title">
      <h4><?php echo app('translator')->get('theme.section_headings.contact_seller'); ?></h4>
    </div>
    <div class="message-list">
      <div class="row">
        <?php echo Form::open(['route' => ['order.conversation', $order], 'files' => true, 'id' => 'conversation-form', 'data-toggle' => 'validator']); ?>

        <div class="col-md-6">
          <div class="form-group">
            <?php echo Form::label('message', trans('theme.write_your_message')); ?>

            <?php echo Form::textarea('message', null, ['class' => 'form-control form-control flat', 'placeholder' => trans('theme.leave_message_to_seller'), 'rows' => '4', 'maxlength' => 500, 'required']); ?>

            <div class="help-block with-errors"></div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <?php echo Form::label('photoInput', trans('theme.button.upload_photo')); ?>

            <?php echo Form::file('photo'); ?>

            <span class="help-block small"><?php echo app('translator')->get('theme.help.upload_photo'); ?></span>
          </div>
          <?php if (! ($order->order_status_id == \App\Models\Order::STATUS_DELIVERED)): ?>
            <div class="checkbox">
              <label>
                <?php echo Form::checkbox('goods_received', 1, null, ['class' => 'i-check-blue']); ?> <?php echo e(trans('theme.goods_received'), false); ?>

              </label>
            </div>
          <?php endif; ?>
          <?php echo Form::button(trans('theme.button.send_message'), ['type' => 'submit', 'class' => 'btn btn-info flat']); ?>

        </div>
        <?php echo Form::close(); ?>

      </div> <!-- /.row -->

      <?php if($order->conversation): ?>
        <div class="message-list-header">
          <h4><?php echo app('translator')->get('theme.message_history'); ?></h4>
        </div>

        <?php $__currentLoopData = $order->conversation->replies->sortByDesc('created_at'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $msg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="row message-list-item <?php echo e($msg->customer_id ? 'message-buyer message-me' : 'message-seller', false); ?>">
            <div class="col-2 nopadding-right">
              <?php if (! ($msg->customer_id)): ?>
                <div class="message-user-info">
                  <div class="message-user-name" title="seller"><?php echo e($order->shop->name ?? lang('theme.seller'), false); ?></div>
                  <div class="message-date"><?php echo e($msg->created_at->toDayDateTimeString(), false); ?></div>
                </div>
              <?php endif; ?>
            </div>
            <div class="col-8">
              <div class="message-content-wrapper">
                <div class="message-content"><?php echo $msg->reply; ?></div>
                <?php if($attachment = optional($msg->attachments)->first()): ?>
                  <a href="<?php echo e(get_storage_file_url($attachment->path, 'original'), false); ?>" class="pull-right message-attachment" target="_blank">
                    <img src="<?php echo e(get_storage_file_url($attachment->path, 'tiny'), false); ?>" class="img-sm thumbnail">
                  </a>
                <?php endif; ?>
              </div>
            </div>
            <div class="col-2 nopadding-left">
              <?php if($msg->customer_id): ?>
                <div class="message-user-info">
                  <div class="message-user-name" title="me"><?php echo app('translator')->get('theme.me'); ?></div>
                  <div class="message-date"><?php echo e($msg->created_at->toDayDateTimeString(), false); ?></div>
                </div>
              <?php endif; ?>
            </div>
          </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <div class="row message-list-item message-buyer message-me">
          <div class="col-2 nopadding-right">
          </div>
          <div class="col-8">
            <div class="message-content-wrapper">
              <div class="message-content"><?php echo $order->conversation->message; ?></div>
              <?php if($attachment = optional($order->conversation->attachments)->first()): ?>
                <a href="<?php echo e(get_storage_file_url($attachment->path, 'original'), false); ?>" class="pull-right message-attachment" target="_blank">
                  <img src="<?php echo e(get_storage_file_url($attachment->path, 'tiny'), false); ?>" class="img-sm thumbnail">
                </a>
              <?php endif; ?>
            </div>
          </div>
          <div class="col-2 nopadding-left">
            <div class="message-user-info">
              <div class="message-user-name" title="me"><?php echo app('translator')->get('theme.me'); ?></div>
              <div class="message-date"><?php echo e($order->conversation->created_at->toDayDateTimeString(), false); ?></div>
            </div>
          </div>
        </div>
      <?php endif; ?>
    </div><!-- /.message-list -->
  </div><!-- /.container -->
</section>
<!-- END CONTENT SECTION -->

<div class="clearfix space20"></div>
<?php /**PATH /home/dappr/public_html/test.dappr.com.au/public/themes/default/views/contents/order_detail.blade.php ENDPATH**/ ?>