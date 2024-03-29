<?php $__env->startSection('content'); ?>
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title"><?php echo e(trans('app.languages'), false); ?></h3>
      <div class="box-tools pull-right">
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create', \App\Models\Language::class)): ?>
          <a href="javascript:void(0)" data-link="<?php echo e(route('admin.setting.language.create'), false); ?>" class="ajax-modal-btn btn btn-new btn-flat"><?php echo e(trans('app.add_language'), false); ?></a>
        <?php endif; ?>
      </div>
    </div> <!-- /.box-header -->
    <div class="box-body">
      <table class="table table-hover table-2nd-no-sort">
        <thead>
          <tr>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('massDelete', \App\Models\Language::class)): ?>
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
                    <li><a href="javascript:void(0)" data-link="<?php echo e(route('admin.setting.language.massTrash'), false); ?>" class="massAction " data-doafter="reload"><i class="fa fa-trash"></i> <?php echo e(trans('app.trash'), false); ?></a></li>
                    <li><a href="javascript:void(0)" data-link="<?php echo e(route('admin.setting.language.massDestroy'), false); ?>" class="massAction " data-doafter="reload"><i class="fa fa-times"></i> <?php echo e(trans('app.delete_permanently'), false); ?></a></li>
                  </ul>
                </div>
              </th>
            <?php endif; ?>
            <th><?php echo e(trans('app.language'), false); ?></th>
            <th><?php echo e(trans('app.code'), false); ?></th>
            <th><?php echo e(trans('app.php_locale_code'), false); ?></th>
            <th>&nbsp;</th>
          </tr>
        </thead>
        <tbody id="massSelectArea">
          <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
              <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('massDelete', \App\Models\Language::class)): ?>
                <td><input id="<?php echo e($language->id, false); ?>" type="checkbox" class="massCheck"></td>
              <?php endif; ?>
              <td width="45%">
                <img src="<?php echo e(asset(sys_image_path('flags') . array_slice(explode('_', $language->php_locale_code), -1)[0] . '.png'), false); ?>" class="lang-flag small" alt="<?php echo e($language->code, false); ?>">
                <span class="indent10"><?php echo e($language->language, false); ?></span>
                <?php if($language->rtl): ?>
                  <span class="indent10 label label-outline"><?php echo e(trans('app.rtl'), false); ?></span>
                <?php endif; ?>
                <?php if($language->active): ?>
                  <span class="indent10 label label-primary pull-right"><?php echo e(trans('app.active'), false); ?></span>
                  <i class="fa fa-question-circle pull-right" data-toggle="tooltip" data-placement="top" title="<?php echo e(trans('help.new_language_info'), false); ?>"></i>
                <?php endif; ?>
              </td>
              <td><?php echo $language->code; ?></td>
              <td><?php echo $language->php_locale_code; ?></td>
              <td class="row-options text-muted small">
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update', $language)): ?>
                  <a href="javascript:void(0)" data-link="<?php echo e(route('admin.setting.language.edit', $language), false); ?>" class="ajax-modal-btn"><i data-toggle="tooltip" data-placement="top" title="<?php echo e(trans('app.edit'), false); ?>" class="fa fa-edit"></i></a>&nbsp;
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete', $language)): ?>
                  <?php if(in_array($language->id, config('system.freeze.languages'))): ?>
                    <i class="fa fa-bell-o text-muted" data-toggle="tooltip" data-placement="left" title="<?php echo e(trans('messages.freezed_model'), false); ?>"></i>
                  <?php else: ?>
                    <?php echo Form::open(['route' => ['admin.setting.language.trash', $language], 'method' => 'delete', 'class' => 'data-form']); ?>

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
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('massDelete', \App\Models\Language::class)): ?>
          <?php echo Form::open(['route' => ['admin.setting.language.emptyTrash'], 'method' => 'delete', 'class' => 'data-form']); ?>

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
      <table class="table table-hover table-2nd-sort">
        <thead>
          <tr>
            <th><?php echo e(trans('app.language'), false); ?></th>
            <th><?php echo e(trans('app.code'), false); ?></th>
            <th><?php echo e(trans('app.deleted_at'), false); ?></th>
            <th><?php echo e(trans('app.option'), false); ?></th>
          </tr>
        </thead>
        <tbody>
          <?php $__currentLoopData = $trashes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trash): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
              <td width="45%">
                <img src="<?php echo e(asset(sys_image_path('flags') . array_slice(explode('_', $trash->php_locale_code), -1)[0] . '.png'), false); ?>" class="lang-flag small" alt="<?php echo e($trash->code, false); ?>">
                <span class="indent10"><?php echo e($trash->language, false); ?></span>
                <?php if($trash->rtl): ?>
                  <span class="indent10 label label-primary pull-right"><?php echo e(trans('app.rtl'), false); ?></span>
                <?php endif; ?>
              </td>
              <td><?php echo $trash->code; ?></td>
              <td><?php echo e($trash->deleted_at->diffForHumans(), false); ?></td>
              <td class="row-options text-muted small">
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete', $trash)): ?>
                  <a href="<?php echo e(route('admin.setting.language.restore', $trash), false); ?>"><i data-toggle="tooltip" data-placement="top" title="<?php echo e(trans('app.restore'), false); ?>" class="fa fa-database"></i></a>&nbsp;
                  <?php echo Form::open(['route' => ['admin.setting.language.destroy', $trash], 'method' => 'delete', 'class' => 'data-form']); ?>

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

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dappr/public_html/portal.dappr.com.au/resources/views/admin/language/index.blade.php ENDPATH**/ ?>