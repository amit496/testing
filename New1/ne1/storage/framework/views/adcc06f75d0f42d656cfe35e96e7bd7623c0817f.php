
<?php if(config('system.subscription.enabled')): ?>

    <?php if(config('system.subscription.billing') == 'stripe' && ! \App\Models\SystemConfig::isPaymentConfigured('stripe')): ?>

      <div class="alert alert-danger">
          <h4><i class="fa fa-exclamation-triangle"></i> <?php echo e(trans('app.misconfigured') . '!!!', false); ?></h4>
          <?php echo trans('messages.misconfigured_subscription_stripe'); ?>

      </div>

    <?php elseif(config('system.subscription.billing') == 'wallet'): ?>

      <?php if (! (is_incevio_package_loaded(['wallet','subscription']))): ?>
        <div class="alert alert-danger">
            <h4><i class="fa fa-exclamation-triangle"></i> <?php echo e(trans('app.misconfigured') . '!!!', false); ?></h4>
            <?php echo trans('messages.misconfigured_subscription_wallet'); ?>

        </div>
      <?php endif; ?>

    <?php endif; ?>
<?php endif; ?>

<?php /**PATH C:\wamp64\www\hype-dappr\resources\views/admin/partials/_check_misconfigured_subscription.blade.php ENDPATH**/ ?>