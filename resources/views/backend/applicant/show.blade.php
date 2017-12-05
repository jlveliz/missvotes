@extends('layouts.backend')
@section('content')
<div class="panel panel-default">
	<div class="panel-heading">{{ trans('backend.applicant.show.panel_title') }}</div>
	<div class="panel-body">
		@if (Session::has('mensaje'))
        <div class="alert alert-dismissible @if(Session::get('tipo_mensaje') == 'success') alert-info  @endif @if(Session::get('tipo_mensaje') == 'error') alert-danger  @endif" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
          {{session('mensaje')}}
        </div>
        <div class="clearfix"></div>
       @endif
            
      @if ($applicant->state == \MissVote\Models\Miss::FORRATING) 
            <div class="alert alert-dismissible alert-warning" role="alert">
                  <p class="text-danger text-center"><b>{{ trans('backend.applicant.show.miss_missing') }}</b></p> 
            </div>
            <div class="clearfix"></div>
      @endif

      @if ($applicant->state == \MissVote\Models\Miss::PRESELECTED) 
            <div class="alert alert-dismissible alert-success" role="alert">
                  <p class="text-danger text-center"><b>{{ trans('backend.applicant.show.miss_preselected') }}</b></p> 
            </div>
            <div class="clearfix"></div>
      @endif

      @if ($applicant->state == \MissVote\Models\Miss::NOPRESELECTED) 
            <div class="alert alert-dismissible alert-danger" role="alert">
                  <p class="text-danger text-center"><b>{{ trans('backend.applicant.show.miss_no_preselected') }}</b></p> 
            </div>
            <div class="clearfix"></div>
      @endif

       <div class="row">
       	<div class="form-group col-md-3 col-sm-3 col-xs-12">
       		<label class="control-label">{{ trans('backend.applicant.show.label_name') }} </label>
       		<input type="text" class="form-control" name="name" value="{{ $applicant->name }}" disabled>
       	</div>

       	<div class="form-group col-md-3 col-sm-3 col-xs-12">
       		<label class="control-label">{{ trans('backend.applicant.show.label_lastname') }} </label>
       		<input type="text" class="form-control"  name="last_name" value="{{ $applicant->last_name }}" disabled>
       	</div>

       	<div class="form-group col-md-3 col-sm-3 col-xs-12">
       		<label class="control-label">{{ trans('backend.applicant.show.label_country') }} </label>
       		<input type="text" class="form-control" value="{{ $applicant->country->name }}" disabled>
       	</div>
       	<div class="form-group col-md-3 col-sm-3 col-xs-12">
       		<label class="control-label">{{ trans('backend.applicant.show.label_birthdate') }} </label>
       		<input type="date" class="form-control"  name="birthdate" value="{{ $applicant->birthdate }}" disabled>
       	</div>
       </div>
       

       	
       <div class="row">
       	<div class="form-group col-md-3 col-sm-3 col-xs-12">
       		<label class="control-label">{{ trans('backend.applicant.show.label_place_of_birth') }} </label>
       		<input type="text" class="form-control"  name="placebirth" value="{{ $applicant->placebirth }}" disabled>
       	</div>

       	<div class="form-group col-md-4 col-sm-4 col-xs-12">
       		<label class="control-label">{{ trans('backend.applicant.show.label_address') }} </label>
       		<input type="text" class="form-control"  name="address" value="{{ $applicant->address }}" disabled>
       	</div>

       	<div class="form-group col-md-3 col-sm-3 col-xs-4">
       		<label class="control-label" for="email">{{ trans('backend.applicant.show.label_email') }} </label>
       		<input class="form-control" type="email" name="email" id="email"   value="{{ $applicant->email }}" disabled>
       	</div>
       	<div class="form-group col-md-2 col-sm-2 col-xs-12">
       		<label class="control-label">{{ trans('backend.applicant.show.label_phone_number') }} </label>
       		<input type="text" class="form-control"  name="phone_number" value="{{ $applicant->phone_number }}" disabled>
       	</div>
       </div>
       
       <div class="row">
       	<div class="form-group col-md-2 col-sm-2 col-xs-12">
       		<label class="control-label">{{ trans('backend.applicant.show.label_city') }} </label>
       		<input type="text" class="form-control" name="city" value="{{ $applicant->city }}" disabled>
       	</div>

       	<div class="form-group col-md-3 col-sm-3 col-xs-12">
       		<label class="control-label">{{ trans('backend.applicant.show.label_state_province') }} </label>
       		<input type="text" class="form-control"  name="state_province" value="{{ $applicant->state_province }}" disabled>
       	</div>
       	<div class="form-group col-md-7 col-sm-7 col-xs-12">
       		<label class="control-label col-md-12 col-sm-12 col-xs-12 no-padding">{{ trans('backend.applicant.show.label_measurements') }} </label>
       		<div class="form-group col-md-3 col-sm-2 col-xs-4 no-padding-left">
       			<input type="text"  name="height" id="height" class="form-control" value="{{ trans('backend.applicant.show.label_height') }}: {{$applicant->height}} {{ $applicant->height_type_measure }}" disabled>
       		</div>
       		<div class="form-group col-md-3 col-sm-2 col-xs-4 no-padding-left">
       			<input type="text" placeholder="Peso (lb)" name="weight" id="weight" class="form-control" value="{{ trans('backend.applicant.show.label_weight') }}: {{$applicant->weight}} {{ $applicant->weight_type_measure }}" disabled>
       		</div>
       		<div class="form-group col-md-2 col-sm-2 col-xs-4 no-padding-left">
       			<input type="text" placeholder="Busto" name="bust_measure" id="bust_measure" class="form-control" value="{{ trans('backend.applicant.show.label_bust_measure') }}: {{$applicant->bust_measure}}" disabled>
       		</div>
       		<div class="form-group col-md-2 col-sm-2 col-xs-4 no-padding-left">
       			<input type="text" placeholder="Cintura" name="waist_measure" id="waist_measure" class="form-control" value="{{ trans('backend.applicant.show.label_waist_measure') }}: {{$applicant->waist_measure}}" disabled>
       		</div>

       		<div class="form-group col-md-2 col-sm-2 col-xs-4 no-padding-left">
       			<input type="text" placeholder="Cadera" name="hip_measure" id="hip_measure" class="form-control" value="{{ trans('backend.applicant.show.label_hip_measure') }}: {{$applicant->hip_measure}}" disabled>
       		</div>
       	</div>	
       </div>
       
       <div class="row">
       	<div class="form-group col-md-2 col-sm-2 col-xs-4">
       		<label class="control-label" for="hair-color">{{ trans('backend.applicant.show.label_hair_color') }} </label>
       		<input class="form-control" type="text" name="hair_color" id="hair-color" value="{{ $applicant->hair_color }}" disabled>
       	</div>
       	<div class="form-group col-md-2 col-sm-2 col-xs-4">
          <label class="control-label" for="eye-color">{{ trans('backend.applicant.show.label_eye_color') }} </label>
          <input class="form-control" type="text" name="eye_color" id="eye-color"  value="{{ $applicant->eye_color }}" disabled>
        </div>

        <div class="form-group col-md-4 col-sm-4 col-xs-4">
       		<label class="control-label" for="eye-color">{{ trans('backend.applicant.show.how_hear_about_us') }} </label>
       		<input class="form-control" type="text" name="eye_color" id="eye-color"  value="{{ $applicant->getFormattedHowDidYouHearAboutUs() }}" disabled>
       	</div>
       </div>

       <div class="row">
       	<div class="col-md-6 col-sm-6 col-xs-12">
       		<label class="control-label" for="dairy_philosophy">{{ trans('backend.applicant.show.label_dairy_philosophy') }} </label>
       		<textarea class="form-control" name="dairy_philosophy" id="dairy_philosophy" disabled>
       			{!! trim($applicant->dairy_philosophy) !!}
       		</textarea>	
       	</div>
       	<div class="col-md-6 col-sm-6 col-xs-12">
       		<label class="control-label" for="best-film-book-in-life">{{ trans('backend.applicant.show.label_why_would_you_win') }} {{config('app.name')}} ? </label>
       		<textarea class="form-control" name="why_would_you_win" id="why-would-you-win" disabled>
       			{!! trim($applicant->why_would_you_win) !!}
       		</textarea>	
       	</div>
       </div>

        <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                    <label style="display: block"  class="control-label" for="dairy_philosophy">{{ trans('backend.applicant.show.label_photos') }} </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <img src="{{ asset($applicant->applicant_face_photo) }}" alt="" class="img-responsive">  
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <img src="{{ asset($applicant->applicant_body_photo) }}" alt="" class="img-responsive">
                    </div>
              </div>
        </div>
       
	</div>

	<div class="panel-footer">
		<dir class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
          <a href="{{ route('applicants.index') }}" class="btn btn-primary">{{ trans('backend.applicant.show.btn_back') }}</a>
          @if ($applicant->state == \MissVote\Models\Miss::FORRATING)
              <form action="{{ route('applicants.update',$applicant->id) }}"  method="POST" style="display: inline">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="state" value="2">
                <button type="submit" class="btn btn-warning" id="save">{{ trans('backend.applicant.show.label_no_preselected') }}</button>
              </form>
              <form action="{{ route('applicants.update',$applicant->id) }}"  method="POST" style="display: inline">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="state" value="1">
                <button type="submit" class="btn btn-success" id="save">{{ trans('backend.applicant.show.label_preselected') }}</button>
              </form>
          @endif
          @if ($applicant->state ==  \MissVote\Models\Miss::PRESELECTED)
      				<form action="{{ route('applicants.update',$applicant->id) }}" method="POST"  style="display: inline">
      					{{ csrf_field() }}
      					<input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="state" value="0">
      		      <button type="submit" class="btn btn-success" id="save">{{ trans('backend.applicant.show.label_qualify_missing') }}</button>
      				</form>
              <form action="{{ route('applicants.update',$applicant->id) }}"  method="POST" style="display: inline">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="state" value="3">
                <button type="submit" class="btn btn-success" id="save">{{ trans('backend.applicant.show.label_precandidate') }}</button>
              </form>
              <form action="{{ route('applicants.update',$applicant->id) }}"  method="POST" style="display: inline">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="state" value="2">
                <button type="submit" class="btn btn-warning" id="save">{{ trans('backend.applicant.show.label_no_preselected') }}</button>
              </form> 
          @endif
          
          @if ($applicant->state ==  \MissVote\Models\Miss::NOPRESELECTED)
            <form action="{{ route('applicants.update',$applicant->id) }}" method="POST"  style="display: inline">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="state" value="0">
                <button type="submit" class="btn btn-warning" id="save">{{ trans('backend.applicant.show.label_qualify_missing') }}</button>
              </form>
              <form action="{{ route('applicants.update',$applicant->id) }}" method="POST"  style="display: inline">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="state" value="1">
                <button type="submit" class="btn btn-success" id="save">{{ trans('backend.applicant.show.label_preselected') }}</button>
              </form>
          @endif

		    </div>
		</dir>
	</div>
</div>
@endsection