<!DOCTYPE html>
<html>

<head>
  <title>@lang('app.marketplace_down')</title>

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

    /* .container {
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
    img
    {
        width: 310px
    }
    .go_back
    {
        text-decoration: none
        color:#6dbcd4;
    } */
    .container
    {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
    .container .go_back
    {
        text-decoration: none;
        font: normal normal normal 25px/22px Open Sans;
        display: block;
        text-align: center;
        background: #6dbcd4;
        padding: 10px;
        color: #fff;

    }
    .container .title p
    {
        color: #1c1c1c;
        font: normal normal normal 25px/22px Open Sans;
        text-align: center;
    }
  </style>
</head>

<body>
    {{-- <img src="{{ get_logo_url('platform', 'full') }}" class="brand-logo" alt="LOGO" title="LOGO" /> --}}
  <div class="container">
    <a href="{{ url('/') }}" class="logo_anchor">
        <img class="logo" src="{{ url('images/stylist/header_logo.jpg') }}" alt="" width="300" >
    </a>
    <div class="title">
        <p>419 - Session Expire</p>
    </div>
      {{-- <div class="title">{{ trans('responses.404_not_found') }}</div> --}}
      <a class="go_back" href="{{ url()->previous() }}">@lang('theme.button.go_back')</a>
  </div>
</body>

</html>
