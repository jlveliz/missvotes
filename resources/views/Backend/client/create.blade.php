@extends('layouts.backend')
@section('content')
<div class="panel panel-default">
	<div class="panel-heading">Clientes</div>
	<p class="subtitle">Creación de Clientes</p>
	<div class="panel-body">
		@if (Session::has('mensaje'))
        <div class="alert alert-dismissible @if(Session::get('tipo_mensaje') == 'success') alert-info  @endif @if(Session::get('tipo_mensaje') == 'error') alert-danger  @endif" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
          {{session('mensaje')}}
           </div>
        <div class="clearfix"></div>
       @endif
		<form action="{{ route('clients.store') }}" method="post">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<input type="hidden" name="is_admin" value="0">
			<div class="row">
				<div class="form-group col-md-3 col-sm-3 col-xs-12 @if($errors->has('email')) has-error @endif">
					<label class="control-label">Email </label>
					<input type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}">
					@if ($errors->has('email')) <p class="help-block">{{ $errors->first('email') }}</p> @endif
				</div>

				<div class="form-group col-md-3 col-sm-3 col-xs-12 @if($errors->has('name')) has-error @endif">
					<label class="control-label">Nombre </label>
					<input type="text" class="form-control" placeholder="Nombre" name="name" value="{{ old('name') }}">
					@if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
				</div>

				<div class="form-group col-md-3 col-sm-3 col-xs-12 @if($errors->has('last_name')) has-error @endif">
					<label class="control-label">Apellido </label>
					<input type="text" class="form-control" placeholder="Nombre" name="last_name" value="{{ old('last_name') }}">
					@if ($errors->has('last_name')) <p class="help-block">{{ $errors->first('last_name') }}</p> @endif
				</div>

				<div class="form-group col-md-3 col-sm-3 col-xs-12 @if($errors->has('country_id')) has-error @endif">
					<label class="control-label">País </label>
					<select class="form-control" name="country_id" id="country">
						<option value="null">--Seleccione--</option>
						@foreach ($countries as $element)
							<option value="{{$element->id}}" @if(old('country_id') == $element->id) selected  @endif>{{$element->name}}</option>
						@endforeach
					</select>
					@if ($errors->has('country_id')) <p class="help-block">{{ $errors->first('country_id') }}</p> @endif
				</div>
			</div>
			
			<div class="row">
				<div class="form-group col-md-3 col-sm-3 col-xs-6 @if($errors->has('city')) has-error @endif">
					<label class="control-label">Ciudad </label>
					<input type="text" class="form-control" placeholder="Ciudad" name="city" value="{{ old('city') }}">
					@if ($errors->has('city')) <p class="help-block">{{ $errors->first('city') }}</p> @endif
				</div>

				<div class="form-group col-md-6 col-sm-6 col-xs-6 @if($errors->has('address')) has-error @endif">
					<label class="control-label">Dirección </label>
					<input type="text" class="form-control" placeholder="Dirección" name="address" value="{{ old('address') }}">
					@if ($errors->has('address')) <p class="help-block">{{ $errors->first('address') }}</p> @endif
				</div>
			</div>


			<div class="row">
				<div class="form-group col-md-3 col-sm-3 col-xs-12 @if($errors->has('password')) has-error @endif">
					<label class="control-label">Clave </label>
					<input type="password" class="form-control" placeholder="Clave" name="password" value="">
					@if ($errors->has('password')) <p class="help-block">{{ $errors->first('password') }}</p> @endif
				</div>

				<div class="form-group col-md-3 col-sm-3 col-xs-12 @if($errors->has('password_repeat')) has-error @endif">
					<label class="control-label">Repetir Clave </label>
					<input type="password" class="form-control" placeholder="Clave" name="password_repeat" value="">
					@if ($errors->has('password_repeat')) <p class="help-block">{{ $errors->first('password_repeat') }}</p> @endif
				</div>
			</div>

			<div class="form-group  col-md-12 col-sm-12 col-xs-12">
				<a href="{{ route('clients.index') }}" class="btn btn-primary">Cancelar</a>
                <button type="submit" class="btn btn-success">Guardar</button>
            </div>

		</form>
	</div>

</div>
@endsection