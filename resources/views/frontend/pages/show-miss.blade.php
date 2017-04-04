@extends('layouts.frontend')

@section('css')
<link rel="stylesheet" href="{{ asset('/public/css/wallop/wallop.css') }}">
<link rel="stylesheet" href="{{ asset('/public/css/wallop/wallop--fade.css') }}">
<link rel="stylesheet" href="{{ asset('/public/css/show-misses.css') }}">
<link rel="stylesheet" href="{{ asset('/public/css/selectize/selectize.bootstrap3.css') }}">
@endsection()

@section('js')
<script type="text/javascript" src="{{ asset('/public/js/wallop/Wallop.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/public/js/selectize/selectize.js') }}"></script>
<script type="text/javascript" src="{{ asset('/public/js/show-miss-app.js') }}"></script>
@endsection()

@section('content')
{{-- photo gallery --}}
<div class="container-page">
	<h2>{{ $miss->name }} {{ $miss->last_name }}</h2>
	<div class="col-lg-8 col-md-8 col-sm-6 col-xs-6">

		<div class="Wallop Wallop--fade">
		  <div class="Wallop-list">
		  	@foreach ($miss->photos as $photo)
		    	<div class="Wallop-item">
		    		<img class="img-responsive photo-show" src="{{config('app.url') .'/'. $photo->path }}" alt="{{ $miss->name }} {{ $miss->last_name }}" title="{{ $miss->name }} {{ $miss->last_name }}">
		    	</div>
		  	@endforeach

		  	 <div class="Wallop-pagination">
		  	 	@foreach ($miss->photos as $key => $photo) 
      				<button class="Wallop-dot @if($key == 0) Wallop-dot--current @endif">go to item {{ $key + 1 }}</button>
		  	 	@endforeach
      		</div>
		  </div>
		  <button class="Wallop-buttonPrevious">Previous</button>
		  <button class="Wallop-buttonNext">Next</button>
		</div>
	</div>

	{{-- description --}}
	<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
		<p class="description-miss"><b>Nacionalidad</b></p>
		<p>{{ $miss->country->name }}</p>
		<p class="description-miss"><b>Medidas</b></p>
		<p><b>Al: </b> {{ $miss->height }}  / <b>Bu:</b> {{ $miss->bust_measure }} /  <b>Ci:</b> {{ $miss->waist_measure }} / <b>Ca:</b> {{ $miss->hip_measure }}</p>
		<p><b>Hobbies</b></p>
		<p>{{ $miss->hobbies }}</p>
		
		<hr>
		
		@if (Session::has('mensaje'))
    		<div class="alert alert-dismissible @if(Session::get('tipo_mensaje') == 'success') alert-info  @endif @if(Session::get('tipo_mensaje') == 'error') alert-danger  @endif" role="alert">
      			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
      			{{session('mensaje')}}
       		</div>
    		<div class="clearfix"></div>
   		@endif
		
		<div class="vote-section text-center @if(Auth::user()) ready-vote @else no-ready-vote  @endif">
			@if (Auth::user())

				@if (!Auth::user()->is_admin)
					@cannot('vote', Auth::user())
						<p class="text-center">
							<b>Gracias por registrar tu voto, vuelve el día de <span class="text-danger">mañana</span> para volver a votar</b> 
						</p>
					@endcannot
				@else
					@cannot('vote', Auth::user())
						<p class="text-center text-danger">
							<b>Usted no puede realizar esta acción.</b> 
						</p>
					@endcannot
				@endif

				@can('vote',Auth::user())
					<form action="{{ route('website.miss.vote.store') }}" method="POST">
						{{ csrf_field() }}
						<input type="hidden" name="miss_id" value="{{$miss->id}}">
						<input type="hidden" name="client_id" value="{{Auth::user()->id}}">
						<button type="submit" class="btn btn-primary btn-lg" @cannot('vote', Auth::user()) disabled @endcannot>
							<i class="fa fa-heart like-vote" aria-hidden="true"></i> Votar
						</button>
					</form>
				@endcan
			@else 
				Para votar, <a href="#" id="go-login" title="Iniciar Sesión"><span>Inicie Sesión</span></a> o  <a href="#" id="go-register" title="Registrarse"><span>Registrese</span></a>
			@endif
		</div>
		<hr>

		<div class="navigate-section">
			<h5><b>Mire las otras candidatas</b></h5>
			<div class="col-md-10 col-xs-12 no-padding">
				<select class="form-control" name="select_misses" id="select-misses">
					@foreach ($misses as $miss)
						<option value="null">--Seleccione--</option>
						<option value="{{ route('website.miss.show',$miss->slug) }}"> {{ $miss->name }} {{ $miss->last_name }} </option>
					@endforeach
				</select>
			</div>
			<div class="col-md-2">
				<a id="go-miss" href="" class="btn btn-default btn-go">Ir</a>	
			</div>
		</div>
	</div>
	<div class="clearfix"></div>
</div>
<div class="clearfix"></div>

@endsection()