<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('massDelete', \App\Models\Category::class)): ?>
  <td>
    <?php if (! ($category->products_count)): ?>
      <input id="<?php echo e($category->id, false); ?>" type="checkbox" class="massCheck">
    <?php endif; ?>
  </td>
<?php endif; ?>
<?php /**PATH C:\wamp64\www\hype-dappr\resources\views/admin/category/partials/checkbox.blade.php ENDPATH**/ ?>