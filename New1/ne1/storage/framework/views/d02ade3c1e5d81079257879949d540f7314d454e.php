<section class="store-cover-img-wrapper">
  <div class="banner banner-o-hid cover-img-wrapper" style="background-image:url( <?php echo e(get_cover_img_src($shop, 'shop'), false); ?> );">
    <div class="page-cover-caption">
      <img src="<?php echo e(get_storage_file_url(optional($shop->logoImage)->path, 'thumbnail'), false); ?>" class="img-rounded">
      <h5 class="page-cover-title">
        <a href="<?php echo e(route('show.store', $shop->slug), false); ?>">
          <?php echo $shop->getQualifiedName(); ?>

        </a>
      </h5>
      <?php if($shop->feedbacks->count()): ?>
        <span class="small">
          <?php echo $__env->make('theme::layouts.ratings', ['ratings' => $shop->feedbacks->avg('rating'), 'count' => $shop->feedbacks->count(), 'shop' => true], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </span>
      <?php endif; ?>
      <p class="member-since small"><?php echo e(trans('theme.member_since'), false); ?>: <?php echo e($shop->created_at->diffForHumans(), false); ?></p>
    </div>
  </div>
</section>
<?php /**PATH /home/dappr/public_html/test.dappr.com.au/public/themes/default/views/banners/shop_cover.blade.php ENDPATH**/ ?>