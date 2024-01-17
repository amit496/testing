<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="<?php echo e(csrf_token(), false); ?>">
  <title><?php echo e($title ?? get_platform_title(), false); ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <link href="<?php echo e(url('css/app.css'), false); ?>" rel="stylesheet">
  
  <link href="<?php echo e(url('css/login_style.css'), false); ?>" rel="stylesheet">

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
<div class="text-center login-header-text-style"><img src="<?php echo e(URL('images/stylist/header_logo.jpg'), false); ?> " alt="" width="200px">  </div>
<div class="row align-page-login">
        <div class="col-md-6  custom-login-box">
          <img src="<?php echo e(URL('images/stylist/Login_img.jpg'), false); ?>" alt="" width="100%">
          <div class="login-bg-transprant-color"></div>
        </div>

    <div class="col-md-6 p-0 custom-login-box-text">
      <?php if(count($errors) > 0): ?>
        <div class="alert alert-danger">
          <strong><?php echo e(trans('theme.error'), false); ?>!</strong> <?php echo e(trans('messages.input_error'), false); ?><br><br>
          <ul class="list-group">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <li class="list-group-item list-group-item-danger"><?php echo e($error, false); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </ul>
        </div>
      <?php endif; ?>

      <div class="login-logo">
        <!-- <a href="<?php echo e(url('/'), false); ?>"><?php echo e(get_platform_title(), false); ?></a> -->      
      </div>

      <?php echo $__env->yieldContent('content'); ?>

    </div>
</div>
  <!-- /.login-box -->

  <script src="<?php echo e(url('js/app.js'), false); ?>"></script>

  
  <?php if(config('services.recaptcha.key')): ?>
    <?php echo $__env->make('theme::scripts.recaptcha', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php endif; ?>

  <!-- Scripts -->
  <?php echo $__env->yieldContent('scripts', ''); ?>

  <script type="text/javascript">
    // ;(function($, window, document) {
    $("#plans").select2({
      minimumResultsForSearch: -1,
    });
    $("#exp-year").select2({
      placeholder: "<?php echo e(trans('theme.placeholder.exp_year'), false); ?>",
      minimumResultsForSearch: -1,
    });
    $("#exp-month").select2({
      placeholder: "<?php echo e(trans('theme.placeholder.exp_month'), false); ?>",
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
      var url = "<?php echo e(route('ajax.getCountryStates'), false); ?>"

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
            placeholder: "<?php echo e(trans('app.placeholder.state'), false); ?>",
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
      <img class="loading-image" src="<?php echo e(theme_asset_url('img/loading.gif'), false); ?>" alt="busy...">
    </center>
  </div>
</body>

</html>
<?php /**PATH C:\wamp64\www\hype-dappr\public\themes\default/views/auth/layout.blade.php ENDPATH**/ ?>