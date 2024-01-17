<?php $__env->startComponent('mail::message'); ?>
<?php echo e(trans('notifications.customer_password_reset.message'), false); ?>

<br/>

<?php $__env->startComponent('mail::button', ['url' => $url, 'color' => 'blue']); ?>
<?php echo e(trans('notifications.customer_password_reset.button_text'), false); ?>

<?php echo $__env->renderComponent(); ?>

<?php echo e(trans('messages.thanks'), false); ?>,<br>
<?php echo e(get_platform_title(), false); ?>

<?php echo $__env->renderComponent(); ?>
<?php /**PATH /home/dappr/public_html/test.dappr.com.au/resources/views/admin/mail/auth/customer_password_reset.blade.php ENDPATH**/ ?>