<section class="mt-1 mb-0">
  <div class="container">
    <div class="featured-categories owl-carousel hide">
      <?php $__currentLoopData = $featured_category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="featured-category">
          <a href="<?php echo e(route('category.browse', $item->slug), false); ?>">
            <figure>
              <img src="<?php echo e(get_storage_file_url(optional($item->featureImage)->path, 'full'), false); ?>" alt="<?php echo e($item->name, false); ?>">
            </figure>

            <div class="featured-category-content py-3">
              <h3 class="mb-3"><?php echo e($item->name, false); ?></h3>
              <span> <?php echo e(trans('theme.listings_count', ['count' => $item->listings_count]), false); ?></span>
            </div>
          </a>
        </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
  </div>
</section>
<?php /**PATH C:\wamp64\www\hype-dappr\public\themes\default/views/sections/featured_category-new.blade.php ENDPATH**/ ?>