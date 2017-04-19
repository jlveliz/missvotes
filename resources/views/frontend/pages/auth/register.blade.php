@extends('layouts.frontend')
@section('content')
  <div class="row">
    <div class="col-md-4 col-lg-4 col-xs-12 col-md-offset-4 container-page-auth">
        <h1 class="text-center">Registro</h1><br>
      <form role="form" action="{{ route('client.register') }}" method="POST">
        {{ csrf_field() }}
        <div class="form-group  {{ $errors->has('email') ? ' has-error' : '' }}">
            <input type="email" class="form-control" name="email" id="register-email" placeholder="Correo" value="{{ old('email') }}" autofocus required>
            @if ($errors->has('email'))
                <span class="help-block"><strong>{{ $errors->first('email') }}</strong></span>
            @endif
        </div>

        <div class="form-group {{ $errors->has('name') || $errors->has('last_name') ? ' has-error' : '' }}">
          <div class="row">
            <div class="col-md-6">
                <input type="text" class="form-control" name="name" id="register-name" placeholder="Nombres" value="{{ old('name') }}">
                 @if ($errors->has('name'))
                  <span class="help-block"><strong>{{ $errors->first('name') }}</strong></span>
                  @endif
            </div>
            <div class="col-md-6">
                <input type="text" class="form-control" name="last_name" id="register-lastname" placeholder="Apellidos" value="{{ old('last_name')}}">
                @if ($errors->has('last_name'))
                 <span class="help-block"><strong>{{ $errors->first('last_name') }}</strong></span>
                 @endif
            </div>
          </div>
        </div>

        <div class="form-group {{ $errors->has('country_id') ? ' has-error' : '' }}">
          <select class="form-control" name="country_id" id="country">
              <option value="null">--Seleccione--</option>
            @foreach (\MissVote\Models\Country::orderby('name')->get() as $country)
              <option value="{{ $country->id }}" @if($country->id == old('country_id')) selected @endif>{{ $country->name }}</option>
            @endforeach
          </select>
           @if ($errors->has('country_id'))
              <span class="help-block"><strong>{{ $errors->first('country_id') }}</strong></span>
          @endif

        </div>

        <div class="form-group {{ $errors->has('city') ? ' has-error' : '' }}">
            <input type="text" class="form-control" name="city" id="city" placeholder="Ciudad" value="{{ old('city') }}">
             @if ($errors->has('city'))
              <span class="help-block"><strong>{{ $errors->first('city') }}</strong></span>
          @endif
        </div>

        <div class="form-group {{ $errors->has('address') ? ' has-error' : '' }}">
            <input type="text" class="form-control" name="address" id="register-address" placeholder="Dirección" value="{{ old('address') }}">
             @if ($errors->has('address'))
              <span class="help-block"><strong>{{ $errors->first('address') }}</strong></span>
          @endif
        </div>
        
        <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
            <input type="password" class="form-control" name="password" id="register-password" placeholder="Contraseña">
             @if ($errors->has('password'))
              <span class="help-block"><strong>{{ $errors->first('password') }}</strong></span>
          @endif
        </div> 

        <div class="form-group {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
            <input type="password" class="form-control" name="password_confirmation" id="register-password-confirmation" placeholder="Confirme Contraseña">
            @if ($errors->has('password_confirmation'))
              <span class="help-block"><strong>{{ $errors->first('password_confirmation') }}</strong></span>
          @endif
        </div>

        <input type="submit" name="register" id="register" class="register btn btn-primary btn-block registermodal-submit" value="Aceptar">
      </form>
      
      <div class="register-help">
        <a href="{{ route('client.show.login') }}">Iniciar Sesión</a>
      </div>
    </div>
  </div>
    
@endsection()