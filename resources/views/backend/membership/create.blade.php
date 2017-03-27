@extends('layouts.backend')
@section('content')
<div class="panel panel-default">
	<div class="panel-heading">Membresias</div>
	<p class="subtitle">Creación de Membresias</p>
	<div class="panel-body">
		@if (Session::has('mensaje'))
        <div class="alert alert-dismissible @if(Session::get('tipo_mensaje') == 'success') alert-info  @endif @if(Session::get('tipo_mensaje') == 'error') alert-danger  @endif" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
          {{ session('mensaje') }}
           </div>
        <div class="clearfix"></div>
       @endif
		<form action="{{ route('memberships.store') }}" method="post">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<div class="row">
				<div class="form-group col-md-2 col-sm-2 col-xs-8 @if($errors->has('name')) has-error @endif">
					<label class="control-label">Nombre </label>
					<input type="text" class="form-control" placeholder="Nombre" name="name" value="{{ old('name') }}">
					@if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
				</div>

				<div class="form-group col-md-6 col-sm-6 col-xs-12 @if($errors->has('description')) has-error @endif">
					<label class="control-label">Descripción </label>
					<input type="text" class="form-control" placeholder="Descripción" name="description" value="{{ old('description') }}">
					@if ($errors->has('description')) <p class="help-block">{{ $errors->first('description') }}</p> @endif
				</div>
				<div class="form-group col-md-4 col-sm-4 col-xs-12">
					<label class="control-label col-md-12 col-sm-12 col-xs-12 no-padding">Duración </label>
					<div class="form-group col-md-4 col-sm-4 col-xs-6 no-padding-left @if($errors->has('duration_time')) has-error @endif">
							<input type="number" step="1" min="1" placeholder="Tiempo" name="duration_time" id="duration_time" class="form-control" value="{{ old('duration_time') }}">
							@if ($errors->has('duration_time')) <p class="help-block">{{ $errors->first('duration_time') }}</p> @endif
						</div>
						<div class="form-group col-md-8 col-sm-8 col-xs-6 no-padding-left @if($errors->has('duration_mode')) has-error @endif">
							<select name="duration_mode" id="duration_mode" class="form-control">
								<option value="null">--Seleccione--</option>
								@foreach($durationsMode as $index => $element)
								<option value="{{ $index }}" @if(old('duration_mode') == $index) selected @endif>{{ $element }}</option>	
								@endforeach
							</select>
							@if ($errors->has('duration_mode')) <p class="help-block">{{ $errors->first('duration_mode') }}</p> @endif
						</div>
				</div>
			</div>
			
			<div class="row">
				<div class="form-group col-md-2 col-sm-2 col-xs-4 @if($errors->has('price')) has-error @endif">
					<label class="control-label">Precio </label>
					<input type="number" step="0.01" min="0.00" class="form-control" placeholder="Precio" name="price" value="{{ old('price') }}">
					@if ($errors->has('price')) <p class="help-block">{{ $errors->first('price') }}</p> @endif
				</div>

				<div class="form-group col-md-2 col-sm-2 col-xs-4 @if($errors->has('points_per_vote')) has-error @endif">
					<label class="control-label">Puntos por voto </label>
					<input type="text" class="form-control" placeholder="Puntos por voto" name="points_per_vote" value="{{ old('points_per_vote') }}">
					@if ($errors->has('points_per_vote')) <p class="help-block">{{ $errors->first('points_per_vote') }}</p> @endif
				</div>

			</div>
			
			<div class="row">
				<div class="form-group  col-md-12 col-sm-12 col-xs-12">
					<a href="{{ route('memberships.index') }}" class="btn btn-primary">Cancelar</a>
	                <button type="submit" class="btn btn-success">Guardar</button>
	            </div>
			</div>

		</form>
	</div>

</div>
@endsection