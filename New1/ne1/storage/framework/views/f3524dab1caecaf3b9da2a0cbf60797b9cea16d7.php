<?php $__env->startSection('content'); ?>

  <div class="row">
    <div class="col-sm-12">
      <div id="filter-panel">
        <div class="panel panel-default">
          <div class="panel-body">
            <div class="row">
              <div class="col-md-2 nopadding-right">
                <div class="form-group">
                  <label><?php echo e(trans('app.customer'), false); ?></label>
                  <select style="width: 100%" onchange="fireEventOnFilter(this.value)" id="customerId" name="customer_id" class="form-control searchCustomer"></select>
                </div>
              </div>
              <div class="col-md-2 nopadding-right nopadding-left">
                <div class="form-group">
                  <label><?php echo e(trans('app.shops'), false); ?></label>
                  <select style="width: 100%" name="shop_id" onchange="fireEventOnFilter(this.value)" id="shopId" class="form-control searchMerchant"></select>
                </div>
              </div>
              <div class="col-md-2 nopadding-right nopadding-left">
                <div class="form-group">
                  <label><?php echo e(trans('app.order_number'), false); ?></label>
                  <input type="text" id="orderNumber" onkeyup="fireEventOnFilter(this.value)" name="order_number" value="<?php echo e(request()->get('order_number'), false); ?>" class="form-control" placeholder="<?php echo e(trans('app.order_number'), false); ?>">
                </div>
              </div>
              <div class="col-md-2 nopadding-right nopadding-left">
                <div class="form-group">
                  <label><?php echo e(trans('app.order_status'), false); ?></label>
                  <select id="orderStatus" onchange="fireEventOnFilter(this.value)" class="form-control" name="order_status">
                    <option value="" <?php if(request()->get('order_status') == 'all'): ?> selected <?php endif; ?>><?php echo e(trans('app.all'), false); ?></option>
                    <option value="STATUS_WAITING_FOR_PAYMENT" <?php if(request()->get('order_status') == 'STATUS_WAITING_FOR_PAYMENT'): ?> selected <?php endif; ?>><?php echo e(trans('app.waiting_for_payment'), false); ?></option>
                    <option value="STATUS_CONFIRMED" <?php if(request()->get('order_status') == 'STATUS_CONFIRMED'): ?> selected <?php endif; ?>><?php echo e(trans('app.confirmed'), false); ?></option>
                    <option value="STATUS_FULFILLED" <?php if(request()->get('order_status') == 'STATUS_FULFILLED'): ?> selected <?php endif; ?>><?php echo e(trans('app.fulfilled'), false); ?></option>
                    <option value="STATUS_AWAITING_DELIVERY" <?php if(request()->get('order_status') == 'STATUS_AWAITING_DELIVERY'): ?> selected <?php endif; ?>><?php echo e(trans('app.awaiting_delivery'), false); ?></option>
                    <option value="STATUS_DELIVERED" <?php if(request()->get('order_status') == 'STATUS_DELIVERED'): ?> selected <?php endif; ?>><?php echo e(trans('app.delivered'), false); ?></option>
                    <option value="STATUS_CANCELED" <?php if(request()->get('order_status') == 'STATUS_CANCELED'): ?> selected <?php endif; ?>><?php echo e(trans('app.canceled'), false); ?></option>
                    <option value="STATUS_PAYMENT_ERROR" <?php if(request()->get('order_status') == 'STATUS_PAYMENT_ERROR'): ?> selected <?php endif; ?>><?php echo e(trans('app.payment_error'), false); ?></option>
                    <option value="STATUS_RETURNED" <?php if(request()->get('order_status') == 'STATUS_RETURNED'): ?> selected <?php endif; ?>><?php echo e(trans('app.returns'), false); ?></option>
                    <option value="STATUS_DISPUTED" <?php if(request()->get('order_status') == 'STATUS_DISPUTED'): ?> selected <?php endif; ?>><?php echo e(trans('app.disputed'), false); ?></option>
                  </select>
                </div>
              </div>

              <div class="col-md-2 nopadding-right nopadding-left">
                <div class="form-group">
                  <label><?php echo e(trans('app.payment_status'), false); ?></label>
                  <select id="paymentStatus" onchange="fireEventOnFilter(this.value)" class="form-control" name="payment_status">
                    <option value="" <?php if(request()->get('order_status') == 'all'): ?> selected <?php endif; ?>><?php echo e(trans('app.all'), false); ?></option>
                    <option value="PAYMENT_STATUS_UNPAID" <?php if(request()->get('order_status') == 'PAYMENT_STATUS_UNPAID'): ?> selected <?php endif; ?>><?php echo e(trans('app.unpaid'), false); ?></option>
                    <option value="PAYMENT_STATUS_PENDING" <?php if(request()->get('order_status') == 'PAYMENT_STATUS_PENDING'): ?> selected <?php endif; ?>><?php echo e(trans('app.pending'), false); ?></option>
                    <option value="PAYMENT_STATUS_PAID" <?php if(request()->get('order_status') == 'PAYMENT_STATUS_PAID'): ?> selected <?php endif; ?>><?php echo e(trans('app.paid'), false); ?></option>
                    
                    <option value="PAYMENT_STATUS_REFUNDED" <?php if(request()->get('order_status') == 'PAYMENT_STATUS_REFUNDED'): ?> selected <?php endif; ?>><?php echo e(trans('app.refunded'), false); ?></option>
                  </select>
                </div>
              </div>

              <div class="col-md-2 nopadding-left">
                <div class="form-group">
                  <label>&nbsp;</label>
                  <button onclick="clearAllFilter()" type="button" class="btn btn-default pull-right" name="search" value="1"><i class="fa fa-caret-left"></i> <?php echo e(trans('app.clear'), false); ?></button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="box margin-top-2">
    <div class="box-header with-border">
      <h3 class="box-title"><?php echo e(trans('app.orders'), false); ?></h3>

      

      

      <div class="box-tools pull-right">
        <?php echo $__env->make('admin.partials.reports.timeframe', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      </div>
    </div> <!-- /.box-header -->
    <div class="box-body">
      <div class="rg-card-simple equal-height">
        <canvas id="salesReport" style="height: 300px; min-height: 300px; max-height: 300px"></canvas>
      </div>

      <span class="spacer20"></span>

      <table class="table table-hover table-no-sort table-responsive" style="overflow-x: scroll">
        <thead>
          <tr>
            <th><?php echo e(trans('app.order_date'), false); ?></th>
            <th><?php echo e(trans('app.delivery_date'), false); ?></th>
            <th><?php echo e(trans('app.order_number'), false); ?></th>
            <th><?php echo e(trans('app.customer'), false); ?></th>
            <?php if(!Auth::user()->isMerchant()): ?>
              <th><?php echo e(trans('app.shop'), false); ?></th>
            <?php endif; ?>
            <th><?php echo e(trans('app.quantity'), false); ?></th>
            <th><?php echo e(trans('app.total'), false); ?></th>

          </tr>
        </thead>
        <tbody>
          <?php if(count($data) > 0): ?>
            <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
                <td><?php echo e($item->date, false); ?></td>
                <td><?php echo e($item->delivery_date, false); ?></td>
                <td>
                  <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view', $item)): ?>
                    <a href="<?php echo e(route('admin.order.order.show', $item->id), false); ?>" title="view order">
                      <?php echo e($item->order_number, false); ?>

                    </a>
                  <?php else: ?>
                    <?php echo e($item->order_number, false); ?>

                  <?php endif; ?>
                </td>
                <td><?php echo e($item->customer, false); ?></td>
                <td><?php echo e($item->shop, false); ?></td>
                <td><?php echo e($item->quantity, false); ?></td>
                <td><?php echo e(get_formated_price($item->grand_total), false); ?></td>
              </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          <?php endif; ?>
        </tbody>
      </table>
    </div> <!-- /.box-body -->
  </div> <!-- /.box -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-script'); ?>
  <?php echo $__env->make('plugins.report-orders', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dappr/public_html/test.dappr.com.au/resources/views/admin/report/platform/sales/orders.blade.php ENDPATH**/ ?>