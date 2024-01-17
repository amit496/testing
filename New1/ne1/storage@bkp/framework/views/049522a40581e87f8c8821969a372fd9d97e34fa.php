<?php $__env->startSection('content'); ?>
<style>    .nav li:last-child{ border-bottom: 0px solid #c3c3c3; }    </style>
  <div class="login-box-body">
    <ul class="nav nav-pills nav-justified  nav-mar-style" id="ex1" role="tablist" >
          <li class="nav-item" role="presentation">
            <a class="nav-link active" id="tab-login" data-mdb-toggle="pill" href="#pills-login" role="tab"
              aria-controls="pills-login" aria-selected="true">Login</a>
          </li>
          <li class="nav-item" role="presentation">
            <a class="nav-link" id="tab-register" data-mdb-toggle="pill" href="<?php echo e(route('customer.register'), false); ?>" role="tab"
              aria-controls="pills-register" aria-selected="false">Register</a>
          </li>
        </ul>


    <div class="box-header with -border">
      <!-- <h3 class="box-title"><?php echo e(trans('theme.account_login'), false); ?></h3> -->
    </div> <!-- /.box-header -->
    <div class="box-body">
      <?php echo Form::open(['route' => 'customer.login.submit', 'id' => 'form', 'data-toggle' => 'validator']); ?>

      <div class="form-group has-feedback">
      <label for="basic-url" class="form-label">Email*</label>
        <?php echo Form::email('email', null, ['class' => 'form-control input-lg', 'placeholder' => trans('theme.placeholder.email'), 'required']); ?>

        <!-- <span class="glyphicon glyphicon-envelope form-control-feedback"></span> -->
        <div class="help-block with-errors"></div>
      </div>
      <div class="form-group has-feedback">
      <label for="basic-url" class="form-label">Password*</label>
        <?php echo Form::password('password', ['class' => 'form-control input-lg', 'id' => 'password', 'placeholder' => trans('theme.placeholder.password'), 'data-minlength' => '6', 'required']); ?>

        <!-- <span class="glyphicon glyphicon-lock form-control-feedback"></span> -->
        <div class="help-block with-errors"></div>
      </div>
      <div class="row">
        <div class="col-md-12 col-sm-12">
          <div class="form-group text-sm-center">
            <label>
              <?php echo Form::checkbox('remember', null, null, ['class' => 'icheck']); ?> <?php echo e(trans('theme.remember_me'), false); ?>

            </label>
          </div>
        </div>
        <div class="col-md-12 col-sm-12">
          <?php echo Form::submit(trans('theme.button.login'), ['class' => 'btn btn-block btn-lg btn-flat btn-primary']); ?>

        </div>
      </div>
      <?php echo Form::close(); ?>


      <?php if(config('system_settings.social_auth')): ?>
        <div class="social-auth-links text-center">
          <?php if(config('services.facebook.client_id')): ?>
            <a href="<?php echo e(route('socialite.customer', 'facebook'), false); ?>" class="btn btn-block btn-social btn-facebook btn-lg btn-flat">
              <i class="fa fa-facebook"></i> <?php echo e(trans('theme.button.login_with_fb'), false); ?>

            </a>
          <?php endif; ?>

          <?php if(config('services.google.client_id')): ?>
            <a href="<?php echo e(route('socialite.customer', 'google'), false); ?>" class="btn btn-block btn-social btn-google btn-lg btn-flat">
              <i class="fa fa-google"></i> <?php echo e(trans('theme.button.login_with_g'), false); ?>

            </a>
          <?php endif; ?>

          <?php if(is_incevio_package_loaded('apple-login')): ?>
            <a href="<?php echo e(route('socialite.customer', 'apple'), false); ?>" class="btn btn-block btn-social btn-apple btn-lg btn-flat">
              <i class="fa fa-apple"></i> <?php echo e(trans('appleLogin::lang.login_with_apple'), false); ?>

            </a>
          <?php endif; ?>
        </div> <!-- /.social-auth-links -->
      <?php endif; ?>

      <div class="col-md-12 text-center">
      <a class="btn btn-link" href="<?php echo e(route('customer.password.request'), false); ?>">
        <?php echo e(trans('theme.forgot_password'), false); ?>

      </a>

      </div>
      <!-- <a class="btn btn-link" href="<?php echo e(route('customer.register'), false); ?>" class="text-center">
        <?php echo e(trans('theme.register_here'), false); ?>

      </a> -->
    </div>
  </div>

  <?php if(config('app.demo') == true): ?>
    <div class="box login-box-body">
      <div class="box-header with-border">
        <h3 class="box-title">Demo Login::</h3>
      </div> <!-- /.box-header -->
      <div class="box-body">
        <p>Username: <strong>customer@demo.com</strong> | Password: <strong>123456</strong> </p>
      </div>
    </div>
  <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('theme::auth.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\hype-dappr\public\themes\default/views/auth/login.blade.php ENDPATH**/ ?>