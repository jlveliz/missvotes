@extends('layouts.backend')
@section('content')
<div class="panel panel-default">
	<div class="panel-heading">Candidatas</div>
	<p class="subtitle">Creación de Candidatas</p>
	<div class="panel-body">
		@if (Session::has('mensaje'))
        <div class="alert alert-dismissible @if(Session::get('tipo_mensaje') == 'success') alert-info  @endif @if(Session::get('tipo_mensaje') == 'error') alert-danger  @endif" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
          {{session('mensaje')}}
           </div>
        <div class="clearfix"></div>
       @endif
		<form action="{{ route('misses.store') }}" method="post">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<div class="row">
				<div class="form-group col-md-4 col-sm-4 col-xs-12 @if($errors->has('name')) has-error @endif">
					<label class="control-label">Nombre </label>
					<input type="text" class="form-control" placeholder="Nombre" name="name" value="{{ old('name') }}" autofocus>
					@if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
				</div>

				<div class="form-group col-md-4 col-sm-4 col-xs-12 @if($errors->has('last_name')) has-error @endif">
					<label class="control-label">Apellido </label>
					<input type="text" class="form-control" placeholder="Apellido" name="last_name" value="{{ old('last_name') }}">
					@if ($errors->has('last_name')) <p class="help-block">{{ $errors->first('last_name') }}</p> @endif
				</div>

				<div class="form-group col-md-4 col-sm-4 col-xs-12 @if($errors->has('city_id')) has-error @endif">
					<label class="control-label">Ciudad </label>
					<select class="form-control" name="city_id" id="city">
						<option value="null">--Seleccione--</option>
						@foreach ($cities as $element)
							<option value="{{$element->id}}" @if(old('city_id') == $element->id) selected  @endif>{{$element->name}}</option>
						@endforeach
					</select>
					@if ($errors->has('city_id')) <p class="help-block">{{ $errors->first('city_id') }}</p> @endif
				</div>
			</div>


			<div class="row">
				<div class="form-group col-md-5 col-sm-5 col-xs-12">
					<label class="control-label col-md-12 col-sm-12 col-xs-12 no-padding">Medidas </label>
					<div class="form-group col-md-3 col-sm-3 col-xs-4 no-padding-left @if($errors->has('bust_measure')) has-error @endif">
						<input type="number" placeholder="Busto" name="bust_measure" id="bust_measure" class="form-control" value="{{old('bust_measure')}}">
						@if ($errors->has('bust_measure')) <p class="help-block">{{ $errors->first('bust_measure') }}</p> @endif
					</div>
					<div class="form-group col-md-3 col-sm-3 col-xs-4 no-padding-left @if($errors->has('waist_measure')) has-error @endif">
						<input type="number" placeholder="Cintura" name="waist_measure" id="waist_measure" class="form-control" value="{{old('waist_measure')}}">
						@if ($errors->has('waist_measure')) <p class="help-block">{{ $errors->first('waist_measure') }}</p> @endif
					</div>

					<div class="form-group col-md-3 col-sm-3 col-xs-4 no-padding-left @if($errors->has('hip_measure')) has-error @endif">
						<input type="number" placeholder="Cadera" name="hip_measure" id="hip_measure" class="form-control" value="{{old('hip_measure')}}">
						@if ($errors->has('hip_measure')) <p class="help-block">{{ $errors->first('hip_measure') }}</p> @endif
					</div>
				</div>

				<div class="form-group col-md-7 col-sm-7 col-xs-12"  @if($errors->has('city_id')) has-error @endif>
					<label class="control-label" for="hobbies">Hobbies </label>
					<textarea name="hobbies" id="hobbies" class="form-control">{{old('hobbies')}}</textarea>
				</div>
			</div>

			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					Dropzone
				</div>
			</div>

			<div class="form-group  col-md-12 col-sm-12 col-xs-12">
				<a href="{{ route('misses.index') }}" class="btn btn-primary">Cancelar</a>
                <button type="submit" class="btn btn-success">Guardar</button>
            </div>

		</form>
	</div>

</div>
@endsection