<section>
  <div class="container text-center mb-5 mt-0">
    <div class="row thumb-lists">
      <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-6 col-md-2 my-5">
          <span class="vertical-helper"></span>
          <a href="<?php echo e(route('show.brand', $brand->slug), false); ?>" class="">
            <img src="<?php echo e(get_storage_file_url(optional($brand->logoImage)->path, 'logo_lg'), false); ?>">
            <p><?php echo e($brand->name, false); ?></p>
          </a>
        </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div><!-- /.row -->

    <div class="row pagenav-wrapper mt-4">
      <?php echo e($brands->links('theme::layouts.pagination'), false); ?>

    </div>
  </div><!-- /.container -->
</section>
<?php /**PATH C:\wamp64\www\hype-dappr\public\themes\default/views/contents/brand_list.blade.php ENDPATH**/ ?>