<?php $__env->startSection('content'); ?>
  <!-- PAGE COVER IMAGE -->
  <?php echo $__env->make('theme::banners.page_cover', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <!-- CONTENT SECTION -->
  <div class="clearfix space20"></div>
  <section>
    <div class="container">
      <div class="row">
        <div class="col-12">
          <?php echo $page->content; ?>

        </div><!-- /.col-12 -->
      </div><!-- /.row -->
    </div><!-- /.container -->
  </section>

  <!-- For contact page only -->
  <input type="hidden" id="customer_last_anwser" value="<?php if(isset($customer_last_anwser) && ($customer_last_anwser != '')){echo $customer_last_anwser;}else{echo '';} ?>">
  <?php if(\App\Models\Page::PAGE_CONTACT_US == $page->slug): ?>
    <?php echo $__env->make('theme::contents.contact_us', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php endif; ?>

  <!-- BROWSING ITEMS -->
  
<?php $__env->stopSection(); ?>

<?php echo $__env->make('theme::layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dappr/public_html/test.dappr.com.au/public/themes/default/views/page.blade.php ENDPATH**/ ?>