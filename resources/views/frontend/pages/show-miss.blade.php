@extends('layouts.frontend')

@section('css')
<link rel="stylesheet" href="{{ asset('/public/css/wallop/wallop.css') }}">
<link rel="stylesheet" href="{{ asset('/public/css/wallop/wallop--fade.css') }}">
<link rel="stylesheet" href="{{ asset('/public/css/show-misses.css') }}">
@endsection()

@section('js')
<script type="text/javascript" src="{{ asset('/public/js/wallop/Wallop.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/public/js/show-miss-app.js') }}"></script>
@endsection()

@section('content')
{{-- photo gallery --}}
<div class="miss-content">
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
		<div class="vote-section text-center">
			<form action="#">
				<button type="submit" class="btn btn-info btn-lg">Votar</button>
			</form>
		</div>
		<hr>
	</div>
</div>

<div class="clearfix"></div>
@endsection()