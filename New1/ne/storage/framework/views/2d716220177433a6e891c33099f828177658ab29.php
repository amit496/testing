<?php $__env->startSection('content'); ?>
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title"><?php echo e(trans('app.cancellations'), false); ?></h3>
      <div class="box-tools pull-right">
      </div>
    </div> <!-- /.box-header -->
    <div class="box-body">
      <table class="table table-hover table-no-sort">
        <thead>
          <tr>
            <th><?php echo e(trans('app.order_number'), false); ?></th>
            <th><?php echo e(trans('app.shop'), false); ?></th>
            <th><?php echo e(trans('app.customer'), false); ?></th>
            <th><?php echo e(trans('app.grand_total'), false); ?></th>
            <th><?php echo e(trans('app.payment'), false); ?></th>
            <th><?php echo e(trans('app.requested_items'), false); ?></th>
            <th><?php echo e(trans('app.requested_at'), false); ?></th>
            <th><?php echo e(trans('app.status'), false); ?></th>
            
          </tr>
        </thead>
        <tbody>
          <?php $__currentLoopData = $cancellations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cancellation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if(!empty($cancellation->order)): ?>
                  <tr>
                    <td>
                      <a href="<?php echo e(route('admin.order.order.show', $cancellation->order->id), false); ?>">
                        <?php echo e($cancellation->order->order_number, false); ?>

                      </a>
                      <span class="indent5"><?php echo $cancellation->order->orderStatus(); ?></span>
                      <?php if($cancellation->order->disputed): ?>
                        <span class="label label-danger indent5"><?php echo e(trans('app.statuses.disputed'), false); ?></span>
                      <?php endif; ?>
                    </td>
                    <td>
                      <a href="javascript:void(0)" data-link="<?php echo e(route('admin.vendor.shop.show', $cancellation->shop_id), false); ?>" class="ajax-modal-btn"><?php echo e($cancellation->shop->getName(), false); ?></a>
                    </td>
                    <td>
                      <a href="javascript:void(0)" data-link="<?php echo e(route('admin.admin.customer.show', $cancellation->customer_id), false); ?>" class="ajax-modal-btn modal-btn"><?php echo e($cancellation->customer->getName(), false); ?></a>
                    </td>
                    <td><?php echo e(get_formated_currency($cancellation->order->grand_total, 2), false); ?></td>
                    <td><?php echo $cancellation->order->paymentStatusName(); ?></td>
                    <td><?php echo e($cancellation->items_count . '/' . $cancellation->order->quantity, false); ?></td>
                    <td><?php echo e($cancellation->created_at->diffForHumans(), false); ?></td>
                    <td><?php echo $cancellation->statusName(); ?></td>
                  </tr>
                <?php endif; ?>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
      </table>
    </div> <!-- /.box-body -->
  </div> <!-- /.box -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dappr/public_html/test.dappr.com.au/resources/views/admin/order/approvals.blade.php ENDPATH**/ ?>