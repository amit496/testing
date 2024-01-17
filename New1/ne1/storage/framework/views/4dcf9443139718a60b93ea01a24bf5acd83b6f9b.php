<style>
    *
    {
        text-decoration: none !important;
    }
    .footer__content-box-titles h3 {
        /* font-weight: 600; */
        font-weight:bold;
        letter-spacing: 1px;
        margin-bottom: 15px;
        /* font-size: 18px; */
        font-size:12px;
        line-height: 27px;
        color: #fff;
        /* font-family: Arimo, sans-serif; */
        font-family: 'Open Sans';
    }

    .footer__content-box-link a {
        font-weight:
        text-decoration: none !important;
        color: #fff;
        font-family: 'Open Sans';
        -webkit-transition: all .2s;
        -moz-transition: all .2s;
        -ms-transition: all .2s;
        -o-transition: all .2s;
        transition: all .2s;
        font-style: normal;
        font-weight: 400;
        font-size: 12px;
        line-height: 16px;

    }

    .force_hide_footer
    {
        display: none !important;
    }
</style>

    <footer class="hide-bottom" id='common-footer'
    style="display: <?php  if(isset($hide_bottom)) { echo $hide_bottom; } elseif(isset($show_footer_qa_incomplete_edit_time)) { echo $show_footer_qa_incomplete_edit_time; } else { echo 'block'; } ?>" ;">

        <div class="footer" style="background-color: #000000;">
            <div class="container">
                <div class="footer__inner">

                    <div class="footer__content" style="padding: 38px 0">
                        <div class="row">
                            <div class="col-lg-6 col-md-4 col-sm-6 col-12">
                                <div class="footer__content-box">
                                    <div class="footer__content-box-inner">
                                        <div class="footer__content-box-logo my-2">
                                            <a href="<?php echo e(url('/'), false); ?>">
                                                <img src="<?php echo e(url('images/stylist/header_logo.jpg'), false); ?>" class="brand-logo"
                                                    alt="<?php echo e(trans('app.logo'), false); ?>" title="<?php echo e(trans('app.logo'), false); ?>"
                                                    style="max-width: 35%; margin-bottom: 10px;">
                                            </a>
                                        </div>

                                        <?php if(config('system_settings.support_phone')): ?>
                                        <div class="footer__content-box-number">
                                            <a href="tel: <?php echo config('system_settings.support_phone'); ?>"><i
                                                    class="fas fa-phone-alt"></i> <?php echo config('system_settings.support_phone'); ?></a>
                                        </div>
                                        <?php endif; ?>

                                        
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-2 col-md-4  col-sm-6 col-6">
                                <div class="footer__content-box">
                                    <div class="footer__content-box-inner">
                                        <div class="footer__content-box-titles">
                                            <h3><?php echo e(trans('theme.nav.dappr'), false); ?></h3>
                                        </div>
                                        <div class="footer__content-box-link">
                                            <ul style="padding-left: 0px">
                                                <li>
                                                    <a href="<?php echo e(url('/my/account'), false); ?>" rel="nofollow"><?php echo e(trans('theme.nav.your_account'), false); ?></a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo e(route('account', 'orders'), false); ?>" rel="nofollow"><?php echo e(trans('theme.nav.your_orders'), false); ?></a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo e(url('stylist/customer/info?q=show_quesiton_answer_edit_screen'), false); ?>" oncontextmenu="return false"><?php echo e(trans('theme.nav.edit_question'), false); ?></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-2 col-md-4  col-sm-6 col-6">
                                <div class="footer__content-box">
                                    <div class="footer__content-box-inner">
                                        <div class="footer__content-box-titles">
                                            
                                            <h3>Help & Support</h3>
                                        </div>
                                        <div class="footer__content-box-link">
                                            <ul style="padding-left: 0px">
                                                <li>
                                                    
                                                    <a href="<?php echo e(url('/selling#faqs'), false); ?>" rel="nofollow">FAQ's</a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo e(url('/page/delivery-info'), false); ?>" rel="nofollow"><?php echo e(trans('theme.nav.delivery'), false); ?></a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo e(url('/page/return-and-refund-policy'), false); ?>" rel="nofollow">Returns</a>
                                                    
                                                </li>

                                                <li>
                                                    <a href="<?php echo e(url('/page/terms-of-use-customer'), false); ?>" rel="nofollow"><?php echo e(trans('theme.nav.term_and_conditions'), false); ?></a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo e(url('/page/privacy-policy'), false); ?>" rel="nofollow"><?php echo e(trans('theme.nav.privacy_policy'), false); ?></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-2 col-md-4  col-sm-6 col-6">
                                <div class="footer__content-box">
                                    <div class="footer__content-box-inner">
                                        <div class="footer__content-box-titles">
                                            <h3><?php echo e(trans('theme.nav.follow_us'), false); ?></h3>
                                        </div>
                                        <div class="footer__content-box-link">
                                            <ul style="padding-left: 0px">
                                                <li>
                                                    
                                                    <a href="#"><?php echo e(trans('theme.social.facebook'), false); ?></a>
                                                </li>
                                                <li>
                                                    
                                                        <a href="#"><?php echo e(trans('theme.social.instagram'), false); ?></a>
                                                </li>
                                                <li>
                                                    
                                                    <a href="#"><?php echo e(trans('theme.social.tik_tok'), false); ?></a>
                                                </li>
                                                
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div> <!-- /.row -->
                    </div> <!-- /.footer__content -->
                </div> <!-- /.footer__inner -->
            </div> <!-- /.container -->
        </div> <!-- /.footer -->
    </footer>




    
                                        
    
    <!-- COPYRIGHT AREA -->
    


<style>
    #common-footer li{
        line-height:24px;
    }
    #common-footer .container {
        width: 100%!important;
        padding-right: var(--bs-gutter-x,.75rem);
        padding-left: var(--bs-gutter-x,.75rem);
        margin-right: auto;
        margin-left: auto;
    }

    @media (min-width: 576px){
        #common-footer .container, #common-footer .container-sm {
            max-width: 540px;
        }
    }
    @media (min-width: 768px){
        #common-footer .container, #common-footer .container-md, #common-footer .container-sm {
            max-width: 720px;
        }
    }
    @media (min-width: 992px){
        #common-footer .container, #common-footer .container-lg, #common-footer .container-md, #common-footer .container-sm {
            max-width: 960px;
        }
    }
    @media (min-width: 1200px){
        #common-footer .container, #common-footer .container-lg, #common-footer .container-md, #common-footer .container-sm, #common-footer .container-xl {
            max-width: 1140px;
        }
    }
    @media (min-width: 1400px){
        #common-footer .container, #common-footer .container-lg, #common-footer .container-md, #common-footer .container-sm, #common-footer .container-xl, #common-footer .container-xxl {
            max-width: 1320px;
        }
    }

    #common-footer ul {
        margin-top: 0;
        margin-bottom: 1rem;
    }

    #common-footer .row {
        --bs-gutter-x: 1.5rem;
        --bs-gutter-y: 0;
        display: flex;
        flex-wrap: wrap;
        margin-top: calc(var(--bs-gutter-y) * -1);
        margin-right: calc(var(--bs-gutter-x) * -.5);
        margin-left: calc(var(--bs-gutter-x) * -.5);
    }
</style>
<?php /**PATH /home/dappr/public_html/portal.dappr.com.au/public/themes/default/views/nav/footer.blade.php ENDPATH**/ ?>