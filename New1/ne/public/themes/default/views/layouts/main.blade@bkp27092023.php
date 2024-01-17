<!DOCTYPE html>
<html class="no-js" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <style>
    
  </style>
<head>
  @include('meta')

  @if (url('/') !== request()->url())
    <link href='https://fonts.googleapis.com/css?family=Roboto:500,300,700,400italic,400' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,600' rel='stylesheet' type='text/css'>
  @endif

  <!-- Main custom css -->
  <link href="{{ theme_asset_url('css/style.css') }}" media="screen" rel="stylesheet">
  {{-- <link href="https://dl.dropbox.com/s/zyu2rzm3r1limec/resposive.css" media="screen" rel="stylesheet"> --}}

  @if (config('active_locales') && config('active_locales')->firstWhere('code', App::getLocale())->rtl)
    <link href="{{ theme_asset_url('css/rtl.css') }}" media="screen" rel="stylesheet">

  @endif

   <link href="{{ url('css/frotend-stylist-form-common-all.css?').rand(10,100) }}"  rel="stylesheet">
  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  {{-- <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]--> --}}

  @if (get_from_option_table('theme_custom_styling'))
    <style>
      {{ get_from_option_table('theme_custom_styling') }}
    </style>
  @endif
</head>

@php
if(!isset($stylist_body_class)){
  $stylist_body_class = '';
}
@endphp

