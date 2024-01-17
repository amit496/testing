@extends('theme::auth.layout')

@section('content')
<style>    .nav li:last-child{ border-bottom: 0px solid #c3c3c3; }    </style>
  <div class="login-box-body">
    <ul class="nav nav-pills nav-justified  nav-mar-style" id="ex1" role="tablist" >
          <li class="nav-item" role="presentation">
            <a class="nav-link active" id="tab-login" data-mdb-toggle="pill" href="#pills-login" role="tab"
              aria-controls="pills-login" aria-selected="true">Login</a>
          </li>
          <li class="nav-item" role="presentation">
            <a class="nav-link" id="tab-register" data-mdb-toggle="pill" href="{{ route('customer.register') }}" role="tab"
              aria-controls="pills-register" aria-selected="false">Register</a>
          </li>
        </ul>


    <div class="box-header with -border">
      <!-- <h3 class="box-title">{{ trans('theme.account_login') }}</h3> -->
    </div> <!-- /.box-header -->
    <div class="box-body">
      {!! Form::open(['route' => 'customer.login.submit', 'id' => 'form', 'data-toggle' => 'validator']) !!}
      <div class="form-group has-feedback">
      <label for="basic-url" class="form-label">Email*</label>
        {!! Form::email('email', null, ['class' => 'form-control input-lg', 'placeholder' => trans('theme.placeholder.email'), 'required']) !!}
        <!-- <span class="glyphicon glyphicon-envelope form-control-feedback"></span> -->
        <div class="help-block with-errors"></div>
      </div>
      <div class="form-group has-feedback">
      <label for="basic-url" class="form-label">Password*</label>
        {!! Form::password('password', ['class' => 'form-control input-lg', 'id' => 'password', 'placeholder' => trans('theme.placeholder.password'), 'data-minlength' => '6', 'required']) !!}
        <!-- <span class="glyphicon glyphicon-lock form-control-feedback"></span> -->
        <div class="help-block with-errors"></div>
      </div>
      <div class="row">
        <div class="col-md-12 col-sm-12">
          <div class="form-group text-sm-center">
            <label>
              {!! Form::checkbox('remember', null, null, ['class' => 'icheck']) !!} {{ trans('theme.remember_me') }}
            </label>
          </div>
        </div>
        <div class="col-md-12 col-sm-12">
          {!! Form::submit(trans('theme.button.login'), ['class' => 'btn btn-block btn-lg btn-flat btn-primary']) !!}
        </div>
      </div>
      {!! Form::close() !!}

      @if (config('system_settings.social_auth'))
        <div class="social-auth-links text-center">
          @if (config('services.facebook.client_id'))
            <a href="{{ route('socialite.customer', 'facebook') }}" class="btn btn-block btn-social btn-facebook btn-lg btn-flat">
              <i class="fa fa-facebook"></i> {{ trans('theme.button.login_with_fb') }}
            </a>
          @endif

          @if (config('services.google.client_id'))
            <a href="{{ route('socialite.customer', 'google') }}" class="btn btn-block btn-social btn-google btn-lg btn-flat">
              <i class="fa fa-google"></i> {{ trans('theme.button.login_with_g') }}
            </a>
          @endif

          @if (is_incevio_package_loaded('apple-login'))
            <a href="{{ route('socialite.customer', 'apple') }}" class="btn btn-block btn-social btn-apple btn-lg btn-flat">
              <i class="fa fa-apple"></i> {{ trans('appleLogin::lang.login_with_apple') }}
            </a>
          @endif
        </div> <!-- /.social-auth-links -->
      @endif

      <div class="col-md-12 text-center">
      <a class="btn btn-link" href="{{ route('customer.password.request') }}">
        {{ trans('theme.forgot_password') }}
      </a>

      </div>
      <!-- <a class="btn btn-link" href="{{ route('customer.register') }}" class="text-center">
        {{ trans('theme.register_here') }}
      </a> -->
    </div>
  </div>

  @if (config('app.demo') == true)
    <div class="box login-box-body">
      <div class="box-header with-border">
        <h3 class="box-title">Demo Login::</h3>
      </div> <!-- /.box-header -->
      <div class="box-body">
        <p>Username: <strong>customer@demo.com</strong> | Password: <strong>123456</strong> </p>
      </div>
    </div>
  @endif
@endsection
