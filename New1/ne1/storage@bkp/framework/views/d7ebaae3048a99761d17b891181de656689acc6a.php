<?php $__env->startComponent('mail::layout'); ?>

<?php $__env->slot('header'); ?>
<?php $__env->startComponent('mail::header', ['url' => config('app.url')]); ?>
<img src="<?php echo e(get_logo_url('platform', 'full'), false); ?>" width="200px" class="brand-logo" alt="<?php echo e(get_platform_title(), false); ?>" title="<?php echo e(get_platform_title(), false); ?>">

<?php echo $__env->renderComponent(); ?>
<?php $__env->endSlot(); ?>


<?php echo e($slot, false); ?>



<?php if(isset($subcopy)): ?>
<?php $__env->slot('subcopy'); ?>
<?php $__env->startComponent('mail::subcopy'); ?>
<?php echo e($subcopy, false); ?>

<?php echo $__env->renderComponent(); ?>
<?php $__env->endSlot(); ?>
<?php endif; ?>


<?php $__env->slot('footer'); ?>
<?php $__env->startComponent('mail::footer'); ?>
&copy; <?php echo e(date('Y'), false); ?> <?php echo e(get_platform_title(), false); ?>. All rights reserved.
<?php echo $__env->renderComponent(); ?>
<?php $__env->endSlot(); ?>
<?php echo $__env->renderComponent(); ?>
<?php /**PATH /home/dappr/public_html/portal.dappr.com.au/resources/views/vendor/mail/text/message.blade.php ENDPATH**/ ?>