

<?php $__env->startSection('content'); ?>
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title"><?php echo e(trans('app.usedcoupons'), false); ?></h3>
      
    </div> <!-- /.box-header -->
    <div class="box-body">
      <table class="table table-hover table-no-sort">
        <thead>
          <tr>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('massDelete', \App\Models\Coupon::class)): ?>
              <th class="massActionWrapper">
                <!-- Check all button -->
                <div class="btn-group ">
                  <button type="button" class="btn btn-xs btn-default checkbox-toggle">
                    <i class="fa fa-square-o" data-toggle="tooltip" data-placement="top" title="<?php echo e(trans('app.select_all'), false); ?>"></i>
                  </button>
                  <button type="button" class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <span class="caret"></span>
                    <span class="sr-only"><?php echo e(trans('app.toggle_dropdown'), false); ?></span>
                  </button>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="javascript:void(0)" data-link="<?php echo e(route('admin.promotion.coupon.massTrash'), false); ?>" class="massAction " data-doafter="reload"><i class="fa fa-trash"></i> <?php echo e(trans('app.trash'), false); ?></a></li>
                    <li><a href="javascript:void(0)" data-link="<?php echo e(route('admin.promotion.coupon.massDestroy'), false); ?>" class="massAction " data-doafter="reload"><i class="fa fa-times"></i> <?php echo e(trans('app.delete_permanently'), false); ?></a></li>
                  </ul>
                </div>
              </th>
            <?php endif; ?>
            <th><?php echo e(trans('app.name'), false); ?></th>
            <th><?php echo e(trans('app.code'), false); ?></th>
            <th><?php echo e(trans('app.value'), false); ?></th>
            <th><?php echo e(trans('app.customer'), false); ?></th>     
            <th><?php echo e(trans('app.shipping'), false); ?></th>  
            <th><?php echo e(trans('app.packaging'), false); ?></th> 
            <th><?php echo e(trans('app.handling'), false); ?></th> 
            <th><?php echo e(trans('app.taxes'), false); ?></th> 
            <th><?php echo e(trans('app.total'), false); ?></th>                      
            <th><?php echo e(trans('app.payment'), false); ?></th> 
          </tr>
        </thead>
        <tbody id="massSelectArea">
            <?php $__currentLoopData = $order_all; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $coupon_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
         <tr>
            <td><?php echo e($coupon_data->orderCoupon->name, false); ?></td>
            <td><?php echo e($coupon_data->orderCoupon->code, false); ?></td>
            <td><?php echo e(number_format($coupon_data->orderCoupon->value,2,), false); ?></td>            
            <td><?php echo e($coupon_data->couponCustomer->name, false); ?></td>
           
            <td><?php echo e(number_format($coupon_data->shipping,2,), false); ?></td>
            <td><?php echo e(number_format($coupon_data->packaging,2,), false); ?></td>
            <td><?php echo e(number_format($coupon_data->handling,2,), false); ?></td>
            <td><?php echo e(number_format($coupon_data->taxes,2,), false); ?></td>
            <td><?php echo e(number_format($coupon_data->total,2,) + number_format($coupon_data->handling,2,) +  number_format($coupon_data->packaging,2,) + number_format($coupon_data->shipping,2,), false); ?></td>
            <td><?php echo e(number_format($coupon_data->grand_total,2,), false); ?></td>
            
         </tr>
         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
      </table>
    </div> <!-- /.box-body -->
  </div> <!-- /.box -->

  
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dappr/public_html/portal.dappr.com.au/resources/views/admin/promotions/coupon_used.blade.php ENDPATH**/ ?>