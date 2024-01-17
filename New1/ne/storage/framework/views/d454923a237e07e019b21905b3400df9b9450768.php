<section class="mb-4">
  <div class="shell-banner">
    <div class="container">
      <div class="shell-banner__inner">
        <div class="row">
          <?php $__currentLoopData = $banners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-lg-<?php echo e($banner['columns'], false); ?> col-12 my-2 px-2">
              <div class="image-banner <?php echo e($banner['columns'] > 11 ? 'single-banner' : '', false); ?>">
                <div class="shell-banner__box <?php echo e(!empty($banner['effect']) ? 'outline-effect' : '', false); ?>">
                  <div class="shell-banner__img">
                    <img src="<?php echo e(isset($banner['feature_image']['path']) && Storage::exists($banner['feature_image']['path']) ? get_storage_file_url($banner['feature_image']['path'], 'full') : '', false); ?>" alt="<?php echo e($banner['title'] ?? 'Banner Image', false); ?>" title="<?php echo e($banner['title'] ?? 'Banner Image', false); ?>">
                  </div>

                  <div class="shell-banner__overlay <?php echo e(isset($banner['color']) ? 'black' : '', false); ?>">
                    <div class="single-banner__texts <?php echo e(isset($banner['color']) ? 'black' : '', false); ?> ">
                      <div class=shell-banner__overlay-title>
                        <h3><?php echo $banner['title']; ?></h3>
                      </div>

                      <div class="shell-banner__overlay-text">
                        <p><?php echo $banner['description']; ?></p>
                      </div>
                    </div>

                    <?php if($banner['link']): ?>
                      <div class="neckbands__button">
                        <a href="<?php echo e($banner['link'], false); ?>"><?php echo $banner['link_label'] ? $banner['link_label'] . ' <i class="fas fa-caret-right"></i>' : ''; ?></a>
                      </div>
                    <?php endif; ?>

                    
                  </div>
                </div>
                
              </div>
            </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
      </div>
    </div>
  </div>
</section>
<?php /**PATH C:\wamp64\www\hype-dappr\public\themes\default/views/sections/banners.blade.php ENDPATH**/ ?>