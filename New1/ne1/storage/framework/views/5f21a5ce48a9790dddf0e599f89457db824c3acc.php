<section class="mb-2">
  <div id="ei-slider" class="ei-slider">
    <ul class="ei-slider-large">
      <?php $__currentLoopData = $sliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if(isset($slider['mobile_image']['path'])): ?>
          <li>
            <a href="<?php echo e($slider['link'], false); ?>">
              <img src="<?php echo e(get_storage_file_url($slider['mobile_image']['path'], 'full'), false); ?>" alt="<?php echo e($slider['title'] ?? 'Slider Image ' . $loop->count, false); ?>">
            </a>
          </li>
        <?php endif; ?>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul> <!-- ei-slider-large -->

    
    <ul class="ei-slider-thumbs">
      <li class="ei-slider-element">Current</li>

      <?php $__currentLoopData = $sliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if(isset($slider['mobile_image']['path'])): ?>
          <li></li>
        <?php endif; ?>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
  </div>
</section>
<?php /**PATH /home/dappr/public_html/portal.dappr.com.au/public/themes/default/views/mobile/slider.blade.php ENDPATH**/ ?>