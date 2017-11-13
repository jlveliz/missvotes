@extends('layouts.backend')

@section('css')
<style type="text/css" rel="stylesheet">

#profile-section > .middle {
    transition: .5s ease;
    opacity: 0;
    position: absolute;
    top: 55%;
    left: 50%;
    transform: translate(-50%, -50%);
    text-align: center;
}

#profile-section > .middle > .text {
    background: #cdcdcd;
    color: #ffffff;
}

#profile-section:hover > .middle {
    opacity: 1;
}

.profile-img {
    padding: 5px;
    background-position: top center;
    background-repeat: no-repeat;
    background-size: cover;
    width: 250px;
    height: 250px;
}

.upgrade-membership {
    color: #ddcc33;
}

</style>
@endsection

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
		<form action="{{ route('countries.store') }}" method="post">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<div class="row">
				<div class="col-md-8 col-lg-8 col-sm-8 col-xs-12">
					<div class="form-group col-md-6 col-sm-6 col-xs-12 @if($errors->has('name')) has-error @endif">
						<label class="control-label">{{ trans('backend.country.create-edit.label_name') }} </label>
						<input type="text" class="form-control"  name="name" value="{{ old('name') }}" autofocus>
						@if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
					</div>

					<div class="form-group col-md-3 col-sm-3 col-xs-6 @if($errors->has('code')) has-error @endif">
						<label class="control-label">{{ trans('backend.country.create-edit.label_code') }} </label>
						<input type="text" class="form-control"  name="code" value="{{ old('code') }}">
						@if ($errors->has('code')) <p class="help-block">{{ $errors->first('code') }}</p> @endif
					</div>

					<div class="form-group col-md-3 col-sm-3 col-xs-6 @if($errors->has('lang')) has-error @endif">
						<label class="control-label">{{ trans('backend.country.create-edit.label_lang') }} </label>
						<input type="text" class="form-control"  name="lang" value="{{ old('lang') }}">
						@if ($errors->has('lang')) <p class="help-block">{{ $errors->first('lang') }}</p> @endif
					</div>
				</div>
				
				<div class="col-md-4 col-lg-4 col-sm-4 col-xs-12" id="profile-section">
					<div class="profile-img center-block" style="background-image: url({{ asset('public/images/default_flag.svg') }})" title="">
		    		</div>
		    		<div class="middle">
		    			<div class="text">@lang('backend.country.create-edit.btn_change_flag')</div>
		    		</div>
		    		<form id="form-update-photo" action="{{ route('website.account.update') }}" enctype="multipart/form-data" method="POST">
		    			{{ csrf_field() }}
		    			<input type="file" id="file-profile-upload" name="photo" type="file" accept="image/*"/ style="display: none">
		    		</form>
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

@section('js')
<script type="text/javascript">
	$(document).ready(function(){
		 /******** PROFILE ********/
	    var readURL = function(input) {
	        if (input.files && input.files[0]) {
	            var reader = new FileReader();
	            reader.onload = function(e) {
	                $('.profile-img').css('background-image', 'url('+e.target.result+')');
	            }

	            reader.readAsDataURL(input.files[0]);
	        }
	    }
	    $("#profile-section").on('click', function(event) {
	        event.preventDefault();
	       $("#file-profile-upload").click();
	    });

	    $("#file-profile-upload").on('change', function(event) {
	        readURL(this);
	        $("#form-update-photo").submit();

	    });
	    /******** PROFILE ********/
	})
</script>
@endsection