@extends('layouts.frontend')
@section('content')
  <div class="row">
    <div class="col-md-4 col-lg-4 col-xs-12 col-md-offset-4 container-page-auth">
        <div class="row">
          <div class="col-md-12 text-center">
              <img class="image-responsive"  src="{{ asset('public/images/logo_square.png') }}" alt=" {{config('app.name')}} " title=" {{config('app.name')}} ">
           </div> 
        </div>

        <h1 class="text-center">@lang('auth.login_title')</h1><br>
        <div class="row">
          <form role="form" action="{{ route('client.login') }}" method="POST">
            {{ csrf_field() }}
            <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                <input type="text" class="form-control" name="email" id="login-email" value="{{ old('email') }}" placeholder="@lang('auth.login_fields.email')" autofocus required>
                @if ($errors->has('email'))
                    <span class="help-block"><strong>{{ $errors->first('email') }}</strong></span>
                @endif
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" id="login-password" placeholder="@lang('auth.login_fields.password')" required>
            </div>

            <div class="form-group">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : ''}}> @lang('auth.login_fields.remember_me')
                    </label>
                </div>
            </div>

            <input type="submit" name="login" id="login" class="login btn btn-primary btn-block loginmodal-submit" value="@lang('auth.login_options.login_button')">
          </form>
          
          <div class="login-help">
            <a href="{{ route('client.show.register') }}">@lang('auth.login_options.go_register')</a> - 
            <a href="{{ route('client.show.reset-email') }}">@lang('auth.login_options.forgot_password')</a> - 
            <a href="{{ route('client.show.activate') }}">@lang('auth.login_options.code_not_recivied')</a>
          </div>
        </div>
    </div>
  </div>
    
@endsection()