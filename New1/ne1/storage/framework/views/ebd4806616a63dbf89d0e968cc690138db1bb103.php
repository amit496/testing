<td>
  <h5>
    <?php echo e($category->name, false); ?>

    <?php if($category->featured): ?>
      <small class="label label-primary indent10"><?php echo e(trans('app.featured'), false); ?></small>
    <?php endif; ?>
    <?php if (! ($category->active)): ?>
      <span class="label label-default indent5 small"><?php echo e(trans('app.inactive'), false); ?></span>
    <?php endif; ?>
  </h5>
  <?php if($category->description): ?>
    <span class="excerpt-td small">
      <?php echo Str::limit($category->description, 200); ?>

    </span>
  <?php endif; ?>
</td>
<?php /**PATH C:\wamp64\www\hype-dappr\resources\views/admin/category/partials/name.blade.php ENDPATH**/ ?>