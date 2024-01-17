<h3 class="widget-title"><?php echo e(trans('theme.payment_options'), false); ?></h3>
<div class="space20">
  <?php
    $config_shop = vendor_get_paid_directly() ? $shop : null;
    
    // When admin get paid but still give option to vendors on/off a active payment method.
    $active_payment_methods = isset($shop) && !vendor_get_paid_directly() && vendor_can_on_off_payment_method() ? $shop->paymentMethods->pluck('id')->toArray() : [];
  ?>

  <?php $__currentLoopData = $paymentMethods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $paymentMethod): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    
    <?php if(!vendor_get_paid_directly() && isset($shop) && vendor_can_on_off_payment_method() && !in_array($paymentMethod->id, $active_payment_methods)) continue; ?>

    <?php
      $config = get_payment_config_info($paymentMethod->code, $config_shop);
      
      $suffix = '';
      if ($paymentMethod->code == 'zcart-wallet' && isset($config['config'])) {
          $suffix = ' (' . get_formated_currency($config['config']) . ')';
      }
    ?>

    
    <?php if(!$config || !is_array($config) || !$config['config']) continue; ?>

    
    <?php if($customer && $paymentMethod->code == 'stripe' && $customer->hasBillingToken()): ?>
      <div class="form-group">
        <label>
          <input name="payment_method" value="saved_card" class="i-radio-blue payment-option" type="radio" data-info="<?php echo e($config['msg'], false); ?>" data-type="<?php echo e($paymentMethod->type, false); ?>" required="required" <?php echo e(old('payment_method') ? '' : 'checked', false); ?> /> <?php echo app('translator')->get('theme.card'); ?>: <i class="fab fa-cc-<?php echo e(strtolower($customer->pm_type), false); ?>"></i> ************<?php echo e($customer->pm_last_four, false); ?>

        </label>
      </div>
      
    <?php endif; ?>

    
    <div class="form-group">
      <label>
        <input name="payment_method" value="<?php echo e($paymentMethod->code, false); ?>" data-code="<?php echo e($paymentMethod->code, false); ?>" class="i-radio-blue payment-option" type="radio" data-info="<?php echo e($config['msg'], false); ?>" data-type="<?php echo e($paymentMethod->type, false); ?>" required="required" <?php echo e(old('payment_method') == $paymentMethod->code ? 'checked' : '', false); ?> /> <?php echo e($paymentMethod->code == 'stripe' ? trans('theme.credit_card') : $paymentMethod->name . $suffix, false); ?>

      </label>
    </div>
    
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>


<?php echo $__env->make('partials.authorizenet_card_form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<?php echo $__env->make('partials.strip_card_form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<?php if(is_incevio_package_loaded('razorpay')): ?>
  <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
  <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
  <input type="hidden" name="razorpay_signature" id="razorpay_signature">
<?php endif; ?>


<?php if(is_incevio_package_loaded('jrfpay')): ?>
  <?php echo $__env->make('jrfpay::jrfpay_payment_form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>


<?php if(is_incevio_package_loaded('mpesa')): ?>
  <?php echo $__env->make('mpesa::mpesa_payment_form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>


<div id="payInPerson" class="hide">
  <h3 class="widget-title"><?php echo e(trans('theme.contact_info'), false); ?></h3>
  <?php
    $warehouseIds = [];
  ?>

  <?php $__currentLoopData = $cart->inventories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $inventory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php if(!empty($inventory->warehouse)): ?>
      <?php if(!in_array($inventory->warehouse_id, $warehouseIds)): ?>
        <?php
          $warehouseIds[] = $inventory->warehouse_id;
        ?>
        <ul class="shopping-cart-summary">
          <li class="text-left">
            <span><?php echo e(trans('theme.notify.business_days'), false); ?></span>
            <span></span>
          </li>
          <li class="text-left">
            <?php echo e($inventory->warehouse->business_days, false); ?>

          </li>
          <li>
            <span><?php echo e(trans('theme.availability'), false); ?></span>
            <span><?php echo e($inventory->warehouse->opening_time, false); ?> - <?php echo e($inventory->warehouse->close_time, false); ?></span>
          </li>
          <li>
            <?php echo address_str_to_html($inventory->warehouse->address->toString()); ?>

          </li>
        </ul>
      <?php endif; ?>
    <?php endif; ?>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>


<p id="payment-instructions" class="text-info small space30">
  <i class="fas fa-info-circle"></i>
  <span><?php echo app('translator')->get('theme.placeholder.select_payment_option'); ?></span>
</p>

<div class="form-group mb-4">
  <div class="checkbox">
    <label>
      <?php echo Form::checkbox('agree', null, null, ['class' => 'i-check-blue', 'required']); ?> <?php echo trans('theme.input_label.i_agree_with_terms', ['url' => route('page.open', \App\Models\Page::PAGE_TNC_FOR_CUSTOMER)]); ?>

    </label>
  </div>
  <div class="help-block with-errors"></div>
</div>

<div id="submit-btn-block" class="clearfix space30" style="display: none;">
  <button id="pay-now-btn" class="btn btn-primary btn-lg btn-block" type="submit">
    <small>
      <i class="far fa-shield"></i> <span id="pay-now-btn-txt"><?php echo app('translator')->get('theme.button.checkout'); ?></span>
    </small>
  </button>

  <a href="javascript:void(0)" id="paypal-express-btn" class="hide" type="submit">
    <img src="<?php echo e(asset(sys_image_path('payment-methods') . 'paypal-express.png'), false); ?>" width="70%" alt="paypal express checkout" title="paypal-express" />
  </a>
</div>
<?php /**PATH C:\wamp64\www\hype-dappr\resources\views/partials/payment_options.blade.php ENDPATH**/ ?>