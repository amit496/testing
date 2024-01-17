<div class="modal-dialog modal-md">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      <?php echo e(trans('app.response'), false); ?>

    </div>
    <div class="modal-body" style="padding: 0px;">
      <div class="col-md-4 nopadding-right" style="margin-top: 10px;">
        <div class="form-group">
          <label><?php echo e(trans('app.customer'), false); ?></label>
          <p class="lead"><?php echo e($refund->order->customer->getName(), false); ?></p>
          <?php if($refund->order->customer->image): ?>
            <img src="<?php echo e(get_storage_file_url(optional($refund->order->customer->image)->path, 'small'), false); ?>" class="thumbnail" alt="<?php echo e(trans('app.avatar'), false); ?>">
          <?php else: ?>
            <img src="<?php echo e(get_gravatar_url($refund->order->customer->email, 'small'), false); ?>" class="thumbnail" alt="<?php echo e(trans('app.avatar'), false); ?>">
          <?php endif; ?>
        </div>
      </div>
      <div class="col-md-8 nopadding-left">
        <table class="table no-border">
          <tr>
            <th class="text-right"><?php echo e(trans('app.order_number'), false); ?>: </th>
            <td style="width: 60%;"><?php echo e(get_formated_order_number(null, $refund->order_id), false); ?></td>
          </tr>
          <tr>
            <th class="text-right"><?php echo e(trans('app.refund_amount'), false); ?>: </th>
            <td style="width: 60%;"><span class="label label-primary"><?php echo e(get_formated_currency($refund->amount), false); ?></span></td>
          </tr>
          <tr>
            <th class="text-right"><?php echo e(trans('app.order_amount'), false); ?>: </th>
            <td style="width: 60%;"><span class="label label-outline"><?php echo e(get_formated_currency($refund->order->total), false); ?></span></td>
          </tr>
          <tr>
            <th class="text-right"><?php echo e(trans('app.payment_status'), false); ?>: </th>
            <td style="width: 60%;"><?php echo $refund->order->paymentStatusName(); ?></td>
          </tr>
          <tr>
            <th class="text-right"><?php echo e(trans('app.order_received'), false); ?>: </th>
            <td style="width: 60%;"><?php echo e(get_yes_or_no($refund->order_received), false); ?></td>
          </tr>
          <tr>
            <th class="text-right"><?php echo e(trans('app.return_goods'), false); ?>: </th>
            <td style="width: 60%;"><?php echo e(get_yes_or_no($refund->return_goods), false); ?></td>
          </tr>
          <tr>
            <th class="text-right"><?php echo e(trans('app.order_date'), false); ?>:</th>
            <td style="width: 60%;"><?php echo e($refund->order->created_at->toDayDateTimeString(), false); ?></td>
          </tr>
        </table>
      </div>

      <div class="spacer30"></div>

      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active no-border"><a href="#tab_1" data-toggle="tab">
              <?php echo e(trans('app.description'), false); ?>

            </a></li>
        </ul>
        <div class="tab-content nopadding">
          <div class="tab-pane active" id="tab_1">
            <div class="box-body">
              <?php echo $refund->description ?? trans('app.description_not_available'); ?>

            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="modal-footer">
      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('approve', $refund)): ?>
        <div class="btn-group btn-group-justified" role="group" aria-label="...">
          <div class="btn-group" role="group">
            <a href="<?php echo e(route('admin.support.refund.approve', $refund), false); ?>" class="btn btn-lg btn-danger confirm ajax-silent"><?php echo e(trans('app.approve'), false); ?></a>
          </div>
          <div class="btn-group" role="group">
            <a href="<?php echo e(route('admin.support.refund.decline', $refund), false); ?>" class="btn btn-lg btn-default confirm ajax-silent"><?php echo e(trans('app.decline'), false); ?></a>
          </div>
        </div>
      <?php endif; ?>
    </div>
  </div> <!-- / .modal-content -->
</div> <!-- / .modal-dialog -->
<?php /**PATH /home/dappr/public_html/portal.dappr.com.au/resources/views/admin/refund/_response.blade.php ENDPATH**/ ?>