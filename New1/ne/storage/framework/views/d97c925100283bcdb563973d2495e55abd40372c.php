<?php $__env->startSection('content'); ?>
<?php if(session('success')): ?>
<div class="alert <?php echo e(Session::get('alert-class', 'alert-info'), false); ?> alert-dismissible fade show">
    <?php echo e(session('success'), false); ?>

    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<?php endif; ?>
<?php if(session('error')): ?>
<div class="alert <?php echo e(Session::get('alert-class', 'alert-info'), false); ?> alert-danger  fade show">
    <?php echo e(session('error'), false); ?>

    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>


<?php endif; ?>

<style>
    .stf_outer_body_img-costom {
        position: relative;
    }

    .stf_outer_body_img-costom-text {
        position: absolute;
        display: flex;
        align-items: center;
        top: 0;
        height: 100%;
        width: 100%;
        justify-content: center;
    }

    .btn.bg-dark-costom-style {
        background-color: #000;
        color: #fff;
        width: 100%;
    }

    .stf_outer_body_img-costom-text h3 {
        color: #fff;
        background: black;
        padding: 10px 30px;

    }
    /* .top_selling_heading
    {
        color: #fff;
        background: black;
        padding: 10px 30px;
    } */

    .has-search .form-control {
        padding-left: 2.375rem;
    }

    .has-search .form-control-feedback {
        position: absolute;
        left: 11px;
    }

    .border-dark-costom-style {
        border: 1px solid;
        height: 200px;
        overflow: scroll;
        padding: 30px;
        /* margin: 20px 0 0 0; */
        display: flex;
    }

    .blog_image {
        width: 60px;
        height: 60px;
        /* background: red; */
        margin-top: 30px;
        margin-right: 30px;
    }

    .blog_image .stf_outer_img_style-coston-s {
        width: 100%;
        height: 100%;
        opacity: 1;
        border-radius: 300px;
        overflow: hidden;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-right: 60px !important;
        position: relative;
    }

    .blog_image .stf_outer_img_style-coston-s img {
        width: 100% !important;
        height: 100% !important;
    }

    .outer_img_mane_vs P {
        display: inline-block;
        font-size: 19px;
        letter-spacing: 1px;
        font-family: revert;
        margin: 0px;
    }

    span.outer_img_team_text {
        font-weight: bold;
        color: #03C4FF;
    }

    .box-header.with-border h4 {
        font-size: 20px;
        font-weight: bold;
        color: #000;
    }

    .box-header.with-border P {
        font-size: 19px;
        letter-spacing: 1px;
        font-family: revert;
        margin: 0px;
    }

    .btn.bg-dark-costom-styles {
        background-color: #000;
        color: #fff;
        width: 100%;
    }

    .btn.bg-dark-costom-styles p {
        font-size: 15px;
        letter-spacing: 1px;
        font-family: revert;
        margin: 0px;
        color: #fff;
        padding: 20px;
    }

    .box-header.with-border1 {
        padding: 0px;
    }

    .owl-costom-stytle-text {
        position: absolute;
        z-index: 9;
        text-align: center;
        top: 0;
        color: black;
        letter-spacing: 1px;
        font-family: revert;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100%;
        width: 100%;
        font-size: 24px;
    }

    .owl-costom-stytle-color {
        top: 0;
        opacity: 0.23;
        background-color: #000;
        height: 100%;
        width: 1000%;
        position: absolute;
        z-index: 9;
    }

    .owl-carousel .owl-nav button.owl-prev,
    .owl-carousel .owl-nav button.owl-next,
    .owl-carousel button.owl-dot {
        position: absolute;
        background: white !important;
        color: red !important;
        border: none !important;
        font: inherit !important;
        margin-left: 10px !important;
        padding: initial !important;
    }

    */
