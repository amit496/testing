<?php $__env->startSection('content'); ?>
  <?php if(config('app.demo') == true): ?>
    <div class="alert alert-info">
      <h4><i class="fa fa-info"></i> <?php echo e(trans('app.info'), false); ?></h4>
      <?php echo trans('messages.not_accessible_on_demo'); ?>

      <a href="https://incevio.com/plugins" class="indent10" target="_blank">You can get all available plagins here. </a>
    </div>
  <?php else: ?>
    <div class="alert alert-danger">
      <h4><i class="fa fa-exclamation-triangle"></i> <?php echo e(trans('app.alert'), false); ?></h4>
      <?php echo trans('messages.be_careful_sensitive_area'); ?>

    </div>
  <?php endif; ?>

  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title"><?php echo e(trans('app.available_packages'), false); ?></h3>
      <div class="box-tools pull-right">
        
      </div>
    </div> <!-- /.box-header -->
    <div class="box-body">
      <table class="table">
        <thead>
          <tr>
            <th width="30%"><?php echo e(trans('app.package'), false); ?></th>
            <th>&nbsp;</th>
            <th><?php echo e(trans('app.description'), false); ?></th>
          </tr>
        </thead>
        <tbody>
          <?php $__currentLoopData = $installables; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
              $dependencies = $package['dependency'];
              $can_load = !(bool) $dependencies;
              $registered = $installs->where('slug', $package['slug'])->first();
              
              if (!$can_load) {
                  $arr = explode(',', $dependencies);
                  $can_load = is_incevio_package_loaded($arr);
                  $dependencies = count($arr) > 1 ? strrev(implode(strrev(', ' . trans('app.and') . ' '), explode(strrev(','), strrev($dependencies), 2))) : $dependencies;
              }
              
              // Forcefully deactivate the dependent packages
              if ($registered && $registered->active && !$can_load) {
                  $registered->deactivate();
              }
            ?>
            <tr>
              <td>
                <h4 class="text-<?php echo e($registered ? 'primary' : 'muted', false); ?>">
                  <i class="fa fa-<?php echo e($package['icon'] ?? 'puzzle-piece', false); ?> text-muted"></i>&nbsp;
                  <?php echo e($package['name'], false); ?>

                </h4>

                <?php if (! ($can_load)): ?>
                  <small class="text-danger">
                    <i class="fa fa-ban"></i>
                    <?php echo e(trans('help.package_dependency_not_loaded', ['dependency' => $dependencies]), false); ?>

                  </small>
                <?php endif; ?>

                <?php if($registered): ?>
                  <?php if (! ($registered->active && $package['active'] == false)): ?>
                    <?php echo Form::open(['route' => ['admin.package.uninstall', $package['slug']]]); ?>

                    <button type="submit" class="confirm btn btn-sm btn-link" data-confirm="<?php echo trans('help.confirm_uninstall_package', ['package' => $package['name']]); ?>">
                      <i class=" fa fa-trash-o"></i> <?php echo e(trans('app.uninstall'), false); ?>

                    </button>
                    <?php echo Form::close(); ?>

                  <?php endif; ?>
                <?php elseif($can_load): ?>
                  <?php if(config('app.demo') == true): ?>
                    <span class="text-muted" title="<?php echo trans('messages.demo_restriction'); ?>" data-toggle="tooltip"><i class=" fa fa-wrench"></i> <?php echo e(trans('app.install'), false); ?></span>
                    <a href="https://incevio.com/plugins" class="text-bold small indent10" target="_blank">Check it here </a>
                  <?php else: ?>
                    <a href="javascript:void(0)" data-link="<?php echo e(route('admin.package.initiate', $package['slug']), false); ?>" type="button" class="btn btn-md btn-secondary ajax-modal-btn">
                      <i class=" fa fa-wrench"></i> <?php echo e(trans('app.install'), false); ?>

                    </a>
                  <?php endif; ?>
                <?php endif; ?>
              </td>
              <td>
                <?php if($registered && $package['active'] == false): ?>
                  <div class="handle horizontal">
                    <a href="javascript:void(0)" data-link="<?php echo e(route('admin.package.switch', $package['slug']), false); ?>" type="button" class="btn btn-md btn-secondary btn-toggle <?php echo e($registered && $registered->active ? 'active' : '', false); ?>" data-doafter="reload" data-toggle="button" aria-pressed="<?php echo e($registered && $registered->active ? 'true' : 'false', false); ?>" autocomplete="off" <?php echo e($can_load ? '' : 'disabled', false); ?>>
                      <div class="btn-handle"></div>
                    </a>
                  </div>
                <?php endif; ?>
              </td>
              <td>
                <p><?php echo e($package['description'], false); ?></p>
                <?php if (! (empty($package['warning']))): ?>
                  <p class="text-danger small">
                    <i class="fa fa-warning"></i>
                    <?php echo $package['warning']; ?>

                  </p>
                <?php endif; ?>

                <span class="text-muted small">
                  <?php echo e(trans('app.version') . ' ' . $package['version'], false); ?> &bull;

                  <?php if($registered): ?>

                    

                    <?php echo e(trans('app.installed_at') . ' ' . $registered->created_at, false); ?> &bull;
                    <?php echo e(trans('app.updated_at') . ' ' . $registered->updated_at, false); ?> &bull;
                  <?php endif; ?>

                  <?php echo e(trans('app.zcart_compatiblity') . ' ' . $package['compatible'], false); ?>

                </span>
              </td>
            </tr>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
      </table>
    </div> <!-- /.box-body -->
  </div> <!-- /.box -->

  <div class="row">
    <div class="col-md-6">
      <div class="panel panel-success">
        <div class="panel-heading">
          <i class="fa fa-rocket"></i>
          More Packages Available!
        </div>
        <div class="panel-body">
          We're developing more and more packages with useful functionality extensions.
          <br /><br />
          <a href="https://incevio.com/plugins" class="btn btn-primary" target="_blank">
            All Available Packages
            <i class="fa fa-external-link"></i>
          </a>
        </div>
      </div>
    </div> <!-- /.col-md-6 -->

    <div class="col-md-6">
      <div class="panel panel-default">
        <div class="panel-heading">
          <i class="fa fa-rocket"></i>
          Looking for a custom packages?
        </div>
        <div class="panel-body">
          Send us an email for any kind of modification or custom work as we know the code better than everyone.
          <br /><br />
          <a href="https://incevio.com/contact" class="btn btn-default" target="_blank">
            Contact Us
            <i class="fa fa-external-link"></i>
          </a>
        </div>
      </div>
    </div> <!-- /.col-md-6 -->
  </div> <!-- /.row -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\hype-dappr\resources\views/admin/packages/index.blade.php ENDPATH**/ ?>