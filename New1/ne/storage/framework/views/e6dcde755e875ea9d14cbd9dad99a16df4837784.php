<td class="row-options">
  <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update', $category)): ?>
    <a href="javascript:void(0)" data-link="<?php echo e(route('admin.catalog.category.edit', $category->id), false); ?>" class="ajax-modal-btn"><i data-toggle="tooltip" data-placement="top" title="<?php echo e(trans('app.edit'), false); ?>" class="fa fa-edit"></i></a>&nbsp;
  <?php endif; ?>
  <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete', $category)): ?>
    <?php echo Form::open(['route' => ['admin.catalog.category.trash', $category->id], 'method' => 'delete', 'class' => 'data-form']); ?>

    <?php echo Form::button('<i class="fa fa-trash-o"></i>', ['type' => 'submit', 'class' => 'confirm ajax-silent', 'title' => trans('app.trash'), 'data-toggle' => 'tooltip', 'data-placement' => 'top']); ?>

    <?php echo Form::close(); ?>

  <?php endif; ?>
</td>
<?php /**PATH C:\wamp64\www\hype-dappr\resources\views/admin/category/partials/options.blade.php ENDPATH**/ ?>