<?php
 $stylist_body_class = ' order_complete_place  ';
?>





<?php $__env->startSection('content'); ?>
  <!-- breadcrumb -->
  <?php echo $__env->make('theme::headers.cart_page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <!-- CONTENT SECTION -->
  <?php echo $__env->make('theme::contents.cart_page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <div class="space50"></div>

  <!-- BROWSING ITEMS -->
  
  
<?php $__env->stopSection(); ?>


<?php $__env->startSection('scripts'); ?>
  <?php echo $__env->make('theme::modals.ship_to', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php echo $__env->make('theme::scripts.cart', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php echo $__env->make('theme::scripts.dynamic_checkout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('theme::layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\hype-dappr\public\themes\default/views/cart.blade.php ENDPATH**/ ?>