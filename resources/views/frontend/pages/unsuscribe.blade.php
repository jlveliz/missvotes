@extends('layouts.frontend')
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('public/css/profile.css') }}">
@endsection
@section('content')
<div class="container-page">
	<h2>{{ Auth::user()->name }} {{ Auth::user()->last_name }}</h2>
	<div class="container-tabs-profile unsubscribe-form">
		<div class="row">
			<p>{!! trans('account_profile.paragraph_delete',['appname'=>config('app.name')]) !!}</p>
			{!! trans('account_profile.characteristics_lost_delete',['appname'=>config('app.name')]) !!}
		</div>
		<div class="row">
			<form action="{{ route('website.account.postdelete') }}" method="POST">
				{{ csrf_field() }}
				<div class="form-group col-md-12 col-sm-12 col-xs-12 @if($errors->has('password')) has-error @endif">
					<label class="control-label">@lang('account_profile.insert_password') </label>
					<input type="password" class="form-control" name="password" value="{{ old('password') }}">
					@if ($errors->has('password')) <p class="help-block">{{ $errors->first('password') }}</p> @endif
				</div><hr>
				<div class="form-group col-md-12 col-sm-12 col-xs-12">
					<button type="submit" name="submit" class="btn btn-danger btn-block">@lang('account_profile.btn_unsuscribe')</button>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection