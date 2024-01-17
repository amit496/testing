<?php $__env->startSection('content'); ?>
  <!-- HEADER SECTION -->
  

  

  <!-- CONTENT SECTION -->
  <section>
    <div class="container">
      <div class="row">
        <div class="col-md-2 nopadding">
          <?php echo $__env->make('theme::nav.account_page_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div><!-- /.col-md-2 -->

        <div class="col-md-10 nopadding-right">
          <?php if(isset($content)): ?>
            <?php echo $content; ?>

          <?php else: ?>
            <?php echo $__env->make('theme::contents.' . $tab, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
          <?php endif; ?>
        </div><!-- /.col-md-10 -->
      </div><!-- /.row -->
    </div><!-- /.container -->
  </section>

  <!-- BROWSING ITEMS -->
  
<?php $__env->stopSection(); ?>

<?php if(request()->is('*/wallet/deposit/form')): ?>
  <?php $__env->startSection('scripts'); ?>
    
    <?php echo $__env->make('wallet::customer.scripts.deposit', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php $__env->stopSection(); ?>
<?php endif; ?>

<?php echo $__env->make('theme::layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\hype-dappr\public\themes\default/views/dashboard.blade.php ENDPATH**/ ?>