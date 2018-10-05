@extends('layouts.frontend')
@section('js')

<script type="text/javascript" src="{{ asset('/public/js/show-miss-app.js') }}"></script>

@if(!Auth::user())
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $("#go-login-modal").modal({
                backdrop : 'static',
                keyboard : false
            });
        });
    </script>
@endif

@endsection()

@section('content')
<div class="row text-center">
    {{ $misses->links() }}
</div>
<div class="row gallery-container">
	@foreach ($misses as $miss)
        <div class="miss-item">
            <div class="gallery_product col-lg-3 col-md-3 col-sm-3 col-xs-6 filter hdpe thumbnail" style="background-image: url('{{config('app.url') .'/'. $miss->photos()->first()->path }}'); ">
                
            </div>
            <div class="middle">
                <div class="text">
                    @include('frontend.partials.vote',['miss'=>$miss])
                </div>
            </div>
        </div>
    @endforeach
@if(!Auth::user())
    @include('frontend.modals.go-login');
@endif
</div>
<div class="row text-center">
    {{ $misses->links() }}
</div>
@endsection()
