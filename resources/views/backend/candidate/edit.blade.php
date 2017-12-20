@extends('layouts.backend')
@section('content')
<div class="panel panel-default">
	<div class="panel-heading">{{ trans('backend.candidates.create-edit.panel_title') }}</div>
	<p class="subtitle">{{ trans('backend.candidates.create-edit.panel_edit_subtitle') }}</p>
	<div class="panel-body">
		@if (Session::has('mensaje'))
        <div class="alert alert-dismissible @if(Session::get('tipo_mensaje') == 'success') alert-info  @endif @if(Session::get('tipo_mensaje') == 'error') alert-danger  @endif" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
          {{session('mensaje')}}
           </div>
        <div class="clearfix"></div>
       @endif

        @if ($candidate->state == \MissVote\Models\Miss::DISQUALIFIEDCANDIDATE) 
            <div class="alert alert-dismissible alert-warning" role="alert">
                  <p class="text-danger text-center"><b>{{ trans('backend.candidates.create-edit.flag_disqualited') }}</b></p> 
            </div>
            <div class="clearfix"></div>
      	@endif

      	@if ($candidate->state == \MissVote\Models\Miss::CANDIDATE) 
            <div class="alert alert-dismissible alert-success" role="alert">
                  <p class="text-danger text-center"><b>{{ trans('backend.candidates.create-edit.flag_qualited') }}</b></p> 
            </div>
            <div class="clearfix"></div>
      	@endif
		<form action="{{ route('candidates.update',$candidate->id) }}" method="post" enctype="multipart/form-data">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<input type="hidden" name="_method" value="PUT">
			<input type="hidden" name="key" value="{{$candidate->id}}">
			<input type="hidden" name="state" value="{{$candidate->state}}">
			<div class="row">
				<div class="form-group col-md-3 col-sm-3 col-xs-12 @if($errors->has('name')) has-error @endif">
					<label class="control-label">{{ trans('backend.candidates.create-edit.label_name') }} </label>
					<input type="text" class="form-control" name="name" value="{{ $candidate->name }}" autofocus>
					@if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
				</div>

				<div class="form-group col-md-3 col-sm-3 col-xs-12 @if($errors->has('last_name')) has-error @endif">
					<label class="control-label">{{ trans('backend.candidates.create-edit.label_lastname') }} </label>
					<input type="text" class="form-control" name="last_name" value="{{ $candidate->last_name }}">
					@if ($errors->has('last_name')) <p class="help-block">{{ $errors->first('last_name') }}</p> @endif
				</div>

				<div class="form-group col-md-3 col-sm-3 col-xs-12 @if($errors->has('country_id')) has-error @endif">
					<label class="control-label">{{ trans('backend.candidates.create-edit.label_country') }} </label>
					<select class="form-control" name="country_id" id="country">
						<option value="null">{{ trans('backend.candidates.create-edit.select_default') }}</option>
						@foreach ($countries as $element)
							<option value="{{$element->id}}" @if($candidate->country_id == $element->id) selected  @endif>{{$element->name}}</option>
						@endforeach
					</select>
					@if ($errors->has('country_id')) <p class="help-block">{{ $errors->first('country_id') }}</p> @endif
				</div>

				{{-- <div class="form-group col-md-3 col-sm-3 col-xs-12 @if($errors->has('state')) has-error @endif">
					<label class="control-label">{{ trans('backend.candidates.create-edit.label_state') }} </label>
					<select name="state" id="state" class="form-control">
						<option value="null">{{ trans('backend.candidates.create-edit.select_default') }}</option>
						<option value="1" @if ($candidate->state == '1') selected @endif>{{ trans('backend.candidates.create-edit.select_state_active') }}</option>
						<option value="0" @if ($candidate->state == '0') selected @endif>{{ trans('backend.candidates.create-edit.select_state_inactive') }}</option>
					</select>
					@if ($errors->has('state')) <p class="help-block">{{ $errors->first('state') }}</p> @endif
				</div> --}}
				<div class="form-group col-md-3 col-sm-3 col-xs-12 @if($errors->has('birthdate')) has-error @endif">
					<label class="control-label">{{ trans('backend.candidates.create-edit.label_birthdate') }} </label>
					<input type="date" class="form-control" name="birthdate" value="{{ $candidate->birthdate }}">
					@if ($errors->has('birthdate')) <p class="help-block">{{ $errors->first('birthdate') }}</p> @endif
				</div>
			</div>
			

			<div class="row">
				
				<div class="form-group col-md-3 col-sm-3 col-xs-12 @if($errors->has('placebirth')) has-error @endif">
					<label class="control-label">{{ trans('backend.candidates.create-edit.label_place_of_birth') }} </label>
					<input type="text" class="form-control" name="placebirth" value="{{ $candidate->placebirth }}">
					@if ($errors->has('placebirth')) <p class="help-block">{{ $errors->first('placebirth') }}</p> @endif
				</div>

				<div class="form-group col-md-3 col-sm-3 col-xs-4 @if($errors->has('email')) has-error @endif">
					<label class="control-label" for="email">{{ trans('backend.candidates.create-edit.label_email') }} </label>
					<input class="form-control" type="email" name="email" id="email" value="{{ $candidate->email }}">
					@if ($errors->has('email')) <p class="help-block">{{ $errors->first('email') }}</p> @endif
				</div>
				<div class="form-group col-md-3 col-sm-3 col-xs-12 @if($errors->has('phone_number')) has-error @endif">
					<label class="control-label">{{ trans('backend.candidates.create-edit.label_phone_number') }} </label>
					<input type="text" class="form-control" name="phone_number" value="{{ $applicant->phone_preffix }}{{ $candidate->phone_number }}">
					@if ($errors->has('phone_number')) <p class="help-block">{{ $errors->first('phone_number') }}</p> @endif
				</div>
				<div class="form-group col-md-3 col-sm-3 col-xs-4">
       				<label class="control-label" for="eye-color">{{trans('backend.candidates.create-edit.how_hear_about_us')}} </label>
       				<input class="form-control" type="text" name="eye_color" id="eye-color"  value="{{ $candidate->getFormattedHowDidYouHearAboutUs() }}" disabled>
       			</div>
			</div>
			
			<div class="row">
				
				<div class="form-group col-md-4 col-sm-4 col-xs-12 @if($errors->has('address')) has-error @endif">
					<label class="control-label">{{ trans('backend.candidates.create-edit.label_address') }} </label>
					<input type="text" class="form-control" name="address" value="{{ $candidate->address }}">
					@if ($errors->has('address')) <p class="help-block">{{ $errors->first('address') }}</p> @endif
				</div>

				<div class="form-group col-md-4 col-sm-4 col-xs-12 @if($errors->has('city')) has-error @endif">
					<label class="control-label">{{ trans('backend.candidates.create-edit.label_city') }} </label>
					<input type="text" class="form-control" name="city" value="{{ $candidate->city }}">
					@if ($errors->has('address')) <p class="help-block">{{ $errors->first('city') }}</p> @endif
				</div>

				<div class="form-group col-md-4 col-sm-4 col-xs-12 @if($errors->has('state_province')) has-error @endif">
					<label class="control-label">{{ trans('backend.candidates.create-edit.label_state_province') }}  </label>
					<input type="text" class="form-control" name="state_province" value="{{ $candidate->state_province }}">
					@if ($errors->has('state_province')) <p class="help-block">{{ $errors->first('state_province') }}</p> @endif
				</div>				
			</div>
			
			<div class="row">
				<div class="form-group col-md-8 col-sm-8 col-xs-12">
					<label class="control-label col-md-12 col-sm-12 col-xs-12 no-padding">{{ trans('backend.candidates.create-edit.label_measurements') }} </label>
					<div class="form-group col-md-3 col-sm-2 col-xs-4 no-padding-left @if($errors->has('height')) has-error @endif">
						<input type="number" step="any" min="0.00" placeholder="{{ trans('backend.candidates.create-edit.label_height') }}" name="height" id="height" class="form-control" value="{{$candidate->height}}">
						@if ($errors->has('height')) <p class="help-block">{{ $errors->first('height') }}</p> @endif
					</div>
					<div class="form-group col-md-3 col-sm-2 col-xs-4 no-padding-left @if($errors->has('weight')) has-error @endif">
						<input type="number" step="any" min="0.00" placeholder="{{ trans('backend.candidates.create-edit.label_weight') }}" name="weight" id="weight" class="form-control" value="{{$candidate->weight}}">
						@if ($errors->has('weight')) <p class="help-block">{{ $errors->first('weight') }}</p> @endif
					</div>
					<div class="form-group col-md-2 col-sm-2 col-xs-4 no-padding-left @if($errors->has('bust_measure')) has-error @endif">
						<input type="number" placeholder="{{ trans('backend.candidates.create-edit.label_bust_measure') }}" name="bust_measure" id="bust_measure" class="form-control" value="{{$candidate->bust_measure}}">
						@if ($errors->has('bust_measure')) <p class="help-block">{{ $errors->first('bust_measure') }}</p> @endif
					</div>
					<div class="form-group col-md-2 col-sm-2 col-xs-4 no-padding-left @if($errors->has('waist_measure')) has-error @endif">
						<input type="number" placeholder="{{ trans('backend.candidates.create-edit.label_waist_measure') }}" name="waist_measure" id="waist_measure" class="form-control" value="{{$candidate->waist_measure}}">
						@if ($errors->has('waist_measure')) <p class="help-block">{{ $errors->first('waist_measure') }}</p> @endif
					</div>

					<div class="form-group col-md-2 col-sm-2 col-xs-4 no-padding-left @if($errors->has('hip_measure')) has-error @endif">
						<input type="number" placeholder="{{ trans('backend.candidates.create-edit.label_hip_measure') }}" name="hip_measure" id="hip_measure" class="form-control" value="{{$candidate->hip_measure}}">
						@if ($errors->has('hip_measure')) <p class="help-block">{{ $errors->first('hip_measure') }}</p> @endif
					</div>
				</div>
				<div class="form-group col-md-2 col-sm-2 col-xs-4 @if($errors->has('hair_color')) has-error @endif">
					<label class="control-label" for="hair-color">{{ trans('backend.candidates.create-edit.label_hair_color') }} </label>
					<input class="form-control" type="text" name="hair_color" id="hair-color" value="{{ $candidate->hair_color }}">
					@if ($errors->has('hair_color')) <p class="help-block">{{ $errors->first('hair_color') }}</p> @endif
				</div>
				<div class="form-group col-md-2 col-sm-2 col-xs-4 @if($errors->has('eye_color')) has-error @endif">
					<label class="control-label" for="eye-color">{{ trans('backend.candidates.create-edit.label_eye_color') }}  </label>
					<input class="form-control" type="text" name="eye_color" id="eye-color"   value="{{ $candidate->eye_color }}">
					@if ($errors->has('eye_color')) <p class="help-block">{{ $errors->first('eye_color') }}</p> @endif
				</div>
			</div>

			<div class="row">
				<div class="col-md-6 col-sm-6 col-xs-12 @if($errors->has('dairy_philosophy')) has-error @endif">
					<label class="control-label" for="dairy_philosophy">{{ trans('backend.candidates.create-edit.label_dairy_philosophy') }} </label>
					<textarea class="form-control" name="dairy_philosophy" id="dairy_philosophy">
						{!! trim($candidate->dairy_philosophy) !!}
					</textarea>	
					@if($errors->has('dairy_philosophy')) <p class="help-block">{{ $errors->first('dairy_philosophy') }}</p> @endif
				</div>
				<div class="col-md-6 col-sm-6 col-xs-12 @if($errors->has('why_would_you_win')) has-error @endif">
					<label class="control-label" for="best-film-book-in-life">{{ trans('backend.candidates.create-edit.label_why_would_you_win') }} {{config('app.name')}}? </label>
					<textarea class="form-control" name="why_would_you_win" id="why-would-you-win">
						{!! trim($candidate->why_would_you_win) !!}
					</textarea>	
					@if($errors->has('why_would_you_win')) <p class="help-block">{{ $errors->first('why_would_you_win') }}</p> @endif
				</div>
			</div>

			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<label class="control-label">{{ trans('backend.candidates.create-edit.label_photos') }}</label>
					<input type="file" name="photos[]" id="photos" multiple accept="image/*">
					@if ($errors->has('photos')) <p class="help-block">{{ $errors->first('photos') }}</p> @endif
				</div>
			</div>
	</div>
	<div class="panel-footer">
			<div class="row">
				<div class="form-group col-md-12 col-sm-12 col-xs-12">
					<a href="{{ route('candidates.index') }}" class="btn btn-primary">{{ trans('backend.candidates.create-edit.btn_back') }}</a>
	                <button type="submit" class="btn btn-success" id="save">{{ trans('backend.candidates.create-edit.btn_save') }}</button>
	</form>
	@if ($candidate->state == '5')
	<form action="{{ route('candidates.update',$candidate->id) }}" method="POST" style="display: inline">
		{{ csrf_field() }}
			<input type="hidden" name="_method" value="PUT">
			<input type="hidden" name="state" value="{{\Missvote\Models\Miss::DISQUALIFIEDCANDIDATE}}">
		    <button type="submit" class="btn btn-warning" id="save">{{ trans('backend.candidates.create-edit.disqualify') }}</button>
	</form>
	@endif
	@if ($candidate->state == '6')
	<form action="{{ route('candidates.update',$candidate->id) }}" method="POST" style="display: inline">
		{{ csrf_field() }}
			<input type="hidden" name="_method" value="PUT">
			<input type="hidden" name="state" value="{{\Missvote\Models\Miss::CANDIDATE}}">
		    <button type="submit" class="btn btn-success" id="save">{{ trans('backend.candidates.create-edit.qualify') }}</button>
	</form>
	@endif
	            </div>
			</div>

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
	$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
	});
	$("#photos").fileinput({
		@if (App::isLocale('es'))
		language : 'es',
		@endif
		theme:'fa',
		uploadAsync: true,
		uploadUrl : '{{ url('/backend/upload-photo') }}',
		ajaxSetting : {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
		allowedFileTypes: ['image'],
		// showUpload: true,
		showRemove: true,
		minFileCount: 1,
		maxFileCount: 3,
		autoReplace:false,
		initialPreviewCount: true,
		showUploadedThumbs: true,
		overwriteInitial:false,
		initialPreviewAsData: true,
    	initialPreviewFileType: 'image',
		initialPreview : [
			@foreach ($candidate->photos as $element)
			 	'{{config('app.url').'/'.$element->path}}',
			@endforeach
		],
		uploadExtraData: {
			miss_id : {{$candidate->id}}
		},
    	initialPreviewConfig: [
    		@foreach ($candidate->photos as $element)
    			{ caption : '{{$element->path}}', url: '{{url('/backend/delete-photo')}}', key : {{$element->id}} },
    		@endforeach
    	]
		
	});
</script>
@endsection