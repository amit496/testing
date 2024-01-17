<div id="authorize-net-cc-form" class="authorize-net-cc-form" style="display: none;">
  <hr class="style4 muted">
  <div class="stripe-errors alert alert-danger flat small hide"><?php echo e(trans('messages.trouble_validating_card'), false); ?></div>
  <div class="form-group form-group-cc-name">
    <?php echo Form::text('cardholder_name', Null, ['class' => 'form-control flat', 'placeholder' => trans('theme.placeholder.cardholder_name'), 'data-error' => trans('theme.help.enter_cardholder_name')]); ?>

    <div class="help-block with-errors"></div>
  </div>
  <div class="form-group form-group-cc-number">
    <?php echo Form::text('cnumber', Null, ['id' => 'cnumber', 'class' => 'form-control flat', 'placeholder' => trans('theme.placeholder.card_number')]); ?>

    <div class="help-block with-errors"></div>
  </div>
  <div class="form-group form-group-cc-cvc">
    <?php echo Form::text('ccode', Null, ['id' => 'ccode', 'class' => 'form-control flat', 'placeholder' => trans('theme.placeholder.card_cvc')]); ?>

    <div class="help-block with-errors"></div>
  </div>

  <div class="row">
    <div class="col-md-6 nopadding-right">
      <div class="form-group has-feedback">
        <?php echo e(Form::selectMonth('card_expiry_month', Null, ['id' =>'card_expiry_month', 'class' => 'form-control flat', 'placeholder' => trans('theme.placeholder.card_exp_month'), 'data-error' => trans('theme.help.card_exp_month')], '%m'), false); ?>

        <div class="help-block with-errors"></div>
      </div>
    </div>

    <div class="col-md-6 nopadding-left">
      <div class="form-group has-feedback">
        <?php echo e(Form::selectYear('card_expiry_year', date('Y'), date('Y') + 10, Null, ['id' =>'card_expiry_year', 'class' => 'form-control flat', 'placeholder' => trans('theme.placeholder.card_exp_year'), 'data-error' => trans('theme.help.card_exp_year')]), false); ?>

        <div class="help-block with-errors"></div>
      </div>
    </div>
  </div>
</div> <!-- /#authorize-net-cc-form --><?php /**PATH C:\wamp64\www\hype-dappr\resources\views/partials/authorizenet_card_form.blade.php ENDPATH**/ ?>