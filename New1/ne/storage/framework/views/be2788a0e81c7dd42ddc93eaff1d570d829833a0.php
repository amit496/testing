<?php $__env->startComponent('mail::message'); ?>
#<?php echo e(trans('notifications.new_message.greeting', ['receiver' => $receiver]), false); ?>


<?php echo trans('notifications.new_message.message', ['message' => $message->message]); ?>

<br/>

<?php if (! (isset($guest) && $guest)): ?>
<?php $__env->startComponent('mail::button', ['url' => $url, 'color' => 'blue']); ?>
<?php echo e(trans('notifications.new_message.button_text'), false); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>

<?php echo e(trans('messages.thanks'), false); ?>,<br>
<?php echo e(get_platform_title(), false); ?>

<?php echo $__env->renderComponent(); ?>
<?php /**PATH /home/dappr/public_html/portal.dappr.com.au/resources/views/admin/mail/message/new_message.blade.php ENDPATH**/ ?>