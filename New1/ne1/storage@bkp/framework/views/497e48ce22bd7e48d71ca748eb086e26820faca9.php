<div class="row">
  <div class="col-md-8 nopadding-right">
    <div class="form-group">
      <?php echo Form::label('name', trans('app.form.topic_name').'*'); ?>

      <?php echo Form::text('name', null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.name'), 'required']); ?>

    </div>
  </div>
  <div class="col-md-4 nopadding-left">
    <div class="form-group">
      <?php echo Form::label('for', trans('app.form.topic_for').'*'); ?>

      <?php echo Form::select('for', $topics, isset($faqTopic) ? Null : 1, ['class' => 'form-control select2-normal', 'required']); ?>

      <div class="help-block with-errors"></div>
    </div>
  </div>
</div>
<p class="help-block">* <?php echo e(trans('app.form.required_fields'), false); ?></p><?php /**PATH /home/dappr/public_html/test.dappr.com.au/resources/views/admin/faq-topic/_form.blade.php ENDPATH**/ ?>