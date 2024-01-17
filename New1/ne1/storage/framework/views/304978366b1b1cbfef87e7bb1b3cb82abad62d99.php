<div class="row">
  <div class="col-md-12">
    <?php echo $__env->make('admin.partials._subscription_notice', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!-- Error Message -->
    <?php if(Session::has('error')): ?>
      <div class="alert alert-danger"><?php echo e(Session::get('error'), false); ?></div>
    <?php endif; ?>
  </div>

  <div class="col-md-8 col-md-offset-2">
    <?php if(Auth::user()->hasExpiredPlan()): ?>
      <div class="alert alert-danger">
        <strong><i class="icon fa fa-info-circle"></i><?php echo e(trans('app.notice'), false); ?></strong>
        <?php echo e(trans('messages.subscription_expired'), false); ?>

      </div>
    <?php endif; ?>

    <?php if (! (Auth::user()->isSubscribed())): ?>
      <div class="alert alert-info">
        <i class="icon fa fa-rocket"></i><?php echo e(trans('messages.choose_subscription'), false); ?>

      </div>
    <?php endif; ?>

    <div class="panel panel-default">
      <div class="panel-body">
        <fieldset>
          <legend><?php echo e(trans('app.subscription_plans'), false); ?></legend>
          <table class="table no-border">
            <tbody>
              <?php $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                  <td>
                    <span class="lead"><?php echo e($plan->name, false); ?></span>
                    <?php if(optional($current_plan)->stripe_price == $plan->plan_id): ?>
                      <i class="fa fa-dot-circle-o text-primary indent5" data-toggle="tooltip" title="<?php echo e(trans('app.current_plan'), false); ?>"></i>
                    <?php endif; ?>
                  </td>
                  <td>
                    <a href="javascript:void(0)" data-link="<?php echo e(route('admin.account.subscription.features', $plan->plan_id), false); ?>" class="ajax-modal-btn btn btn-link">
                      <i class="fa fa-star-o"></i> <?php echo e(trans('app.features'), false); ?>

                    </a>
                  </td>

                  <td class="lead">
                    <?php echo e(get_formated_currency($plan->cost) . trans('app.per_month'), false); ?>

                  </td>

                  <?php if(\Auth::user()->isMerchant()): ?>
                    <td class="pull-right">
                      <?php if(optional($current_plan)->stripe_price == $plan->plan_id): ?>
                        <?php if(Auth::user()->isOnGracePeriod()): ?>
                          <a href="<?php echo e(route('admin.account.subscription.resume'), false); ?>" class="confirm btn btn-lg btn-primary">
                            <i class="fa fa-play"></i> <?php echo e(trans('app.resume_subscription'), false); ?>

                          </a>
                        <?php elseif($current_plan->provider == 'stripe'): ?>
                          <?php echo Form::open(['route' => ['admin.account.subscription.cancel', $current_plan], 'method' => 'delete', 'class' => 'inline']); ?>

                          <button type="submit" class="confirm ajax-silent btn btn-lg btn-danger">
                            <i class="fa fa-times-circle-o"></i> <?php echo e(trans('app.cancel'), false); ?>

                          </button>
                          <?php echo Form::close(); ?>

                        <?php else: ?>
                          <button class="btn btn-lg btn-new disabled">
                            <i class="fa fa-check-circle-o"></i> <?php echo e(trans('app.current_plan'), false); ?>

                          </button>
                        <?php endif; ?>
                      <?php else: ?>
                        <a href="<?php echo e(route('admin.account.subscribe', $plan->plan_id), false); ?>" class="confirm btn btn-lg btn-default">
                          <i class="fa fa-leaf"></i> <?php echo e(trans('app.select_this_plan'), false); ?>

                        </a>
                      <?php endif; ?>
                    </td>
                  <?php endif; ?>
                </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
          </table>
          <?php if((bool) config('system_settings.trial_days')): ?>
            <span class="spacer10"></span>
            <span class="text-info">
              <i class="icon fa fa-info-circle"></i>
              <?php echo trans('messages.plan_comes_with_trial', ['days' => config('system_settings.trial_days')]); ?>

            </span>
          <?php endif; ?>
        </fieldset>
      </div>
    </div>

    <?php if(Auth::user()->isMerchant()): ?>
      
      <?php if (! (\App\Models\SystemConfig::isBillingThroughWallet())): ?>
        <div class="alert alert-info">
          <strong><i class="icon fa fa-credit-card"></i></strong>
          <?php echo e(trans('messages.no_billing_info'), false); ?>

        </div>

        <?php if(\App\Models\SystemConfig::isPaymentConfigured('stripe')): ?>
          <div class="panel panel-default">
            <div class="panel-body">
              <?php echo Form::model($profile, ['method' => 'PUT', 'route' => ['admin.account.card.update'], 'id' => 'stripe-form', 'data-toggle' => 'validator']); ?>


              <?php echo $__env->make('auth.stripe_form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

              <div class="pull-right">
                <?php echo Form::submit(trans('app.update'), ['class' => 'btn btn-lg btn-new', 'id' => 'card-button', 'data-secret' => $intent->client_secret]); ?>

              </div>
              <?php echo Form::close(); ?>

            </div>
          </div>
        <?php endif; ?>
      <?php endif; ?>

      <div class="panel panel-default">
        <div class="panel-body">
          <fieldset>
            <legend><?php echo e(trans('app.invoices'), false); ?> <i class="fa fa-files"></i> </legend>
            <?php echo $__env->make('admin.account._invoices', ['billable' => Auth::user()->shop], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
          </fieldset>
        </div>
      </div>
    <?php else: ?>
      <div class="alert alert-danger">
        <strong><i class="icon fa fa-info-circle"></i><?php echo e(trans('app.notice'), false); ?></strong>
        <?php echo e(trans('messages.only_merchant_can_change_plan'), false); ?>

      </div>
    <?php endif; ?>

    <fieldset>
      <legend><?php echo e(trans('app.history'), false); ?> <i class="fa fa-history"></i> </legend>
      <?php echo $__env->make('admin.account._activity_logs', ['logger' => Auth::user()->shop], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </fieldset>
  </div>
</div>
<?php /**PATH C:\wamp64\www\hype-dappr\resources\views/admin/account/_billing.blade.php ENDPATH**/ ?>