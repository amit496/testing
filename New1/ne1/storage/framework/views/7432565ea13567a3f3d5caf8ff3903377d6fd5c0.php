<?php $__env->startSection('content'); ?>
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title"><?php echo e(trans('app.custom_styling'), false); ?></h3>
    </div> <!-- /.box-header -->
    <div class="box-body">
      <div class="row">
        <div class="col-md-7">
          <?php if(config('app.demo') == true): ?>
            <div class="alert alert-warning">
              <h4><i class="fa fa-info"></i> <?php echo e(trans('app.info'), false); ?></h4>
              <?php echo e(trans('messages.demo_restriction'), false); ?>

            </div>
          <?php else: ?>
            <?php echo Form::open(['route' => 'admin.appearance.custom_css.update', 'id' => 'form', 'data-toggle' => 'validator']); ?>

            <div class="form-group">
              <?php echo Form::label('theme_custom_css', trans('app.custom_css') . '*'); ?>

              <?php echo Form::textarea('theme_custom_css', get_from_option_table('theme_custom_styling', ''), ['class' => 'form-control', 'rows' => '10', 'placeholder' => trans('help.custom_css_help_text')]); ?>

              <div class="help-block with-errors"></div>
            </div>

            <p class="help-block small">
              <i class="fa fa-question-circle"></i> <?php echo e(trans('help.custom_css_help_text'), false); ?>

            </p>

            <?php echo Form::submit(trans('app.form.save'), ['class' => 'btn btn-lg btn-flat btn-new pull-right  ']); ?>

            <?php echo Form::close(); ?>

          <?php endif; ?>
        </div> <!-- /.col-md-7 -->
        <div class="col-md-5 nopadding-left">
          <?php echo $__env->make('admin.customcss._css_example', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div> <!-- /.col-md-5 -->
      </div> <!-- /.row -->
      <div class="spacer20"></div>
    </div> <!-- /.box-body -->
  </div> <!-- /.box -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\hype-dappr\resources\views/admin/customcss/edit.blade.php ENDPATH**/ ?>