<body class="{{ $stylist_body_class }} {{ config('active_locales')->firstWhere('code', App::getLocale())->rtl ? 'rtl' : 'ltr' }}">


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


    <img src="{{ url('images/stylist/header_logo.jpg') }}" alt="" width="100%" style='margin-left:4em;'>
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
              <li class="image-icon" style="{{$hide_icon}}">
                <a href="{{ route('cart.index') }}"  title="Cart">
                  <i class="fal fa-shopping-bag"style="font-size: 17px;color:#fff;"></i>
                </a>
              </li>
              {{-- {{<span>Hello, Rahul</span>}} --}}
             @auth('customer')
              <li class="image-icon">
                <a href="{{ url('my/account')}}"  title="Account">
                  <i class="fal fa-user" style="font-size: 17px; color:#fff;"> </i>
                </a>
               </li>
               <li class="image-icon">
                <a href="{{ route('customer.logout') }}" title="Logout">
                <i class="fa fa-sign-out" style="font-size: 17px;  color:#fff;"> </i>

                </a>
                {{-- <a href="{{ route('account', 'dashboard') }}">
                  <i class="fal fa-user"style="font-size: 17px;"></i>
                   <span>Logout</span>
                </a> --}}
              </li>
               @else
                <li class="image-icon">
               <a href="javascript:void(0)" data-toggle="modal" data-target="#loginModal">
                  {{-- <i class="fal  fa-user"style="font-size: 17px;"></i> --}}
                  {{-- <span>Logout</span> --}}
                </a>
              </li>
               @endauth




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
@media screen and (max-height: 450px) {  .sidenav {padding-top: 15px;}  .sidenav a {font-size: 18px;}}
</style>

   @if ((Auth::guard('customer')->check()))

    <div id="mySidenav" class="sidenav" style="z-index: 9 !important; background: #fff ;box-shadow: -4px 0 26px #00000024;top: inherit;">
        <a  href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <a  class="side_bar_nav_link" href="#"><u style="text-underline-offset: 10px;font-size: large;font-weight: 700; ">Hello @php $login_cutomer_obj =  Auth::guard('customer')->user(); echo  $login_cutomer_obj->name @endphp</u></a>
        <a  class="side_bar_nav_link" href="{{url('stylist/customer/info')}}">My Dashboard</a>
        <!--<a  class="side_bar_nav_link"  href="{{url('stylist/customer/info?q=show_quesiton_answer_edit_screen')}}">Edit Profile  Questionnarie</a>-->
        <a  class="side_bar_nav_link"  onclick="stylist_question_start();return false;">Edit Profile  Questionnarie</a>
        <a  class="side_bar_nav_link side_menu_link" href="{{ url('my/account') }}" >Account</a>
        <a  class="side_bar_nav_link side_menu_link" href="{{ url('stylist/order/cancel') }}" >Return/Exchange</a>
        <a  class="side_bar_nav_link" href="{{url('page/contact-us')}}">Contact</a>
        <a  class="side_bar_nav_link" href="https://dappr.com.au/">Logout</a>
    </div>

    @else

        <div id="mySidenav" class="sidenav" style="z-index:9 !important; background: #fff ;box-shadow: -4px 0 26px #00000024;top: inherit;">
            <a  href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            <a  class="side_bar_nav_link" href="{{url('https://dev-dappr.manipuraco.net/')}}">Home</a>
            {{-- <a  class="side_bar_nav_link" href="{{url('http://192.168.0.102/chris/dappr-new/public/')}}">Home</a> --}}
            <a  class="side_bar_nav_link" href="{{url('selling#howItWorks')}}">How DAPPR Works</a>
            <a  class="side_bar_nav_link" href="{{url('page/joindappr')}}">How TO Join DAPPR</a>
            <a  class="side_bar_nav_link" href="{{ url('page/about-us') }}" class="side_menu_link">About DAPPR</a>
            <a  class="side_bar_nav_link" href={{url('page/contact-us')}}>Contact</a>
            <a  class="side_bar_nav_link" href="{{ url('customer/login') }}">Login</a>
        </div>

  @endif

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
    @if (count($errors) > 0)
      <div class="alert alert-danger alert-dismissible mb-0" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>{{ trans('theme.error') }}!</strong> {{ trans('messages.input_error') }}<br><br>
        <ul class="list-group">
          @foreach ($errors->all() as $error)
            <li class="list-group-item list-group-item-danger">{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <!-- global announcement -->
    @if (isset($global_announcement))
      <div id="global-announcement" style="display:none">
        {!! $global_announcement->parsed_body !!}

        @if ($global_announcement->action_url)
          <span class="indent10">
            <a href="{{ $global_announcement->action_url }}" class="btn btn-sm">
              {{ $global_announcement->action_text }}
            </a>
          </span>
        @endif
      </div>
    @endif

    <!-- Header start -->
    <header class="header">
      <!-- Primary Menu -->
      @include('theme::nav.main')

      <!-- Mobile Menu -->
      @include('theme::nav.mobile')
    </header>

    <div class="close-sidebar">
      <strong><i class="fal fa-times"></i></strong>
    </div>

    <div id="content-wrapper">
      @yield('content')
    </div>
    {{-- @unless(Auth::guard('customer')->check())
            @include('theme::auth.modals')
        @endunless --}}
    <div id="loading">
      <img id="loading-image" src="{{ theme_asset_url('img/loading.gif') }}" alt="busy...">
    </div>
    <!-- Quick View Modal-->
    <div id="quickViewModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false"></div>

    <!-- my Dynamic Modal-->
    <div id="myDynamicModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false"></div>

    {{-- @if (is_incevio_package_loaded('zipcode')) --}}
    {{-- @include('theme::modals.zipcode') --}}
    {{-- @include('zipcode::_modal') --}}
    {{-- @endif --}}

    <!-- footer start -->
    @include('theme::nav.footer')
  </div>
  <!-- Wrapper end -->

  <!-- MODALS -->
  @unless(Auth::guard('customer')->check())
    @include('theme::auth.modals')
  @endunless
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
  <script src="{{ theme_asset_url('js/app.js') }}"></script>
  {{-- <script src="https://dl.dropbox.com/s/nqdfqqp5fper8no/script.js"></script> --}}

  @include('theme::notifications')

  <!-- AppJS -->
  @include('theme::scripts.appjs')

  <!-- Page Scripts -->
  @yield('scripts')
</body>

</html>
