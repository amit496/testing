<!-- Error Message / Stripe Threw Exception -->
<div class="form-group has-feedback">
    <?php echo Form::text('name', isset($billable) ? $billable->card_holder_name : Null, ['class' => 'form-control input-lg', 'data-stripe' => 'name', 'id' => 'card-holder-name', 'placeholder' => trans('app.placeholder.card_holders_name'), 'required']); ?>

    <i class="glyphicon glyphicon-user form-control-feedback"></i>
    <div class="help-block with-errors"></div>
</div>
<br/><br/>

<!-- Stripe Elements Placeholder -->
<div id="card-element"></div>
<br/><br/>

<div class="alert alert-danger hide" id="stripe-errors"></div>

<span class="text-info">
	<strong><i class="icon fa fa-info-circle"></i></strong>
	<?php echo trans('messages.we_dont_save_card_info'); ?>

</span>
<span class="spacer20"></span><?php /**PATH /home/dappr/public_html/test.dappr.com.au/resources/views/auth/stripe_form.blade.php ENDPATH**/ ?>