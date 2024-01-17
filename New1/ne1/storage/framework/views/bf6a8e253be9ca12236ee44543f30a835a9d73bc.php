<?php $__env->startSection('content'); ?>
  <div class="admin-user-widget">
    <span class="admin-user-widget-img">
      <img src="<?php echo e(get_storage_file_url(optional($addressable->image)->path, 'small'), false); ?>" class="thumbnail" alt="<?php echo e(trans('app.avatar'), false); ?>">
    </span>

    <div class="admin-user-widget-content">
      <span class="admin-user-widget-title">
        <?php echo e(trans('app.' . $addressable_type) . ': ' . $addressable->name, false); ?>

      </span>
      <span class="admin-user-widget-text text-muted">
        <?php echo e(trans('app.email') . ': ' . $addressable->email, false); ?>

      </span>
      <?php if($addressable->primaryAddress): ?>
        <span class="admin-user-widget-text text-muted">
          <?php echo e(trans('app.phone') . ': ' . $addressable->primaryAddress->phone, false); ?>

        </span>
        <span class="admin-user-widget-text text-muted">
          <?php echo e(trans('app.zip_code') . ': ' . $addressable->primaryAddress->zip_code, false); ?>

        </span>
      <?php endif; ?>
      <a href="javascript:void(0)" data-link="<?php echo e(route('admin.admin.' . $addressable_type . '.show', $addressable->id), false); ?>" class="ajax-modal-btn small"><?php echo e(trans('app.view_detail'), false); ?></a>

      <span class="pull-right" style="margin-top: -60px;margin-right: 30px;font-size: 40px; color: rgba(0, 0, 0, 0.2);">
        <i class="fa fa-check-square-o"></i>
      </span>
    </div> <!-- /.admin-user-widget-content -->
  </div> <!-- /.admin-user-widget -->

  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title"><?php echo e(trans('app.addresses'), false); ?></h3>
      <div class="box-tools pull-right">
        <a href="javascript:void(0)" data-link="<?php echo e(route('address.create', [$addressable_type, $addressable->id]), false); ?>" class="ajax-modal-btn btn btn-new btn-flat"><?php echo e(trans('app.add_address'), false); ?></a>
      </div>
    </div> <!-- /.box-header -->
    <div class="box-body">
      <?php $__currentLoopData = $addresses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $address): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="row">
          <div class="col-md-6">
            <?php echo $address->toHtml(); ?>

            <div class="pull-right">
              <a href="javascript:void(0)" data-link="<?php echo e(route('address.edit', $address->id), false); ?>" class="ajax-modal-btn">
                <i data-toggle="tooltip" data-placement="top" title="<?php echo e(trans('app.edit'), false); ?>" class="fa fa-edit"></i>
              </a>&nbsp;
              <?php if (! ($address->address_type == 'Primary')): ?>
                <?php echo Form::open(['route' => ['address.destroy', $address->id], 'method' => 'delete', 'class' => 'data-form', 'style' => 'display: inline;']); ?>

                <?php echo Form::button('<i class="fa fa-trash-o"></i>', ['type' => 'submit', 'class' => 'confirm ajax-silent', 'title' => trans('app.delete'), 'data-toggle' => 'tooltip', 'data-placement' => 'top']); ?>

                <?php echo Form::close(); ?>

              <?php endif; ?>
              <span class="spacer10"></span>
            </div>
          </div>
          <div class="col-md-6">
            <?php if(config('system_settings.address_show_map')): ?>
              <iframe width="100%" height="150" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.it/maps?q=<?php echo e(urlencode($address->toGeocodeString()), false); ?>&output=embed"></iframe>
            <?php endif; ?>
          </div>
        </div>

        <?php if (! ($loop->last)): ?>
          <hr />
        <?php endif; ?>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div> <!-- /.box-body -->
  </div> <!-- /.box -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dappr/public_html/portal.dappr.com.au/resources/views/address/show.blade.php ENDPATH**/ ?>