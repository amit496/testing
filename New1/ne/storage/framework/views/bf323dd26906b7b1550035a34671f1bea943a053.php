<div class="modal-dialog modal-sm">
  <div class="modal-content">
    <?php echo Form::open(['route' => ['admin.order.deliveryboy.assign', $order], 'method' => 'post', 'id' => 'form', 'data-toggle' => 'validator']); ?>

    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      <?php echo e(trans('app.assign_deliveryboy'), false); ?>

    </div>
    <div class="modal-body">
      <?php echo Form::select('delivery_boy_id', $deliveryboys, $order->delivery_boy_id, ['class' => 'form-control select2', 'placeholder' => trans('app.placeholder.select'), 'required']); ?>

    </div>
    <div class="modal-footer">
      <?php echo Form::submit(trans('app.form.proceed'), ['class' => 'btn btn-flat btn-new']); ?>

    </div>
    <?php echo Form::close(); ?>

  </div> <!-- / .modal-content -->
</div> <!-- / .modal-dialog -->
<?php /**PATH C:\wamp64\www\hype-dappr\resources\views/admin/order/_assign_delivery_boy.blade.php ENDPATH**/ ?>