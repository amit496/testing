<?php $__env->startSection('content'); ?>
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title"><?php echo e(trans('app.category_groups'), false); ?></h3>
      <div class="box-tools pull-right">
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create', \App\Models\CategoryGroup::class)): ?>
          <a href="javascript:void(0)" data-link="<?php echo e(route('admin.catalog.categoryGroup.create'), false); ?>" class="ajax-modal-btn btn btn-new btn-flat"><?php echo e(trans('app.add_category_group'), false); ?></a>
        <?php endif; ?>
      </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <table class="table table-hover table-2nd-no-sort">
        <thead>
          <tr>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('massDelete', \App\Models\CategoryGroup::class)): ?>
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
                    <li><a href="javascript:void(0)" data-link="<?php echo e(route('admin.catalog.categoryGroup.massTrash'), false); ?>" class="massAction " data-doafter="reload"><i class="fa fa-trash"></i> <?php echo e(trans('app.trash'), false); ?></a></li>
                    <li><a href="javascript:void(0)" data-link="<?php echo e(route('admin.catalog.categoryGroup.massDestroy'), false); ?>" class="massAction " data-doafter="reload"><i class="fa fa-times"></i> <?php echo e(trans('app.delete_permanently'), false); ?></a></li>
                  </ul>
                </div>
              </th>
            <?php endif; ?>
            <th><?php echo e(trans('app.background_image'), false); ?></th>
            <th><?php echo e(trans('app.cover_image'), false); ?></th>
            <th><?php echo e(trans('app.category_group'), false); ?></th>
            <th><?php echo e(trans('app.sub_groups'), false); ?></th>
            <th><?php echo e(trans('app.order'), false); ?></th>
            <th>&nbsp;</th>
          </tr>
        </thead>
        <tbody id="massSelectArea">
          <?php $__currentLoopData = $categoryGrps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categoryGrp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
              <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('massDelete', \App\Models\CategoryGroup::class)): ?>
                <td><input id="<?php echo e($categoryGrp->id, false); ?>" type="checkbox" class="massCheck"></td>
              <?php endif; ?>
              <td>
                <?php if(Storage::exists(optional($categoryGrp->backgroundImage)->path)): ?>
                  <img src="<?php echo e(get_storage_file_url(optional($categoryGrp->backgroundImage)->path, 'small'), false); ?>" class="" alt="<?php echo e(trans('app.background_image'), false); ?>">
                <?php endif; ?>
              </td>
              <td>
                <?php if(Storage::exists(optional($categoryGrp->coverImage)->path)): ?>
                  <img src="<?php echo e(get_storage_file_url(optional($categoryGrp->coverImage)->path, 'cover_thumb'), false); ?>" class="img-sm" alt="<?php echo e(trans('app.cover_image'), false); ?>">
                <?php endif; ?>
              </td>
              <td>
                <h5>
                  <i class="fa <?php echo e($categoryGrp->icon, false); ?>"></i> <?php echo e($categoryGrp->name, false); ?>

                  <?php if (! ($categoryGrp->active)): ?>
                    <span class="label label-default indent5 small"><?php echo e(trans('app.inactive'), false); ?></span>
                  <?php endif; ?>
                </h5>
                <?php if($categoryGrp->description): ?>
                  <span class="excerpt-td small"><?php echo Str::limit($categoryGrp->description, 220); ?></span>
                <?php endif; ?>
              </td>
              <td>
                <span class="label label-default"><?php echo e($categoryGrp->sub_groups_count, false); ?></span>
              </td>
              <td><?php echo e($categoryGrp->order, false); ?></td>
              <td class="row-options">
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update', $categoryGrp)): ?>
                  <a href="javascript:void(0)" data-link="<?php echo e(route('admin.catalog.categoryGroup.edit', $categoryGrp->id), false); ?>" class="ajax-modal-btn"><i data-toggle="tooltip" data-placement="top" title="<?php echo e(trans('app.edit'), false); ?>" class="fa fa-edit"></i></a>&nbsp;
                <?php endif; ?>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete', $categoryGrp)): ?>
                  <?php echo Form::open(['route' => ['admin.catalog.categoryGroup.trash', $categoryGrp->id], 'method' => 'delete', 'class' => 'data-form']); ?>

                  <?php echo Form::button('<i class="fa fa-trash-o"></i>', ['type' => 'submit', 'class' => 'confirm ajax-silent', 'title' => trans('app.trash'), 'data-toggle' => 'tooltip', 'data-placement' => 'top']); ?>

                  <?php echo Form::close(); ?>

                <?php endif; ?>
              </td>
            </tr>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
      </table>
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->

  <div class="box collapsed-box">
    <div class="box-header with-border">
      <h3 class="box-title">
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('massDelete', \App\Models\CategoryGroup::class)): ?>
          <?php echo Form::open(['route' => ['admin.catalog.categoryGroup.emptyTrash'], 'method' => 'delete', 'class' => 'data-form']); ?>

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
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <table class="table table-hover table-option">
        <thead>
          <tr>
            <th><?php echo e(trans('app.category_group'), false); ?></th>
            <th><?php echo e(trans('app.deleted_at'), false); ?></th>
            <th><?php echo e(trans('app.option'), false); ?></th>
          </tr>
        </thead>
        <tbody>
          <?php $__currentLoopData = $trashes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trash): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
              <td>
                <h5>
                  <i class="fa <?php echo e($trash->icon, false); ?>"></i> <?php echo e($trash->name, false); ?>

                </h5>
                <?php if($trash->description): ?>
                  <span class="excerpt-td small"><?php echo Str::limit($trash->description, 220); ?></span>
                <?php endif; ?>
              </td>
              <td><?php echo e($trash->deleted_at->diffForHumans(), false); ?></td>
              <td class="row-options">
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete', $trash)): ?>
                  <a href="<?php echo e(route('admin.catalog.categoryGroup.restore', $trash->id), false); ?>"><i data-toggle="tooltip" data-placement="top" title="<?php echo e(trans('app.restore'), false); ?>" class="fa fa-database"></i></a>&nbsp;

                  <?php echo Form::open(['route' => ['admin.catalog.categoryGroup.destroy', $trash->id], 'method' => 'delete', 'class' => 'data-form']); ?>

                  <?php echo Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'confirm ajax-silent', 'title' => trans('app.delete_permanently'), 'data-toggle' => 'tooltip', 'data-placement' => 'top']); ?>

                  <?php echo Form::close(); ?>

                <?php endif; ?>
              </td>
            </tr>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
      </table>
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dappr/public_html/test.dappr.com.au/resources/views/admin/category/categoryGroup.blade.php ENDPATH**/ ?>