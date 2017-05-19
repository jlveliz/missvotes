@extends('layouts.backend')
@section('content')
<div class="panel panel-default">
	<div class="panel-heading">{{ trans('backend.user.create-edit.panel_title') }}</div>
	<p class="subtitle">{{ trans('backend.user.create-edit.panel_subtitle_edit') }}</p>
	<div class="panel-body">
		@if (Session::has('mensaje'))
        <div class="alert alert-dismissible @if(Session::get('tipo_mensaje') == 'success') alert-info  @endif @if(Session::get('tipo_mensaje') == 'error') alert-danger  @endif" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
          {{session('mensaje')}}
           </div>
        <div class="clearfix"></div>
       @endif
		<form action="{{ route('users.update',$user->id) }}" method="post">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<input type="hidden" name="_method" value="PUT">
			<input type="hidden" name="key" value="{{$user->id}}">
			<input type="hidden" name="is_admin" value="1">
			<div class="row">
				<div class="form-group col-md-3 col-sm-3 col-xs-12 @if($errors->has('email')) has-error @endif">
					<label class="control-label">{{ trans('backend.user.create-edit.label_email') }} </label>
					<input type="email" class="form-control" name="email" value="{{ $user->email }}">
					@if ($errors->has('email')) <p class="help-block">{{ $errors->first('email') }}</p> @endif
				</div>

				<div class="form-group col-md-3 col-sm-3 col-xs-12 @if($errors->has('name')) has-error @endif">
					<label class="control-label">{{ trans('backend.user.create-edit.label_name') }} </label>
					<input type="text" class="form-control" name="name" value="{{ $user->name }}">
					@if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
				</div>

				<div class="form-group col-md-3 col-sm-3 col-xs-12 @if($errors->has('last_name')) has-error @endif">
					<label class="control-label">{{ trans('backend.user.create-edit.label_lastname') }} </label>
					<input type="text" class="form-control" name="last_name" value="{{ $user->last_name }}">
					@if ($errors->has('last_name')) <p class="help-block">{{ $errors->first('last_name') }}</p> @endif
				</div>

				<div class="form-group col-md-3 col-sm-3 col-xs-12 @if($errors->has('address')) has-error @endif">
					<label class="control-label">{{ trans('backend.user.create-edit.label_address') }} </label>
					<input type="text" class="form-control" name="address" value="{{ $user->address }}">
					@if ($errors->has('address')) <p class="help-block">{{ $errors->first('address') }}</p> @endif
				</div>
			</div>


			<div class="row">
				<div class="form-group col-md-3 col-sm-3 col-xs-12 @if($errors->has('password')) has-error @endif">
					<label class="control-label">{{ trans('backend.user.create-edit.label_password') }} </label>
					<input type="password" class="form-control" name="password" value="">
					@if ($errors->has('password')) <p class="help-block">{{ $errors->first('password') }}</p> @endif
				</div>

				<div class="form-group col-md-3 col-sm-3 col-xs-12 @if($errors->has('password_repeat')) has-error @endif">
					<label class="control-label">{{ trans('backend.user.create-edit.label_repeat_password') }} </label>
					<input type="password" class="form-control" name="password_repeat" value="">
					@if ($errors->has('password_repeat')) <p class="help-block">{{ $errors->first('password_repeat') }}</p> @endif
				</div>
			</div>

			<div class="form-group  col-md-12 col-sm-12 col-xs-12">
				<a href="{{ route('users.index') }}" class="btn btn-primary">{{ trans('backend.user.create-edit.btn_cancel') }}</a>
                <button type="submit" class="btn btn-success">{{ trans('backend.user.create-edit.btn_save') }}</button>
            </div>

		</form>
	</div>

</div>
@endsection