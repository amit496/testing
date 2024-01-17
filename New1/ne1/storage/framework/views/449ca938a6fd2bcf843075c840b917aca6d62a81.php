<div class="clearfix">
  <?php
    $pImg = get_product_img_src($item, 'large');
  ?>
  <a href="<?php echo e($pImg, false); ?>" id="<?php echo e($zoomID ?? 'jqzoom', false); ?>" data-rel="gal-1">
    <img class="product-img" data-name="product_image" src="<?php echo e($pImg, false); ?>" alt="<?php echo e($item->title, false); ?>" title="<?php echo e($item->title, false); ?>" />
  </a>
</div>

<ul class="jqzoom-thumbs mt-2">
  <?php
    $item_images = $item->images->count() ? $item->images : $item->product->images;
    
    if (isset($variants)) {
        // Remove images of current items from the variants imgs
        $other_images = $variants
            ->pluck('images')
            ->flatten(1)
            ->filter(function ($value, $key) use ($item) {
                return $value->imageable_id != $item->id;
            });
        $item_images = $item_images->concat($other_images);
    }
  ?>

  <?php $__currentLoopData = $item_images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php if(!$img->path) continue; ?>

    <?php
      $fImg = get_storage_file_url($img->path, 'full');
    ?>

    <li>
      <a class="d-flex flex-wrap align-items-center <?php echo e($img->path == optional($item->image)->path ? 'zoomThumbActive' : '', false); ?>" href="javascript:void(0)" data-rel="{gallery:'gal-1', smallimage: '<?php echo e($fImg, false); ?>', largeimage: '<?php echo e($fImg, false); ?>'}">
        <img src="<?php echo e(get_storage_file_url($img->path, 'thumbnail'), false); ?>" alt="Thumb" title="<?php echo e($item->title, false); ?>" />
      </a>
    </li>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</ul> <!-- /.jqzoom-thumbs -->
<?php /**PATH C:\wamp64\www\hype-dappr\public\themes\default/views/layouts/jqzoom.blade.php ENDPATH**/ ?>