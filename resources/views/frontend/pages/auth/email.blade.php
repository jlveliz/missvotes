@extends('layouts.frontend')
@section('content')
<div class="row">
    <div class="col-md-4 col-lg-4 col-xs-12 col-md-offset-4 container-page-auth">
		<div class="row">
			<h1 class="text-center">{{ trans('auth.forgot_password_title') }}</h1><br>
		</div>
		<div class="row">
			@if (session('status'))
			    <div class="alert alert-success">
			        {{ trans('auth.forgot_password_message') }}
			    </div>
			@endif
		</div>
		<form role="form" action="{{ route('client.reset-email') }}" method="POST">
		{{ csrf_field() }}
		<div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
		    <input type="email" class="form-control" name="email" id="email-email" placeholder="{{ trans('auth.forgot_password_fields.email') }}" autofocus>
		    @if ($errors->has('email'))
                <span class="help-block"><strong>{{ $errors->first('email') }}</strong></span>
            @endif
		</div>
		<input type="submit" name="button" id="email" class="email btn btn-primary btn-block loginmodal-submit" value="{{ trans('auth.forgot_password_options.reset_password') }}">
		</form>
    </div>
</div>
@endsection()