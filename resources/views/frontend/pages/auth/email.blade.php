@extends('layouts.frontend')
@section('content')
<div class="row">
    <div class="col-md-4 col-lg-4 col-xs-12 col-md-offset-4 container-page-auth">
		<div class="row">
			<h1 class="text-center">Recuperar Contraseña</h1><br>
		</div>
		<div class="row">
			@if (session('status'))
			    <div class="alert alert-success">
			        Se ha enviado el correo para poder cambiar su contraseña, no olvide de revisar en su bandeja de correo no deseado. Por favor reviselo y siga las instrucciones.
			    </div>
			@endif
		</div>
		<form role="form" action="{{ route('client.reset-email') }}" method="POST">
		{{ csrf_field() }}
		<div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
		    <input type="email" class="form-control" name="email" id="email-email" placeholder="Correo" autofocus>
		    @if ($errors->has('email'))
                <span class="help-block"><strong>{{ $errors->first('email') }}</strong></span>
            @endif
		</div>
		<input type="submit" name="button" id="email" class="email btn btn-primary btn-block loginmodal-submit" value="Recuperar Contraseña">
		</form>
    </div>
</div>
@endsection()