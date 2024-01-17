<div class="modal-dialog modal-md modal-dialog-centered" role="document">
  <div class="modal-content p-2">
    <div class="modal-header p-3">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
      <div class="form-title text-center">
        <h4>
          <?php echo e(trans('theme.button.add_new_address'), false); ?>

        </h4>
      </div>

      <div class="d-flex flex-column">
        <?php echo Form::open(['route' => 'my.address.save', 'data-toggle' => 'validator']); ?>

        <?php if(isset($address_types)): ?>
          <div class="form-group">
            <?php echo Form::select('address_type', $address_types, null, ['class' => 'form-control flat', 'placeholder' => trans('theme.placeholder.address_type') . '*', 'required']); ?>

            <div class="help-block with-errors"></div>
          </div>
        <?php endif; ?>

        <?php echo $__env->make('partials.address_form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <button type="submit" class="btn btn-primary btn-block btn-lg btn-round mt-3">
          
          <?php echo e(trans('theme.button.submit'), false); ?>

        </button>
        <?php echo Form::close(); ?>

      </div>
      <small class="help-block text-muted text-left mt-4">* <?php echo e(trans('theme.help.required_fields'), false); ?></small>
    </div>

    <div class="modal-footer d-flex justify-content-center">
      <div class="signup-section">
      </div>
    </div>
  </div>
</div>
<?php /**PATH C:\wamp64\www\hype-dappr\public\themes\default/views/modals/_create_address.blade.php ENDPATH**/ ?>