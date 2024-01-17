

  <div class="copyright-area hide-bottom"  style="display: <?php if(isset($show_footer_qa_incomplete_edit_time)) { echo $show_footer_qa_incomplete_edit_time; }  else if(isset($hide_bottom)) { echo $hide_bottom; } else { echo 'block'; } ?>;">
  <div class="footer" style="background-color: #000000;">



  <div class="container">
    <div class="row">
      <!-- <div class="col-md-8">
        <ul class="links-list">
          <?php $__currentLoopData = $pages->where('position', 'copyright_area'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li><a href="<?php echo e(get_page_url($page->slug), false); ?>" target="_blank"><?php echo e($page->title, false); ?></a></li>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          <li><a href="<?php echo e(url('admin/dashboard'), false); ?>"><?php echo e(trans('theme.nav.merchant_dashboard'), false); ?></a></li>
        </ul>
      </div> -->
      <div class="col-md-12">
        <p class="copyright-text text-center">© <?php echo e(date('Y'), false); ?> <a href="<?php echo e(url('/'), false); ?>"><?php echo e(get_platform_title(), false); ?></a></p>
      </div>
    </div>
  </div>
</div> <!-- /.copyright-area -->
<?php /**PATH C:\wamp64\www\hype-dappr\public\themes\default/views/nav/copyright.blade.php ENDPATH**/ ?>