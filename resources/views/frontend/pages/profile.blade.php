@extends('layouts.frontend')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('public/css/profile.css') }}">
@endsection()

@section('content')
<div class="container-page">
	<h2>{{ Auth::user()->name }}</h2>
	<div class="container-tabs-profile">
		
		<ul class="nav nav-tabs" role="tablist">
		    <li role="presentation" class="active">
		    	<a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Perfil</a>
		    </li>
		    <li role="presentation">
		    	<a href="#membership" aria-controls="membership" role="tab" data-toggle="tab">Membresia @if(Auth::user()->client && !Auth::user()->client->current_membership()) <small class="upgrade-membership">(Actualiza!!)</small> @endif</a>
		    </li>
		    <li role="presentation">
		    	<a href="#tickets" aria-controls="tickets" role="tab" data-toggle="tab">Tickets</a>
		    </li>
  		</ul>

  		<!-- Tab panes -->
		<div class="tab-content">
			<div role="tabpanel" class="tab-pane active" id="profile">
		    	<div class="col-md-3 col-sm-3 col-xs-12 hidden-xs">
		    		<div class="profile-img">
		    			<img class="img-responsive" src="{{ asset('public/images/account.png') }}" alt="{{Auth::user()->name}}" title="{{Auth::user()->name}}">
		    		</div>
		    	</div>
		    	<div class="col-md-9 col-sm-9 col-xs-12">
		    		<h4>Datos Personales</h4>
		    		<table class="table table-striped ">
		    			<tbody>
		    				<tr>
		    					<td><b>Nombres: </b> {{Auth::user()->name}}</td>
		    				</tr>
		    				<tr>
		    					<td><b>Correo: </b> {{Auth::user()->email}}</td>
		    				</tr>
		    				<tr>
		    					<td><b>Dirección: </b> {{Auth::user()->address}}</td>
		    				</tr>
		    				<tr>
		    					<td><b>Último Acceso: </b> {{Auth::user()->last_login}}</td>
		    				</tr>
		    			</tbody>
		    		</table>
		    		<h4>Cambiar Contraseña</h4>
		    		<form action="{{ route('website.account.update') }}" method="POST">
		    			@if (Session::has('mensaje'))
    						<div class="alert alert-dismissible @if(Session::get('tipo_mensaje') == 'success') alert-info  @endif @if(Session::get('tipo_mensaje') == 'error') alert-danger  @endif" role="alert">
      							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
      							{{session('mensaje')}}
       						</div>
    						<div class="clearfix"></div>
   						@endif
		    			{{ csrf_field() }}
		    			<div class="form-group col-md-4 col-sm-4 col-xs-12 @if($errors->has('password')) has-error @endif">
		    				<label class="control-label">Contraseña nueva </label>
							<input type="password" class="form-control" placeholder="Nueva Contraseña" name="password" value="{{ old('password') }}">
							@if ($errors->has('password')) <p class="help-block">{{ $errors->first('password') }}</p> @endif
		    			</div>
		    			<div class="form-group col-md-4 col-sm-4 col-xs-12 @if($errors->has('repeat_password')) has-error @endif">
		    				<label class="control-label">Repita Contraseña nueva </label>
							<input type="password" class="form-control" placeholder="Repita Nueva Contraseña " name="repeat_password" value="{{ old('repeat_password') }}">
							@if ($errors->has('repeat_password')) <p class="help-block">{{ $errors->first('repeat_password') }}</p> @endif
		    			</div>
		    			<div class="form-group col-md-4 col-sm-4 col-xs-12" style="padding-top: 4px">
		    				<br>
		    				<button type="submit" name="submit" class="btn btn-default">Cambiar Contraseña</button>
		    			</div>
		    		</form>
		    	</div>
		    </div>

		    {{-- membershipss --}}
		    <div role="tabpanel" class="tab-pane" id="membership" >
		    	<h4>Membresia</h4> 
		    	@include('frontend.partials.membership',$memberships)
		    </div>
		    <div role="tabpanel" class="tab-pane" id="tickets">
		    	Tickets
		    </div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>
@endsection()