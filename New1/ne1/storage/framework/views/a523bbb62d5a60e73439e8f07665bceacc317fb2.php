<div class="modal-dialog modal-sm">
    <div class="modal-content">
        <?php echo Form::model($order, ['method' => 'PUT', 'route' => ['admin.order.order.cancel', $order->id], 'files' => true, 'id' => 'form', 'data-toggle' => 'validator']); ?>

        <div class="modal-header">
        	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        	<?php echo e(trans('app.cancel_order'), false); ?>

        </div>
        <div class="modal-body">
            <?php if(Auth::user()->isFromPlatform()): ?>
    			<div class="form-group">
                    <?php echo Form::label('cancellation_fee', trans('app.vendor_order_cancellation_fee'). ':', ['class' => 'with-help']); ?>

                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="<?php echo e(trans('help.vendor_order_cancellation_fee'), false); ?>"></i>
                    <div class="input-group">
                        <?php if(get_currency_prefix()): ?>
                            <span class="input-group-addon" id="basic-addon1">
                                <?php echo e(get_currency_prefix(), false); ?>

                            </span>
                        <?php endif; ?>
                        
                        <?php echo Form::number('cancellation_fee', config('system_settings.vendor_order_cancellation_fee') ?? 0, ['class' => 'form-control', 'step' => 'any', 'placeholder' => trans('app.cancellation_fee'), 'required']); ?>


                        <?php if(get_currency_suffix()): ?>
                            <span class="input-group-addon" id="basic-addon1">
                                <?php echo e(get_currency_suffix(), false); ?>

                            </span>
                        <?php endif; ?>
                    </div>
                    <div class="help-block with-errors"></div>
    			</div>
            <?php elseif(cancellation_require_admin_approval()): ?>
                <div class="alert alert-info">
                    <strong><i class="icon fa fa-warning"></i><?php echo e(trans('app.alert'), false); ?></strong>
                    <?php echo trans('messages.cancellation_require_admin_approval'); ?>

                </div>
            <?php elseif(config('system_settings.vendor_order_cancellation_fee') > 0): ?>
                <div class="alert alert-warning">
                    <strong><i class="icon fa fa-warning"></i><?php echo e(trans('app.info'), false); ?>: </strong>
                    <?php echo trans('messages.a_cancellation_fee_be_charged', ['fee' => get_formated_currency(config('system_settings.vendor_order_cancellation_fee'))]); ?>

                </div>
            <?php else: ?>
                <div class="alert alert-warning">
                    <strong><i class="icon fa fa-warning"></i><?php echo e(trans('app.alert'), false); ?></strong>
                    <?php echo trans('messages.order_will_be_cancelled_instantly'); ?>

                </div>
            <?php endif; ?>

            
			
        </div>
        <div class="modal-footer">
            <?php echo Form::submit(trans('app.cancel_order'), ['class' => 'btn btn-flat btn-new']); ?>

        </div>
        <?php echo Form::close(); ?>

    </div> <!-- / .modal-content -->
</div> <!-- / .modal-dialog --><?php /**PATH C:\wamp64\www\hype-dappr\resources\views/admin/order/_cancellation_create.blade.php ENDPATH**/ ?>