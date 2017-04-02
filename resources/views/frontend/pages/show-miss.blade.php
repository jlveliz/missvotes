@extends('layouts.frontend')

@section('css')
<link rel="stylesheet" href="{{ asset('/public/css/wallop/wallop.css') }}">
<link rel="stylesheet" href="{{ asset('/public/css/wallop/wallop--fade.css') }}">
<style rel="stylesheet">
	
	/* Demo styles for pagination */
	.Wallop-pagination {
	  text-align: center;
	}

	.Wallop-dot {
	  text-indent: -9999px;
	  border: 0;
	  border-radius: 50%;
	  width: 12px;
	  height: 12px;
	  padding: 0;
	  margin: 5px;
	  background-color: #ccc;
	  -webkit-appearance: none;  
	}

	.Wallop-dot--current {
	  background-color: #000;
	}
</style>
@endsection()

@section('js')
<script type="text/javascript" src="{{ asset('/public/js/wallop/Wallop.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/public/js/show-miss-app.js') }}"></script>
@endsection()

@section('content')
{{-- photo gallery --}}
<div class="miss-content">
	<div class="col-lg-8 col-md-8 col-sm-6 col-xs-6">
		<h2>{{ $miss->name }} {{ $miss->last_name }}</h2>

		<div class="Wallop Wallop--fade">
		  <div class="Wallop-list">
		  	@foreach ($miss->photos as $photo)
		    	<div class="Wallop-item">
		    		<img class="img-responsive" src="{{config('app.url') .'/'. $photo->path }}" alt="{{ $miss->name }} {{ $miss->last_name }}" title="{{ $miss->name }} {{ $miss->last_name }}">
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
	<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6"></div>
</div>

<div class="clearfix"></div>
@endsection()