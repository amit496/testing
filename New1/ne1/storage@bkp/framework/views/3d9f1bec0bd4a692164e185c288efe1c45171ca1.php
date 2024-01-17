<div class="modal fade" id="shipToModal" tabindex="-1" role="dialog" aria-labelledby="shipToModal" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
    <div class="modal-content p-2">
      <div class="modal-header p-3">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-title text-center">
          <h4>
            <i class="fa fa-map-marker-alt"></i>
            <?php echo e(trans('theme.choose_delivery_location'), false); ?>

          </h4>
        </div>

        <div class="d-flex flex-column text-center">
          <?php echo Form::open(['route' => ['register'], 'data-toggle' => 'validator', 'id' => 'shipToForm']); ?>

          <?php echo e(Form::hidden('cart', null, ['id' => 'cartinfo']), false); ?> 

          <div class="row select-box-wrapper">
            <div class="form-group col-md-12">
              <label for="shipTo_country" class="text-left">
                <?php echo e(trans('theme.country'), false); ?>:
              </label>
              <select name="ship_to" id="shipTo_country" required="required">
                <?php $__currentLoopData = $business_areas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <option value="<?php echo e($country->id, false); ?>"><?php echo e($country->name, false); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </select>
              <div class="help-block with-errors"></div>
            </div>
          </div>

          <div class="row select-box-wrapper hidden" id="state_id_select_wrapper">
            <div class="form-group col-md-12">
              <label for="shipTo_state" class="text-left">
                <?php echo e(trans('theme.placeholder.state'), false); ?>:
              </label>
              <select name="state_id" id="shipTo_state" class="selectBoxIt"></select>
              <div class="help-block with-errors"></div>
            </div>
          </div>

          <p class="small text-left"><i class="fas fa-info-circle"></i> <?php echo trans('theme.delivery_locations_info'); ?></p>

          <input class="btn btn-primary btn-block btn-lg btn-round mt-3" type="submit" value="<?php echo e(trans('theme.button.submit'), false); ?>">
          <?php echo Form::close(); ?>

        </div>
      </div>
      <div class="modal-footer d-flex justify-content-center">
        <div class="signup-section">
        </div>
      </div>
    </div>
  </div>
</div> <!-- /#passwordResetModal -->
<?php /**PATH C:\wamp64\www\hype-dappr\public\themes\default/views/modals/ship_to.blade.php ENDPATH**/ ?>