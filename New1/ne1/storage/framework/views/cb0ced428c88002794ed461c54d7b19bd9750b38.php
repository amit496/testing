<style>
   
    .form-control {
        display: block;
        width: 100%;
        height: 34px;
        padding: 6px 0px;
        font-size: 14px;
        line-height: 1.42857143;
        color: #555;
        background-color: #fff;
        background-image: none;
        border-bottom: 2px solid #000 !important;
        border-radius: 4px;
        border-left: 0 !important;
        border-right: 0 !important;
        border-top: 0 !important;
    }

    .section-title h4 {
        color: #000;
    }

    .form-group label {
        font-size: 11px;
        text-transform: none;
        letter-spacing: 0;
        display: block;
        margin-left: 0;
        margin-bottom: 5px;
    }

    label {
        cursor: none !important;
        line-height: 1.42857143;
        font-weight: 600 !important;
    }

    label:hover {
        cursor: none !important;
        font-weight: none !important;
    }
    .submit_btn {
    background: #6DBCD4;
    font-family: 'Open Sans';
    font-weight: 600;
    font-size: 15px;
    font-family: 'Open Sans';
    font-style: normal;
    font-weight: 600;
    font-size: 15px;
    line-height: 20px;
    display: flex;
    align-items: center;
    text-align: center;
    text-transform: uppercase;
}
    .submit_btn:hover
    {
        background: #6DBCD4 !important;
        border: 1px solid #6DBCD4;
        outline:none;
    }

    .con_form .section-title h4 {
        padding: 0;
        font-family: 'Open Sans';
        text-transform: uppercase;
        font-size:15px;
        line-height:2;
    }
    .con_form .form-group label{
        font-family: 'Open Sans';
        font-style: normal;
        font-weight: 400;
        font-size: 15px;
        line-height: 20px;
        margin-bottom:17px;
    }
    .form-control{
        font-family: 'Open Sans';
        font-style: normal;
        font-weight: 400;
        font-size: 15px;
        line-height: 20px;
        color:#afafaf;
        padding: 20px 0;
    }
   .contact-info .media-body  a{
        color: #6dbcd4 !important;
    }
    @media (min-width: 768px){
        section{
            width: 50%;
            margin: 0 auto !important; 
        }
    }
    @media (min-width: 992px) and (max-width: 1199px){
#content-wrapper section {
    margin: 0 auto !important; 
}
    }
</style>

<div class="clearfix space50"></div>
<section style="margin-top: -100px !important;" >
    <div class="container con_form">
        <div class="row">
             <!-- /.col-md-4 -->

            <div class="col-md-12 m-auto" >
                <div class="section-title "
                    style="width: 150px;margin-bottom: 70px; padding-bottom:5px; ">
                    
                    <h4 class="text-dark" style="border-bottom: 1px solid #000;">CONTACT US</h4>
                </div>

                <?php echo Form::open(['route' => 'contact_us', 'id' => 'contact_us_form', 'role' => 'form', 'data-toggle' =>
                'validator']); ?>

                <div class="row g-3" style="display: inherit;">
                    <div class="col-md-6 pr-md-5">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <?php echo Form::text('name', null, ['class' => 'form-control input-lg flat', 'placeholder' =>
                            trans('theme.placeholder.name'), 'maxlength' => '100', 'required']); ?>

                            <div class="help-block with-errors"></div>
                        </div>
                    </div>

                    <div class="col-md-6 pl-md-5">
                        <div class="form-group">
                            <label for="name">Email</label>
                            <?php echo Form::email('email', null, ['class' => 'form-control input-lg flat', 'placeholder' =>
                            trans('theme.placeholder.email'), 'maxlength' => '100', 'required']); ?>

                            <div class="help-block with-errors"></div>
                        </div>
                    </div>


                </div>

                <!-- <div class="form-group">
                
                <div class="help-block with-errors"></div>
                </div> -->
                <div class="row">
                    <div class="col-md-12 mt-5">
                        <div class="form-group">
                            <label for="name">Message</label>
                            <?php echo Form::textarea('message', null, ['class' => 'form-control input-lg flat', 'placeholder'
                            => trans('theme.placeholder.message'), 'rows' => 1, 'maxlength' => 500, 'required']); ?>

                            <div class="help-block with-errors"></div>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-6 nopadding-right">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-lg flat submit_btn mt-5"><!--<i class="fas fa-paper-plane"></i>-->
                                <?php echo e(trans('theme.button.send_message'), false); ?>

                            </button>
                        </div>
                    </div>
                    <div class="col-md-6 nopadding-left">
                        <div class="form-group">
                            <?php if(config('services.recaptcha.key')): ?>
                            <div class="g-recaptcha" data-sitekey="<?php echo config('services.recaptcha.key'); ?>"></div>
                            <?php endif; ?>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                </div>
                <?php echo Form::close(); ?>

            </div> <!-- /.col-md-8 -->
            <div class="col-md-2">
            </div>
        </div>
    </div>
    <div class="col-md-12 text-center"  style="">
        <div class="contact-info">
            <h2 class="space20">&nbsp;</h2>
            <div class="media-list">
                

                

                <?php if(config('system_settings.support_email')): ?>
                <div class="media space20">
                    <i class="pull-left fas fa-envelope-o"></i>
                    <div class="media-body">
                        <h4 style="display: inline-block"><?php echo app('translator')->get('theme.email'); ?>:</h4>
                        
                        
                        
                            <a href="mailto:hello@dappr.com.au">hello@dappr.com.au</a>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<!-- END CONTENT SECTION -->

<div class="clearfix space50"></div>


<?php if(config('services.recaptcha.key')): ?>
<?php $__env->startSection('scripts'); ?>
<?php echo $__env->make('theme::scripts.recaptcha', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php endif; ?>
<?php /**PATH /home/dappr/public_html/test.dappr.com.au/public/themes/default/views/contents/contact_us.blade.php ENDPATH**/ ?>