<div class="form-group">
  <div class="input-group">
    <span class="input-group-addon flat"><i class="fas fa-user"></i></span>
    <?php echo Form::text('address_title', null, ['id' => '', 'class' => 'form-control flat', 'placeholder' => trans('theme.placeholder.address_title') . '*', 'required']); ?>

  </div>
  <div class="help-block with-errors"></div>
</div>

<div class="form-group">
  <?php echo Form::text('address_line_1', null, ['id' => 'address_line_1', 'class' => 'form-control flat', 'placeholder' => trans('theme.placeholder.address_line_1') . '*', 'required']); ?>

  <div class="help-block with-errors"></div>
</div>

<div class="form-group">
  <?php echo Form::text('address_line_2', null, ['id' => 'address_line_2', 'class' => 'form-control flat', 'placeholder' => trans('theme.placeholder.address_line_2')]); ?>

  <div class="help-block with-errors"></div>
</div>

<div class="row">
  <div class="col-md-8 nopadding-right">
    <div class="form-group">
      <?php if(is_address_autocomplete_on()): ?>
        <?php echo Form::text('country_id', isset($cart) ? $cart->country->name : null, ['id' => 'address_country', 'class' => 'form-control', 'placeholder' => trans('theme.country') . '*', 'required']); ?>

        <div class="help-block with-errors"></div>
      <?php elseif(isset($one_checkout_form)): ?>
        <?php echo Form::text('country_id', $cart->country->name, ['id' => 'address_country', 'class' => 'form-control', 'disabled' => 'true']); ?>

        <div class="help-block with-errors small text-warning"><?php echo e(trans('checkout::lang.make_changes_on_cart_page'), false); ?></div>
      <?php else: ?>
        <?php echo Form::select('country_id', $countries, isset($address) ? null : (isset($cart) ? $cart->ship_to_country_id : config('system_settings.address_default_country')), ['id' => 'address_country', 'class' => 'form-control flat', 'placeholder' => trans('theme.country') . '*', 'required']); ?>

        <div class="help-block with-errors"></div>
      <?php endif; ?>
    </div>
  </div>
  <div class="col-md-4 nopadding-left">
    <div class="form-group">
      <?php echo Form::text('zip_code', null, ['id' => 'postcode', 'class' => 'form-control flat', 'placeholder' => trans('theme.placeholder.zip_code') . '*', 'required']); ?>

      <div class="help-block with-errors"></div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-6 nopadding-right">
    <div class="form-group">
      <?php echo Form::text('city', null, ['id' => 'address_city', 'class' => 'form-control flat', 'placeholder' => trans('theme.placeholder.city') . '*', 'required']); ?>

      <div class="help-block with-errors"></div>
    </div>
  </div>
  <div class="col-md-6 nopadding-left">
    <div class="form-group">
      <?php if(is_address_autocomplete_on()): ?>
        <?php echo Form::text('state_id', isset($cart) ? $cart->state->name : null, ['id' => 'address_state', 'class' => 'form-control', 'placeholder' => trans('theme.placeholder.state') . '*', 'required']); ?>

        <div class="help-block with-errors"></div>
      <?php elseif(isset($one_checkout_form)): ?>
        <?php echo Form::text('state_id', $cart->state->name, ['id' => 'address_state', 'class' => 'form-control', 'disabled' => 'true']); ?>

        <div class="help-block with-errors small text-warning"><?php echo e(trans('checkout::lang.make_changes_on_cart_page'), false); ?></div>
      <?php else: ?>
        <?php echo Form::select('state_id', isset($states) ? $states : [], isset($cart) ? $cart->ship_to_state_id : (isset($address) ? null : config('system_settings.address_default_state')), ['id' => 'address_state', 'class' => 'form-control flat', 'placeholder' => trans('theme.placeholder.state') . '*', empty($states) ? '' : 'required']); ?>

        <div class="help-block with-errors"></div>
      <?php endif; ?>
    </div>
  </div>
</div>

<div class="form-group">
  <?php echo Form::text('phone', null, ['id' => 'address_phone', 'class' => 'form-control flat', 'placeholder' => trans('theme.placeholder.phone_number')]); ?>

  <div class="help-block with-errors"></div>
</div>


<?php if(is_address_autocomplete_on()): ?>

  <?php echo $__env->make('scripts.google_place', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php endif; ?>
<?php /**PATH C:\wamp64\www\hype-dappr\resources\views/partials/address_form.blade.php ENDPATH**/ ?>