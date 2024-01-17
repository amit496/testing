<?php $__env->startSection('content'); ?>
  <!-- BRAND COVER IMAGE -->
  <section class="brand-cover-img-wrapper">
    <div class="banner banner-o-hid cover-img-wrapper" style="background-image:url( <?php echo e(asset('images/placeholders/brand_cover.jpg'), false); ?> );">
      <div class="page-cover-caption">
        <h5 class="page-cover-title"><?php echo e(trans('theme.all_brands'), false); ?></h5>
        
      </div>
    </div>
  </section>

  <!-- CONTENT SECTION -->
  <?php echo $__env->make('theme::contents.brand_list', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <!-- BROWSING ITEMS -->
  <?php echo $__env->make('theme::sections.recent_views', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('theme::layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\hype-dappr\public\themes\default/views/brand_lists.blade.php ENDPATH**/ ?>