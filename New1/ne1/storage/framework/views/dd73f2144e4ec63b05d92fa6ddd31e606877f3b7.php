<?php $__env->startSection('content'); ?>
  <div class="box login-box-body">
    <div class="box-header with-border">
      <h3 class="box-title"><?php echo e(trans('app.form.register'), false); ?></h3>
    </div> <!-- /.box-header -->
    <div class="box-body">
      <?php echo Form::open(['route' => 'register', 'id' => config('system_settings.required_card_upfront') ? 'stripe-form' : 'registration-form', 'data-toggle' => 'validator']); ?>


      <?php if(is_subscription_enabled()): ?>
        <div class="form-group has-feedback">
          <?php echo e(Form::select('plan', $plans, isset($plan) ? $plan : null, ['id' => 'plans', 'class' => 'form-control input-lg', 'required']), false); ?>

          <i class="glyphicon glyphicon-dashboard form-control-feedback"></i>
          <div class="help-block with-errors">
            <?php if((bool) config('system_settings.trial_days')): ?>
              <?php echo e(trans('help.charge_after_trial_days', ['days' => config('system_settings.trial_days')]), false); ?>

            <?php endif; ?>
          </div>
        </div>
      <?php endif; ?>

      <div class="form-group has-feedback">
        <?php echo Form::email('email', null, ['class' => 'form-control input-lg', 'placeholder' => trans('app.placeholder.valid_email'), 'required']); ?>

        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        <div class="help-block with-errors"></div>
      </div>
      <div class="form-group has-feedback">
        <?php echo Form::password('password', ['class' => 'form-control input-lg', 'id' => 'password', 'placeholder' => trans('app.placeholder.password'), 'data-minlength' => '6', 'required']); ?>

        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        <div class="help-block with-errors"></div>
      </div>
      <div class="form-group has-feedback">
        <?php echo Form::password('password_confirmation', ['class' => 'form-control input-lg', 'placeholder' => trans('app.placeholder.confirm_password'), 'data-match' => '#password', 'required']); ?>

        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        <div class="help-block with-errors"></div>
      </div>

      <div class="form-group has-feedback">
        <?php echo Form::text('phone', null, ['class' => 'form-control input-lg', 'placeholder' => trans('app.placeholder.phone')]); ?>

        <i class="glyphicon glyphicon-phone form-control-feedback"></i>
        <div class="help-block with-errors"></div>
      </div>

      <div class="form-group has-feedback">
        <?php echo Form::text('shop_name', null, ['class' => 'form-control input-lg', 'placeholder' => trans('app.placeholder.shop_name'), 'required']); ?>

        <i class="glyphicon glyphicon-equalizer form-control-feedback"></i>
        <div class="help-block with-errors"></div>
      </div>

      <div class="row">
        <div class="col-xs-8">
          <div class="form-group">
            <label>
              <?php echo Form::checkbox('agree', null, null, ['class' => 'icheck', 'required']); ?> <?php echo trans('app.form.i_agree_with_merchant_terms', ['url' => route('page.open', \App\Models\Page::PAGE_TNC_FOR_MERCHANT)]); ?>

            </label>
            <div class="help-block with-errors"></div>
          </div>
        </div>

        <div class="col-xs-4">
          <?php echo Form::submit(trans('app.form.register'), ['id' => 'card-button', 'class' => 'btn btn-block btn-lg btn-flat btn-primary']); ?>

        </div>
      </div>
      <?php echo Form::close(); ?>


      <a href="<?php echo e(route('login'), false); ?>" class="btn btn-link"><?php echo e(trans('app.form.merchant_login'), false); ?></a>
    </div>
  </div>
  <!-- /.form-box -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('auth.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\hype-dappr\resources\views/auth/register.blade.php ENDPATH**/ ?>