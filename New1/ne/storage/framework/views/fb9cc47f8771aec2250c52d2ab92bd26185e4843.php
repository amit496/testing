<?php echo $__env->make('theme::contents.product_list_top_filter', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="row product-list">
  <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="col-12 col-sm-4 col-md-<?php echo e($colum ?? '3', false); ?> p-0">
      <div class="product product-grid-view sc-product-item">
        <ul class="product-info-labels">
          <?php if($item->shop->isVerified() && Route::current()->getName() != 'show.store'): ?>
            <li><?php echo app('translator')->get('theme.from_verified_seller'); ?></li>
          <?php endif; ?>

          <?php $__currentLoopData = $item->getLabels(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li><?php echo $label; ?></li>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>

        <div class="product-img-wrap">
          <img class="product-img-primary" src="<?php echo e(get_product_img_src($item, 'medium'), false); ?>" alt="<?php echo e($item->title, false); ?>" title="<?php echo e($item->title, false); ?>" />

          <img class="product-img-alt" src="<?php echo e(get_product_img_src($item, 'medium', 'alt'), false); ?>" alt="<?php echo e($item->title, false); ?>" title="<?php echo e($item->title, false); ?>" />

          <a class="product-link" href="<?php echo e(route('show.product', $item->slug), false); ?>"></a>
        </div>

        <div class="product-actions btn-group">
          <a class="btn btn-default flat add-to-wishlist" href="javascript:void(0)" data-link="<?php echo e(route('wishlist.add', $item), false); ?>">
            <i class="far fa-heart" data-toggle="tooltip" title="<?php echo app('translator')->get('theme.button.add_to_wishlist'); ?>"></i> <span><?php echo app('translator')->get('theme.button.add_to_wishlist'); ?></span>
          </a>

          <a class="btn btn-default flat itemQuickView" href="<?php echo e(route('quickView.product', $item->slug), false); ?>">
            <i class="far fa-external-link" data-toggle="tooltip" title="<?php echo app('translator')->get('theme.button.quick_view'); ?>"></i> <span><?php echo app('translator')->get('theme.button.quick_view'); ?></span>
          </a>

          <a class="btn btn-primary flat sc-add-to-cart" data-link="<?php echo e(route('cart.addItem', $item->slug), false); ?>">
            <i class="far fa-shopping-cart"></i> <?php echo app('translator')->get('theme.button.add_to_cart'); ?>
          </a>
        </div>

        <div class="product-info">
          <?php echo $__env->make('theme::layouts.ratings', ['ratings' => $item->ratings, 'count' => $item->ratings_count], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
          

          <a href="<?php echo e(route('show.product', $item->slug), false); ?>" class="product-info-title" data-name="product_name"><?php echo e($item->title, false); ?></a>

          <div class="product-info-availability">
            <?php echo app('translator')->get('theme.availability'); ?>: <span><?php echo e($item->stock_quantity > 0 ? trans('theme.in_stock') : trans('theme.out_of_stock'), false); ?></span>
          </div>

          <?php echo $__env->make('theme::layouts.pricing', ['item' => $item], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

          <div class="product-info-desc"> <?php echo $item->description; ?> </div>

          <ul class="product-info-feature-list">
            <?php if(config('system_settings.show_item_conditions')): ?>
              <li><?php echo $item->condition; ?></li>
            <?php endif; ?>
            
          </ul>
        </div><!-- /.product-info -->
      </div><!-- /.product -->
    </div><!-- /.col-md-* -->

    <?php if($loop->iteration % 4 == 0): ?>
      <div class="clearfix"></div>
    <?php endif; ?>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div><!-- /.row .product-list -->

<div class="sep"></div>

<div class="row pagenav-wrapper text-center mb-5 mt-3">
  <?php echo e($products->appends(request()->input())->links('theme::layouts.pagination'), false); ?>

</div><!-- /.row .pagenav-wrapper -->
<?php /**PATH C:\wamp64\www\hype-dappr\public\themes\default/views/contents/product_list.blade.php ENDPATH**/ ?>