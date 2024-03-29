<?php $__env->startSection('content'); ?>
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title"><?php echo e(trans('app.coupons'), false); ?></h3>
      <div class="box-tools pull-right">
        
          <a href="javascript:void(0)" data-link="<?php echo e(route('admin.promotion.coupon.create'), false); ?>" class="ajax-modal-btn btn btn-new btn-flat"><?php echo e(trans('app.add_coupon'), false); ?></a>
        
      </div>
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
            <th><?php echo e(trans('app.restricted'), false); ?></th>
            <th><?php echo e(trans('app.value'), false); ?></th>
            <th><?php echo e(trans('app.starting_time'), false); ?></th>
            <th><?php echo e(trans('app.ending_time'), false); ?></th>
            <th><?php echo e(trans('app.option'), false); ?></th>
          </tr>
        </thead>
        <tbody id="massSelectArea">
          <?php $__currentLoopData = $coupons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $coupon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
              <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('massDelete', \App\Models\Coupon::class)): ?>
                <td><input id="<?php echo e($coupon->id, false); ?>" type="checkbox" class="massCheck"></td>
              <?php endif; ?>
              <td>
                <?php echo e($coupon->name, false); ?>

                <?php if($coupon->ending_time < \Carbon\Carbon::now()): ?>
                  <span class="label label-default indent10"><?php echo e(strtoupper(trans('app.expired')), false); ?></span>
                <?php elseif(!$coupon->isActive()): ?>
                  <span class="label label-info indent10"><?php echo e(strtoupper(trans('app.inactive')), false); ?></span>
                <?php endif; ?>
              </td>
              <td><?php echo e($coupon->code, false); ?></td>
              <td><?php echo e(get_yes_or_no($coupon->customers_count || $coupon->promotion_zones_count), false); ?></td>
              <td>
                <strong>
                  <?php echo e($coupon->type == 'amount'? get_formated_currency($coupon->value, 2): get_formated_decimal($coupon->value) . ' ' . trans('app.percent'), false); ?>

                </strong>
              </td>
              <td>
                <?php echo e($coupon->starting_time ? $coupon->starting_time->toDayDateTimeString() : '', false); ?>

              </td>
              <td>
                <?php echo e($coupon->ending_time ? $coupon->ending_time->toDayDateTimeString() : '', false); ?>

              </td>
              <td class="row-options">
                
                  <a href="javascript:void(0)" data-link="<?php echo e(route('admin.promotion.coupon.show', $coupon->id), false); ?>" class="ajax-modal-btn"><i data-toggle="tooltip" data-placement="top" title="<?php echo e(trans('app.detail'), false); ?>" class="fa fa-expand"></i></a>&nbsp;
                

                
                  <a href="javascript:void(0)" data-link="<?php echo e(route('admin.promotion.coupon.edit', $coupon->id), false); ?>" class="ajax-modal-btn"><i data-toggle="tooltip" data-placement="top" title="<?php echo e(trans('app.edit'), false); ?>" class="fa fa-edit"></i></a>&nbsp;
                

                
                  <?php echo Form::open(['route' => ['admin.promotion.coupon.trash', $coupon->id], 'method' => 'delete', 'class' => 'data-form']); ?>

                  <?php echo Form::button('<i class="fa fa-trash-o"></i>', ['type' => 'submit', 'class' => 'confirm ajax-silent', 'title' => trans('app.trash'), 'data-toggle' => 'tooltip', 'data-placement' => 'top']); ?>

                  <?php echo Form::close(); ?>

                
              </td>
            </tr>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
      </table>
    </div> <!-- /.box-body -->
  </div> <!-- /.box -->

  <div class="box collapsed-box">
    <div class="box-header with-border">
      <h3 class="box-title">
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('massDelete', \App\Models\Coupon::class)): ?>
          <?php echo Form::open(['route' => ['admin.promotion.coupon.emptyTrash'], 'method' => 'delete', 'class' => 'data-form']); ?>

          <?php echo Form::button('<i class="fa fa-trash-o"></i>', ['type' => 'submit', 'class' => 'confirm btn btn-default btn-flat ajax-silent', 'title' => trans('help.empty_trash'), 'data-toggle' => 'tooltip', 'data-placement' => 'right']); ?>

          <?php echo Form::close(); ?>

        <?php else: ?>
          <i class="fa fa-trash-o"></i>
        <?php endif; ?>
        <?php echo e(trans('app.trash'), false); ?>

      </h3>
      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
      </div>
    </div> <!-- /.box-header -->
    <div class="box-body">
      <table class="table table-hover table-no-sort">
        <thead>
          <tr>
            <th><?php echo e(trans('app.name'), false); ?></th>
            <th><?php echo e(trans('app.code'), false); ?></th>
            <th><?php echo e(trans('app.value'), false); ?></th>
            <th><?php echo e(trans('app.deleted_at'), false); ?></th>
            <th><?php echo e(trans('app.option'), false); ?></th>
          </tr>
        </thead>
        <tbody>
          <?php $__currentLoopData = $trashes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trash): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
              <td><?php echo e($trash->name, false); ?></td>
              <td>
                <?php echo e($trash->code, false); ?>

                <?php if($trash->ending_time < \Carbon\Carbon::now()): ?>
                  (<?php echo e(trans('app.expired'), false); ?>)
                <?php endif; ?>
              </td>
              <td>
                <?php echo e($trash->type == 'amount'? get_formated_currency($trash->value, 2): get_formated_decimal($trash->value) . ' ' . trans('app.percent'), false); ?>

              </td>
              <td><?php echo e($trash->deleted_at->diffForHumans(), false); ?></td>
              <td class="row-options">
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete', $trash)): ?>
                  <a href="<?php echo e(route('admin.promotion.coupon.restore', $trash->id), false); ?>"><i data-toggle="tooltip" data-placement="top" title="<?php echo e(trans('app.restore'), false); ?>" class="fa fa-database"></i></a>&nbsp;

                  <?php echo Form::open(['route' => ['admin.promotion.coupon.destroy', $trash->id], 'method' => 'delete', 'class' => 'data-form']); ?>

                  <?php echo Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'confirm ajax-silent', 'title' => trans('app.delete_permanently'), 'data-toggle' => 'tooltip', 'data-placement' => 'top']); ?>

                  <?php echo Form::close(); ?>

                <?php endif; ?>
              </td>
            </tr>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
      </table>
    </div> <!-- /.box-body -->
  </div> <!-- /.box -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dappr/public_html/test.dappr.com.au/resources/views/admin/coupon/index.blade.php ENDPATH**/ ?>