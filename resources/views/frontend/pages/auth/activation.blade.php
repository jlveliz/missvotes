@extends('layouts.frontend')
@section('content')
<div class="row">
	<div class="col-md-4 col-lg-4 col-xs-12 col-md-offset-4 container-page-auth">
		<div class="row">
			<h1 class="text-center">Activación de Usuario</h1>
		</div>
		<div class="row">
			@if (session('status'))
			    <div class="alert alert-success">
			        Se ha enviado el correo de activación. Por favor revise su correo y no olvide de revisar en su bandeja de correo no deseado. 
			    </div>
			@endif
		</div>
		<p class="text-justify">El código de activación puede demorar hasta 30 minutos en llegar. Revise en su bandeja de correo no deseados.</p>
		<form role="form" action="{{ route('client.re-send-activate') }}" method="POST">
			{{ csrf_field() }}
		  <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
		     <input type="email" class="form-control" name="email" id="activation-email" placeholder="Correo" autofocus value="{{old('email')}}">
		     @if ($errors->has('email'))
                <span class="help-block"><strong>{{ $errors->first('email') }}</strong></span>
            @endif
		  </div>
		  <input type="submit" name="activation" id="activation" class="activation btn btn-primary btn-block activationmodal-submit" value="Enviar Código">
		</form>
	</div>
</div>
@endsection