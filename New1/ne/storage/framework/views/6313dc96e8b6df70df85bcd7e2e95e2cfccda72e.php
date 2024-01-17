<style>
#content-wrapper {
    min-height: 680px;
}
.order_text
{
    color: #6DBCD4 ;
}
</style>
<?php if($orders->count() > 0): ?>
<table class="table" id="buyer-order-table">
    <thead>
        <tr>
            <th colspan="3"><?php echo app('translator')->get('theme.your_order_history'); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr class="order-info-head">
                <td width="40%">
                    <h5 class="mb-2">
                        <span style="color: #6DBCD4 ;"><?php echo app('translator')->get('theme.order_id'); ?>: </span>
                        <a class="btn-link" href="<?php echo e(route('order.detail', $order), false); ?>"><?php echo e($order->order_number, false); ?></a>
                        <?php if($order->hasPendingCancellationRequest()): ?>
                            
                            
                        <?php elseif($order->hasClosedCancellationRequest()): ?>
                            <span class="indent10" style="color: #6DBCD4 ;">
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
                    <h5><span  style="color: #6DBCD4 ;"><?php echo app('translator')->get('theme.order_time_date'); ?>: </span><?php echo e($order->created_at->toDayDateTimeString(), false); ?></h5>
                </td>
                <td width="40%" class="store-info">
                    <h5>
                        <span  style="color: #6DBCD4 ;"><?php echo app('translator')->get('theme.status'); ?></span>
                        <?php echo $order->orderStatus(true) . ' &nbsp; ' . $order->paymentStatusName(); ?>

                    </h5>
                </td>
                <td width="20%" class="order-amount">
                    <h5 class="mb-2" ><span  style="color: #6DBCD4 ;"><?php echo app('translator')->get('theme.order_amount'); ?>: $</span><?php echo e(number_format($order->grand_total, 2 ,'.', ''), false); ?></h5>
                    
                </td>
            </tr> <!-- /.order-info-head -->
            
            <?php $__currentLoopData = $order->inventories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php 
                    $string = $item->pivot->item_description;
                    $covert_tem = explode("-", $string);
                    
                    // echo $item_inventory_ids;
                    // dd($item);
                    $title ='';
                    $size = ''; 
                    foreach ($covert_tem as $key => $covert_tems) {
                        // echo $key .$covert_tems ."<br>";
                        $title = $covert_tem[0];
                        $size = $covert_tem[3];
                    }

                    $item_inventory_ids = $item->id;

                    
                    ?>
                <tr class="order-body">
                    <td colspan="2">
                        <div class="product-img-wrap">
                            <img src="<?php echo e(get_storage_file_url(optional($item->image)->path, 'small'), false); ?>" alt="<?php echo e($item->slug, false); ?>" title="<?php echo e($item->slug, false); ?>" />
                        </div>
                        <div class="product-info">
                            
                            
                            <?php
                                $html ='';
                                if(isset($order->cancellation))
                                {   
                                    $item_inventory_ids ."<br>";
                                    // $arr2 = [];
                                    $arr1 =json_decode($order->cancellation->exchnage_return_option, true);
                                    foreach ($arr1 as $key => $value) {
                                        
                                        if($key == $item_inventory_ids)
                                        {
                                            // echo $arr1[$key];
                                            $html .= "<span class='label label-danger indent10' style='margin-left: 0 !important'>".strtoupper($arr1[$key])." REQUESTED</span><br>";
                                        }
                                        
                                    }     
                                }
                                                       
                                ?>
                                
                                <?php echo $html; ?>

                            <?php if($order->cancellation && $order->cancellation->isItemInRequest($item->id)): ?>
                            <?php endif; ?>
                            <a href="<?php echo e(route('show.product', $item->slug), false); ?>" class="product-info-title" style="display: inline;"><?php echo e($title, false); ?></a>
                            <br>
                            <a href="<?php echo e(route('show.product', $item->slug), false); ?>" class="product-info-title" style="display: inline;"><?php echo e($size, false); ?></a>
                            <br>
                            <a href="<?php echo e(route('show.product', $item->slug), false); ?>" class="product-info-title" style="display: inline;"><?php echo e($item->brand, false); ?></a>

                            
                            <div class="order-info-amount">
                                
                                <span>$<?php echo e(number_format($item->pivot->unit_price, 2, '.',''), false); ?> x <?php echo e($item->pivot->quantity, false); ?></span>
                            </div>
                        </div>
                    </td>

                    <?php if($loop->first): ?>
                        <td rowspan="<?php echo e($loop->count, false); ?>" class="order-actions">
                            
                            <a href="<?php echo e(url('stylist/order/cancel'), false); ?>"
                                        class="btn btn-default btn-sm btn-block flat"><?php echo app('translator')->get('theme.button.Exchange_Return'); ?></a>
                            <?php if (! ($order->isCanceled())): ?>
                                <?php if($order->canBeCanceled()): ?>
                                    <?php echo Form::model($order, ['method' => 'PUT', 'route' => ['order.cancel', $order]]); ?>

                                    <?php echo Form::button('<i class="fas fa-times-circle-o"></i> ' . trans('theme.cancel_order'), ['type' =>'submit', 'class' => 'confirm btn btn-default btn-block flat', 'data-confirm' =>trans('theme.confirm_action.cant_undo')]); ?>

                                    <?php echo Form::close(); ?>

                                    <?php if($order->canTrack()): ?>
                                        <a href="<?php echo e(route('order.track', $order), false); ?>" class="btn btn-black btn-sm btn-block flat"><i class="fas fa-map-marker"></i> <?php echo app('translator')->get('theme.button.track_order'); ?></a>
                                    <?php endif; ?>
                                    <?php if($order->isFulfilled()): ?>
                                        <?php if($order->canRequestReturn()): ?>
                                            
                                                
                                                
                                            <a href="<?php echo e(route('cancellation.form', ['order' => $order, 'action' => 'return']), false); ?>" class="modalAction btn btn-default btn-sm btn-block flat">
                                                
                                                Exchange/Return</a>
                                        <?php endif; ?>
                                        <?php if (! ($order->goods_received)): ?>
                                            <?php echo Form::model($order, ['method' => 'PUT', 'route' => ['goods.received', $order]]); ?>

                                            <?php echo Form::button(trans('theme.button.confirm_goods_received'), ['type' => 'submit', 'class' => 'confirm btn btn-primary btn-block flat', 'data-confirm' => trans('theme.confirm_action.goods_received')]); ?>

                                            <?php echo Form::close(); ?>

                                        <?php endif; ?>
                                    <?php endif; ?>
                                <?php endif; ?>
                            <?php endif; ?>
                        </td>
                    <?php endif; ?>
                </tr> <!-- /.order-body -->
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php if($order->message_to_customer): ?>
                <tr class="message_from_seller">
                    <td colspan="3">
                        <p>
                            <strong><?php echo app('translator')->get('theme.message_from_seller'); ?>: </strong> <?php echo e($order->message_to_customer, false); ?>

                        </p>
                    </td>
                </tr>
            <?php endif; ?>
            <?php if($order->buyer_note): ?>
            <tr class="order-info-footer">
                <td colspan="3">
                    <p class="order-detail-buyer-note">
                        <span><?php echo app('translator')->get('theme.note'); ?>: </span> <?php echo e($order->buyer_note, false); ?>

                    </p>
                </td>
            </tr>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>

<?php else: ?>
<div class="clearfix space50"></div>
<p class="lead text-center space50">
    <?php echo app('translator')->get('theme.no_order_history'); ?>
    
    
</p>
<?php endif; ?>

<div class="row pagenav-wrapper">
    <?php echo e($orders->links('theme::layouts.pagination'), false); ?>

</div><!-- /.row .pagenav-wrapper -->
<div class="clearfix space20"></div>
<?php /**PATH C:\wamp64\www\hype-dappr\public\themes\default/views/contents/orders.blade.php ENDPATH**/ ?>