<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ $title ?? get_platform_title() }}</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <link href="{{ url('css/app.css') }}" rel="stylesheet">
  
  <link href="{{ url('css/login_style.css') }}" rel="stylesheet">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  <style>
   .login-header-text-style {  background-color: #000;  padding: 12px 0px;}
   
  </style>
</head>

<body class="hold-transition login-page">
<div class="text-center login-header-text-style"><img src="{{ URL('images/stylist/header_logo.jpg'); }} " alt="" width="200px">  </div>
<div class="row align-page-login">
        <div class="col-md-6  custom-login-box">
          <img src="{{ URL('images/stylist/Login_img.jpg'); }}" alt="" width="100%">
          <div class="login-bg-transprant-color"></div>
        </div>

    <div class="col-md-6 p-0 custom-login-box-text">
      @if (count($errors) > 0)
        <div class="alert alert-danger">
          <strong>{{ trans('theme.error') }}!</strong> {{ trans('messages.input_error') }}<br><br>
          <ul class="list-group">
            @foreach ($errors->all() as $error)
              <li class="list-group-item list-group-item-danger">{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <div class="login-logo">
        <!-- <a href="{{ url('/') }}">{{ get_platform_title() }}</a> -->      
      </div>

      @yield('content')

    </div>
</div>
  <!-- /.login-box -->

  <script src="{{ url('js/app.js') }}"></script>

  {{-- Include the recaptcha api script when its enabled --}}
  @if (config('services.recaptcha.key'))
    @include('theme::scripts.recaptcha')
  @endif

  <!-- Scripts -->
  @yield('scripts', '')

  <script type="text/javascript">
    // ;(function($, window, document) {
    $("#plans").select2({
      minimumResultsForSearch: -1,
    });
    $("#exp-year").select2({
      placeholder: "{{ trans('theme.placeholder.exp_year') }}",
      minimumResultsForSearch: -1,
    });
    $("#exp-month").select2({
      placeholder: "{{ trans('theme.placeholder.exp_month') }}",
      minimumResultsForSearch: -1,
    });

    $('.icheck').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass: 'iradio_minimal-blue'
    });

    //Country
    $("#country_id").change(function() {
      $("#state_id").empty().trigger('change'); //Reset the state dropdown

      $("#country_id").select2();

      var ID = $("#country_id").select2('data')[0].id;
      var url = "{{ route('ajax.getCountryStates') }}"

      $.ajax({
        delay: 250,
        data: "id=" + ID,
        url: url,
        success: function(result) {
          var data = [];
          if (result.length !== 0) {
            data = $.map(result, function(val, id) {
              return {
                id: id,
                text: val
              };
            })
          }

          $("#state_id").select2({
            allowClear: true,
            tags: true,
            placeholder: "{{ trans('app.placeholder.state') }}",
            data: data,
            sortResults: function(results, container, query) {
              if (query.term) {
                return results.sort();
              }

              return results;
            }
          });
        }
      });
    });

    // });
  </script>

  <div class="loader">
    <center>
      <img class="loading-image" src="{{ theme_asset_url('img/loading.gif') }}" alt="busy...">
    </center>
  </div>
</body>

</html>
