@extends('layouts.frontend')
@section('content')
<div class="jumbotron jumbotron-app hidden-xs">
    <h1>Reinas de belleza</h1>
    <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Autem, quidem, quibusdam. Ducimus eligendi repudiandae natus error eveniet consectetur veniam in et, nobis hic, laudantium non nostrum deserunt atque praesentium temporibus!</p>
</div>
<div class="row gallery-container">
	@foreach ($misses as $miss)
        <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter hdpe thumbnail">
            <a href="{{ route('website.miss.show',$miss->slug) }}">
                <img src="{{config('app.url') .'/'. $miss->photos()->first()->path }}" class="img-responsive image" alt="{{ $miss->name .' '. $miss->last_name}}">
                <div class="middle">
                    <div class="text">{{ $miss->name .' '. $miss->last_name}}</div>
                </div>
            </a>
        </div>
    @endforeach
</div>
@endsection()