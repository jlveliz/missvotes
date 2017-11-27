@extends('layouts.backend')

@section('content')
<div class="panel panel-default">
	<div class="panel-heading">{{ trans('backend.country.create-edit.panel_title') }}</div>
	<p class="subtitle">{{ trans('backend.country.create-edit.panel_caption_edit') }}</p>
	<div class="panel-body">
		@if (Session::has('mensaje'))
        <div class="alert alert-dismissible @if(Session::get('tipo_mensaje') == 'success') alert-info  @endif @if(Session::get('tipo_mensaje') == 'error') alert-danger  @endif" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
          {{ session('mensaje') }}
           </div>
        <div class="clearfix"></div>
       @endif
		<form action="{{ route('countries.update',$country->id) }}" method="post" enctype="multipart/form-data">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<input type="hidden" name="_method" value="PUT">
			<input type="hidden" name="key" value="{{$country->id}}">
			<div class="row">
				<div class="col-md-8 col-lg-8 col-sm-8 col-xs-12">
					<div class="form-group col-md-4 col-sm-4 col-xs-12 @if($errors->has('name')) has-error @endif">
						<label class="control-label">{{ trans('backend.country.create-edit.label_name') }} </label>
						<input type="text" class="form-control"  name="name" value="{{ $country->name }}" autofocus>
						@if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
					</div>

					<div class="form-group col-md-3 col-sm-3 col-xs-6 @if($errors->has('code')) has-error @endif">
						<label class="control-label">{{ trans('backend.country.create-edit.label_code') }} </label>
						<input type="text" class="form-control"  name="code" value="{{ $country->code }}">
						@if ($errors->has('code')) <p class="help-block">{{ $errors->first('code') }}</p> @endif
					</div>
					<div class="form-group col-md-5 col-sm-5 col-xs-6 @if($errors->has('email_contact')) has-error @endif">
						<label class="control-label">{{ trans('backend.country.create-edit.label_email') }} </label>
						<input type="text" class="form-control"  name="email_contact" value="{{ $country->email_contact }}">
						@if ($errors->has('email_contact')) <p class="help-block">{{ $errors->first('email_contact') }}</p> @endif
					</div>
				</div>
				
				<div class="col-md-4 col-lg-4 col-sm-4 col-xs-12">
					<a href="#"  id="flag-section">
						<div class="flag-img center-block" style="background-image: url({{ asset('public/images/'.$country->flag_img) }})" title="">
			    		</div>
			    		<div class="middle">
			    			<div class="text">@lang('backend.country.create-edit.btn_change_flag')</div>
			    		</div>
					</a>
	    			<input type="file" id="file-flag-upload" name="flag_img" type="file" accept="image/*"/ style="display: none"/>
				</div>
			</div>
			
			<div class="row">
				<div class="form-group  col-md-12 col-sm-12 col-xs-12">
					<a href="{{ route('countries.index') }}" class="btn btn-primary">{{ trans('backend.country.create-edit.btn_cancel') }}</a>
	                <button type="submit" class="btn btn-success">{{ trans('backend.country.create-edit.btn_save') }}</button>
	            </div>
			</div>

		</form>
	</div>

</div>
@endsection