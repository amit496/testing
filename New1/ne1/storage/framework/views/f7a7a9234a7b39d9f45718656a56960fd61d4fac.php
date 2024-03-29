<div class="container">
    <div class="row">
        <div class="col-lg-12 text-center">
            <h2 class="section-heading"><?php echo e(trans('theme.contact_us'), false); ?></h2>
            <h3 class="section-subheading" style="color: #fed136;"><?php echo e(trans('messages.we_will_get_back_to_you_soon'), false); ?></h3>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <?php echo Form::open(['route' => 'contact_us', 'id' => 'contactForm', 'name' => 'sentMessage', 'data-toggle' => 'validator', 'novalidate']); ?>

                <div class="row">
                    <div class="col-md-12 text-center">
                        <div id="success"></div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <?php echo Form::text('name', null, ['class' => 'form-control', 'placeholder' => trans('theme.placeholder.name'), 'data-validation-required-message' => trans('validation.required', ['attribute' => 'name']), 'required']); ?>

                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="form-group">
                            <?php echo Form::email('email', null, ['id' => 'email', 'class' => 'form-control', 'placeholder' => trans('theme.placeholder.email'), 'data-validation-required-message' => trans('validation.required', ['attribute' => 'email']), 'required']); ?>

                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="form-group">
                            <?php echo Form::text('phone', null, ['class' => 'form-control', 'placeholder' => trans('theme.placeholder.phone_number')]); ?>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <?php echo Form::text('subject', null, ['class' => 'form-control', 'placeholder' => trans('theme.placeholder.contact_us_subject'), 'data-validation-required-message' => trans('validation.required', ['attribute' => 'subject']), 'required']); ?>

                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="form-group">
                            <?php echo Form::textarea('message', null, ['class' => 'form-control', 'placeholder' => trans('theme.placeholder.message'), 'rows' => '3', 'data-validation-required-message' => trans('validation.required', ['attribute' => 'message']), 'required']); ?>

                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <?php if(config('services.recaptcha.key')): ?>
                              <div class="g-recaptcha"
                                  data-sitekey="<?php echo e(config('services.recaptcha.key'), false); ?>">
                              </div>
                            <?php endif; ?>
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <div class="col-md-6 text-center">
                        <div class="form-group">
                            <div id="success"></div>
                            <button type="submit" class="btn btn-xl"><?php echo e(trans('theme.button.send_message'), false); ?></button>
                        </div>
                    </div>
                </div>
            <?php echo Form::close(); ?>

        </div>
    </div>
</div>

<script src='https://www.google.com/recaptcha/api.js'></script><?php /**PATH /home/dappr/public_html/portal.dappr.com.au/public/themes/_selling/default/views/contact.blade.php ENDPATH**/ ?>