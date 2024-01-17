<?php if(count($trending_categories)): ?>
  <section>
    <div class="feature">
      <div class="container">
        <div class="feature__inner">
          <div class="feature__header">
            <div class="sell-header sell-header--bold">
              <div class="sell-header__title">
                <h2><?php echo trans('theme.trending_now'); ?></h2>
              </div>

              <div class="header-line">
                <span></span>
              </div>

              <div class="feature__tabs">
                <ul>
                  <?php $__currentLoopData = $trending_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trendingCat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="<?php echo e($loop->first ? 'active' : '', false); ?>">
                      <a href="#trending-<?php echo e($trendingCat->slug, false); ?>">
                        <?php echo $trendingCat->name; ?>

                      </a>
                    </li>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
              </div>

              <div class="header-line">
                <span></span>
              </div>

              <div class="best-deal__arrow">
                
              </div>
            </div>
          </div>

          <div class="feature__items">
            <?php $__currentLoopData = $trending_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trendingCat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <div class="feature__items-inner" id="trending-<?php echo e($trendingCat->slug, false); ?>">
                <?php echo $__env->make('theme::partials._product_horizontal', ['products' => $trendingCat->listings], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
              </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>
        </div>
      </div>
    </div>
  </section>
<?php endif; ?>
<?php /**PATH C:\wamp64\www\hype-dappr\public\themes\default/views/sections/trending_now.blade.php ENDPATH**/ ?>