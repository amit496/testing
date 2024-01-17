<!DOCTYPE html>
<html>

<head>
  <title><?php echo app('translator')->get('app.marketplace_down'); ?></title>

  <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

  <style>
    html,
    body {
      height: 100%;
    }

    body {
      margin: 0;
      padding: 0;
      width: 100%;
      color: #B0BEC5;
      display: table;
      font-weight: 100;
      font-family: 'Lato', sans-serif;
    }

    .container {
      text-align: center;
      display: table-cell;
      vertical-align: middle;
    }

    .content {
      text-align: center;
      display: inline-block;
    }

    .title {
      padding: 0 20px;
      font-size: 42px;
      margin-top: 20px;
      margin-bottom: 40px;
    }

    .brand-logo {
      max-width: 140px;
      max-height: 50px;
    }

  </style>
</head>

<body>
  <div class="container">
    <div class="content">
      <a href="<?php echo e(url('/'), false); ?>">
        <img src="<?php echo e(get_logo_url('platform', 'full'), false); ?>" class="brand-logo" alt="LOGO" title="LOGO" />
      </a>
      <div class="title"><?php echo e(trans('responses.404_not_found'), false); ?></div>
      <a href="<?php echo e(url()->previous(), false); ?>"><?php echo app('translator')->get('theme.button.go_back'); ?></a>
    </div>
  </div>
</body>

</html>
<?php /**PATH C:\wamp64\www\hype-dappr\resources\views/errors/404.blade.php ENDPATH**/ ?>