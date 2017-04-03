@extends('layouts.frontend')
@section('content')
<div class="jumbotron jumbotron-app hidden-xs">
    <h1>Reinas de belleza</h1>
    <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Autem, quidem, quibusdam. Ducimus eligendi repudiandae natus error eveniet consectetur veniam in et, nobis hic, laudantium non nostrum deserunt atque praesentium temporibus!</p>
</div>
<div class="row gallery-container">
	@foreach ($misses as $miss)
        <a href="{{ route('website.miss.show',$miss->slug) }}">
            <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter hdpe thumbnail " style="background-image: url('{{config('app.url') .'/'. $miss->photos()->first()->path }}'); ">
                    <div class="middle">
                        <div class="text">{{ $miss->name .' '. $miss->last_name}}</div>
                    </div>
            </div>
        </a>
    @endforeach
</div>
@endsection()