</style>
<div class="box stf_outer_body stf_outer_page_load" style="display:none">
    <div class="row " style="display: flex; margin-left: 0;">
        <div class="col-md-9">
            <div class="box-header with-border">
                <h4><b class="bg-dark">Hi <?php echo e($stylist_name, false); ?>,</b></h4>
                <p>What you weekend looks </p>
                <br>
                <div class="row">
                    <div class="col-md-4 bg-dark">
                        <div class="stf_outer_body_img-costom">
                            <img src="<?php echo e(url('images/stylist/questions/section/dappr_.jpg'), false); ?>" alt=""
                                style="width: 100%;">
                            <div class="stf_outer_body_img-costom-text">
                                <h3><?php echo e($status_comelete . ' Reveals Compelete', false); ?></h3>
                            </div>
                        </div>
                        <div class="btn bg-dark-costom-style">
                            <h3 style="margin: 10px;">Reveals</h3>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="stf_outer_body_img-costom">
                            <img src="<?php echo e(url('images/stylist/questions/section/dappr_.jpg'), false); ?>" alt=""
                                style="width: 100%;">
                            <div class="stf_outer_body_img-costom-text">
                                <h3><?php echo e($client_number_value . ' New Client', false); ?></h3>
                            </div>
                        </div>
                        <div class="btn bg-dark-costom-style">
                            <h3 style="margin: 10px;">Client</h3>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="stf_outer_body_img-costom">
                            <img src="<?php echo e(url('images/stylist/questions/section/dappr_.jpg'), false); ?>" alt=""
                                style="width: 100%;">
                            <div class="stf_outer_body_img-costom-text">
                                <h3><?php echo e('Panel Broderie Shirt', false); ?></h3>
                            </div>
                        </div>
                        <div class="btn bg-dark-costom-style">
                            <h3 style="margin: 10px;">New Item</h3>
                        </div>
                    </div>

                </div>
                <br>

                <div class="row">
                    <div class="col-md-4"><a href="#">
                            <h4>News</h4>
                        </a></div>
                    <div class="col-md-8">
                        <div class="form-group has-search">
                            <span class="fa fa-search form-control-feedback"></span>
                            <input type="text" class="form-control" placeholder="">
                        </div>
                    </div>
                </div>

                <?php $__currentLoopData = $blog_user_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bloguserinfo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <div class="row border-dark-costom-style">
                    <div class=" p-0 text-center blog_image">
                        <div class="stf_outer_img_style-coston-s">
                            <img src="<?php echo e(get_storage_file_url(optional($bloguserinfo->coverImage)->path, 'tiny'), false); ?>"
                                class="img-lg" alt="<?php echo $bloguserinfo->title; ?>">
                        </div>

                        <h5><?php echo e($bloguserinfo->name, false); ?></h5>
                    </div>
                    <div class="outer_img_mane_vs">
                        <p><span class="outer_img_team_text"> <?php echo e($bloguserinfo->title, false); ?></span></p>
                        <p><?php echo $bloguserinfo->content; ?></p>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </div>
        </div>
        <div class="col-md-3">
            <div class="box-header with-border1">

                <link rel="stylesheet"
                    href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css"
                    integrity="sha512-UTNP5BXLIptsaj5WdKFrkFov94lDx+eBvbKyoe1YAfjeRPC+gT5kyZ10kOHCfNZqEui1sxmqvodNUx3KbuYI/A=="
                    crossorigin="anonymous" referrerpolicy="no-referrer">

                <div class="owl-carousel owl-carousel-costom owl-theme">
                    <?php
                        if ($inventory_obj->isNotEmpty())
                        {
                            foreach ($inventory_obj as $inventory_info)
                            {
                            ?>
                    <div class="item">
                        <a href="">
                            <?php
                                            $img_src = url('images/stylist/product-placeholder.jpg');
                                            $sale_price = 0;
                                            if(isset($img_src))
                                            {
                                                foreach ($inventory_info->images as $img)
                                             {
                                                // echo '<img src="{{url('')}}">';
                                                $img_src = url('') . '/image/' . $img->path;
                                                echo '<img src = '.$img_src.' height="400" width="300">';
                                                echo '<P class="owl-costom-stytle-text top_selling_heading text-success" style="z-index: 9">TOP SELLING ITEMS<br>THIS MONTH </P>';
                                                echo '<div class="btn bg-dark-costom-styles">
                            <p>'.$inventory_info->title .'<br>'.$inventory_info->sale_price.'</p>
                        </div>';
                                                break;
                                            }
                                            }
                                            else {
                                                echo '<img src = '.$img_src.' height="400" width="300">';

                                            }


                                       echo ' </a>
                                    </div>';
                                }}
                                        ?>

                </div>

                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
                    integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw=="
                    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
                <script>
                    $('.owl-carousel-costom').owlCarousel({

                                                loop:true,
                                                margin:20,
                                                autoPlay:true,
                                                nav:false,
                                                rewindNav:false,
                                                pageDots: false,
                                                responsive:{
                                                        0:{items:1},}
                                        })





                </script>
            </div>
        </div>
    </div>
</div>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-style'); ?>
<style>
    #DataTables_Table_0 .c-text-left {
        text-align: left !important
    }

    #DataTables_Table_0 .c-text-center {
        text-align: center !important
    }
</style>
<?php $__env->startSection('page-script'); ?>
<?php echo $__env->make('admin.stylist_form.common', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\hype-dappr\resources\views/admin/stylist_form/post_details_dashboard.blade.php ENDPATH**/ ?>