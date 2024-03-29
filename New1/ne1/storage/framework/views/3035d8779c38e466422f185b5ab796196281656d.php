<div class="modal-dialog modal-sm">
  <div class="modal-content">
    <?php echo Form::model($order, ['method' => 'PUT', 'route' => ['admin.order.order.fulfill', $order->id], 'files' => true, 'id' => 'form', 'data-toggle' => 'validator']); ?>

    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      <?php echo e(trans('app.fulfill_order'), false); ?>

    </div>
    <div class="modal-body">
      <div class="form-group">
        <?php echo Form::label('tracking_id', trans('app.form.order_tracking_id'), ['class' => 'with-help']); ?>

        <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(trans('help.order_tracking_id'), false); ?>"></i>
        <?php echo Form::text('tracking_id', null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.order_tracking_id')]); ?>

      </div>

      <?php
        $carrier_id = $order->carrier ? $order->carrier->id : ($order->shippingRate ? optional($order->shippingRate->carrier)->id : null);
      ?>

      <div class="form-group">
        <?php echo Form::label('carrier_id', trans('app.form.carrier') . '*', ['class' => 'with-help']); ?>

        <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(trans('help.order_fulfillment_carrier'), false); ?>"></i>
        <?php echo Form::select('carrier_id', $carriers, $carrier_id, ['class' => 'form-control select2-normal', 'placeholder' => trans('app.placeholder.carrier'), 'required']); ?>

        <?php echo Form::hidden('order_id', $order->id, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.carrier'), 'required' => 'required']); ?>

        <?php echo Form::hidden('reveal_id', $order->reveal_id, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.carrier'), 'required' => 'required']); ?>

        <?php echo Form::hidden('order_number', $order->order_number, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.carrier'), 'required' => 'required']); ?>


        <div class="help-block with-errors"></div>
      </div>

      <small>
        <?php echo Form::checkbox('notify_customer', 1, null, ['class' => 'icheck', 'id' => 'notify_customer', 'checked']); ?>

        <?php echo Form::label('notify_customer', strtoupper(trans('app.notify_customer')), ['class' => 'indent5']); ?>

        <i class="fa fa-question-circle indent5" data-toggle="tooltip" data-placement="top" title="<?php echo e(trans('help.notify_customer'), false); ?>"></i>
      </small>
      <p class="help-block">* <?php echo e(trans('app.form.required_fields'), false); ?></p>
    </div>
    <div class="modal-footer">
      <?php echo Form::submit(trans('app.form.update'), ['class' => 'btn btn-flat btn-new']); ?>

    </div>
    <?php echo Form::close(); ?>

  </div> <!-- / .modal-content -->
</div> <!-- / .modal-dialog -->
<?php /**PATH /home/dappr/public_html/portal.dappr.com.au/resources/views/admin/order/_fulfill.blade.php ENDPATH**/ ?>