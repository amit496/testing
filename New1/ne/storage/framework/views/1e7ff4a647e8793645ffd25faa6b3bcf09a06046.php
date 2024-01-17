<!DOCTYPE html>
<html class="no-js" lang="<?php echo e(str_replace('_', '-', app()->getLocale()), false); ?>">
  <style>
    
  </style>
<head>
  <?php echo $__env->make('meta', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <?php if(url('/') !== request()->url()): ?>
    <link href='https://fonts.googleapis.com/css?family=Roboto:500,300,700,400italic,400' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,600' rel='stylesheet' type='text/css'>
  <?php endif; ?>

  <!-- Main custom css -->
  <link href="<?php echo e(theme_asset_url('css/style.css'), false); ?>" media="screen" rel="stylesheet">
  

  <?php if(config('active_locales') && config('active_locales')->firstWhere('code', App::getLocale())->rtl): ?>
    <link href="<?php echo e(theme_asset_url('css/rtl.css'), false); ?>" media="screen" rel="stylesheet">

  <?php endif; ?>

   <link href="<?php echo e(url('css/frotend-stylist-form-common-all.css?').rand(10,100), false); ?>"  rel="stylesheet">
  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  

  <?php if(get_from_option_table('theme_custom_styling')): ?>
    <style>
      <?php echo e(get_from_option_table('theme_custom_styling'), false); ?>

    </style>
  <?php endif; ?>
</head>

<?php
if(!isset($stylist_body_class)){
  $stylist_body_class = '';
}
?>

<body class="<?php echo e($stylist_body_class, false); ?> <?php echo e(config('active_locales')->firstWhere('code', App::getLocale())->rtl ? 'rtl' : 'ltr', false); ?>">


  <div class="text-center login-header-text-style px-2 d-flex   justify-content-between align-item-center" style="top: 0;position: sticky;z-index: 2;">
     <div id="main">
      <div class="d-flex align-items-center"  onclick="openNav()">
        <div>
          <div class="bar1 "></div>
          <div class="bar2"></div>
          <div class="bar3"></div>
        </div>
        <!-- <h4 class="px-3 m-0">MENU</h4> -->
      </div>
     </div>


    <img src="<?php echo e(url('images/stylist/header_logo.jpg'), false); ?>" alt="" width="100%" style='margin-left:4em;'>
    <div class="header__top-utility d-flex">
          <ul class="m-0">
            <?php 
              $hide_icon = '';
              $stylist_url = url('/').'/stylist/customer/info';
              if($stylist_url)
              {
                $hide_icon = 'display:none';
              }
              else {
                $hide_icon = 'display:block';
              }
            ?>
              <li class="image-icon" style="<?php echo e($hide_icon, false); ?>">
                <a href="<?php echo e(route('cart.index'), false); ?>"  title="Cart">
                  <i class="fal fa-shopping-bag"style="font-size: 17px;color:#fff;"></i>
                </a>
              </li>
              
             <?php if(auth()->guard('customer')->check()): ?>
              <li class="image-icon">
                <a href="<?php echo e(url('my/account'), false); ?>"  title="Account">
                  <i class="fal fa-user" style="font-size: 17px; color:#fff;"> </i>
                </a>
               </li>
               <li class="image-icon">
                <a href="<?php echo e(route('customer.logout'), false); ?>" title="Logout">
                <i class="fa fa-sign-out" style="font-size: 17px;  color:#fff;"> </i>

                </a>
                
              </li>
               <?php else: ?>
                <li class="image-icon">
               <a href="javascript:void(0)" data-toggle="modal" data-target="#loginModal">
                  
                  
                </a>
              </li>
               <?php endif; ?>




          </ul>
        </div>
  </div>

  <style>
.sidenav {  height: 100%; display: none;  width: 300px; /* position: sticky; */ position: fixed ; z-index: 1;  top: 92px;  left: 0; background: #eee; overflow-x: hidden;  transition: 0.5s;  padding-top: 60px;}
.sidenav .side_bar_nav_link {  padding: 8px 8px 8px 32px;  text-decoration: none;   color: #0f0f0f;  display: block;  transition: 0.3s;}
.sidenav .side_bar_nav_link:hover {  color: #000;}
.sidenav .closebtn {  position: absolute;  top: 0;  right: 25px;  font-size: 36px;  margin-left: 50px; text-decoration: none; display: block; color: #000}
#main {  transition: margin-left .5s;  padding: 16px;}
/* .hide_class{display: none;} */
@media  screen and (max-height: 450px) {  .sidenav {padding-top: 15px;}  .sidenav a {font-size: 18px;}}
</style>

   <?php if((Auth::guard('customer')->check())): ?>

    <div id="mySidenav" class="sidenav" style="z-index: 9 !important; background: #fff ;box-shadow: -4px 0 26px #00000024;top: inherit;">
        <a  href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <a  class="side_bar_nav_link" href="#"><u style="text-underline-offset: 10px;font-size: large;font-weight: 700; ">Hello <?php $login_cutomer_obj =  Auth::guard('customer')->user(); echo  $login_cutomer_obj->name ?></u></a>
        <a  class="side_bar_nav_link" href="<?php echo e(url('stylist/customer/info'), false); ?>">My Dashboard</a>
        <a  class="side_bar_nav_link"  href="<?php echo e(url('stylist/customer/info?q=show_quesiton_answer_edit_screen'), false); ?>">Edit Profile  Questionnarie</a>
        <a  class="side_bar_nav_link side_menu_link" href="<?php echo e(url('my/account'), false); ?>" >Account</a>
        <a  class="side_bar_nav_link side_menu_link" href="<?php echo e(url('stylist/order/cancel'), false); ?>" >Return/Exchange</a>
        <a  class="side_bar_nav_link" href="<?php echo e(url('page/contact-us'), false); ?>">Contact</a>
        <a  class="side_bar_nav_link" href="https://dappr.com.au/">Logout</a>
    </div>

    <?php else: ?>

        <div id="mySidenav" class="sidenav" style="z-index:9 !important; background: #fff ;box-shadow: -4px 0 26px #00000024;top: inherit;">
            <a  href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            <a  class="side_bar_nav_link" href="<?php echo e(url('https://dev-dappr.manipuraco.net/'), false); ?>">Home</a>
            
            <a  class="side_bar_nav_link" href="<?php echo e(url('selling#howItWorks'), false); ?>">How DAPPR Works</a>
            <a  class="side_bar_nav_link" href="<?php echo e(url('page/joindappr'), false); ?>">How TO Join DAPPR</a>
            <a  class="side_bar_nav_link" href="<?php echo e(url('page/about-us'), false); ?>" class="side_menu_link">About DAPPR</a>
            <a  class="side_bar_nav_link" href=<?php echo e(url('page/contact-us'), false); ?>>Contact</a>
            <a  class="side_bar_nav_link" href="<?php echo e(url('customer/login'), false); ?>">Login</a>
        </div>

  <?php endif; ?>

<script>
function openNav() {
  document.getElementById("mySidenav").style.display = "block";
}

function closeNav() {
  document.getElementById("mySidenav").style.display = "none";
}
</script>





  <!--[if lte IE 9]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
    <![endif]-->

  <!-- Wrapper start -->
  <div class="wrapper">
    <!-- VALIDATION ERRORS -->
    <?php if(count($errors) > 0): ?>
      <div class="alert alert-danger alert-dismissible mb-0" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong><?php echo e(trans('theme.error'), false); ?>!</strong> <?php echo e(trans('messages.input_error'), false); ?><br><br>
        <ul class="list-group">
          <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li class="list-group-item list-group-item-danger"><?php echo e($error, false); ?></li>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
      </div>
    <?php endif; ?>

    <!-- global announcement -->
    <?php if(isset($global_announcement)): ?>
      <div id="global-announcement" style="display:none">
        <?php echo $global_announcement->parsed_body; ?>


        <?php if($global_announcement->action_url): ?>
          <span class="indent10">
            <a href="<?php echo e($global_announcement->action_url, false); ?>" class="btn btn-sm">
              <?php echo e($global_announcement->action_text, false); ?>

            </a>
          </span>
        <?php endif; ?>
      </div>
    <?php endif; ?>

    <!-- Header start -->
    <header class="header">
      <!-- Primary Menu -->
      <?php echo $__env->make('theme::nav.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

      <!-- Mobile Menu -->
      <?php echo $__env->make('theme::nav.mobile', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </header>

    <div class="close-sidebar">
      <strong><i class="fal fa-times"></i></strong>
    </div>

    <div id="content-wrapper">
      <?php echo $__env->yieldContent('content'); ?>
    </div>
    
    <div id="loading">
      <img id="loading-image" src="<?php echo e(theme_asset_url('img/loading.gif'), false); ?>" alt="busy...">
    </div>
    <!-- Quick View Modal-->
    <div id="quickViewModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false"></div>

    <!-- my Dynamic Modal-->
    <div id="myDynamicModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false"></div>

    
    
    
    

    <!-- footer start -->
    <?php echo $__env->make('theme::nav.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  </div>
  <!-- Wrapper end -->

  <!-- MODALS -->
  <?php if (! (Auth::guard('customer')->check())): ?>
    <?php echo $__env->make('theme::auth.modals', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php endif; ?>
  <script>
  function stylistTopMenuToggle(x) {
    x.classList.toggle("change");
  }
//   $(document).ready(function () {
//     $('#side_bar_edit').on('click',function () {
//         $find('.hide-bottom').css('display', 'none');
//     });
//   });
  </script>
  <script src="<?php echo e(theme_asset_url('js/app.js'), false); ?>"></script>
  

  <?php echo $__env->make('theme::notifications', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <!-- AppJS -->
  <?php echo $__env->make('theme::scripts.appjs', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <!-- Page Scripts -->
  <?php echo $__env->yieldContent('scripts'); ?>
</body>

</html>
<?php /**PATH C:\wamp64\www\hype-dappr\public\themes\default/views/layouts/main.blade.php ENDPATH**/ ?>