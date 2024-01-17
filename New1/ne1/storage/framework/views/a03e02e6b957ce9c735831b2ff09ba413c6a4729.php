<div class="product-info">
  <?php if($item->product->manufacturer->slug): ?>
    <a href="<?php echo e(route('show.brand', $item->product->manufacturer->slug), false); ?>" class="product-info-seller-name">
      <i class="fal fa-crown small"></i> <?php echo $item->product->manufacturer->name; ?>

    </a>
  <?php else: ?>
    <a href="<?php echo e(route('show.store', $item->shop->slug), false); ?>" class="product-info-seller-name">
      <i class="far fa-store"></i> <?php echo $item->shop->getQualifiedName(); ?>

    </a>
  <?php endif; ?>

  <h5 class="product-info-title space10" data-name="product_name"><?php echo $item->title; ?></h5>

  <?php if($item->ratings): ?>
    <?php echo $__env->make('theme::layouts.ratings', ['ratings' => $item->ratings, 'count' => $item->ratings_count], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php endif; ?>

  <?php echo $__env->make('theme::layouts.pricing', ['item' => $item], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <div class="row">
    <div class="col-6 nopadding-right">
      <div class="product-info-availability space10">
        <div class="d-none d-sm-inline-block"><?php echo app('translator')->get('theme.availability'); ?>:</div>
        <span><?php echo e($item->availability, false); ?></span>
      </div>
    </div>

    <?php if(config('system_settings.show_item_conditions')): ?>
      <div class="col-6 nopadding-left">
        <div class="product-info-condition space10">
          <div class="d-none d-sm-inline-block"><?php echo app('translator')->get('theme.condition'); ?>:</div>
          <span><b id="item_condition"><?php echo $item->condition; ?></b></span>

          <?php if($item->condition_note): ?>
            <sup>
              <i class="fas fa-question" id="item_condition_note" data-toggle="tooltip" title="<?php echo $item->condition_note; ?>" data-placement="top"></i>
            </sup>
          <?php endif; ?>
        </div>
      </div>
    <?php endif; ?>
  </div><!-- /.row -->

  <div class="row mb-2">
    <div class="col-6 nopadding-right">
      <a href="javascript:void(0)" data-link="<?php echo e(route('wishlist.add', $item), false); ?>" class="btn btn-link add-to-wishlist">
        <i class="far fa-heart"></i> <?php echo app('translator')->get('theme.button.add_to_wishlist'); ?>
      </a>
    </div>

    <div class="col-6 nopadding-left">
      <?php if('quickView.product' == Route::currentRouteName()): ?>
        <a href="<?php echo e(route('show.store', $item->shop->slug), false); ?>" class="btn btn-link">
          <i class="far fa-list"></i> <?php echo app('translator')->get('theme.more_items_from_this_seller', ['seller' => $item->shop->name]); ?>
        </a>
        
        
      <?php else: ?>
        <a href="javascript:void(0);" class="btn btn-link" data-toggle="modal" data-target="<?php echo e(Auth::guard('customer')->check() ? '#contactSellerModal' : '#loginModal', false); ?>">
          <i class="far fa-envelope"></i> <?php echo app('translator')->get('theme.button.contact_seller'); ?>
        </a>
      <?php endif; ?>
    </div>
  </div><!-- /.row -->
</div><!-- /.product-info -->

<?php echo $__env->make('theme::layouts.share_btns', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\wamp64\www\hype-dappr\public\themes\default/views/layouts/product_info.blade.php ENDPATH**/ ?>