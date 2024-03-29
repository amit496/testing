<?php
$can_update = Gate::allows('update', $config) ?: null;
$active_payment_methods = $config->paymentMethods->pluck('id')->toArray();
$has_config = false;
?>

<?php $__env->startSection('content'); ?>
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">
        <?php echo e(trans('app.payment_methods'), false); ?>

      </h3>
    </div> <!-- /.box-header -->
    <div class="box-body">
      <div class="row">
        <div class="col-sm-12">
          <?php $__currentLoopData = $payment_method_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type_id => $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
              $payment_providers = $payment_methods->where('type', $type_id);
              $logo_path = sys_image_path('payment-method-types') . "{$type_id}.svg";
            ?>

            <?php if($payment_providers->count()): ?>
              <div class="row">
                <span class="spacer10"></span>
                <div class="col-sm-5">
                  <?php if(File::exists($logo_path)): ?>
                    <img src="<?php echo e(asset($logo_path), false); ?>" width="100" height="25" alt="<?php echo e($type, false); ?>">
                    <span class="spacer10"></span>
                  <?php else: ?>
                    <p class="lead"><?php echo e($type, false); ?></p>
                  <?php endif; ?>
                  <p><?php echo get_payment_method_type($type_id)['description']; ?></p>
                </div> <!-- /.col-ms-5 -->

                <div class="col-sm-7">
                  <?php $__currentLoopData = $payment_providers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment_provider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <!-- Skip the wallet because wallet setting has option to activatte -->
                    <?php if($payment_provider->code == 'zcart-wallet') continue; ?>

                    <?php
                      $has_config = false;
                      $logo_path = sys_image_path('payment-methods') . "{$payment_provider->code}.png";
                    ?>
                    <ul class="list-group">
                      <li class="list-group-item">
                        <?php if(File::exists($logo_path)): ?>
                          <img src="<?php echo e(asset($logo_path), false); ?>" class="open-img-md" alt="<?php echo e($type, false); ?>">
                        <?php else: ?>
                          <p class="list-group-item-heading inline lead">
                            <?php echo e($payment_provider->name, false); ?>

                          </p>
                        <?php endif; ?>

                        <span class="spacer10"></span>

                        <p class="list-group-item-text">
                          <?php echo $payment_provider->description; ?>

                        </p>

                        <span class="spacer20"></span>

                        <?php if(in_array($payment_provider->id, $active_payment_methods)): ?>
                          <?php if($can_update): ?>
                            <?php switch($payment_provider->code):
                              case ('stripe'): ?>
                                <?php if($config->stripe): ?>
                                  <?php
                                    $has_config = true;
                                  ?>
                                <?php endif; ?>
                              <?php break; ?>

                              <?php case ('instamojo'): ?>
                                <?php if($config->instamojo): ?>
                                  <?php
                                    $has_config = true;
                                  ?>
                                <?php endif; ?>
                              <?php break; ?>

                              <?php case ('authorize-net'): ?>
                                <?php if($config->authorizeNet): ?>
                                  <?php
                                    $has_config = true;
                                  ?>
                                <?php endif; ?>
                              <?php break; ?>

                              <?php case ('paypal-express'): ?>
                                <?php if($config->paypalExpress): ?>
                                  <?php
                                    $has_config = true;
                                  ?>
                                <?php endif; ?>
                              <?php break; ?>

                              <?php case ('paypal-marketplace'): ?>
                                <?php if($config->paypalMarketplace): ?>
                                  <?php
                                    $has_config = true;
                                  ?>
                                <?php endif; ?>
                              <?php break; ?>

                              <?php case ('paystack'): ?>
                                <?php if($config->paystack): ?>
                                  <?php
                                    $has_config = true;
                                  ?>
                                <?php endif; ?>
                              <?php break; ?>

                              <?php case ('cybersource'): ?>
                                <?php if($config->cybersource): ?>
                                  <?php
                                    $has_config = true;
                                  ?>
                                <?php endif; ?>
                              <?php break; ?>

                              <?php case ('razorpay'): ?>
                                <?php if($config->razorpay): ?>
                                  <?php
                                    $has_config = true;
                                  ?>
                                <?php endif; ?>
                              <?php break; ?>

                              <?php case ('mpesa'): ?>
                                <?php if($config->mpesa): ?>
                                  <?php
                                    $has_config = true;
                                  ?>
                                <?php endif; ?>
                              <?php break; ?>

                              <?php case ('wire'): ?>
                              <?php case ('cod'): ?>
                              <?php case ('pip'): ?>
                                <?php
                                  $active = $config->manualPaymentMethods->pluck('id')->toArray();
                                  
                                  $has_config = in_array($payment_provider->id, $active) ? true : false;
                                ?>
                              <?php break; ?>
                            <?php endswitch; ?>

                            <?php if (! ($has_config)): ?>
                              <div class="alert alert-danger"><?php echo app('translator')->get('app.payment_method_configuration_issue'); ?></div>
                            <?php endif; ?>

                            <?php if($payment_provider->code == 'stripe'): ?>
                              <a href="<?php echo e(route('admin.setting.paymentMethod.activate', $payment_provider->id), false); ?>" class="btn btn-info"><?php echo e(trans('app.update'), false); ?></a>
                            <?php else: ?>
                              <a href="javascript:void(0)" data-link="<?php echo e(route('admin.setting.paymentMethod.activate', $payment_provider->id), false); ?>" class="btn ajax-modal-btn btn-info"><?php echo e(trans('app.update'), false); ?></a>
                            <?php endif; ?>

                            <a href="<?php echo e(route('admin.setting.paymentMethod.deactivate', $payment_provider->id), false); ?>" class="btn btn-default ajax-silent confirm"> <?php echo e(trans('app.deactivate'), false); ?></a>
                          <?php else: ?>
                            <span class="label label-default"><?php echo e(trans('app.active'), false); ?></span>
                          <?php endif; ?>
                        <?php else: ?>
                          <?php if($can_update): ?>
                            <?php if($payment_provider->code == 'stripe'): ?>
                              <a href="<?php echo e(route('admin.setting.paymentMethod.activate', $payment_provider->id), false); ?>" class="btn btn-primary"><?php echo e($has_config ? trans('app.reactivate') : trans('app.activate'), false); ?></a>
                            <?php else: ?>
                              <a href="javascript:void(0)" data-link="<?php echo e(route('admin.setting.paymentMethod.activate', $payment_provider->id), false); ?>" class="btn ajax-modal-btn btn-primary"><?php echo e($has_config ? trans('app.reactivate') : trans('app.activate'), false); ?></a>
                            <?php endif; ?>
                          <?php else: ?>
                            <span class="label label-default"><?php echo e(trans('app.inactive'), false); ?></span>
                          <?php endif; ?>
                        <?php endif; ?>

                        <span class="spacer15"></span>
                  </li>
                </ul>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div> <!-- /.col-ms-7 -->
          </div> <!-- /.row -->

          <?php if (! ($loop->last)): ?>
            <hr />
          <?php endif; ?>
        <?php endif; ?>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div> <!-- /.col-sm-12 -->
  </div> <!-- /.row -->
</div> <!-- /.box-body -->
</div> <!-- /.box -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dappr/public_html/test.dappr.com.au/resources/views/admin/config/payment-method/index.blade.php ENDPATH**/ ?>