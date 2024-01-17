<?php $__env->startSection('content'); ?>
  <section>
    <div class="container">
      <div class="clearfix space50"></div>
      <p class="lead text-center space50">
        <?php echo trans('theme.item_not_available'); ?><br /><br />
        <a href="<?php echo e(url('/'), false); ?>" class="btn btn-primary btn-sm flat"><?php echo app('translator')->get('theme.button.shop_from_other_categories'); ?></a>
      </p>
    </div> <!-- /.container -->
  </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('theme::layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dappr/public_html/portal.dappr.com.au/public/themes/default/views/exceptions/item_not_available.blade.php ENDPATH**/ ?>