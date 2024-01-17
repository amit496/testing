<?php $__env->startSection('content'); ?>

  <div class="row">
    <div class="col-sm-12">
      <div id="filter-panel">
        <div class="panel panel-default">
          <div class="panel-body">
            <form action="<?php echo e(route('admin.sales.payments'), false); ?>/" method="get">
              <div class="row">
                <div class="col-md-2 nopadding-right">
                  <div class="form-group">
                    <label><?php echo e(trans('app.payment_status'), false); ?></label>
                    <select id="paymentMethod" class="form-control" name="payment_status" onchange="fireEventOnFilter(this.value)">
                      <option value="">select</option>
                      <?php $__currentLoopData = $paymentMethods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($payment->id, false); ?>"><?php echo e($payment->name, false); ?></option>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-2 nopadding-right nopadding-left">
                  <div class="form-group">
                    <label><?php echo e(trans('app.payment_status'), false); ?></label>
                    <select id="paymentStatus" onchange="fireEventOnFilter(this.value)" class="form-control" name="payment_status">
                      <option value="" <?php if(request()->get('order_status') == 'all'): ?> selected <?php endif; ?>><?php echo e(trans('app.all'), false); ?></option>
                      <option value="PAYMENT_STATUS_PENDING" <?php if(request()->get('order_status') == 'PAYMENT_STATUS_PENDING'): ?> selected <?php endif; ?>><?php echo e(trans('app.pending'), false); ?></option>
                      <option value="PAYMENT_STATUS_PAID" <?php if(request()->get('order_status') == 'PAYMENT_STATUS_PAID'): ?> selected <?php endif; ?>><?php echo e(trans('app.paid'), false); ?></option>
                      <option value="PAYMENT_STATUS_REFUNDED" <?php if(request()->get('order_status') == 'PAYMENT_STATUS_REFUNDED'): ?> selected <?php endif; ?>><?php echo e(trans('app.refunded'), false); ?></option>
                    </select>
                  </div>
                </div>
                <div class="col-md-2 nopadding-right nopadding-left">
                  &nbsp;
                </div>
                <div class="col-md-2 nopadding-right nopadding-left">
                  &nbsp;
                </div>
                <div class="col-md-2 nopadding-right nopadding-left">
                  &nbsp;
                </div>
                <div class="col-md-2 nopadding-left">
                  <div class="form-group">
                    <label>&nbsp;</label>
                    <button onclick="clearAllFilter()" type="button" class="btn btn-default pull-right" name="search" value="1"><i class="fa fa-caret-left"></i> <?php echo e(trans('app.clear'), false); ?></button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="box margin-top-2">
    <div class="box-header with-border">
      <h3 class="box-title"><?php echo e(trans('app.payments'), false); ?></h3>
      <div class="box-tools pull-right">
        <?php echo $__env->make('admin.partials.reports.timeframe', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      </div>
    </div> <!-- /.box-header -->
    <div class="box-body">
      <div class="rg-card-simple equal-height">
        <canvas id="salesReport" style="height: 300px; min-height: 300px; max-height: 300px; width: 100%"></canvas>
      </div>

      <span class="spacer30"></span>

      <div class="col-md-6">
        <div class="rg-card-simple equal-height">
          <canvas id="paymentMethodChart" style="height: 300px; min-height: 300px; max-height: 300px"></canvas>
        </div>
      </div>

      <div class="col-md-6">
        <div class="rg-card-simple equal-height">
          <canvas id="paymentStatusChart" style="height: 300px; min-height: 300px; max-height: 300px"></canvas>
        </div>
      </div>

      
    </div> <!-- /.box-body -->
  </div> <!-- /.box -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-script'); ?>
  <?php echo $__env->make('plugins.report-payment', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dappr/public_html/test.dappr.com.au/resources/views/admin/report/platform/sales/payments.blade.php ENDPATH**/ ?>