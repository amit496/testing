@extends('theme::auth.layout')

@section('content')
<style>   .nav li:first-child{ border-bottom: 0px solid #c3c3c3; }</style>
  <div class=" login-box-body">
  <ul class="nav nav-pills nav-justified  nav-mar-style" id="ex1" role="tablist">
          <li class="nav-item" role="presentation">
            <a class="nav-link active" id="tab-login" data-mdb-toggle="pill" href="{{ route('customer.login') }}" role="tab"
              aria-controls="pills-login" aria-selected="true">Login</a>
          </li>
          <li class="nav-item" role="presentation">
            <a class="nav-link" id="tab-register" data-mdb-toggle="pill" href="#pills-login"  role="tab"
              aria-controls="pills-register" aria-selected="false">Create Account </a>
          </li>
        </ul>
    <div class="box-header with- border">
      <!-- <h3 class="box-title">{{ trans('theme.register') }}</h3> -->
    </div> 
    <!-- /.box-header -->
    <div class="box-body">
      {!! Form::open(['route' => 'customer.register', 'id' => 'form', 'data-toggle' => 'validator']) !!}
      <div class="form-group has-feedback">
      <label for="basic-url" class="form-label">First name*</label>
        {!! Form::text('name', null, ['class' => 'form-control input-lg', 'placeholder' => trans('theme.placeholder.full_name'), 'required']) !!}
        <!-- <span class="glyphicon glyphicon-user form-control-feedback"></span> -->
        <div class="help-block with-errors"></div>
      </div>

       <div class="form-group has-feedback">
       <label for="basic-url" class="form-label">Last name*</label>
        {!! Form::text('last_name', null, ['class' => 'form-control input-lg', 'placeholder' => trans('stylist.placeholder.last_name'), 'required']) !!}
        <!-- <span class="glyphicon glyphicon-user form-control-feedback"></span> -->
        <div class="help-block with-errors"></div>
      </div>

      <div class="form-group has-feedback">
      <label for="basic-url" class="form-label">Email*</label>
        {!! Form::email('email', null, ['class' => 'form-control input-lg', 'placeholder' => trans('theme.placeholder.valid_email'), 'required']) !!}
        <!-- <span class="glyphicon glyphicon-envelope form-control-feedback"></span> -->
        <div class="help-block with-errors"></div>
      </div>
      <div class="form-group has-feedback">
      <label for="basic-url" class="form-label">Password*</label>
        {!! Form::password('password', ['class' => 'form-control input-lg', 'id' => 'password', 'placeholder' => trans('theme.placeholder.password'), 'data-minlength' => '6', 'required']) !!}
        <!-- <span class="glyphicon glyphicon-lock form-control-feedback"></span> -->
        <div class="help-block with-errors"></div>
      </div>
      <div class="form-group has-feedback">
      <label for="basic-url" class="form-label">Confirm Password</label>
        {!! Form::password('password_confirmation', ['class' => 'form-control input-lg', 'placeholder' => trans('theme.placeholder.confirm_password'), 'data-match' => '#password', 'required']) !!}
        <!-- <span class="glyphicon glyphicon-lock form-control-feedback"></span> -->
        <div class="help-block with-errors"></div>
      </div>
       <div class="form-group has-feedback">
       <label for="basic-url" class="form-label">Date of birth*</label>
        {!! Form::date('dob', null, ['class' => 'form-control input-lg', 'placeholder' => trans('stylist.placeholder.dob'), 'required']) !!}

        <div class="help-block with-errors"></div>
      </div>



      @if (is_incevio_package_loaded('zipcode'))
        @include('address._form')
      @endif
<!--
      <div class="form-group has-feedback">
        @if (config('services.recaptcha.key'))
          <div class="g-recaptcha" data-sitekey="{!! config('services.recaptcha.key') !!}"></div>
        @endif
        <div class="help-block with-errors"></div>
      </div>

      @if (config('system_settings.ask_customer_for_email_subscription'))
        <div class="form-group">
          <label>
            {!! Form::checkbox('subscribe', null, null, ['class' => 'icheck']) !!} {!! trans('theme.input_label.subscribe_to_the_newsletter') !!}
          </label>
        </div>
      @endif -->

      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label>
              {!! Form::checkbox('agree', null, null, ['class' => 'icheck', 'required']) !!} {!! trans('theme.input_label.i_agree_with_terms', ['url' => route('page.open', \App\Models\Page::PAGE_TNC_FOR_CUSTOMER)]) !!}
            </label>
            <div class="help-block with-errors"></div>
          </div>
        </div>
        <div class="col-md-12">
          {!! Form::submit(trans('CREATE ACCOUNT'), ['class' => 'btn btn-block btn-lg btn-flat btn-primary']) !!}
        </div>
      </div>
      {!! Form::close() !!}

      @if (config('system_settings.social_auth'))
        <div class="social-auth-links text-center">
          @if (config('services.facebook.client_id'))
            <a href="{{ route('socialite.customer', 'facebook') }}" class="btn btn-block btn-social btn-facebook btn-lg btn-flat"><i class="fa fa-facebook"></i> {{ trans('theme.button.login_with_fb') }}</a>
          @endif

          @if (config('services.google.client_id'))
            <a href="{{ route('socialite.customer', 'google') }}" class="btn btn-block btn-social btn-google btn-lg btn-flat"><i class="fa fa-google"></i> {{ trans('theme.button.login_with_g') }}</a>
          @endif

          @if (is_incevio_package_loaded('apple-login'))
            <a href="{{ route('socialite.customer', 'apple') }}" class="btn btn-block btn-social btn-apple btn-lg btn-flat">
              <i class="fa fa-apple"></i> {{ trans('appleLogin::lang.login_with_apple') }}
            </a>
          @endif
        </div>
      @endif

      <!-- <a href="{{ route('customer.login') }}" class="btn btn-link">{{ trans('theme.have_an_account') }}</a> -->
    </div>
  </div>
@endsection
