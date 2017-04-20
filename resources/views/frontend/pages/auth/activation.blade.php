@extends('layouts.frontend')
@section('content')
<div class="row">
	<div class="col-md-4 col-lg-4 col-xs-12 col-md-offset-4 container-page-auth">
		<div class="row">
			<h1 class="text-center">{{ trans('auth.activation_page_title') }}</h1>
		</div>
		<div class="row">
			@if (session('status'))
			    <div class="alert alert-success">
			    	{{ trans('auth.activation_page_message') }}
			    </div>
			@endif
		</div>
		<p class="text-justify">{{ trans('auth.activation_page_description') }}</p>
		<form role="form" action="{{ route('client.re-send-activate') }}" method="POST">
			{{ csrf_field() }}
		  <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
		     <input type="email" class="form-control" name="email" id="activation-email" placeholder="{{ trans('auth.activation_page_fields.email') }}" autofocus value="{{old('email')}}" required>
		     @if ($errors->has('email'))
                <span class="help-block"><strong>{{ $errors->first('email') }}</strong></span>
            @endif
		  </div>
		  <input type="submit" name="activation" id="activation" class="activation btn btn-primary btn-block activationmodal-submit" value="{{ trans('auth.activation_page_options.submit') }}">
		</form>
	</div>
</div>
@endsection