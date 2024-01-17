<td>
  <?php if($category->subGroup->group->deleted_at): ?>
    <i class="fa fa-trash-o small"></i>
  <?php endif; ?>
  <?php echo $category->subGroup->group->name; ?>

  &nbsp;<i class="fa fa-angle-double-right small"></i>&nbsp;
  <?php if($category->subGroup->deleted_at): ?>
    <i class="fa fa-trash-o small"></i>
  <?php endif; ?>
  <?php echo $category->subGroup->name; ?>

</td>
<?php /**PATH C:\wamp64\www\hype-dappr\resources\views/admin/category/partials/parent.blade.php ENDPATH**/ ?>