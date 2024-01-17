<section>
  <div class="container full-width mb-4">
    <div class="row">
      <div class="col-md-3 bg-light">
        <?php echo $__env->make('theme::contents.product_list_sidebar_filters', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      </div><!-- /.col-sm-2 -->

      <div class="col-md-9" style="padding-left: 15px;">
        <?php if($products->count()): ?>

          <?php echo $__env->make('theme::contents.product_list', ['colum' => 4], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

          <?php if(config('system_settings.show_seo_info_to_frontend')): ?>
            <div class="clearfix space20"></div>
            <span class="lead"><?php echo $category->meta_title; ?></span>
            <p><?php echo $category->meta_description; ?></p>
            <div class="clearfix space20"></div>
          <?php endif; ?>
        <?php else: ?>
          <p class="lead text-center mt-5">
            <?php echo e(trans('theme.no_product_found'), false); ?>

          </p>
          <div class="my-3 text-center">
            <a href="<?php echo e(url('categories'), false); ?>" class="btn btn-primary flat"><?php echo e(trans('theme.button.shop_from_other_categories'), false); ?></a>
          </div>
        <?php endif; ?>
      </div><!-- /.col-sm-10 -->
    </div><!-- /.row -->
  </div><!-- /.container -->
</section>
<?php /**PATH C:\wamp64\www\hype-dappr\public\themes\default/views/contents/category_page.blade.php ENDPATH**/ ?>