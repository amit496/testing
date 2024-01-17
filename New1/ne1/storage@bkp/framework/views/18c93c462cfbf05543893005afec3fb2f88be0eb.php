<div class="modal-dialog modal-md">
  <div class="modal-content">
    <?php echo Form::open(['route' => 'admin.promotion.tagline.update', 'method' => 'PUT', 'id' => 'form', 'data-toggle' => 'validator']); ?>

    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      <?php echo e(trans('app.promotional_tagline'), false); ?>

    </div>
    <div class="modal-body">
      <div class="form-group">
        <?php echo Form::label('text', trans('app.text')); ?>

        <?php echo Form::text('text', $tagline['text'] ?? null, ['class' => 'form-control', 'placeholder' => trans('app.tagline_text')]); ?>

        <div class="help-block with-errors"></div>
      </div>

      <div class="form-group">
        <?php echo Form::label('action_url', trans('app.form.action_url')); ?>

        <?php echo Form::text('action_url', $tagline['action_url'] ?? null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.action_url')]); ?>

        <div class="help-block with-errors"></div>
      </div>
    </div>
    <div class="modal-footer">
      <?php echo Form::submit(trans('app.update'), ['class' => 'btn btn-flat btn-new']); ?>

    </div>
    <?php echo Form::close(); ?>

  </div> <!-- / .modal-content -->
</div> <!-- / .modal-dialog -->
<?php /**PATH /home/dappr/public_html/test.dappr.com.au/resources/views/admin/promotions/_edit_tagline.blade.php ENDPATH**/ ?>