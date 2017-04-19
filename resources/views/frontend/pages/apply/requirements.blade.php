@extends('layouts.frontend')
@section('content')
	<div class="row">
		<h1 class="text-center">Requisitos de Aplicación</h1>
		<div class="col-md-6 col-lg-6 col-xs-12 col-md-offset-3">
			@if (Session::has('message'))
        		<div class="alert alert-dismissible @if(Session::get('type') == 'success') alert-info  @endif @if(Session::get('type') == 'error') alert-danger  @endif" role="alert">
          			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
          			{{session('message')}}
           		</div>
        		<div class="clearfix"></div>
        	@endif
			<ol>
				<li>Ser originaria del país que representa.
				<li>Ser mujer de nacimiento.</li>
				<li>Conocer la historia, situación económica y política de su país.</li>
				<li>Tener edad entre 18 a 28 años: La candidata debe tener 18 años o tenerlo antes del evento. La candidata debe tener 28 años de edad al iniciar el evento y cumplir 29 años antes de octubre del año siguiente.</li>
				<li>Tener estudio mínimo: Preparatoria (High School) o equivalente</li>
				<li>Tener estatura mínima sin zapatos:  5.5 ft / 1.67 cm (no menos que la estatura aquí establecida)</li>
				<li>Tener hermosa armonía estética de rostro y cuerpo. </li>
				<li>Gozar de perfecta salud física y mental. </li>
				<li>Tener el peso proporcionado de acuerdo a su estatura. </li>
				<li>Nunca haber sido casada. </li>
				<li>Nunca haber tenido hijos. </li>
				<li>Tener facilidad de expresión corporal y oral. </li>
				<li>Contar con pasaporte vigente del país de origen o certificado de nacimiento</li>
				<li>Tener buenos modales y que no haber cometido felonías. </li>
				<li>Desarrollar una idea turística sobre su país de origen.</li>
				<li>Estar de acuerdo con las reglas y disciplina del certamen Miss Panamerican International.</li>
			</ol>
			<form action="{{ route('apply.aceptrequirements') }}" method="POST">
				{{ csrf_field() }}
				<div class="checkbox">
				    <label>
				      <input type="checkbox" name="acept-terms" value="1"> La candidata acepta poseer las características y requisitos mencionados arriba para representar a su país. 
				    </label>
				</div>
				<div class="text-center">
					<button type="submit" class="btn btn-primary">Aceptar </button>
				</div>
			</form>
			<br><br>
		</div>
	</div>
@endsection