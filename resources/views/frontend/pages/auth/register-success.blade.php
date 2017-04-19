@extends('layouts.frontend')
@section('content')
	 <div class="row">
    <div class="col-md-4 col-lg-4 col-xs-12 col-md-offset-4 container-page-auth">
			  <h2>Registro completo!</h2><br>
			  <p class="text-muted text-center">Su cuenta se creó correctamente, pero debemos verificar su correo electrónico. Hemos enviado un correo de confirmación a su bandeja de entrada. Simplemente debe hacer clic en el enlace que reciba para activar su cuenta. No olvide buscar también en su bandeja de correos no deseados. ¡Gracias!</p>
			  <a type="submit" class="btn btn-primary btn-block" href="{{ route('website.home') }}" value="Aceptar" data-dismiss="modal">Aceptar</a>
			
    </div>
    </div>
@endsection()