@extends('layouts.frontend')
@section('content')
<div class="row text-center">
    {{ $misses->links() }}
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
<div class="row text-center">
    {{ $misses->links() }}
</div>
@endsection()