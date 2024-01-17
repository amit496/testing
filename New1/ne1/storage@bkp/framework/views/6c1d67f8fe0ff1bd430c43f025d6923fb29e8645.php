<?php $__env->startSection('content'); ?>
  <!-- CATEGORY COVER IMAGE -->
  <?php echo $__env->make('theme::banners.category_cover', ['category' => $categorySubGroup], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <!-- HEADER SECTION -->
  <?php echo $__env->make('theme::headers.category_sub_group_page', ['category' => $categorySubGroup], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <!-- CONTENT SECTION -->
  <?php echo $__env->make('theme::contents.category_page', ['category' => $categorySubGroup], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <!-- BROWSING ITEMS -->
  <?php echo $__env->make('theme::sections.recent_views', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <!-- bottom Banner -->
  <?php echo $__env->make('theme::banners.bottom', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('theme::layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\hype-dappr\public\themes\default/views/category_sub_group.blade.php ENDPATH**/ ?>