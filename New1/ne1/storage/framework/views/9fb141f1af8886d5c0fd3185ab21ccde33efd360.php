<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModal" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
    <div class="modal-content p-2">
      <div class="modal-header p-3">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-title text-center">
          <h4><?php echo e(trans('theme.account_login'), false); ?></h4>
        </div>

        <div class="d-flex flex-column text-center">
          <?php echo Form::open(['route' => 'customer.login.submit', 'id' => 'loginForm', 'data-toggle' => 'validator', 'novalidate']); ?>

          <div class="form-group">
            <input name="email" id="email" class="form-control input-lg" type="email" placeholder="<?php echo e(trans('theme.placeholder.your_email'), false); ?>" required />
            <div class="help-block with-errors"></div>
          </div>

          <div class="form-group">
            <input name="password" id="password" class="form-control input-lg" type="password" placeholder="<?php echo e(trans('theme.placeholder.password'), false); ?>" required />
            <div class="help-block with-errors"></div>
          </div>

          <div class="form-group text-left">
            <label>
              <input name="remeber" id="remeber" class="i-check-blue" type="checkbox" /> <?php echo e(trans('theme.remember_me'), false); ?>

            </label>
          </div>

          <input class="btn btn-primary btn-block btn-lg btn-round mt-3" type="submit" value="<?php echo e(trans('theme.button.login'), false); ?>">
          <?php echo Form::close(); ?>


          <?php echo $__env->make('theme::auth._social_login', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
      </div>

      <div class="modal-footer d-flex justify-content-center">
        <div class="signup-section">
          <a href="javascript:void(0);" class="btn btn-link" data-dismiss="modal" data-toggle="modal" data-target="#passwordResetModal"><?php echo e(trans('theme.forgot_password'), false); ?></a>

          <a href="javascript:void(0);" class="btn btn-link text-info" data-dismiss="modal" data-toggle="modal" data-target="#createAccountModal"><?php echo e(trans('theme.register_here'), false); ?></a>
        </div>
      </div>
    </div>
  </div>
</div> <!-- /#loginModal -->

<div class="modal fade" id="createAccountModal" tabindex="-1" role="dialog" aria-labelledby="createAccountModal" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
    <div class="modal-content p-2">
      <div class="modal-header p-3">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-title text-center">
          <h4><?php echo e(trans('theme.create_account'), false); ?></h4>
        </div>

        <div class="d-flex flex-column text-center">
          <?php echo Form::open(['route' => 'customer.register', 'id' => 'registerForm', 'data-toggle' => 'validator', 'novalidate']); ?>

          <div class="form-group">
            <input name="name" class="form-control" placeholder="<?php echo e(trans('theme.placeholder.full_name'), false); ?>" type="text" required />
            <div class="help-block with-errors"></div>
          </div>
          <div class="form-group">
            <input name="email" class="form-control" placeholder="<?php echo e(trans('theme.placeholder.your_email'), false); ?>" type="email" required />
            <div class="help-block with-errors"></div>
          </div>

          <div class="form-group">
            <input name="password" class="form-control" placeholder="<?php echo e(trans('theme.placeholder.password'), false); ?>" type="password" required />
            <div class="help-block with-errors"></div>
          </div>

          <div class="form-group">
            <input name="password_confirmation" class="form-control" placeholder="<?php echo e(trans('theme.placeholder.confirm_password'), false); ?>" type="password" required />
            <div class="help-block with-errors"></div>
          </div>

          <div class="form-group text-left pb-2 has-feedback">
            <?php if(config('services.recaptcha.key')): ?>
              <div class="g-recaptcha" data-sitekey="<?php echo config('services.recaptcha.key'); ?>"></div>
            <?php endif; ?>
            <div class="help-block with-errors"></div>
          </div>

          <?php if(config('system_settings.ask_customer_for_email_subscription')): ?>
            <div class="form-group text-left pb-2">
              <label>
                <input name="subscribe" class="i-check-blue" type="checkbox" /> <?php echo e(trans('theme.input_label.subscribe_to_the_newsletter'), false); ?>

              </label>
            </div>
          <?php endif; ?>

          <div class="form-group text-left pb-2">
            <label>
              <input name="agree" class="i-check-blue" type="checkbox" required /> <?php echo trans('theme.input_label.i_agree_with_terms', ['url' => route('page.open', \App\Models\Page::PAGE_TNC_FOR_CUSTOMER)]); ?>

            </label>
            <div class="help-block with-errors"></div>
          </div>

          <input class="btn btn-primary btn-block btn-lg btn-round mt-3" type="submit" value="<?php echo e(trans('theme.create_account'), false); ?>">
          <?php echo Form::close(); ?>


          <?php echo $__env->make('theme::auth._social_login', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
      </div>
      <div class="modal-footer d-flex justify-content-center">
        <div class="signup-section">
          <a href="javascript:void(0);" class="btn btn-link" data-dismiss="modal" data-toggle="modal" data-target="#loginModal"><?php echo e(trans('theme.have_account'), false); ?></a>
        </div>
      </div>
    </div>
  </div>
</div> <!-- /#createAccountModal -->

<div class="modal fade" id="passwordResetModal" tabindex="-1" role="dialog" aria-labelledby="passwordResetModal" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
    <div class="modal-content p-2">
      <div class="modal-header p-3">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-title text-center">
          <h4><?php echo e(trans('theme.password_recovery'), false); ?></h4>
        </div>

        <div class="d-flex flex-column text-center">
          <?php echo Form::open(['route' => 'customer.password.email', 'id' => 'psswordRecoverForm', 'data-toggle' => 'validator', 'novalidate']); ?>

          <div class="form-group">
            <input name="email" class="form-control input-lg" placeholder="<?php echo e(trans('theme.placeholder.your_email'), false); ?>" type="email" required />
            <div class="help-block with-errors"></div>
          </div>

          <input class="btn btn-primary btn-block btn-lg btn-round mt-3" type="submit" value="<?php echo e(trans('theme.button.recover_password'), false); ?>">
          <?php echo Form::close(); ?>

        </div>
      </div>
      <div class="modal-footer d-flex justify-content-center">
        <div class="signup-section">
          <a href="javascript:void(0);" class="btn btn-link" data-dismiss="modal" data-toggle="modal" data-target="#loginModal"><?php echo e(trans('theme.login'), false); ?></a>
        </div>
      </div>
    </div>
  </div>
</div> <!-- /#passwordResetModal -->


<?php if(config('services.recaptcha.key')): ?>
  <?php echo $__env->make('theme::scripts.recaptcha', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
<?php /**PATH C:\wamp64\www\hype-dappr\public\themes\default/views/auth/modals.blade.php ENDPATH**/ ?>