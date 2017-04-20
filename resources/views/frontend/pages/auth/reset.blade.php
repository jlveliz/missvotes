@extends('layouts.frontend')

@section('content')
    <div class="row">
        <div class="col-md-4 col-lg-4 col-xs-12 col-md-offset-4 container-page-auth">
            <div class="row">
                <h1 class="text-center">{{ trans('auth.reset_password_title') }}</h1>
            </div>
            
            <div class="row">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
            </div>
            
            <div class="row">
                <form role="form" method="POST" action="{{ url('auth/password/reset') }}">
                    {{ csrf_field() }}

                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <input id="email" type="email" placeholder="{{ trans('auth.reset_password_fields.email') }}" class="form-control" name="email" value="{{ $email or old('email') }}" required autofocus>

                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <input id="password" type="password" class="form-control" name="password" placeholder="{{ trans('auth.reset_password_fields.password') }}" required>

                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                    </div>

                    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                        
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="{{ trans('auth.reset_password_fields.confirm_password') }}" required>

                        @if ($errors->has('password_confirmation'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                        @endif
                        
                    </div>

                    <button type="submit" class="login btn btn-primary btn-block loginmodal-submit">
                        {{ trans('auth.reset_password_options.submit') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
