<?php
 $stylist_body_class = ' my_order_details_page_container hide_header_footer  ';
?>



<?php $__env->startSection('content'); ?>
  <!-- HEADER SECTION -->
  <?php echo $__env->make('theme::headers.order_detail', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <!-- CONTENT SECTION -->
  <?php echo $__env->make('theme::contents.order_detail', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <!-- BROWSING ITEMS -->
  
<?php $__env->stopSection(); ?>

<?php echo $__env->make('theme::layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\hype-dappr\public\themes\default/views/order_detail.blade.php ENDPATH**/ ?>