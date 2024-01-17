<?php $__env->startComponent('mail::message'); ?>
#<?php echo e(trans('notifications.cancellation_request_acknowledgement.greeting', ['customer' => $order->customer->getName()]), false); ?>


<?php echo e(trans('notifications.cancellation_request_acknowledgement.message', ['order' => $order->order_number]), false); ?>

<br/>

<?php $__env->startComponent('mail::button', ['url' => $url, 'color' => 'blue']); ?>
<?php echo e(trans('notifications.cancellation_request_acknowledgement.button_text'), false); ?>

<?php echo $__env->renderComponent(); ?>

<?php echo $__env->make('admin.mail.order._order_detail_panel', ['order_detail' => $order], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo e(trans('messages.thanks'), false); ?>,<br>
<?php echo e($order->shop->name  . ', ' . get_platform_title(), false); ?>

<?php echo $__env->renderComponent(); ?>
<?php /**PATH /home/dappr/public_html/test.dappr.com.au/resources/views/admin/mail/order/cancellation_request_acknowledgement.blade.php ENDPATH**/ ?>