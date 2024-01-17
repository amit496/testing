<?php if(count($featured_brands)): ?>
  <section class="mb-3">
    <div class="feature-brand">
      <div class="container">
        <div class="feature-brand__inner">
          <div class="bundle__header">
            <div class="sell-header sell-header--bold">
              <div class="sell-header__title">
                <h2><?php echo e(trans('theme.featured_brand'), false); ?></h2>
              </div>
              <div class="header-line">
                <span></span>
              </div>
            </div>
          </div>
          <div class="feature-brand-content">
            <div class="row">
              <?php $__currentLoopData = $featured_brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-lg-4 col-12">
                  <div class="feature-brand__img mb-3">
                    <a href="<?php echo e(route('show.brand', $brand->slug), false); ?>">
                      <img src="<?php echo e(get_storage_file_url(optional($brand->featureImage)->path, 'full'), false); ?>" alt="<?php echo e($brand->name, false); ?>">
                    </a>
                  </div>
                </div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
<?php endif; ?>
<?php /**PATH C:\wamp64\www\hype-dappr\public\themes\default/views/sections/featured_brands.blade.php ENDPATH**/ ?>