<div class="modal fade" id="contactSellerModal" tabindex="-1" role="dialog" aria-labelledby="contactSellerModal" aria-hidden="true">
  <div class="modal-dialog modal-md modal-dialog-centered" role="document">
    <div class="modal-content p-2">
      <div class="modal-header p-3">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-title text-center">
          <h4>
            
            <?php echo e(trans('theme.button.contact_seller'), false); ?>

          </h4>
        </div>

        <div class="d-flex flex-column">
          <?php echo Form::open(['route' => ['seller.contact', $item->shop->slug], 'data-toggle' => 'validator']); ?>

          <?php echo Form::hidden('product_id', $item->id); ?>

          <div class="form-group">
            <?php echo Form::label('subject', trans('theme.subject') . '*'); ?>

            <?php echo Form::text('subject', null, ['class' => 'form-control input-lg', 'placeholder' => trans('theme.placeholder.contact_us_subject'), 'required']); ?>

            <div class="help-block with-errors"></div>
          </div>

          <div class="form-group">
            <?php echo Form::label('message', trans('theme.write_your_message') . '*'); ?>

            <?php echo Form::textarea('message', null, ['class' => 'form-control', 'rows' => '4', 'placeholder' => trans('theme.placeholder.message'), 'required']); ?>

            <div class="help-block with-errors"></div>
          </div>

          <div class="form-group">
            <?php if(config('services.recaptcha.key')): ?>
              <div class="g-recaptcha" data-sitekey="<?php echo e(config('services.recaptcha.key'), false); ?>"></div>
            <?php endif; ?>
            <div class="help-block with-errors"></div>
          </div>

          <button type="submit" class="btn btn-primary btn-block btn-lg btn-round mt-3">
            <i class="fas fa-paper-plane"></i>
            <?php echo e(trans('theme.button.send_message'), false); ?>

          </button>
          <?php echo Form::close(); ?>


        </div>
        <small class="help-block text-muted text-left mt-4">* <?php echo e(trans('theme.help.required_fields'), false); ?></small>
      </div>
      <div class="modal-footer d-flex justify-content-center">
        <div class="signup-section">
        </div>
      </div>
    </div>
  </div>
</div> <!-- /#contactSellerModal -->

<script src='https://www.google.com/recaptcha/api.js'></script>
<?php /**PATH C:\wamp64\www\hype-dappr\public\themes\default/views/modals/contact_seller.blade.php ENDPATH**/ ?>