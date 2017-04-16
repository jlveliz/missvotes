@extends('layouts.backend')
@section('content')
<div class="panel panel-default">
	<div class="panel-heading">Precandidata</div>
	<p class="subtitle">Edición de Precandidatas  </p>
	<div class="panel-body">
		@if (Session::has('mensaje'))
        <div class="alert alert-dismissible @if(Session::get('tipo_mensaje') == 'success') alert-info  @endif @if(Session::get('tipo_mensaje') == 'error') alert-danger  @endif" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
          {{session('mensaje')}}
        </div>
        <div class="clearfix"></div>
       @endif
            
      @if ($precandidate->state == '0') 
            <div class="alert alert-dismissible alert-danger" role="alert">
                  <p class="text-danger text-center"><b>La candidata esta Descalificada </b></p> 
            </div>
            <div class="clearfix"></div>
      @endif

       <div class="row">
       	<div class="form-group col-md-3 col-sm-3 col-xs-12">
       		<label class="control-label">Nombre </label>
       		<input type="text" class="form-control" placeholder="Su nombre" name="name" value="{{ $precandidate->name }}" disabled>
       	</div>

       	<div class="form-group col-md-3 col-sm-3 col-xs-12">
       		<label class="control-label">Apellido </label>
       		<input type="text" class="form-control" placeholder="Su apellido" name="last_name" value="{{ $precandidate->last_name }}" disabled>
       	</div>

       	<div class="form-group col-md-3 col-sm-3 col-xs-12">
       		<label class="control-label">País </label>
       		<input type="text" class="form-control" value="{{ $precandidate->country->name }}" disabled>
       	</div>
       	<div class="form-group col-md-3 col-sm-3 col-xs-12">
       		<label class="control-label">Fecha de nacimiento </label>
       		<input type="date" class="form-control" placeholder="Fecha de Nacimiento" name="birthdate" value="{{ $precandidate->birthdate }}" disabled>
       	</div>
       </div>
       

       	
       <div class="row">
       	<div class="form-group col-md-3 col-sm-3 col-xs-12">
       		<label class="control-label">Lugar de nacimiento </label>
       		<input type="text" class="form-control" placeholder="Lugar de Nacimiento" name="placebirth" value="{{ $precandidate->placebirth }}" disabled>
       	</div>

       	<div class="form-group col-md-4 col-sm-4 col-xs-12">
       		<label class="control-label">Dirección </label>
       		<input type="text" class="form-control" placeholder="Lugar de Nacimiento" name="address" value="{{ $precandidate->address }}" disabled>
       	</div>

       	<div class="form-group col-md-3 col-sm-3 col-xs-4">
       		<label class="control-label" for="email">Email </label>
       		<input class="form-control" type="email" name="email" id="email"  placeholder="email" value="{{ $precandidate->email }}" disabled>
       	</div>
       	<div class="form-group col-md-2 col-sm-2 col-xs-12">
       		<label class="control-label">Número teléfonico </label>
       		<input type="text" class="form-control" placeholder="59304999999" name="phone_number" value="{{ $precandidate->phone_number }}" disabled>
       	</div>
       </div>
       
       <div class="row">
       	<div class="form-group col-md-2 col-sm-2 col-xs-12">
       		<label class="control-label">Ciudad </label>
       		<input type="text" class="form-control" placeholder="New York" name="city" value="{{ $precandidate->city }}" disabled>
       	</div>

       	<div class="form-group col-md-3 col-sm-3 col-xs-12">
       		<label class="control-label">Estado / Provincia </label>
       		<input type="text" class="form-control" placeholder="New York" name="state_province" value="{{ $precandidate->state_province }}" disabled>
       	</div>
       	<div class="form-group col-md-7 col-sm-7 col-xs-12">
       		<label class="control-label col-md-12 col-sm-12 col-xs-12 no-padding">Medidas </label>
       		<div class="form-group col-md-3 col-sm-2 col-xs-4 no-padding-left">
       			<input type="text"  name="height" id="height" class="form-control" value="Altura: {{$precandidate->height}} cms" disabled>
       		</div>
       		<div class="form-group col-md-3 col-sm-2 col-xs-4 no-padding-left">
       			<input type="text" placeholder="Peso (lb)" name="weight" id="weight" class="form-control" value="Peso: {{$precandidate->weight}} lbs" disabled>
       		</div>
       		<div class="form-group col-md-2 col-sm-2 col-xs-4 no-padding-left">
       			<input type="text" placeholder="Busto" name="bust_measure" id="bust_measure" class="form-control" value="bus: {{$precandidate->bust_measure}}" disabled>
       		</div>
       		<div class="form-group col-md-2 col-sm-2 col-xs-4 no-padding-left">
       			<input type="text" placeholder="Cintura" name="waist_measure" id="waist_measure" class="form-control" value="Cin: {{$precandidate->waist_measure}}" disabled>
       		</div>

       		<div class="form-group col-md-2 col-sm-2 col-xs-4 no-padding-left">
       			<input type="text" placeholder="Cadera" name="hip_measure" id="hip_measure" class="form-control" value="Ca: {{$precandidate->hip_measure}}" disabled>
       		</div>
       	</div>	
       </div>
       
       <div class="row">
       	<div class="form-group col-md-2 col-sm-2 col-xs-4">
       		<label class="control-label" for="hair-color">Color de cabello </label>
       		<input class="form-control" type="text" name="hair_color" id="hair-color"  placeholder="Negro" value="{{ $precandidate->hair_color }}" disabled>
       	</div>
       	<div class="form-group col-md-2 col-sm-2 col-xs-4">
       		<label class="control-label" for="eye-color">Color de ojos </label>
       		<input class="form-control" type="text" name="eye_color" id="eye-color"  placeholder="Azules" value="{{ $precandidate->eye_color }}" disabled>
       	</div>
       </div>

       <div class="row">
       	<div class="col-md-6 col-sm-6 col-xs-12">
       		<label class="control-label" for="dairy_philosophy">Filosofia Diaria </label>
       		<textarea class="form-control" name="dairy_philosophy" id="dairy_philosophy" disabled>
       			{!! trim($precandidate->dairy_philosophy) !!}
       		</textarea>	
       	</div>
       	<div class="col-md-6 col-sm-6 col-xs-12">
       		<label class="control-label" for="best-film-book-in-life">Porque te gustaría ganar el Miss Panamerican US? </label>
       		<textarea class="form-control" name="why_would_you_win" id="why-would-you-win" disabled>
       			{!! trim($precandidate->why_would_you_win) !!}
       		</textarea>	
       	</div>
       </div>
       
	</div>

	<div class="panel-footer">
		<dir class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<form action="{{ route('precandidates.update',$precandidate->id) }}"  method="POST" style="display: inline">
					{{ csrf_field() }}
					<input type="hidden" name="_method" value="PUT">
                              <a href="{{ route('precandidates.index') }}" class="btn btn-primary">Cancelar</a>
                              @if ($precandidate->state == '0')
                                    <input type="hidden" name="state" value="1">
                                    <button type="submit" class="btn btn-warning" id="save">Habilitar Precandidata</button>
                              @else
                                    <input type="hidden" name="state" value="0">
                                    <button type="submit" class="btn btn-warning" id="save">Descalificar</button>
                              @endif
				</form>
                        @if ($precandidate->state == '1')
      				<form action="{{ route('precandidates.update',$precandidate->id) }}" method="POST"  style="display: inline">
      					{{ csrf_field() }}
      					<input type="hidden" name="_method" value="PUT">
                                    <input type="hidden" name="is_precandidate" value="0">
      		        	       <button type="submit" class="btn btn-success" id="save">Calificar como Candidata</button>
      				</form>
                        @endif
		    </div>
		</dir>
	</div>
</div>
@endsection