<?php $__env->startSection('content'); ?>
  <!-- HEADER SECTION -->
  <?php echo $__env->make('theme::headers.product_page', ['product' => $item], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <!-- CONTENT SECTION -->
  <?php echo $__env->make('theme::contents.product_page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <div class="clearfix space50"></div>

  <!-- RELATED ITEMS -->
  <section>
    <div class="feature">
      <div class="container">
        <div class="feature__inner">
          <div class="feature__header">
            <div class="sell-header sell-header--bold">
              <div class="sell-header__title">
                <h2><?php echo trans('theme.related_items'); ?></h2>
              </div>
              <div class="header-line">
                <span></span>
              </div>
              <div class="header-line">
                <span></span>
              </div>
              <div class="best-deal__arrow">
              </div>
            </div>
          </div>

          <div class="feature__items">
            <div class="feature__items-inner">

              <?php echo $__env->make('theme::partials._product_horizontal', ['products' => $related], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <div class="clearfix space20"></div>

  <!-- BROWSING ITEMS -->
  <?php echo $__env->make('theme::sections.recent_views', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <!-- MODALS -->
  <?php echo $__env->make('theme::modals.shopReviews', ['shop' => $item->shop], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <?php if(Auth::guard('customer')->check()): ?>
    <?php echo $__env->make('theme::modals.contact_seller', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
  <?php if(is_chat_enabled($item->shop)): ?>
    <?php echo $__env->make('theme::scripts.chatbox', ['shop' => $item->shop, 'agent' => $item->shop->owner, 'agent_status' => trans('theme.online')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php endif; ?>

  <?php echo $__env->make('theme::modals.ship_to', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php echo $__env->make('theme::scripts.product_page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('theme::layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\hype-dappr\public\themes\default/views/product.blade.php ENDPATH**/ ?>