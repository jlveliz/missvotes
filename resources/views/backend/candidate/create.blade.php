@extends('layouts.backend')
@section('content')
<div class="panel panel-default">
	<div class="panel-heading">{{ trans('backend.candidates.create-edit.panel_title') }}</div>
	<p class="subtitle">{{ trans('backend.candidates.create-edit.panel_subtitle') }}</p>
	<div class="panel-body">
		@if (Session::has('mensaje'))
        <div class="alert alert-dismissible @if(Session::get('tipo_mensaje') == 'success') alert-info  @endif @if(Session::get('tipo_mensaje') == 'error') alert-danger  @endif" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
          {{session('mensaje')}}
           </div>
        <div class="clearfix"></div>
       @endif
		<form action="{{ route('candidates.store') }}" method="post" enctype="multipart/form-data" class="dropzone">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<input type="hidden" name="is_precandidate" value="0">
			@foreach ($errors->all() as $error)
				{{ $error }}
			@endforeach
			<div class="row">
				<div class="form-group col-md-3 col-sm-3 col-xs-12 @if($errors->has('name')) has-error @endif">
					<label class="control-label">{{ trans('backend.candidates.create-edit.label_name') }} </label>
					<input type="text" class="form-control" name="name" value="{{ old('name') }}" autofocus>
					@if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
				</div>

				<div class="form-group col-md-3 col-sm-3 col-xs-12 @if($errors->has('last_name')) has-error @endif">
					<label class="control-label">{{ trans('backend.candidates.create-edit.label_lastname') }} </label>
					<input type="text" class="form-control" name="last_name" value="{{ old('last_name') }}">
					@if ($errors->has('last_name')) <p class="help-block">{{ $errors->first('last_name') }}</p> @endif
				</div>

				<div class="form-group col-md-3 col-sm-3 col-xs-12 @if($errors->has('country_id')) has-error @endif">
					<label class="control-label">{{ trans('backend.candidates.create-edit.label_country') }} </label>
					<select class="form-control" name="country_id" id="country">
						<option value="null">{{ trans('backend.candidates.create-edit.select_default') }}</option>
						@foreach ($countries as $element)
							<option value="{{$element->id}}" @if(old('country_id') == $element->id) selected  @endif>{{$element->name}}</option>
						@endforeach
					</select>
					@if ($errors->has('country_id')) <p class="help-block">{{ $errors->first('country_id') }}</p> @endif
				</div>

				<div class="form-group col-md-3 col-sm-3 col-xs-12 @if($errors->has('state')) has-error @endif">
					<label class="control-label">{{ trans('backend.candidates.create-edit.label_state') }} </label>
					<select name="state" id="state" class="form-control">
						<option value="null">{{ trans('backend.candidates.create-edit.select_default') }}</option>
						<option value="1" @if (old('state') == '1') selected @endif>{{ trans('backend.candidates.create-edit.select_state_active') }}</option>
						<option value="0" @if (old('state') == '0') selected @endif>{{ trans('backend.candidates.create-edit.select_state_inactive') }}</option>
					</select>
					@if ($errors->has('state')) <p class="help-block">{{ $errors->first('state') }}</p> @endif
				</div>
			</div>
			

			<div class="row">
				<div class="form-group col-md-2 col-sm-2 col-xs-12 @if($errors->has('birthdate')) has-error @endif">
					<label class="control-label">{{ trans('backend.candidates.create-edit.label_birthdate') }}</label>
					<input type="date" class="form-control" name="birthdate" value="{{ old('birthdate') }}">
					@if ($errors->has('birthdate')) <p class="help-block">{{ $errors->first('birthdate') }}</p> @endif
				</div>
				<div class="form-group col-md-4 col-sm-4 col-xs-12 @if($errors->has('placebirth')) has-error @endif">
					<label class="control-label">{{ trans('backend.candidates.create-edit.label_place_of_birth') }} </label>
					<input type="text" class="form-control" name="placebirth" value="{{ old('placebirth') }}">
					@if ($errors->has('placebirth')) <p class="help-block">{{ $errors->first('placebirth') }}</p> @endif
				</div>

				<div class="form-group col-md-3 col-sm-3 col-xs-4 @if($errors->has('email')) has-error @endif">
					<label class="control-label" for="email">{{ trans('backend.candidates.create-edit.label_email') }} </label>
					<input class="form-control" type="email" name="email" id="email"  value="{{ old('email') }}">
					@if ($errors->has('email')) <p class="help-block">{{ $errors->first('email') }}</p> @endif
				</div>
				<div class="form-group col-md-1 col-sm-1 col-xs-12 @if($errors->has('phone_preffix')) has-error @endif">
					<label class="control-label">{{ trans('backend.candidates.create-edit.label_phone_prefix') }} </label>
					<input type="text" class="form-control" name="phone_preffix" value="{{ old('phone_preffix') }}">
					@if ($errors->has('phone_preffix')) <p class="help-block">{{ $errors->first('phone_preffix') }}</p> @endif
				</div>
				<div class="form-group col-md-2 col-sm-2 col-xs-12 @if($errors->has('phone_number')) has-error @endif">
					<label class="control-label">{{ trans('backend.candidates.create-edit.label_phone_number') }} </label>
					<input type="text" class="form-control" name="phone_number" value="{{ old('phone_number') }}">
					@if ($errors->has('phone_number')) <p class="help-block">{{ $errors->first('phone_number') }}</p> @endif
				</div>
			</div>
			
			<div class="row">
				
				<div class="form-group col-md-4 col-sm-4 col-xs-12 @if($errors->has('address')) has-error @endif">
					<label class="control-label">{{ trans('backend.candidates.create-edit.label_address') }} </label>
					<input type="text" class="form-control" name="address" value="{{ old('address') }}">
					@if ($errors->has('address')) <p class="help-block">{{ $errors->first('address') }}</p> @endif
				</div>

				<div class="form-group col-md-4 col-sm-4 col-xs-12 @if($errors->has('city')) has-error @endif">
					<label class="control-label">{{ trans('backend.candidates.create-edit.label_city') }} </label>
					<input type="text" class="form-control" name="city" value="{{ old('city') }}">
					@if ($errors->has('address')) <p class="help-block">{{ $errors->first('city') }}</p> @endif
				</div>

				<div class="form-group col-md-4 col-sm-4 col-xs-12 @if($errors->has('state_province')) has-error @endif">
					<label class="control-label">{{ trans('backend.candidates.create-edit.label_state_province') }} </label>
					<input type="text" class="form-control" name="state_province" value="{{ old('state_province') }}">
					@if ($errors->has('state_province')) <p class="help-block">{{ $errors->first('state_province') }}</p> @endif
				</div>				
			</div>
			
			<div class="row">
				<div class="form-group col-md-8 col-sm-8 col-xs-12">
					<label class="control-label col-md-12 col-sm-12 col-xs-12 no-padding">{{ trans('backend.candidates.create-edit.label_measurements') }} </label>
					<div class="form-group col-md-3 col-sm-2 col-xs-4 no-padding-left @if($errors->has('height')) has-error @endif">
						<input type="number" step="any" min="0.00" name="height" id="height" placeholder="{{ trans('backend.candidates.create-edit.label_height') }}" class="form-control" value="{{old('height')}}">
						@if ($errors->has('height')) <p class="help-block">{{ $errors->first('height') }}</p> @endif
					</div>
					<div class="form-group col-md-3 col-sm-2 col-xs-4 no-padding-left @if($errors->has('weight')) has-error @endif">
						<input type="number" step="any" min="0.00" name="weight" id="weight" placeholder="{{ trans('backend.candidates.create-edit.label_weight') }}" class="form-control" value="{{old('weight')}}">
						@if ($errors->has('weight')) <p class="help-block">{{ $errors->first('weight') }}</p> @endif
					</div>
					<div class="form-group col-md-2 col-sm-2 col-xs-4 no-padding-left @if($errors->has('bust_measure')) has-error @endif">
						<input type="number" name="bust_measure" id="bust_measure" class="form-control" placeholder="{{ trans('backend.candidates.create-edit.label_bust_measure') }}" value="{{old('bust_measure')}}">
						@if ($errors->has('bust_measure')) <p class="help-block">{{ $errors->first('bust_measure') }}</p> @endif
					</div>
					<div class="form-group col-md-2 col-sm-2 col-xs-4 no-padding-left @if($errors->has('waist_measure')) has-error @endif">
						<input type="number" name="waist_measure" id="waist_measure" class="form-control" placeholder="{{ trans('backend.candidates.create-edit.label_waist_measure') }}" value="{{old('waist_measure')}}">
						@if ($errors->has('waist_measure')) <p class="help-block">{{ $errors->first('waist_measure') }}</p> @endif
					</div>

					<div class="form-group col-md-2 col-sm-2 col-xs-4 no-padding-left @if($errors->has('hip_measure')) has-error @endif">
						<input type="number" name="hip_measure" id="hip_measure" class="form-control" placeholder="{{ trans('backend.candidates.create-edit.label_hip_measure') }}" value="{{old('hip_measure')}}">
						@if ($errors->has('hip_measure')) <p class="help-block">{{ $errors->first('hip_measure') }}</p> @endif
					</div>
				</div>
				<div class="form-group col-md-2 col-sm-2 col-xs-4 @if($errors->has('hair_color')) has-error @endif">
					<label class="control-label" for="hair-color">{{ trans('backend.candidates.create-edit.label_hair_color') }} </label>
					<input class="form-control" type="text" name="hair_color" id="hair-color"  value="{{ old('hair_color') }}">
					@if ($errors->has('hair_color')) <p class="help-block">{{ $errors->first('hair_color') }}</p> @endif
				</div>
				<div class="form-group col-md-2 col-sm-2 col-xs-4 @if($errors->has('eye_color')) has-error @endif">
					<label class="control-label" for="eye-color">{{ trans('backend.candidates.create-edit.label_eye_color') }} </label>
					<input class="form-control" type="text" name="eye_color" id="eye-color" value="{{ old('eye_color') }}">
					@if ($errors->has('eye_color')) <p class="help-block">{{ $errors->first('eye_color') }}</p> @endif
				</div>
			</div>

			<div class="row">
				<div class="col-md-6 col-sm-6 col-xs-12 @if($errors->has('dairy_philosophy')) has-error @endif">
					<label class="control-label" for="dairy_philosophy">{{ trans('backend.candidates.create-edit.label_dairy_philosophy') }} </label>
					<textarea class="form-control" name="dairy_philosophy" id="dairy_philosophy">{!! trim(old('dairy_philosophy')) !!}</textarea>	
					@if($errors->has('dairy_philosophy')) <p class="help-block">{{ $errors->first('dairy_philosophy') }}</p> @endif
				</div>
				<div class="col-md-6 col-sm-6 col-xs-12 @if($errors->has('why_would_you_win')) has-error @endif">
					<label class="control-label" for="best-film-book-in-life">{{ trans('backend.candidates.create-edit.label_why_would_you_win') }} {{config('app.name')}} ? </label>
					<textarea class="form-control" name="why_would_you_win" id="why-would-you-win">{!! trim(old('why_would_you_win')) !!}</textarea>	
					@if($errors->has('why_would_you_win')) <p class="help-block">{{ $errors->first('why_would_you_win') }}</p> @endif
				</div>
			</div>

			{{-- <div class="row">
					<div class="form-group @if($errors->has('how_did_you_hear_about_us')) has-error @endif">
					   					<label class="control-label col-sm-6 col-md-6" for="how_did_you_hear_about_us">@lang('form_process_apply.lbl_heard') </label>
					   					<div class="col-sm-6 col-md-6">
					   						<select class="form-control" name="how_did_you_hear_about_us" id="how_did_you_hear_about_us" @if(isset($applicant)) disabled @endif>
					   							<option value="null">--Seleccione--</option>
					   							<option value="facebook"  @if( (isset($applicant) && $applicant->how_did_you_hear_about_us == 'facebook') || old('how_did_you_hear_about_us') == 'facebook') selected @endif>Facebook</option>
					   							<option value="friend" @if( (isset($applicant) && $applicant->how_did_you_hear_about_us == 'friend') || old('how_did_you_hear_about_us') == 'friend') selected @endif>Friend</option>
					   							<option value="former_contestant" @if( (isset($applicant) && $applicant->how_did_you_hear_about_us == 'former_contestant') || old('how_did_you_hear_about_us') == 'former_contestant') selected @endif>Former Contestant</option>
					   							<option value="instagram" @if( (isset($applicant) && $applicant->how_did_you_hear_about_us == 'instagram') || old('how_did_you_hear_about_us') == 'instagram') selected @endif>Instagram</option>
					   							<option value="online_ad"  @if( (isset($applicant) && $applicant->how_did_you_hear_about_us == 'online_ad') || old('how_did_you_hear_about_us') == 'online_ad') selected @endif>Online AD</option>
					   							<option value="school_teacher" @if( (isset($applicant) && $applicant->how_did_you_hear_about_us == 'school_teacher') || old('how_did_you_hear_about_us') == 'school_teacher') selected @endif>School Teacher/Coach</option>
					   							<option value="website_google" @if( (isset($applicant) && $applicant->how_did_you_hear_about_us == 'website_google') || old('how_did_you_hear_about_us') == 'website_google') selected @endif>Website / Google Search</option>
					   						</select>
					   						@if ($errors->has('how_did_you_hear_about_us')) <p class="help-block">{{ $errors->first('how_did_you_hear_about_us') }}</p> @endif
					   					</div>
					   				</div>
			</div> --}}
			
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<label class="control-label">{{ trans('backend.candidates.create-edit.label_photos') }}</label>
					<input type="file" name="photos[]" id="photos" multiple accept="image/*">
					@if ($errors->has('photos')) <p class="help-block">{{ $errors->first('photos') }}</p> @endif
				</div>
			</div>
			<hr>
			<div class="row">
				<div class="form-group col-md-12 col-sm-12 col-xs-12">
					<a href="{{ route('candidates.index') }}" class="btn btn-primary">{{ trans('backend.candidates.create-edit.btn_cancel') }}</a>
	                <button type="submit" class="btn btn-success" id="save">{{ trans('backend.candidates.create-edit.btn_save') }}</button>
	            </div>
			</div>

		</form>
	</div>

</div>
@endsection

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('/public/css/bootstrap-file-input/fileinput.min.css') }}">
@endsection

@section('js')
<script src="{{asset('/public/js/bootstrap-file-input/plugins/canvas-to-blob.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/public/js/bootstrap-file-input/plugins/purify.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/public/js/bootstrap-file-input/fileinput.js')}}" type="text/javascript"></script>
<script src="{{asset('/public/js/bootstrap-file-input/themes/fa/theme.js')}}" type="text/javascript"></script>
<script src="{{asset('/public/js/bootstrap-file-input/locales/es.js')}}" type="text/javascript"></script>
<script type="text/javascript">
	$("#photos").fileinput({
		@if (App::isLocale('es'))
		language : 'es',
		@endif
		theme:'fa',
		allowedFileTypes: ['image'],
		showUpload: false,
		minFileCount: 1,
		maxFileCount: 3,
		autoReplace:true,
		overwriteInitial:false,
		showRemove: true,
	});
</script>
@endsection