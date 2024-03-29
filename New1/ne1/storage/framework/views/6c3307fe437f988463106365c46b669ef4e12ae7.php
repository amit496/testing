<?php $__env->startSection('content'); ?>

  <?php echo $__env->make('admin.partials._shop_widget', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title"><?php echo e(trans('app.staffs'), false); ?></h3>
      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
      </div>
    </div> <!-- /.box-header -->
    <div class="box-body">
      <table class="table table-hover table-2nd-no-sort">
        <thead>
          <tr>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('massDelete', \App\Models\User::class)): ?>
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
                    <li><a href="javascript:void(0)" data-link="<?php echo e(route('admin.admin.user.massTrash'), false); ?>" class="massAction " data-doafter="reload"><i class="fa fa-trash"></i> <?php echo e(trans('app.trash'), false); ?></a></li>
                    <li><a href="javascript:void(0)" data-link="<?php echo e(route('admin.admin.user.massDestroy'), false); ?>" class="massAction " data-doafter="reload"><i class="fa fa-times"></i> <?php echo e(trans('app.delete_permanently'), false); ?></a></li>
                  </ul>
                </div>
              </th>
            <?php endif; ?>
            <th><?php echo e(trans('app.avatar'), false); ?></th>
            <th><?php echo e(trans('app.nice_name'), false); ?></th>
            <th><?php echo e(trans('app.full_name'), false); ?></th>
            <th><?php echo e(trans('app.email'), false); ?></th>
            <th><?php echo e(trans('app.role'), false); ?></th>
            <th><?php echo e(trans('app.status'), false); ?></th>
            <th><?php echo e(trans('app.option'), false); ?></th>
          </tr>
        </thead>
        <tbody id="massSelectArea">
          <?php $__currentLoopData = $staffs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
              <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('massDelete', \App\Models\User::class)): ?>
                <td><input id="<?php echo e($user->id, false); ?>" type="checkbox" class="massCheck"></td>
              <?php endif; ?>
              <td>
                <img src="<?php echo e(get_avatar_src($user, 'tiny'), false); ?>" class="img-circle img-sm" alt="<?php echo e(trans('app.avatar'), false); ?>">
              </td>
              <td>
                <?php echo e($user->nice_name, false); ?>

                <?php if($user->id == $shop->owner_id): ?>
                  <span class="label label-outline"><?php echo e(trans('app.owner'), false); ?></span>
                <?php endif; ?>
              </td>
              <td><?php echo e($user->name, false); ?></td>
              <td><?php echo e($user->email, false); ?></td>
              <td>
                <span class="label label-outline"><?php echo e($user->role->name, false); ?></span>
              </td>
              <td><?php echo e($user->active ? trans('app.active') : trans('app.inactive'), false); ?></td>
              <td class="row-options">
                <?php if(Auth::user()->isSuperAdmin() || $user->id != $shop->owner_id): ?>
                  <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view', $user)): ?>
                    <a href="javascript:void(0)" data-link="<?php echo e(route('admin.admin.user.show', $user->id), false); ?>" class="ajax-modal-btn"><i data-toggle="tooltip" data-placement="top" title="<?php echo e(trans('app.detail'), false); ?>" class="fa fa-user-circle-o"></i></a>&nbsp;
                  <?php endif; ?>

                  <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('secretLogin', $user)): ?>
                    <a href="<?php echo e(route('admin.user.secretLogin', $user), false); ?>"><i data-toggle="tooltip" data-placement="top" title="<?php echo e(trans('app.secret_login_user'), false); ?>" class="fa fa-user-secret"></i></a>&nbsp;
                  <?php endif; ?>

                  <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update', $user)): ?>
                    <a href="javascript:void(0)" data-link="<?php echo e(route('admin.admin.user.edit', $user->id), false); ?>" class="ajax-modal-btn"><i data-toggle="tooltip" data-placement="top" title="<?php echo e(trans('app.edit'), false); ?>" class="fa fa-edit"></i></a>&nbsp;

                    <?php if($user->primaryAddress): ?>
                      <a href="javascript:void(0)" data-link="<?php echo e(route('address.edit', $user->primaryAddress->id), false); ?>" class="ajax-modal-btn"><i data-toggle="tooltip" data-placement="top" title="<?php echo e(trans('app.update_address'), false); ?>" class="fa fa-map-marker"></i></a>&nbsp;
                    <?php else: ?>
                      <a href="javascript:void(0)" data-link="<?php echo e(route('address.create', ['user', $user->id]), false); ?>" class="ajax-modal-btn"><i data-toggle="tooltip" data-placement="top" title="<?php echo e(trans('app.add_address'), false); ?>" class="fa fa-plus-square-o"></i></a>&nbsp;
                    <?php endif; ?>
                  <?php endif; ?>

                  <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete', $user)): ?>
                    <?php echo Form::open(['route' => ['admin.admin.user.trash', $user->id], 'method' => 'delete', 'class' => 'data-form']); ?>

                    <?php echo Form::button('<i class="fa fa-trash-o"></i>', ['type' => 'submit', 'class' => 'confirm ajax-silent', 'title' => trans('app.trash'), 'data-toggle' => 'tooltip', 'data-placement' => 'top']); ?>

                    <?php echo Form::close(); ?>

                  <?php endif; ?>
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
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('massDelete', \App\Models\User::class)): ?>
          <?php echo Form::open(['route' => ['admin.admin.user.emptyTrash'], 'method' => 'delete', 'class' => 'data-form']); ?>

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
            <th><?php echo e(trans('app.avatar'), false); ?></th>
            <th><?php echo e(trans('app.nice_name'), false); ?></th>
            <th><?php echo e(trans('app.full_name'), false); ?></th>
            <th><?php echo e(trans('app.email'), false); ?></th>
            <th><?php echo e(trans('app.role'), false); ?></th>
            <th><?php echo e(trans('app.deleted_at'), false); ?></th>
            <th><?php echo e(trans('app.option'), false); ?></th>
          </tr>
        </thead>
        <tbody>
          <?php $__currentLoopData = $trashes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trash): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
              <td>
                <img src="<?php echo e(get_avatar_src($trash, 'tiny'), false); ?>" class="img-circle img-sm" alt="<?php echo e(trans('app.avatar'), false); ?>">
              </td>
              <td><?php echo e($trash->nice_name, false); ?></td>
              <td><?php echo e($trash->name, false); ?></td>
              <td><?php echo e($trash->email, false); ?></td>
              <td><span class="label label-outline"><?php echo e($user->role->name, false); ?></span></td>
              <td><?php echo e($trash->deleted_at->diffForHumans(), false); ?></td>
              <td class="row-options">
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete', $trash)): ?>
                  <a href="<?php echo e(route('admin.admin.user.restore', $trash->id), false); ?>"><i data-toggle="tooltip" data-placement="top" title="<?php echo e(trans('app.restore'), false); ?>" class="fa fa-database"></i></a>&nbsp;

                  <?php echo Form::open(['route' => ['admin.admin.user.destroy', $trash->id], 'method' => 'delete', 'class' => 'data-form']); ?>

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

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dappr/public_html/portal.dappr.com.au/resources/views/admin/shop/staffs.blade.php ENDPATH**/ ?>