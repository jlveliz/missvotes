@extends('layouts.frontend')
@section('content')
	<div class="row" style="margin-top: 70px">
		<h1 class="text-center"> @lang('form_process_apply.tittle_process')</h1>
		<p class="text-center"><a class="btn btn-link " href="{{ route('apply.requirements') }}">{{ trans('form_process_apply.requirements_tab') }}</a></p>
	</div>
	<div class="row">
		<div class="col-md-12 col-xs-12 col-lg-12">
			<!-- Nav tabs -->
			 <ul id="process-tab" class="nav nav-tabs" role="tablist">
			   	<li id="country-tab" role="presentation" class="@if($existApply->process_status == 1) active @endif">
			   		<a href="#countries" aria-controls="countries" role="tab" data-toggle="tab">@lang('form_process_apply.country_tab')</a>
			   	</li>
			   <li id="pay-tab" role="presentation" class="@if($existApply->process_status <= 1) disabled @endif  @if($existApply->process_status == 2) active @endif">
			   		<a href="#pay" aria-controls="pay" role="tab" data-toggle="tab">@lang('form_process_apply.fee_tab')</a>
			   	</li>
			   <li id="subscription-tab" role="presentation" class="@if($existApply->process_status <= 2) disabled @endif @if($existApply->process_status == 3) active @endif">
			   		<a href="#aplication" aria-controls="aplication" role="tab" data-toggle="tab">@lang('form_process_apply.app_tab')</a>
			   	</li>
			   <li id="success-tab" role="presentation" class="@if($existApply->process_status <= 3) disabled @endif @if($existApply->process_status == 4) active @endif">
			   		<a href="#status" aria-controls="status" role="tab" data-toggle="tab">@lang('form_process_apply.status_tab')</a>
			   	</li>
			 </ul>

			 <!-- Tab panes -->
			 <div class="tab-content">
			 	
			   {{-- countries --}}
			   <div role="tabpanel" class="tab-pane fade in active" id="countries">
			   		<div class="process-content">
				   		<p><b>1.- @lang('form_process_apply.sel_country_lbl')</b></p>
				   		<div class="row">
				   			<div class="col-md-12 col-lg-12">
				   				@if ($existApply->process_status < 3)
					   				<ul class="list-unstyled list-inline text-center list-flags" id="menu-countries">

					   					@foreach ($countries as $country)
					   						<li @if($existApply->country_code_selected == $country->code) class="country-selected" @endif>
					   							<a class="country-audition" href="#" data-code="{{$country->code}}" title="{{$country->name}}" alt="{{$country->name}}"><img class="image-responsive" src="{{ asset('public/images/').'/'.$country->flag_img}}"> <br> {{$country->name}}</a> 
					   						</li>
					   					@endforeach
					   					
					   				</ul>
				   				@else
				   					<ul class="list-unstyled list-inline text-center list-flags" id="">
										@foreach ($countries as $country)
						   					<li @if($existApply->country_code_selected == $country->code) class="country-selected" @endif title="{{$country->name}}" alt="{{$country->name}}">
						   						<img class="image-responsive clickable" src="{{ asset('public/images/').'/'.$country->flag_img}}"> <br> {{$country->name}}</a> 
						   					</li>
										@endforeach
					   				</ul>
				   				@endif
				   			</div>
				   		</div>
			   		</div>
			   </div>
			   {{-- pay --}}
			   <div role="tabpanel" class="tab-pane fade" id="pay">
			   		<div class="process-content">
		   				@if (Session::has('payment-message'))
		   					<div class="row">
		   				        <div class="alert alert-dismissible @if(Session::get('payment-type') == 'success') alert-info  @endif @if(Session::get('payment-type') == 'error') alert-danger  @endif" role="alert">
		   				          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
		   				          {{session('payment-message')}}
		   				        </div>
		   					</div>
		   			        <div class="clearfix"></div>
		   			    @endif
			   			
			   			@if ($existApply->payed_at)
			   				<div class="row">
			   					<h2 class="text-center text-success"> @lang('form_process_apply.txt_pay_thanks_lbl'). </h2>
			   				</div>
			   			@else
			   			<p>
			   				<b>2.- @lang('form_process_apply.txt_price_lbl')</b> <br>
			   				<small><b>@lang('form_process_apply.txt_price_off_lbl')</b></small>
			   			</p>
			   			<div class="row">
					   			<div class="col-md-5 col-lg-5 col-sm-8 col-xs-12 col-md-offset-4 text-center">
					   				<h2 id="price-insciption"><small>$</small> 20.00 <br> <small> USD </small></h2>
					   				<form action="{{ route('pay.paypal.aplication') }}" method="POST" accept-charset="utf-8">
					   					{{ csrf_field() }}
					   					<button type="submit" class="btn btn-primary btn-lg btn-block pay-button" data-payment="paypal"><i class="fa fa-paypal"> </i> <b>@lang('form_process_apply.lbl_paypal_')</b></button>

					   					<p style="margin-bottom: 0px;font-size: 12px;text-align: justify; margin-top: 20px">{{ trans('form_process_apply.paypal_message_1') }}</p>
					   					<p style="margin-bottom: 0px;margin-top: 0px;font-size: 12px;text-align: justify;">{{ trans('form_process_apply.paypal_message_2') }} <b>{{ trans('form_process_apply.paypal_message_2_paypal') }} </b> {{ trans('form_process_apply.paypal_message_2_2') }}</p>
					   					
					   				</form>
					   				{{-- <h3>O</h3>
					   				<form id="pay-stripe-aplication" action="{{ route('pay.stripe.aplication') }}" method="post">
					   					{{ csrf_field() }}
					   					<input type="hidden" name="stripeToken" id="stripe-pay-token">
					   					<input type="hidden" name="amount" value="6000">
					   					<input type="hidden" name="description" value="Pay Apply Process Miss Panamerican Int">
					   					<button type="button" id="pay-aplication-stripe" class="btn btn-default btn-lg btn-block pay-button" data-email="{{Auth::user()->email}}" data-amount="6000" data-description="Pay Apply Process Miss Panamerican Int"><i class="fa fa-credit-card"> </i> <b>@lang('form_process_apply.lbl_cc_')</b></button>
					   					
					   				</form> --}}
					   			</div>
			   			</div>
			   			@endif
			   		</div>
			   </div>
			   {{-- aplication --}}
			   <div role="tabpanel" class="tab-pane fade" id="aplication">
			   		<div class="process-content">
		   				@if (Session::has('payment-message'))
		   					<div class="row">
		   				        <div class="alert alert-dismissible @if(Session::get('payment-type') == 'success') alert-info  @endif @if(Session::get('payment-type') == 'error') alert-danger  @endif" role="alert">
		   				          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
		   				          {{session('payment-message')}}
		   				        </div>
		   					</div>
		   			        <div class="clearfix"></div>
		   			    @endif
			   			<p><b>3.- @lang('form_process_apply.lbl_pls_fill')</b> </p>
			   			<hr>
			   			<div class="row">
			   				<div class="col-md-7 col-lg-7 col-sm-12 col-xs-12 col-md-offset-2">
				   				<form action="{{ route('insert.applicant') }}" enctype="multipart/form-data" method="POST" class="form-horizontal" id="form-process" name="form-process">
				   					{{ csrf_field() }}
				   					@if ($countryselected)
				   						<input type="hidden" name="country_id" value="{{$countryselected}}">
				   						<input type="hidden" name="state" value="0">
				   					@endif
				   					
				   					<div class="form-group @if($errors->has('name')) has-error @endif">
				   						<label class="control-label col-sm-6 col-md-6 ">@lang('form_process_apply.lbl_name') </label>
				   						<div class="col-sm-6 col-md-6">
											<input type="text" class="form-control" name="name" value="{{ isset($applicant) ?  $applicant->name :   Auth::user()->name }}" autofocus @if(isset($applicant)) disabled @endif>
												@if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
				   						</div>
				   					</div>

				   					<div class="form-group  @if($errors->has('last_name')) has-error @endif">
				   						<label class="control-label col-sm-6 col-md-6">@lang('form_process_apply.lbl_last_name') </label>
				   						<div class="col-sm-6 col-md-6">
											<input type="text" class="form-control" name="last_name" value="{{ isset($applicant) ? $applicant->last_name : Auth::user()->last_name  }}"  @if(isset($applicant)) disabled @endif>
												@if ($errors->has('last_name')) <p class="help-block">{{ $errors->first('last_name') }}</p> @endif
				   						</div>
				   					</div>

				   					<div class="form-group @if($errors->has('birthdate')) has-error @endif">
				   						<label class="control-label col-sm-6 col-md-6">@lang('form_process_apply.lbl_bday') </label>
				   						<div class="col-sm-6 col-md-6">
					   						<input type="date" class="form-control"  name="birthdate" value="{{ isset($applicant) ? $applicant->birthdate : old('birthdate') }}" @if(isset($applicant)) disabled @endif>
					   						@if ($errors->has('birthdate')) <p class="help-block">{{ $errors->first('birthdate') }}</p> @endif
				   						</div>
				   					</div>

				   					<div class="form-group @if($errors->has('placebirth')) has-error @endif">
					   					<label class="control-label col-sm-6 col-md-6">@lang('form_process_apply.lbl_bplace') </label>
					   					<div class="col-sm-6 col-md-6">
						   					<input type="text" class="form-control" name="placebirth" value="{{ isset($applicant) ? $applicant->placebirth : old('placebirth') }}" @if(isset($applicant)) disabled @endif>
						   					@if ($errors->has('placebirth')) <p class="help-block">{{ $errors->first('placebirth') }}</p> @endif
					   					</div>
					   				</div>

					   				<div class="form-group @if($errors->has('email')) has-error @endif">
					   					<label class="control-label col-sm-6 col-md-6" for="email">@lang('form_process_apply.lbl_email') </label>
					   					<div class="col-sm-6 col-md-6">
					   						<b>{{ isset($applicant) ? $applicant->email  : Auth::user()->email }}</b>
						   					<input type="hidden" name="email" id="email" value="{{ isset($applicant) ? $applicant->email  : Auth::user()->email }}" readonly>
						   					@if ($errors->has('email')) <p class="help-block">{{ $errors->first('email') }}</p> @endif
					   					</div>
					   				</div>

					   				<div class="form-group @if($errors->has('phone_number') || $errors->has('phone_preffix')) has-error @endif">
					   					<label class="control-label col-sm-6 col-md-6" for="phone_number">@lang('form_process_apply.lbl_phone') </label>
					   					<div class="col-sm-2 col-md-2">
					   						<input type="text" id="phone_preffix"  name="phone_preffix" id="phone_preffix" class="form-control" placeholder="Pref" value="{{ isset($applicant)  ? $applicant->phone_preffix :  old('phone_preffix')}}"  @if(isset($applicant)) disabled @endif>
					   						@if ($errors->has('phone_preffix')) <p class="help-block">{{ $errors->first('phone_preffix') }}</p> @endif
					   					</div>
					   					<div class="col-sm-4 col-md-4">
						   					<input type="text" class="form-control" name="phone_number" id="phone_number" value="{{ isset($applicant) ?  $applicant->phone_number : old('phone_number') }}" @if(isset($applicant)) disabled @endif placeholder="">
						   					@if ($errors->has('phone_number')) <p class="help-block">{{ $errors->first('phone_number') }}</p> @endif
					   					</div>
					   				</div>

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

					   				<div class="form-group @if($errors->has('height')) has-error @endif">
					   					<label class="control-label col-sm-6 col-md-6" for="height">@lang('form_process_apply.lbl_size')</label>
					   					<div class="col-sm-2 col-md-2">
					   						<select name="height_type_measure" id="height_type_measure" class="form-control" @if(isset($applicant)) disabled @endif>
					   							<option value="cm" @if( (isset($applicant) && $applicant->height_type_measure == 'cm') || old('height_type_measure') == 'cm') selected @endif>cm</option>
					   							<option value="ft" @if( (isset($applicant) && $applicant->height_type_measure == 'ft') || old('height_type_measure') == 'ft') selected @endif>ft</option>
					   						</select>
											@if ($errors->has('height')) <p class="help-block">{{ $errors->first('height') }}</p> @endif
					   					</div>
					   					<div class="col-sm-3 col-md-3">
						   					<input type="text" id="height"  name="height" id="height" class="form-control" value="{{ isset($applicant)  ? $applicant->height :  old('height')}}"  @if(isset($applicant)) disabled @endif>
							@if ($errors->has('height')) <p class="help-block">{{ $errors->first('height') }}</p> @endif
					   					</div>
					   				</div>

					   				<div class="form-group @if($errors->has('weight')) has-error @endif">
					   					<label class="control-label col-sm-6 col-md-6" for="weight">@lang('form_process_apply.lbl_weight')</label>
					   					<div class="col-sm-2 col-md-2">
					   						<select name="weight_type_measure" id="weight_type_measure" class="form-control" @if(isset($applicant)) disabled @endif>
					   							<option value="lb" @if( (isset($applicant) && $applicant->weight_type_measure == 'lb') || old('weight_type_measure') == 'lb') selected @endif>lb</option>
					   							<option value="kg" @if( (isset($applicant) && $applicant->weight_type_measure == 'kg') || old('weight_type_measure') == 'kg') selected @endif>kg</option>
					   						</select>
											@if ($errors->has('weight_type_measure')) <p class="help-block">{{ $errors->first('weight_type_measure') }}</p> @endif
					   					</div>
					   					<div class="col-sm-3 col-md-3">
					   						<input type="text" name="weight" id="weight" class="form-control" value="{{ isset($applicant)  ? $applicant->weight :  old('weight') }}"  @if(isset($applicant)) disabled @endif>
											@if ($errors->has('weight')) <p class="help-block">{{ $errors->first('weight') }}</p> @endif
					   					</div>
					   				</div>

					   				<div class="form-group @if($errors->has('address')) has-error @endif">
					   					<label class="control-label col-sm-6 col-md-6" for="address">@lang('form_process_apply.lbl_adress') </label>
					   					<div class="col-sm-6 col-md-6">
						   					<input type="text" id="address" class="form-control" name="address" value="{{ isset($applicant) && $applicant->address ?  $applicant->address : old('address') }}" @if(isset($applicant)) disabled @endif>
						   					@if ($errors->has('address')) <p class="help-block">{{ $errors->first('address') }}</p> @endif
					   					</div>
					   				</div>

					   				<div class="form-group @if($errors->has('city')) has-error @endif">
					   					<label class="control-label col-sm-6 col-md-6" for="city">@lang('form_process_apply.lbl_city') </label>
					   					<div class="col-sm-6 col-md-6">
					   						<input type="text" class="form-control" name="city" value="{{ isset($applicant) && $applicant->city ?  $applicant->city : old('city') }}" @if(isset($applicant)) disabled @endif>
					   						@if ($errors->has('address')) <p class="help-block">{{ $errors->first('city') }}</p> @endif
					   					</div>
					   				</div>

					   				<div class="form-group @if($errors->has('state_province')) has-error @endif">
					   					<label class="control-label col-sm-6 col-md-6" for="state_province">@lang('form_process_apply.lbl_state')  </label>
					   					<div class="col-sm-6 col-md-6">
					   						<input type="text" class="form-control" id="state_province" name="state_province" value="{{ isset($applicant) && $applicant->state_province ?  $applicant->state_province : old('state_province') }}" @if(isset($applicant)) disabled @endif>
					   						@if ($errors->has('state_province')) <p class="help-block">{{ $errors->first('state_province') }}</p> @endif
					   					</div>
					   				</div>

					   				<div class="form-group @if($errors->has('bust_measure')) has-error @endif">
					   					<label class="control-label col-sm-6 col-md-6" for="bust_measure">@lang('form_process_apply.lbl_bust')</label>
					   					<div class="col-sm-3 col-md-3">
					   						<input type="number" step="1" min="1" name="bust_measure" id="bust_measure" class="form-control" value="{{ isset($applicant)  ? $applicant->bust_measure :  old('bust_measure')}}"  @if(isset($applicant)) disabled @endif> 
					   						@if ($errors->has('bust_measure')) <p class="help-block">{{ $errors->first('bust_measure') }} </p> @endif
					   					</div>
					   				</div>

					   				<div class="form-group @if($errors->has('waist_measure')) has-error @endif">
					   					<label class="control-label col-sm-6 col-md-6" for="waist_measure">@lang('form_process_apply.lbl_waist')</label>
					   					<div class="col-sm-3 col-md-3">
					   						<input type="number" step="1" min="1" name="waist_measure" id="waist_measure" class="form-control" value="{{ isset($applicant)  ? $applicant->waist_measure :  old('waist_measure')}}"  @if(isset($applicant)) disabled @endif>
					   						@if ($errors->has('waist_measure')) <p class="help-block">{{ $errors->first('waist_measure') }}</p> @endif
					   					</div>
					   				</div>

					   				<div class="form-group @if($errors->has('hip_measure')) has-error @endif">
					   					<label class="control-label col-sm-6 col-md-6" for="hip_measure">@lang('form_process_apply.lbl_hip')</label>
					   					<div class="col-sm-3 col-md-3">
					   						<input type="number" step="1" min="1" name="hip_measure" id="hip_measure" class="form-control" value="{{ isset($applicant)  ? $applicant->hip_measure :  old('hip_measure')}}"  @if(isset($applicant)) disabled @endif>
					   						@if ($errors->has('hip_measure')) <p class="help-block">{{ $errors->first('waist_measure') }}</p> @endif
					   					</div>
					   				</div>

					   				<div class="form-group @if($errors->has('hair_color')) has-error @endif">
					   					<label class="control-label col-sm-6 col-md-6" for="hair_color">@lang('form_process_apply.lbl_hair')</label>
					   					<div class="col-sm-3 col-md-3">
						   					<input class="form-control" type="text" name="hair_color" id="hair-color"   value="{{ isset($applicant)  ? $applicant->hair_color :  old('hair_color')}}"  @if(isset($applicant)) disabled @endif>
						   					@if ($errors->has('hair_color')) <p class="help-block">{{ $errors->first('hair_color') }}</p> @endif				
					   					</div>
					   				</div>

					   				<div class="form-group @if($errors->has('eye_color')) has-error @endif">
					   					<label class="control-label col-sm-6 col-md-6" for="eye_color">@lang('form_process_apply.lbl_eye')</label>
					   					<div class="col-sm-3 col-md-3">
					   						<input class="form-control" type="text" name="eye_color" id="eye-color"   value="{{ isset($applicant)  ? $applicant->eye_color :  old('eye_color')}}"  @if(isset($applicant)) disabled @endif>
					   						@if ($errors->has('eye_color')) <p class="help-block">{{ $errors->first('eye_color') }}</p> @endif
					   					</div>
					   				</div>

					   				<div class="form-group @if($errors->has('dairy_philosophy')) has-error @endif">
					   					<label class="col-sm-6 col-md-6 control-label" for="dairy_philosophy">@lang('form_process_apply.lbl_phil') </label>
					   					<div class="col-sm-6 col-md-6">
					   						<textarea class="form-control" name="dairy_philosophy" id="dairy_philosophy"@if(isset($applicant)) disabled @endif>{{isset($applicant)? $applicant->dairy_philosophy : old('dairy_philosophy')}}</textarea>
					   						@if ($errors->has('dairy_philosophy')) <p class="help-block">{{ $errors->first('dairy_philosophy') }}</p> @endif
					   					</div>
					   				</div>

					   				<div class="form-group @if($errors->has('why_would_you_win')) has-error @endif">
					   					<label class="col-sm-6 col-md-6 control-label" for="why_would_you_win">@lang('form_process_apply.lbl_win')</label>
					   					<div class="col-sm-6 col-md-6">
					   						<textarea class="form-control" name="why_would_you_win" id="why_would_you_win" @if(isset($applicant)) disabled @endif rezise>{{ isset($applicant)  ? $applicant->why_would_you_win :  old('why_would_you_win')}}</textarea>
					   						@if ($errors->has('why_would_you_win')) <p class="help-block">{{ $errors->first('why_would_you_win') }}</p> @endif
					   					</div>
					   				</div>
									
					   				@if(!isset($applicant)) 
						   				<div class="form-group @if($errors->has('applicant_face_photo')) has-error @endif">	
											<label class="control-label">@lang('form_process_apply.lbl_face_photo') <small class="text-warning">(@lang('form_process_apply.lbl_photo_format'))</small></label>
											<input type="file" name="applicant_face_photo" class="photo"  accept="image/*">
											@if ($errors->has('applicant_face_photo')) <p class="help-block">{{ $errors->first('applicant_face_photo') }}</p> @endif

										</div>
										<div class="form-group @if($errors->has('applicant_body_photo')) has-error @endif">
											<label class="control-label">@lang('form_process_apply.lbl_body_photo') <small class="text-warning">(@lang('form_process_apply.lbl_photo_format'))</small></label>
											<input type="file" name="applicant_body_photo"  accept="image/*" class="photo">
											@if ($errors->has('applicant_body_photo')) <p class="help-block">{{ $errors->first('applicant_body_photo') }}</p> @endif
										</div>
										@if ($errors->any())
											<div class="form-group has-error">
												<p class="help-block" style="font-size: 17px"><b>{{ trans('form_process_apply.has_any_error') }}</b></p>
											</div>
										@endif
					   				@else
					   					<img class="col-md-6 col-lg-6 col-xs-12 img-responsive" src="{{ asset($applicant->applicant_face_photo) }}" alt="{{$applicant->name}}" title="{{$applicant->name}}">
					   					<img class="col-md-6 col-lg-6 col-xs-12 img-responsive" src="{{ asset($applicant->applicant_body_photo)}} " alt="{{$applicant->name}}"  title="{{$applicant->name}}">
					   				@endif


					   				@if(!isset($applicant))
					   				<div class="form-group @if($errors->has('g-recaptcha-response')) has-error @endif" style="margin-left: 25%">
					   					{!! Recaptcha::render() !!}
					   					@if ($errors->has('g-recaptcha-response')) <p class="help-block">{{ $errors->first('g-recaptcha-response') }}</p> @endif
					   				</div>
					   				<hr>
					   				<div class="form-group">
					   					<button id="subscribe" type="submit" class="subscribe-button btn btn-primary btn-lg btn-block" id="save">@lang('form_process_apply.lbl_btn_ins')</button>
					   				</div>
					   				@endif
				   				</form>
			   				</div>
			   			</div>
			   		</div>
			   </div>
			   {{-- hola status --}}
			   <div role="tabpanel" class="tab-pane fade" id="status">
			   		<div class="process-content">
			   			<h3>@lang('form_process_apply.lbl_done')</h3>
			   			<div class="row">
			   				<div class="col-md-6 col-lg-6 text-center col-md-offset-3">
			   					<img class="image-responsibe" src="{{ asset('public/images/logo.png') }}" alt="{{config('app.name')}}" title="{{config('app.name')}}">
			   					<h4>@lang('form_process_apply.lbl_last-message')</h4>
			   				</div>
			   			</div>
			   		</div>
			   </div>
			 </div>
		</div>
	</div>
	
