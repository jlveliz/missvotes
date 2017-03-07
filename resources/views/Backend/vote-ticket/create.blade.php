@extends('layouts.backend')
@section('content')
<div class="panel panel-default">
	<div class="panel-heading">Tickets</div>
	<p class="subtitle">Creación de Tickets</p>
	<div class="panel-body">
		@if (Session::has('mensaje'))
        <div class="alert alert-dismissible @if(Session::get('tipo_mensaje') == 'success') alert-info  @endif @if(Session::get('tipo_mensaje') == 'error') alert-danger  @endif" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
          {{session('mensaje')}}
           </div>
        <div class="clearfix"></div>
       @endif
		<form action="{{ route('vote-tickets.store') }}" method="post">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<div class="row">
				<div class="form-group col-md-3 col-sm-3 col-xs-4 @if($errors->has('name')) has-error @endif">
					<label class="control-label">Nombre </label>
					<input type="text" class="form-control" placeholder="Nombre" name="name" value="{{ old('name') }}" autofocus>
					@if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
				</div>

				<div class="form-group col-md-2 col-sm-2 col-xs-3 @if($errors->has('val_vote')) has-error @endif">
					<label class="control-label col-md-12 col-sm-12">Valor de Puntos </label>
					<div class="form-group col-md-10 col-sm-10 col-xs-12">
						<input type="number" step="1" min="1" class="form-control" placeholder="Valor" name="val_vote" value="{{ old('val_vote') }}">
						@if ($errors->has('val_vote')) <p class="help-block">{{ $errors->first('val_vote') }}</p> @endif
					</div>
				</div>

				<div class="form-group col-md-3 col-sm-3 col-xs-3 @if($errors->has('price')) has-error @endif">
					<label class="control-label col-md-12 col-sm-12">Precio </label>
					<div class="form-group col-md-7 col-sm-7 col-xs-12">
						<input type="number" step="any" min="0.00" class="form-control" placeholder="Precio" name="price" value="{{ old('price') }}">
						@if ($errors->has('price')) <p class="help-block">{{ $errors->first('price') }}</p> @endif
					</div>
				</div>
			</div>

			<div class="form-group  col-md-12 col-sm-12 col-xs-12">
				<a href="{{ route('vote-tickets.index') }}" class="btn btn-primary">Cancelar</a>
                <button type="submit" class="btn btn-success">Guardar</button>
            </div>

		</form>
	</div>

</div>
@endsection