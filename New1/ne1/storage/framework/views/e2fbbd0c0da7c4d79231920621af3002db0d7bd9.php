<?php $__env->startSection('content'); ?>
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title"><?php echo e(trans('app.roles'), false); ?></h3>
      <div class="box-tools pull-right">
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create', \App\Models\Role::class)): ?>
          <a href="javascript:void(0)" data-link="<?php echo e(route('admin.setting.role.create'), false); ?>" class="ajax-modal-btn btn btn-new btn-flat"><?php echo e(trans('app.add_role'), false); ?></a>
        <?php endif; ?>
      </div>
    </div> <!-- /.box-header -->
    <div class="box-body">
      <table class="table table-hover table-no-sort">
        <thead>
          <tr>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('massDelete', \App\Models\Role::class)): ?>
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
                    <li><a href="javascript:void(0)" data-link="<?php echo e(route('admin.setting.role.massTrash'), false); ?>" class="massAction " data-doafter="reload"><i class="fa fa-trash"></i> <?php echo e(trans('app.trash'), false); ?></a></li>
                    <li><a href="javascript:void(0)" data-link="<?php echo e(route('admin.setting.role.massDestroy'), false); ?>" class="massAction " data-doafter="reload"><i class="fa fa-times"></i> <?php echo e(trans('app.delete_permanently'), false); ?></a></li>
                  </ul>
                </div>
              </th>
            <?php endif; ?>
            <th><?php echo e(trans('app.name'), false); ?></th>
            <th><?php echo e(trans('app.users'), false); ?></th>
            <th><?php echo e(trans('app.type'), false); ?></th>
            <th><?php echo e(trans('app.role_level'), false); ?></th>
            <th><?php echo e(trans('app.option'), false); ?></th>
          </tr>
        </thead>
        <tbody id="massSelectArea">
          <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
              <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('massDelete', \App\Models\Role::class)): ?>
                <td><input id="<?php echo e($role->id, false); ?>" type="checkbox" class="massCheck"></td>
              <?php endif; ?>
              <td>
                <h5><?php echo e($role->name, false); ?></h5>
                <?php if($role->description): ?>
                  <span class="excerpt-td small"><?php echo $role->description; ?></span>
                <?php endif; ?>
              </td>
              <td><span class="label label-primary"><?php echo e($role->users_count, false); ?></span></td>
              <td><?php echo e($role->public ? trans('app.merchant') : trans('app.platform'), false); ?></td>
              <td><span class="label label-default"><?php echo e($role->level, false); ?></span></td>
              <td class="row-options">
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view', $role)): ?>
                  <a href="javascript:void(0)" data-link="<?php echo e(route('admin.setting.role.show', $role->id), false); ?>" class="ajax-modal-btn"><i data-toggle="tooltip" data-placement="top" title="<?php echo e(trans('app.detail'), false); ?>" class="fa fa-expand"></i></a>&nbsp;
                <?php endif; ?>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update', $role)): ?>
                  <a href="javascript:void(0)" data-link="<?php echo e(route('admin.setting.role.edit', $role), false); ?>" class="ajax-modal-btn"><i data-toggle="tooltip" data-placement="top" title="<?php echo e(trans('app.edit'), false); ?>" class="fa fa-edit"></i></a>&nbsp;
                <?php endif; ?>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete', $role)): ?>
                  <?php echo Form::open(['route' => ['admin.setting.role.trash', $role->id], 'method' => 'delete', 'class' => 'data-form']); ?>

                  <?php echo Form::button('<i class="fa fa-trash-o"></i>', ['type' => 'submit', 'class' => 'confirm ajax-silent', 'title' => trans('app.trash'), 'data-toggle' => 'tooltip', 'data-placement' => 'top']); ?>

                  <?php echo Form::close(); ?>

                <?php endif; ?>
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
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('massDelete', \App\Models\Role::class)): ?>
          <?php echo Form::open(['route' => ['admin.setting.role.emptyTrash'], 'method' => 'delete', 'class' => 'data-form']); ?>

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
            <th><?php echo e(trans('app.type'), false); ?></th>
            <th><?php echo e(trans('app.deleted_at'), false); ?></th>
            <th><?php echo e(trans('app.option'), false); ?></th>
          </tr>
        </thead>
        <tbody>
          <?php $__currentLoopData = $trashes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trash): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
              <td>
                <h5><?php echo e($trash->name, false); ?></h5>
                <?php if($trash->description): ?>
                  <p class="excerpt-td small"><?php echo $trash->description; ?></p>
                <?php endif; ?>
              </td>
              <td><?php echo e($trash->public ? trans('app.merchant') : trans('app.platform'), false); ?></td>
              <td><?php echo e($trash->deleted_at->diffForHumans(), false); ?></td>
              <td class="row-options">
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete', $trash)): ?>
                  <a href="<?php echo e(route('admin.setting.role.restore', $trash->id), false); ?>"><i data-toggle="tooltip" data-placement="top" title="<?php echo e(trans('app.restore'), false); ?>" class="fa fa-database"></i></a>&nbsp;

                  <?php echo Form::open(['route' => ['admin.setting.role.destroy', $trash->id], 'method' => 'delete', 'class' => 'data-form']); ?>

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

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dappr/public_html/test.dappr.com.au/resources/views/admin/role/index.blade.php ENDPATH**/ ?>