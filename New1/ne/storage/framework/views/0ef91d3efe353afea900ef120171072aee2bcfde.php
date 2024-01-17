<?php $__env->startSection('content'); ?>

  <div class="row">
    <div class="col-sm-12">
      <div id="filter-panel">
        <div class="panel panel-default">
          <div class="panel-body">
            <div class="row">
              <div class="col-md-2 nopadding-right">
                <div class="form-group">
                  <label><?php echo e(trans('app.products'), false); ?></label>
                  <select onchange="fireEventOnFilter(this.value)" id="productId" style="width: 100%" name="product_id" class="form-control searchProductForSelect"></select>
                </div>
              </div>
              <div class="col-md-2 nopadding-right nopadding-left">
                <div class="form-group">
                  <label><?php echo e(trans('app.shops'), false); ?></label>
                  <select style="width: 100%" onchange="fireEventOnFilter(this.value)" id="shopId" name="shop_id" class="form-control searchMerchant"></select>
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
          </div>
        </div>
      </div>
    </div>
  </div>

  

  <div class="box margin-top-2">
    <div class="box-header with-border">
      <h3 class="box-title"><?php echo e(trans('app.products'), false); ?></h3>
      <div class="box-tools pull-right">
        <?php echo $__env->make('admin.partials.reports.timeframe', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      </div>
    </div> <!-- /.box-header -->
    <div class="box-body">
      <table class="table table-hover table-no-sort table-responsive" style="overflow-x: scroll">
        <thead>
          <tr>
            <th><?php echo e(trans('app.product'), false); ?></th>
            <th><?php echo e(trans('app.model_number'), false); ?></th>
            <th><?php echo e(trans('app.gtin'), false); ?></th>
            <th><?php echo e(trans('app.quantity'), false); ?></th>
            <th><?php echo e(trans('app.unique_purchase'), false); ?></th>
            <th><?php echo e(trans('app.average_price'), false); ?></th>
            <th><?php echo e(trans('app.revenue'), false); ?></th>
          </tr>
        </thead>
        <tbody>
          <?php if(count($data) > 0): ?>
            <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
                <td><?php echo e($item->name, false); ?></td>
                <td><?php echo e($item->model_number, false); ?></td>
                <td>
                  <span class="label label-outline"><?php echo e($item->gtin_type, false); ?></span> <?php echo e($item->gtin, false); ?>

                </td>
                <td><?php echo e($item->quantity, false); ?></td>
                <td><?php echo e($item->uniquePurchase, false); ?></td>
                <td><?php echo e(get_formated_price($item->avgPrice), false); ?></td>
                <td><?php echo e(get_formated_price($item->totalSale), false); ?></td>
              </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          <?php endif; ?>
        </tbody>
      </table>
    </div> <!-- /.box-body -->
  </div> <!-- /.box -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-script'); ?>

  <?php echo $__env->make('plugins.report-products', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dappr/public_html/test.dappr.com.au/resources/views/admin/report/platform/sales/products.blade.php ENDPATH**/ ?>