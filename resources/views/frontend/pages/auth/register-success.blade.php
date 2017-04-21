@extends('layouts.frontend')
@section('content')
	 <div class="row">
    <div class="col-md-4 col-lg-4 col-xs-12 col-md-offset-4 container-page-auth">
			  <h2 class="text-center">{{ trans('auth.register_success') }}</h2><br>
			  <p class="text-muted text-center">{{ trans('auth.register_success_message') }}</p>
			  <a type="submit" class="btn btn-primary btn-block" href="{{ route('website.home') }}" value="Aceptar" data-dismiss="modal">{{ trans('auth.register_success_submit') }}</a>
			
    </div>
    </div>
@endsection()