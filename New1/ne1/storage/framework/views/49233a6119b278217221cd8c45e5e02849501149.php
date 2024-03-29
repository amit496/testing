<style>


    .marked_fields_box_out .text_right_lg{
         text-align: right;
     }
     .marked_fields_box_out .text_left_lg{
         text-align: left;
     }

 @media  only screen and (max-width:768px) {
     .marked_fields_box_out .text_right_lg{
         text-align: inherit;
     }
     .marked_fields_box_out .text_left_lg{
        text-align: inherit;
        order: 2;
        padding-left: 12px !important;
     }
    .marked_fields_box_out .text_left_lg .pull-right {
        float: left !important;
    }
    .form-group.row.marked_fields_box_out {
        margin-bottom: 15px;
    }
 }
</style>
</style>

<div role="tabpanel">
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active">
      <a href="#account-info-tab" aria-controls="account-info-tab" role="tab" data-toggle="tab" aria-expanded="true"><?php echo app('translator')->get('theme.basic_info'); ?></a>
    </li>
    <li role="presentation" class="">
      <a href="#password-tab" aria-controls="password-tab" role="tab" data-toggle="tab" aria-expanded="false"><?php echo app('translator')->get('theme.change_password'); ?></a>
    </li>
    <li role="presentation" class="">
      <a href="#address-tab" aria-controls="address-tab" role="tab" data-toggle="tab" aria-expanded="false"><?php echo app('translator')->get('theme.addresses'); ?></a>
    </li>
  </ul><!-- /.nav-tab -->

  <div class="tab-content">
    <div role="tabpanel" class="tab-pane fade active in" id="account-info-tab">
      <div class="row">
        <div class="col-md-8">
          <?php echo Form::model($account, ['method' => 'PUT', 'route' => 'account.update', 'class' => 'form-horizontal', 'data-toggle' => 'validator']); ?>

          <div class="form-group">
            <?php echo Form::label('name', trans('theme.full_name') . '*', ['class' => 'col-sm-4 control-label']); ?>

            <div class="col-md-8 col-sm-12">
              <?php echo Form::text('name', null, ['id' => 'name', 'class' => 'form-control flat', 'placeholder' => trans('theme.placeholder.full_name'), 'required']); ?>

              <div class="help-block with-errors"></div>
            </div>
          </div>

          

          <div class="form-group">
            <?php echo Form::label('email', trans('theme.email') . '*', ['class' => 'col-sm-4 control-label']); ?>

            <div class="col-md-8 col-sm-12">
              <?php echo Form::email('email', null, ['class' => 'form-control flat', 'placeholder' => trans('theme.placeholder.email'), 'required']); ?>

              <div class="help-block with-errors"></div>
            </div>
          </div>

          

          <div class="form-group">
            <?php echo Form::label('description', trans('theme.bio'), ['class' => 'col-sm-4 control-label']); ?>

            <div class="col-md-8 col-sm-12">
              <?php echo Form::textarea('description', null, ['class' => 'form-control flat', 'rows' => '4', 'placeholder' => trans('theme.placeholder.bio')]); ?>

              <div class="help-block with-errors"></div>
            </div>
          </div>

          <div class="form-group row marked_fields_box_out">
            <div class="col-9 text_left_lg pl-5">
              <small class="help-block text-muted">* <?php echo e(trans('theme.help.required_fields'), false); ?></small>
            </div>
            <div class="col-3 text_right_lg">
              <?php echo Form::submit(trans('theme.button.update'), ['class' => 'btn btn-primary flat user_account_button', 'style'=>'background:#6DBCD4']); ?>

            </div>
          </div>
          <?php echo Form::close(); ?>

        </div><!-- /.col-md-8 -->

        <div class="col-md-4">
          <div class="user-avatar-section">
            <div class="form-group">
              <?php if($account->image): ?>
                <?php echo Form::model($account, ['method' => 'DELETE', 'route' => 'my.avatar.remove', 'class' => 'form-horizontal', 'data-toggle' => 'validator']); ?>

                
                <?php echo Form::close(); ?>

              <?php endif; ?>

              
              <?php echo Form::label('avatar', 'PROFILE PICTURE'); ?>

              <img src="<?php echo e(get_storage_file_url(optional($account->image)->path, 'medium'), false); ?>" class="thumbnail center-block" alt="<?php echo e(trans('theme.avatar'), false); ?>" />
            </div>

            <?php echo Form::open(['route' => 'my.avatar.save', 'files' => true, 'data-toggle' => 'validator']); ?>

            <div class="form-group mx-4 mb-4">
              <?php echo Form::file('avatar', ['required']); ?>

              <div class="help-block with-errors"></div>
            </div>
            <button type="submit" class=" avatar_button btn btn-default btn-sm mx-4"><?php echo e(trans('theme.button.upload'), false); ?></button>
            <?php echo Form::close(); ?>

          </div>
        </div><!-- /col-md-4 -->
      </div>
    </div><!-- /#account-info-tab -->

    <div role="tabpanel" class="tab-pane fade" id="password-tab">
      <div class="row">
        <div class="col-md-8 col-sm-offset-1">
          <?php echo Form::model($account, ['method' => 'PUT', 'route' => 'my.password.update', 'class' => 'form-horizontal', 'data-toggle' => 'validator']); ?>

          <?php if($account->password): ?>
            <div class="form-group">
              <?php echo Form::label('current_password', trans('theme.current_password') . '*', ['class' => 'col-sm-4 control-label']); ?>

              <div class="col-md-8">
                <?php echo Form::password('current_password', ['class' => 'form-control flat', 'id' => 'current_password', 'placeholder' => trans('theme.placeholder.current_password'), 'data-minlength' => '6', 'required']); ?>

                <div class="help-block with-errors"></div>
              </div>
            </div>
          <?php endif; ?>

          <div class="form-group">
            <?php echo Form::label('password', trans('theme.new_password') . '*', ['class' => 'col-sm-4 control-label']); ?>

            <div class="col-md-8">
              <?php echo Form::password('password', ['class' => 'form-control flat', 'id' => 'password', 'placeholder' => trans('theme.placeholder.password'), 'data-minlength' => '6', 'required']); ?>

              <div class="help-block with-errors"></div>
            </div>
          </div>

          <div class="form-group">
            <?php echo Form::label('password_confirmation', trans('theme.confirm_password') . '*', ['class' => 'col-sm-4 control-label']); ?>

            <div class="col-md-8">
              <?php echo Form::password('password_confirmation', ['class' => 'form-control flat', 'placeholder' => trans('theme.placeholder.confirm_password'), 'data-match' => '#password', 'required']); ?>

              <div class="help-block with-errors"></div>
            </div>
          </div>

          <div class="form-group">
            <div class="col-sm-4">
              <small class="help-block text-muted">* <?php echo e(trans('theme.help.required_fields'), false); ?></small>
            </div>
            <div class="col-sm-8 text-right">
              <?php echo Form::submit(trans('theme.button.update'), ['class' => 'btn btn-primary flat', 'style' => 'background:#6DBCD4']); ?>

            </div>
          </div>
          <?php echo Form::close(); ?>

        </div><!-- /col-md-8 -->
        <div class="col-md-3"></div>
      </div>
    </div><!-- /#password-tab -->

    <div role="tabpanel" class="tab-pane fade" id="address-tab">
      <div class="row">
        <div class="col-md-8 col-sm-offset-2 space30">
          <?php $__empty_1 = true; $__currentLoopData = $account->addresses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $address): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <?php echo $address->toHtml(); ?>

            <div class="btn-group pull-right space20" role="group" aria-label="..." style="margin-top: -100px;">
              <a href="<?php echo e(route('my.address.delete', $address->id), false); ?>" class="confirm btn btn-default btn-xs flat pull-right" data-confirm="<?php echo app('translator')->get('theme.confirm_action.delete'); ?>">
                <i class="fas fa-trash-o"></i> <?php echo app('translator')->get('theme.button.delete'); ?>
              </a>

              <a href="<?php echo e(route('my.address.edit', $address), false); ?>" class="modalAction btn btn-default btn-xs flat pull-right">
                <i class="fas fa-edit"></i> <?php echo app('translator')->get('theme.edit'); ?>
              </a>
            </div>
            <hr />
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="clearfix space50"></div>
            <p class="lead text-center space50">
              <?php echo app('translator')->get('theme.address_not_found'); ?>
            </p>
          <?php endif; ?>
        </div>

        <div class="col-sm-12 text-center">
          <a href="<?php echo e(route('my.address.create'), false); ?>" class="modalAction btn btn-black flat">
            <i class="fas fa-address-card-o"></i> <?php echo app('translator')->get('theme.button.add_new_address'); ?>
          </a>
        </div>
      </div>
    </div><!-- /#address-tab -->
  </div><!-- /.tab-content -->
</div><!-- /.tabpanel -->

<div class="clearfix space50"></div>
<?php /**PATH /home/dappr/public_html/portal.dappr.com.au/public/themes/default/views/contents/account.blade.php ENDPATH**/ ?>