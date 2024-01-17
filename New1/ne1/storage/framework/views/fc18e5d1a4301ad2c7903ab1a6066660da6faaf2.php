<div class="text-center text-muted p-3"><?php echo e(trans('theme.login_with_social'), false); ?></div>

<div class="d-flex justify-content-center social-buttons">
  <?php if(config('services.facebook.client_id')): ?>
    <a href="<?php echo e(route('socialite.customer', 'facebook'), false); ?>" class="btn btn-facebook btn-round" data-toggle="tooltip" data-placement="top" title="<?php echo e(trans('theme.button.login_with_fb'), false); ?>">
      <i class="fab fa-facebook-f"></i>
    </a>
  <?php endif; ?>

  <?php if(config('services.google.client_id')): ?>
    <a href="<?php echo e(route('socialite.customer', 'google'), false); ?>" class="btn btn-google btn-round" data-toggle="tooltip" data-placement="top" title="<?php echo e(trans('theme.button.login_with_g'), false); ?>">
      <i class="fab fa-google"></i>
    </a>
  <?php endif; ?>

  <?php if(is_incevio_package_loaded('apple-login')): ?>
    <a href="<?php echo e(route('socialite.customer', 'apple'), false); ?>" class="btn btn-apple btn-round" data-toggle="tooltip" data-placement="top" title="<?php echo e(trans('appleLogin::lang.login_with_apple'), false); ?>">
      <i class="fab fa-apple"></i>
    </a>
  <?php endif; ?>
</div>
<?php /**PATH C:\wamp64\www\hype-dappr\public\themes\default/views/auth/_social_login.blade.php ENDPATH**/ ?>