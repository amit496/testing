<div class="modal-dialog modal-lg">
  <div class="modal-content">
    <?php echo Form::open(['route' => 'address.store', 'files' => true, 'id' => 'form', 'data-toggle' => 'validator']); ?>

    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      <?php echo e(trans('app.form.form'), false); ?>

    </div>
    <div class="modal-body">

      <?php if(isset($addressable_id)): ?>
        <?php echo Form::hidden('addressable_id', $addressable_id); ?>

        <?php echo Form::hidden('addressable_type', $addressable_type); ?>

      <?php endif; ?>

      <?php echo $__env->make('address._form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    </div>
    <div class="modal-footer">
      <?php echo Form::submit(trans('app.form.save'), ['class' => 'btn btn-flat btn-new']); ?>

    </div>
    <?php echo Form::close(); ?>

  </div> <!-- / .modal-content -->
</div> <!-- / .modal-dialog -->
<?php /**PATH /home/dappr/public_html/test.dappr.com.au/resources/views/address/_create.blade.php ENDPATH**/ ?>