@extends('layouts.frontend')
@section('content')
  <div class="row">
    <div class="col-md-4 col-lg-4 col-xs-12 col-md-offset-4 container-page-auth">
        <div class="row">
          <h1 class="text-center">Ingreso</h1><br>
        </div>
        <div class="row">
          <form role="form" action="{{ route('client.login') }}" method="POST">
            {{ csrf_field() }}
            <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                <input type="text" class="form-control" name="email" id="login-email" value="{{ old('email') }}" placeholder="Correo" autofocus required>
                @if ($errors->has('email'))
                    <span class="help-block"><strong>{{ $errors->first('email') }}</strong></span>
                @endif
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" id="login-password" placeholder="Contraseña" required>
            </div>

            <div class="form-group">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : ''}}> @lang('auth.remember_me')
                    </label>
                </div>
            </div>

            <input type="submit" name="login" id="login" class="login btn btn-primary btn-block loginmodal-submit" value="Ingresar">
          </form>
          
          <div class="login-help">
            <a href="{{ route('client.show.register') }}">Registro</a> - 
            <a href="{{ route('client.show.reset-email') }}">Olvidó su contraseña?</a> - 
            <a href="{{ route('client.show.activate') }}">No recibió su código de activación?</a>
          </div>
        </div>
    </div>
  </div>
    
@endsection()