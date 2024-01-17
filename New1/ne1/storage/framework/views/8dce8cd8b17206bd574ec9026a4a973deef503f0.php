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
            
            <?php echo e(trans('theme.' . $action . '_items'), false); ?>

          </h4>
        </div>

        <div class="d-flex flex-column">
          <?php echo Form::open(['route' => ['order.submitCancelRequest', $order], 'data-toggle' => 'validator']); ?>

          <?php echo Form::hidden('action', $action); ?>


          <div class="row select-box-wrapper">
            <div class="form-group col-md-12">
              <label for="cancellation_reason_id"><?php echo app('translator')->get('theme.select_reason'); ?>:<sup>*</sup></label>
              <select name="cancellation_reason_id" id="cancellation_reason_id" class="selectBoxIt" required="required">
                <option value=""><?php echo app('translator')->get('theme.select'); ?></option>
                <?php $__currentLoopData = $reasons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $reason): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <option value="<?php echo e($id, false); ?>"><?php echo e($reason, false); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </select>
              <div class="help-block with-errors"></div>
            </div>
          </div>

          <div class="row my-3">
            <div class="form-group col-md-12">
              <label for="product_id"><?php echo app('translator')->get('theme.select_product'); ?>:*</label>
              <ul class="list-group" style="margin-bottom: 0">
                <li class="list-group-item">
                  <?php echo Form::checkbox('all_items', null, $order->cancellation && !$order->cancellation->isPartial() ? 1 : null, ['class' => 'i-check']); ?>

                  <?php echo e(trans('theme.all_items'), false); ?> <small class="text-muted indent10">(<?php echo e($order->quantity . ' ' . trans('theme.items'), false); ?>)</small>
                  <span class="badge badge-primary badge-pill"><?php echo e(get_formated_currency($order->grand_total, true, 2), false); ?></span>
                </li>
                <?php $__currentLoopData = $order->inventories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <li class="list-group-item">
                    <?php echo Form::checkbox('items[]', $item->id, $order->cancellation && $order->cancellation->isItemInRequest($item->id) ? 1 : null, ['class' => 'i-check']); ?>

                    <img src="<?php echo e(get_storage_file_url(optional($item->image)->path, 'tiny'), false); ?>" alt="<?php echo e($item->slug, false); ?>" title="<?php echo e($item->slug, false); ?>" />

                    <span class="small"><?php echo e($item->pivot->item_description, false); ?> <small class="text-muted indent5">x <?php echo e($item->pivot->quantity, false); ?></small></span>

                    <span class="badge badge-primary badge-pill"><?php echo e(get_formated_currency($item->pivot->unit_price * $item->pivot->quantity, true, 2), false); ?></span>
                  </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </ul>
              <div class="help-block with-errors"></div>
            </div>
          </div>

          <div class="form-group">
            <label for="description"><?php echo app('translator')->get('theme.description'); ?>:</label>
            <?php echo Form::textarea('description', null, ['id' => 'description', 'class' => 'form-control', 'rows' => 3, 'placeholder' => trans('theme.placeholder.description')]); ?>

            <div class="help-block with-errors"></div>
          </div>

          <div class="help-block">
            <span data-toggle="tooltip" data-title="<?php echo trans('theme.order_' . $action . '_msg'); ?>" data-placement="top">
              <i class="fas fa-exclamation-triangle"></i>
              <?php echo e(trans('theme.order_' . $action . '_msg_title'), false); ?>

            </span>
          </div>

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
  </div><!-- /.modal-dialog -->
<?php /**PATH C:\wamp64\www\hype-dappr\public\themes\default/views/modals/_item_cancel.blade.php ENDPATH**/ ?>