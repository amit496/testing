<?php
 $stylist_body_class = ' checkout_page_container hide_header_footer  ';
?>


<div class="product_check_out">
    <?php $__env->startSection('content'); ?>
    <!-- breadcrumb -->
    <?php echo $__env->make('theme::headers.checkout_page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!-- CONTENT SECTION -->
    <?php echo $__env->make('theme::contents.checkout_page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="space30"></div>
    <?php $__env->stopSection(); ?>
</div>

<?php $__env->startSection('scripts'); ?>
<?php echo $__env->make('scripts.checkout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('theme::scripts.dynamic_checkout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('theme::layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\hype-dappr\public\themes\default/views/checkout.blade.php ENDPATH**/ ?>