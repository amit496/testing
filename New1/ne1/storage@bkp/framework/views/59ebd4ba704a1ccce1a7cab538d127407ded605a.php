<?php $__env->startSection('content'); ?>
<style>   .nav li:first-child{ border-bottom: 0px solid #c3c3c3; }</style>
  <div class=" login-box-body">
  <ul class="nav nav-pills nav-justified  nav-mar-style" id="ex1" role="tablist">
          <li class="nav-item" role="presentation">
            <a class="nav-link active" id="tab-login" data-mdb-toggle="pill" href="<?php echo e(route('customer.login'), false); ?>" role="tab"
              aria-controls="pills-login" aria-selected="true">Login</a>
          </li>
          <li class="nav-item" role="presentation">
            <a class="nav-link" id="tab-register" data-mdb-toggle="pill" href="#pills-login"  role="tab"
              aria-controls="pills-register" aria-selected="false">Create Account </a>
          </li>
        </ul>
    <div class="box-header with- border">
      <!-- <h3 class="box-title"><?php echo e(trans('theme.register'), false); ?></h3> -->
    </div> 
    <!-- /.box-header -->
    <div class="box-body">
      <?php echo Form::open(['route' => 'customer.register', 'id' => 'form', 'data-toggle' => 'validator']); ?>

      <div class="form-group has-feedback">
      <label for="basic-url" class="form-label">First name*</label>
        <?php echo Form::text('name', null, ['class' => 'form-control input-lg', 'placeholder' => trans('theme.placeholder.full_name'), 'required']); ?>

        <!-- <span class="glyphicon glyphicon-user form-control-feedback"></span> -->
        <div class="help-block with-errors"></div>
      </div>

       <div class="form-group has-feedback">
       <label for="basic-url" class="form-label">Last name*</label>
        <?php echo Form::text('last_name', null, ['class' => 'form-control input-lg', 'placeholder' => trans('stylist.placeholder.last_name'), 'required']); ?>

        <!-- <span class="glyphicon glyphicon-user form-control-feedback"></span> -->
        <div class="help-block with-errors"></div>
      </div>

      <div class="form-group has-feedback">
      <label for="basic-url" class="form-label">Email*</label>
        <?php echo Form::email('email', null, ['class' => 'form-control input-lg', 'placeholder' => trans('theme.placeholder.valid_email'), 'required']); ?>

        <!-- <span class="glyphicon glyphicon-envelope form-control-feedback"></span> -->
        <div class="help-block with-errors"></div>
      </div>
      <div class="form-group has-feedback">
      <label for="basic-url" class="form-label">Password*</label>
        <?php echo Form::password('password', ['class' => 'form-control input-lg', 'id' => 'password', 'placeholder' => trans('theme.placeholder.password'), 'data-minlength' => '6', 'required']); ?>

        <!-- <span class="glyphicon glyphicon-lock form-control-feedback"></span> -->
        <div class="help-block with-errors"></div>
      </div>
      <div class="form-group has-feedback">
      <label for="basic-url" class="form-label">Confirm Password</label>
        <?php echo Form::password('password_confirmation', ['class' => 'form-control input-lg', 'placeholder' => trans('theme.placeholder.confirm_password'), 'data-match' => '#password', 'required']); ?>

        <!-- <span class="glyphicon glyphicon-lock form-control-feedback"></span> -->
        <div class="help-block with-errors"></div>
      </div>
       <div class="form-group has-feedback">
       <label for="basic-url" class="form-label">Date of birth*</label>
        <?php echo Form::date('dob', null, ['class' => 'form-control input-lg', 'placeholder' => trans('stylist.placeholder.dob'), 'required']); ?>


        <div class="help-block with-errors"></div>
      </div>



      <?php if(is_incevio_package_loaded('zipcode')): ?>
        <?php echo $__env->make('address._form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <?php endif; ?>
<!--
      <div class="form-group has-feedback">
        <?php if(config('services.recaptcha.key')): ?>
          <div class="g-recaptcha" data-sitekey="<?php echo config('services.recaptcha.key'); ?>"></div>
        <?php endif; ?>
        <div class="help-block with-errors"></div>
      </div>

      <?php if(config('system_settings.ask_customer_for_email_subscription')): ?>
        <div class="form-group">
          <label>
            <?php echo Form::checkbox('subscribe', null, null, ['class' => 'icheck']); ?> <?php echo trans('theme.input_label.subscribe_to_the_newsletter'); ?>

          </label>
        </div>
      <?php endif; ?> -->

      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label>
              <?php echo Form::checkbox('agree', null, null, ['class' => 'icheck', 'required']); ?> <?php echo trans('theme.input_label.i_agree_with_terms', ['url' => route('page.open', \App\Models\Page::PAGE_TNC_FOR_CUSTOMER)]); ?>

            </label>
            <div class="help-block with-errors"></div>
          </div>
        </div>
        <div class="col-md-12">
          <?php echo Form::submit(trans('CREATE ACCOUNT'), ['class' => 'btn btn-block btn-lg btn-flat btn-primary']); ?>

        </div>
      </div>
      <?php echo Form::close(); ?>


      <?php if(config('system_settings.social_auth')): ?>
        <div class="social-auth-links text-center">
          <?php if(config('services.facebook.client_id')): ?>
            <a href="<?php echo e(route('socialite.customer', 'facebook'), false); ?>" class="btn btn-block btn-social btn-facebook btn-lg btn-flat"><i class="fa fa-facebook"></i> <?php echo e(trans('theme.button.login_with_fb'), false); ?></a>
          <?php endif; ?>

          <?php if(config('services.google.client_id')): ?>
            <a href="<?php echo e(route('socialite.customer', 'google'), false); ?>" class="btn btn-block btn-social btn-google btn-lg btn-flat"><i class="fa fa-google"></i> <?php echo e(trans('theme.button.login_with_g'), false); ?></a>
          <?php endif; ?>

          <?php if(is_incevio_package_loaded('apple-login')): ?>
            <a href="<?php echo e(route('socialite.customer', 'apple'), false); ?>" class="btn btn-block btn-social btn-apple btn-lg btn-flat">
              <i class="fa fa-apple"></i> <?php echo e(trans('appleLogin::lang.login_with_apple'), false); ?>

            </a>
          <?php endif; ?>
        </div>
      <?php endif; ?>

      <!-- <a href="<?php echo e(route('customer.login'), false); ?>" class="btn btn-link"><?php echo e(trans('theme.have_an_account'), false); ?></a> -->
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('theme::auth.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\hype-dappr\public\themes\default/views/auth/register.blade.php ENDPATH**/ ?>