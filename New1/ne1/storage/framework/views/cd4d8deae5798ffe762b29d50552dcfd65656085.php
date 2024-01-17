<?php $__env->startSection('content'); ?>
  <!-- SHOP COVER IMAGE -->
  <?php echo $__env->make('theme::banners.shop_cover', ['shop' => $shop], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <!-- CONTENT SECTION -->
  <?php if(\Route::currentRouteName() == 'shop.products'): ?>
    <?php echo $__env->make('theme::headers.shop_page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('theme::contents.shop_products', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php else: ?>
    <?php echo $__env->make('theme::contents.shop_page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php endif; ?>

  <!-- BROWSING ITEMS -->
  <?php echo $__env->make('theme::sections.recent_views', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <!-- MODALS -->
  

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
  <?php if(is_chat_enabled($shop)): ?>
    <?php echo $__env->make('theme::scripts.chatbox', ['shop' => $shop, 'agent' => $shop->owner, 'agent_status' => trans('theme.online')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('theme::layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dappr/public_html/test.dappr.com.au/public/themes/default/views/shop.blade.php ENDPATH**/ ?>