@endsection


@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('public/css/form-process.css') }}">
<style>
	textarea {
		resize: none
	}
</style>
@endsection


@section('js')
<script src="https://checkout.stripe.com/checkout.js"></script>
<script src="{{asset('/public/js/bootstrap-file-input/plugins/canvas-to-blob.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/public/js/bootstrap-file-input/plugins/purify.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/public/js/bootstrap-file-input/fileinput.js')}}" type="text/javascript"></script>
<script src="{{asset('/public/js/bootstrap-file-input/themes/fa/theme.js')}}" type="text/javascript"></script>
<script src="{{asset('/public/js/jquery-validation/dist/jquery.validate.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/public/js/bootstrap-file-input/locales/es.js')}}" type="text/javascript"></script>
<script type="text/javascript">

$(document).ready(function() {

	
	@if ($existApply->process_status == 1 )
    	window.location.hash = $("#country-tab a").attr('href');
    	// $('#process-tab a[href="#countries"]').tab('show');
    	$('#process-tab a:first').tab('show')

    @endif

    @if ($existApply->process_status == 2 ) 
    	window.location.hash = $("#pay-tab a").attr('href');
    	// $('#process-tab a[href="#pay"]').tab('show');
    	$('#process-tab a:first').tab('show')
    @endif

    @if ($existApply->process_status == 3 ) 
    	window.location.hash = $("#subscription-tab a").attr('href');
    	// $('#process-tab a[href="#aplication"]').tab('show');
    	$('#process-tab a:first').tab('show')
    @endif 

    @if ($existApply->process_status == 4 ) 
    	window.location.hash = $("#success-tab a").attr('href');
    	// $('#process-tab a[href="#status"]').tab('show');
    	$('#process-tab a:first').tab('show')
    @endif
   	

	var hash = window.location.hash;
  	hash && $('ul.nav a[href="' + hash + '"]').tab('show');

  
    $('a[data-toggle="tab"]').on('click', function(){
        if ($(this).parent('li').hasClass('disabled')) {
            return false;
        }
        var scrollmem = $('body').scrollTop() || $('html').scrollTop();
    	window.location.hash = this.hash;
    	$('html,body').scrollTop(scrollmem);
    });



    $(".country-audition").on('click', function(event) {
    	event.preventDefault();
    	var countryCode = $(this).data('code');
    	if(!countryCode) return false;
    	$(".country-audition").parent('li').removeClass('country-selected'); //remove all class
    	$(this).parent('li').addClass('country-selected');
    	//next tab
    	var hash = $('#process-tab li:eq(1) a').attr('href');
    	window.location.hash = hash;
    	$('#process-tab li:eq(1) a').tab('show') // Select third tab (0-indexed)
    	$("#pay-tab").removeClass('disabled');


    	$.ajax({
    		@if(App::isLocal())
    		url: '/apply/update-aplication-process',
    		@else
    		url: '../apply/update-aplication-process',
    		@endif
    		type: 'POST',
    		data: {
    			country_code: countryCode,
    			process_status: 2
    		}
    	});
    	
    });

    $(".pay-button").on('click', function(event) {
    	// var payment = $(this).data(payment);
    	// if(!payment) return false;
    	// //next tab
    	// var hash = $('#process-tab li:eq(2) a').attr('href');
    	// window.location.hash = hash;
    	// $('#process-tab li:eq(2) a').tab('show') // Select third tab (0-indexed)
    	// $("#subscription-tab").removeClass('disabled');
    });

    $(".subscribe-button").on('click',  function(event) {
    	// event.preventDefault();
    	// $('#process-tab li:eq(3) a').tab('show') // Select third tab (0-indexed)
    	// $("#subscription-tab").removeClass('disabled');
    });




    // stripe

   var handlerPay = StripeCheckout.configure({
	  key: '{{ config('services.stripe.key') }}',
	  image: '{{ asset('public/images/queen-mini.png') }}',
	  locale: 'auto',
	  name: '{{ config('app.name') }}',
	  description : 'Pay Apply Process Miss Panamerican Int',
	  token : function(token){
	  	$("#stripe-pay-token").val(token.id);
	  	//submit the magic form :3
	  	$("#pay-stripe-aplication").submit();
	  }
	});

   	$("#pay-aplication-stripe").on('click', function(event) {
   		event.preventDefault();
   		var _this = $(this);
      	handlerPay.open({
    		description: _this.data('description'),
    		amount: _this.data('amount'),
    		email: _this.data('email')
  		});
   		/* Act on the event */
   	});


   	$("#height_type_measure").on('change', function(event) {
   		var value = $(this).val();
   		if(value == 'cm') {
   			$("#height").attr({
   				// min: '1.67',
   				// value: '1.67'
   			});
   		} else {
   			$("#height").attr({
   				// min: '5.5',
   				// value: '5.5'
   			});
   		}
   	});	

   	$("#weight_type_measure").on('change', function(event) {
   		var value = $(this).val();
   		if(value == 'lb') {
   			$("#weight").attr({
   				min: '104',
   				value: '104'
   			});
   		} else {
   			$("#weight").attr({
   				min: '57',
   				value: '57'
   			});
   		}
   	});

 //   	 $("#height").keydown(function (e) {
 //        // Allow: backspace, delete, tab, escape, enter and .
 //        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
 //             // Allow: Ctrl+A, Command+A
 //            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
 //             // Allow: home, end, left, right, down, up
 //            (e.keyCode >= 35 && e.keyCode <= 40)) {
 //                 // let it happen, don't do anything
 //                 return;
 //        }
 //        // Ensure that it is a number and stop the keypress
 //        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
 //            e.preventDefault();
 //        }
 //    });
	
	// $("#weight").keydown(function (e) {
 //        // Allow: backspace, delete, tab, escape, enter and .
 //        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
 //             // Allow: Ctrl+A, Command+A
 //            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
 //             // Allow: home, end, left, right, down, up
 //            (e.keyCode >= 35 && e.keyCode <= 40)) {
 //                 // let it happen, don't do anything
 //                 return;
 //        }
 //        // Ensure that it is a number and stop the keypress
 //        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
 //            e.preventDefault();
 //        }
 //    });


});

	 // Close Checkout on page navigation:
	window.addEventListener('popstate', function() {
  		handlerPay.close();
	});

</script>

@endsection()

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('/public/css/bootstrap-file-input/fileinput.min.css') }}">
<style>
	textarea {
		resize: none
	}
</style>
@endsection()
