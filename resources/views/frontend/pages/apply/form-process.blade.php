@extends('layouts.frontend')
@section('content')
	<div class="row">
		<h1 class="text-center">PROCESO DE APLICACIÓN</h1>
	</div>
	<div class="row">
		<div class="col-md-12 col-xs-12 col-lg-,12">
			<!-- Nav tabs -->
			 <ul id="process-tab" class="nav nav-tabs" role="tablist">
			   <li id="country-tab" role="presentation" class="@if($existApply->process_status == 1) active @endif">
			   		<a href="#countries" aria-controls="countries" role="tab" data-toggle="tab">País</a>
			   	</li>
			   <li id="pay-tab" role="presentation" class="@if($existApply->process_status <= 1) disabled @endif  @if($existApply->process_status == 2) active @endif">
			   		<a href="#pay" aria-controls="pay" role="tab" data-toggle="tab">Tasa de Solicitud</a>
			   	</li>
			   <li id="subscription-tab" role="presentation" class="@if($existApply->process_status <= 2) disabled @endif @if($existApply->process_status == 3) active @endif">
			   		<a href="#aplication" aria-controls="aplication" role="tab" data-toggle="tab">Aplicación Online</a>
			   	</li>
			   <li id="success-tab" role="presentation" class="@if($existApply->process_status <= 3) disabled @endif @if($existApply->process_status == 4) active @endif">
			   		<a href="#status" aria-controls="status" role="tab" data-toggle="tab">Estado</a>
			   	</li>
			 </ul>

			 <!-- Tab panes -->
			 <div class="tab-content">
			 	{{-- countries --}}
			   <div role="tabpanel" class="tab-pane fade in active" id="countries">
			   		<div class="process-content">
				   		<p><b>1.- Seleccione el país al que desea audicionar</b></p>
				   		<div class="row">
				   			<div class="col-md-12 col-lg-12">
				   				@if ($existApply->process_status < 3)
					   				<ul class="list-unstyled list-inline text-center" id="menu-countries">
					   					<li @if($existApply->country_code_selected == 'US') class="country-selected" @endif>
					   						<a class="country-audition" href="#" data-code="US" title="Estados Unidos" alt="Estados Unidos"><img class="image-responsive" src="{{ asset('public/images/eeuu_flag.png') }}"> <br> Estados Unidos</a> 
					   					</li>
					   					<li @if($existApply->country_code_selected == 'MX') class="country-selected" @endif>
					   						<a class="country-audition" href="#" data-code="MX" title="México" alt="México"><img class="image-responsive" src="{{ asset('public/images/mx_flag.png') }}"> <br> México</a> 
					   					</li>
					   					<li @if($existApply->country_code_selected == 'HN') class="country-selected" @endif>
					   						<a class="country-audition" href="#" data-code="HN" title="Honduras" alt="Honduras"><img class="image-responsive" src="{{ asset('public/images/ho_flag.png') }}"> <br> Honduras</a> 
					   					</li>
					   					<li @if($existApply->country_code_selected == 'GT') class="country-selected" @endif>
					   						<a class="country-audition" href="#" data-code="GT" title="Guatemala" alt="Guatemala" title=""><img class="image-responsive" src="{{ asset('public/images/gu_flag.png') }}"> <br> Guatemala</a> 
					   					</li>
					   					<li @if($existApply->country_code_selected == 'SV') class="country-selected" @endif>
					   						<a class="country-audition" href="#" data-code="SV" title="El Salvador" alt="El Salvador"><img class="image-responsive" src="{{ asset('public/images/sl_flag.png') }}"> <br> El Salvador</a> 
					   					</li>
					   				</ul>
				   				@else
				   					<ul class="list-unstyled list-inline text-center" id="">
					   					<li @if($existApply->country_code_selected == 'US') class="country-selected" @endif>
					   						<img class="image-responsive clickable" src="{{ asset('public/images/eu_flag.png') }}"> <br> Estados Unidos</a> 
					   					</li>
					   					<li @if($existApply->country_code_selected == 'MX') class="country-selected" @endif>
					   						<img class="image-responsive" src="{{ asset('public/images/mx_flag.png') }}"> <br> México
					   					</li>
					   					<li @if($existApply->country_code_selected == 'HN') class="country-selected" @endif>
					   						<img class="image-responsive" src="{{ asset('public/images/ho_flag.png') }}"> <br> Honduras
					   					</li>
					   					<li @if($existApply->country_code_selected == 'GT') class="country-selected" @endif>
					   						<img class="image-responsive" src="{{ asset('public/images/gu_flag.png') }}"> <br> Guatemala
					   					</li>
					   					<li @if($existApply->country_code_selected == 'SV') class="country-selected" @endif>
					   						<img class="image-responsive" src="{{ asset('public/images/sl_flag.png') }}"> <br> El Salvador
					   					</li>
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
			   					<h2 class="text-center text-success"> Gracias por su pago. </h2>
			   				</div>
			   			@else
			   			<p>
			   				<b>2.- Por favor complete nuestra solicitud en línea. La cuota de la aplicación es de $60.00 </b> <br>
			   				<small><b>También puede llenar la solicitud en persona los días del casting, pero le costará $80.00</b></small>
			   			</p>
			   			<div class="row">
					   			<div class="col-md-4 col-lg-4 col-sm-8 col-xs-12 col-md-offset-4 text-center">
					   				<h2 id="price-insciption"><small>$</small> 60.00 <br> <small> USD </small></h2>
					   				<form action="{{ route('pay.paypal.aplication') }}" method="POST" accept-charset="utf-8">
					   					{{ csrf_field() }}
					   					<button type="submit" class="btn btn-primary btn-lg btn-block pay-button" data-payment="paypal"><i class="fa fa-paypal"> </i> <b>Pagar con Paypal</b></button>
					   					
					   				</form>
					   				<h3>O</h3>
					   				<form id="pay-stripe-aplication" action="{{ route('pay.stripe.aplication') }}" method="post">
					   					{{ csrf_field() }}
					   					<input type="hidden" name="stripeToken" id="stripe-pay-token">
					   					<input type="hidden" name="amount" value="6000">
					   					<input type="hidden" name="description" value="Pay Apply Process Miss Panamerican Int">
					   					<button type="button" id="pay-aplication-stripe" class="btn btn-default btn-lg btn-block pay-button" data-email="{{Auth::user()->email}}" data-amount="6000" data-description="Pay Apply Process Miss Panamerican Int"><i class="fa fa-credit-card"> </i> <b>Pagar Con tarjeta de crédito</b></button>
					   					
					   				</form>
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
			   			<p><b>3.- Por favor llenar todos los campos requeridos cuidadosamente.</b> </p>
			   			<hr>
			   			<div class="row">
			   				<div class="col-md-7 col-lg-7 col-sm-12 col-xs-12 col-md-offset-2">
				   				<form action="{{ route('insert.precandidate') }}" method="POST" class="form-horizontal">
				   					{{ csrf_field() }}
				   					@if ($countryselected)
				   						<input type="hidden" name="country_id" value="{{$countryselected}}">
				   					@endif
				   						<input type="hidden" name="is_precandidate" value="1">
				   					<div class="form-group @if($errors->has('name')) has-error @endif">
				   						<label class="control-label col-sm-6 col-md-6 ">Nombre </label>
				   						<div class="col-sm-6 col-md-6">
											<input type="text" class="form-control" name="name" value="{{ isset($precandidate) ?  $precandidate->name :   Auth::user()->name }}" autofocus @if(isset($precandidate)) disabled @endif>
												@if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
				   						</div>
				   					</div>

				   					<div class="form-group  @if($errors->has('last_name')) has-error @endif">
				   						<label class="control-label col-sm-6 col-md-6">Apellido </label>
				   						<div class="col-sm-6 col-md-6">
											<input type="text" class="form-control" name="last_name" value="{{ isset($precandidate) ? $precandidate->last_name : Auth::user()->last_name  }}"  @if(isset($precandidate)) disabled @endif>
												@if ($errors->has('last_name')) <p class="help-block">{{ $errors->first('last_name') }}</p> @endif
				   						</div>
				   					</div>

				   					<div class="form-group @if($errors->has('birthdate')) has-error @endif">
				   						<label class="control-label col-sm-6 col-md-6">Fecha de nacimiento </label>
				   						<div class="col-sm-6 col-md-6">
					   						<input type="date" class="form-control"  name="birthdate" value="{{ isset($precandidate) ? $precandidate->birthdate : old('birthdate') }}" @if(isset($precandidate)) disabled @endif>
					   						@if ($errors->has('birthdate')) <p class="help-block">{{ $errors->first('birthdate') }}</p> @endif
				   						</div>
				   					</div>

				   					<div class="form-group @if($errors->has('placebirth')) has-error @endif">
					   					<label class="control-label col-sm-6 col-md-6">Lugar de nacimiento </label>
					   					<div class="col-sm-6 col-md-6">
						   					<input type="text" class="form-control" name="placebirth" value="{{ isset($precandidate) ? $precandidate->placebirth : old('placebirth') }}" @if(isset($precandidate)) disabled @endif>
						   					@if ($errors->has('placebirth')) <p class="help-block">{{ $errors->first('placebirth') }}</p> @endif
					   					</div>
					   				</div>

					   				<div class="form-group @if($errors->has('email')) has-error @endif">
					   					<label class="control-label col-sm-6 col-md-6" for="email">Email </label>
					   					<div class="col-sm-6 col-md-6">
						   					<input class="form-control" type="email" name="email" id="email" value="{{ isset($precandidate) ? $precandidate->email  : Auth::user()->email }}" readonly>
						   					@if ($errors->has('email')) <p class="help-block">{{ $errors->first('email') }}</p> @endif
					   					</div>
					   				</div>

					   				<div class="form-group @if($errors->has('phone_number')) has-error @endif">
					   					<label class="control-label col-sm-6 col-md-6" for="phone_number">Número teléfonico </label>
					   					<div class="col-sm-6 col-md-6">
						   					<input type="text" class="form-control" name="phone_number" id="phone_number" value="{{ isset($precandidate) ?  $precandidate->phone_number : old('phone_number') }}" @if(isset($precandidate)) disabled @endif>
						   					@if ($errors->has('phone_number')) <p class="help-block">{{ $errors->first('phone_number') }}</p> @endif
					   					</div>
					   				</div>

					   				<div class="form-group @if($errors->has('how_did_you_hear_about_us')) has-error @endif">
					   					<label class="control-label col-sm-6 col-md-6" for="how_did_you_hear_about_us">¿Como escuchó de nosotros? </label>
					   					<div class="col-sm-6 col-md-6">
					   						<select class="form-control" name="how_did_you_hear_about_us" id="how_did_you_hear_about_us" @if(isset($precandidate)) selected @endif>
					   							<option value="null">--Seleccione--</option>
					   							<option value="brochure" @if( (isset($precandidate) && $precandidate->how_did_you_hear_about_us == 'brochure') || old('how_did_you_hear_about_us') == 'brochure') selected @endif>Brochure</option>
					   							<option value="facebook"  @if( (isset($precandidate) && $precandidate->how_did_you_hear_about_us == 'facebook') || old('how_did_you_hear_about_us') == 'facebook') selected @endif>Facebook</option>
					   							<option value="friend" @if( (isset($precandidate) && $precandidate->how_did_you_hear_about_us == 'friend') || old('how_did_you_hear_about_us') == 'friend') selected @endif>Friend</option>
					   							<option value="former_constentant" @if( (isset($precandidate) && $precandidate->how_did_you_hear_about_us == 'former_constentant') || old('how_did_you_hear_about_us') == 'former_constentant') selected @endif>Former Constentant</option>
					   							<option value="online_ad"  @if( (isset($precandidate) && $precandidate->how_did_you_hear_about_us == 'online_ad') || old('how_did_you_hear_about_us') == 'online_ad') selected @endif>Online AD</option>
					   							<option value="school_teacher" @if( (isset($precandidate) && $precandidate->how_did_you_hear_about_us == 'school_teacher') || old('how_did_you_hear_about_us') == 'school_teacher') selected @endif>School Teacher/Coach</option>
					   							<option value="website_google" @if( (isset($precandidate) && $precandidate->how_did_you_hear_about_us == 'website_google') || old('how_did_you_hear_about_us') == 'website_google') selected @endif>Website / Google Search</option>
					   						</select>
					   						@if ($errors->has('how_did_you_hear_about_us')) <p class="help-block">{{ $errors->first('how_did_you_hear_about_us') }}</p> @endif
					   					</div>
					   				</div>

					   				<div class="form-group @if($errors->has('height')) has-error @endif">
					   					<label class="control-label col-sm-6 col-md-6" for="height">Estatura</label>
					   					<div class="col-sm-2 col-md-2">
					   						<select name="height_type_measure" id="height_type_measure" class="form-control" @if(isset($precandidate)) disabled @endif>
					   							<option value="cm" @if( (isset($precandidate) && $precandidate->height_type_measure == 'cm') || old('height_type_measure') == 'cm') selected @endif>cm</option>
					   							<option value="ft" @if( (isset($precandidate) && $precandidate->height_type_measure == 'ft') || old('height_type_measure') == 'ft') selected @endif>ft</option>
					   						</select>
											@if ($errors->has('height')) <p class="help-block">{{ $errors->first('height') }}</p> @endif
					   					</div>
					   					<div class="col-sm-3 col-md-3">
						   					<input type="number" id="height" step="0.00"  min="1.67" name="height" id="height" class="form-control" value="{{ isset($precandidate)  ? $precandidate->height :  1.67}}"  @if(isset($precandidate)) disabled @endif>
							@if ($errors->has('height')) <p class="help-block">{{ $errors->first('height') }}</p> @endif
					   					</div>
					   				</div>

					   				<div class="form-group @if($errors->has('weight')) has-error @endif">
					   					<label class="control-label col-sm-6 col-md-6" for="weight">Peso</label>
					   					<div class="col-sm-2 col-md-2">
					   						<select name="weight_type_measure" id="weight_type_measure" class="form-control" @if(isset($precandidate)) disabled @endif>
					   							<option value="lb" @if( (isset($precandidate) && $precandidate->weight_type_measure == 'lb') || old('weight_type_measure') == 'lb') selected @endif>lb</option>
					   							<option value="kg" @if( (isset($precandidate) && $precandidate->weight_type_measure == 'kg') || old('weight_type_measure') == 'kg') selected @endif>kg</option>
					   						</select>
											@if ($errors->has('weight_type_measure')) <p class="help-block">{{ $errors->first('weight_type_measure') }}</p> @endif
					   					</div>
					   					<div class="col-sm-3 col-md-3">
					   						<input type="number" step="1" min="104" name="weight" id="weight" class="form-control" value="{{ isset($precandidate)  ? $precandidate->weight :  104 }}"  @if(isset($precandidate)) disabled @endif>
											@if ($errors->has('weight')) <p class="help-block">{{ $errors->first('weight') }}</p> @endif
					   					</div>
					   				</div>

					   				<div class="form-group @if($errors->has('address')) has-error @endif">
					   					<label class="control-label col-sm-6 col-md-6" for="address">Dirección </label>
					   					<div class="col-sm-6 col-md-6">
						   					<input type="text" id="address" class="form-control" name="address" value="{{ isset($precandidate) && $precandidate->address ?  $precandidate->address : old('address') }}" @if(isset($precandidate)) disabled @endif>
						   					@if ($errors->has('address')) <p class="help-block">{{ $errors->first('address') }}</p> @endif
					   					</div>
					   				</div>

					   				<div class="form-group @if($errors->has('city')) has-error @endif">
					   					<label class="control-label col-sm-6 col-md-6" for="city">Ciudad </label>
					   					<div class="col-sm-6 col-md-6">
					   						<input type="text" class="form-control" name="city" value="{{ isset($precandidate) && $precandidate->city ?  $precandidate->city : old('city') }}" @if(isset($precandidate)) disabled @endif>
					   						@if ($errors->has('address')) <p class="help-block">{{ $errors->first('city') }}</p> @endif
					   					</div>
					   				</div>

					   				<div class="form-group @if($errors->has('state_province')) has-error @endif">
					   					<label class="control-label col-sm-6 col-md-6" for="state_province">Estado / Provincia  </label>
					   					<div class="col-sm-6 col-md-6">
					   						<input type="text" class="form-control" id="state_province" name="state_province" value="{{ isset($precandidate) && $precandidate->state_province ?  $precandidate->state_province : old('state_province') }}" @if(isset($precandidate)) disabled @endif>
					   						@if ($errors->has('state_province')) <p class="help-block">{{ $errors->first('state_province') }}</p> @endif
					   					</div>
					   				</div>

					   				<div class="form-group @if($errors->has('bust_measure')) has-error @endif">
					   					<label class="control-label col-sm-6 col-md-6" for="bust_measure">Busto (cm)</label>
					   					<div class="col-sm-3 col-md-3">
					   						<input type="number" name="bust_measure" id="bust_measure" class="form-control" value="{{ isset($precandidate)  ? $precandidate->bust_measure :  old('bust_measure')}}"  @if(isset($precandidate)) disabled @endif> 
					   						@if ($errors->has('bust_measure')) <p class="help-block">{{ $errors->first('bust_measure') }} </p> @endif
					   					</div>
					   				</div>

					   				<div class="form-group @if($errors->has('waist_measure')) has-error @endif">
					   					<label class="control-label col-sm-6 col-md-6" for="waist_measure">Cintura (cm)</label>
					   					<div class="col-sm-3 col-md-3">
					   						<input type="number" name="waist_measure" id="waist_measure" class="form-control" value="{{ isset($precandidate)  ? $precandidate->waist_measure :  old('waist_measure')}}"  @if(isset($precandidate)) disabled @endif>
					   						@if ($errors->has('waist_measure')) <p class="help-block">{{ $errors->first('waist_measure') }}</p> @endif
					   					</div>
					   				</div>

					   				<div class="form-group @if($errors->has('hip_measure')) has-error @endif">
					   					<label class="control-label col-sm-6 col-md-6" for="hip_measure">Cadera (cm)</label>
					   					<div class="col-sm-3 col-md-3">
					   						<input type="number" name="hip_measure" id="hip_measure" class="form-control" value="{{ isset($precandidate)  ? $precandidate->hip_measure :  old('hip_measure')}}"  @if(isset($precandidate)) disabled @endif>
					   						@if ($errors->has('hip_measure')) <p class="help-block">{{ $errors->first('waist_measure') }}</p> @endif
					   					</div>
					   				</div>

					   				<div class="form-group @if($errors->has('hair_color')) has-error @endif">
					   					<label class="control-label col-sm-6 col-md-6" for="hair_color">Color de cabello</label>
					   					<div class="col-sm-3 col-md-3">
						   					<input class="form-control" type="text" name="hair_color" id="hair-color"   value="{{ isset($precandidate)  ? $precandidate->hair_color :  old('hair_color')}}"  @if(isset($precandidate)) disabled @endif>
						   					@if ($errors->has('hair_color')) <p class="help-block">{{ $errors->first('hair_color') }}</p> @endif				
					   					</div>
					   				</div>

					   				<div class="form-group @if($errors->has('eye_color')) has-error @endif">
					   					<label class="control-label col-sm-6 col-md-6" for="eye_color">Color de ojos</label>
					   					<div class="col-sm-3 col-md-3">
					   						<input class="form-control" type="text" name="eye_color" id="eye-color"   value="{{ isset($precandidate)  ? $precandidate->eye_color :  old('eye_color')}}"  @if(isset($precandidate)) disabled @endif>
					   						@if ($errors->has('eye_color')) <p class="help-block">{{ $errors->first('eye_color') }}</p> @endif
					   					</div>
					   				</div>

					   				<div class="form-group @if($errors->has('dairy_philosophy')) has-error @endif">
					   					<label class="col-sm-6 col-md-6 control-label" for="dairy_philosophy">Filosofía Diaria </label>
					   					<div class="col-sm-6 col-md-6">
					   						<textarea class="form-control" name="dairy_philosophy" id="dairy_philosophy"@if(isset($precandidate)) disabled @endif>{{isset($precandidate)? $precandidate->dairy_philosophy : old('dairy_philosophy')}}</textarea>
					   						@if ($errors->has('dairy_philosophy')) <p class="help-block">{{ $errors->first('dairy_philosophy') }}</p> @endif
					   					</div>
					   				</div>

					   				<div class="form-group @if($errors->has('why_would_you_win')) has-error @endif">
					   					<label class="col-sm-6 col-md-6 control-label" for="why_would_you_win">Porque te gustaría ganar el {{config('app.name')}} ? </label>
					   					<div class="col-sm-6 col-md-6">
					   						<textarea class="form-control" name="why_would_you_win" id="why_would_you_win" @if(isset($precandidate)) disabled @endif rezise>{{ isset($precandidate)  ? $precandidate->why_would_you_win :  old('why_would_you_win')}}</textarea>
					   						@if ($errors->has('why_would_you_win')) <p class="help-block">{{ $errors->first('why_would_you_win') }}</p> @endif
					   					</div>
					   				</div>

					   				@if(!isset($precandidate))
					   				<div class="form-group @if($errors->has('g-recaptcha-response')) has-error @endif" style="margin-left: 25%">
					   					{!! Recaptcha::render() !!}
					   					@if ($errors->has('g-recaptcha-response')) <p class="help-block">{{ $errors->first('g-recaptcha-response') }}</p> @endif
					   				</div>
					   				<hr>
					   				<div class="form-group">
					   					<button id="subscribe" type="submit" class="subscribe-button btn btn-primary btn-lg btn-block" id="save">Inscribirme</button>
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
			   			<h3>¡Felicitaciones! Su inscripción está completa.</h3>
			   			<div class="row">
			   				<div class="col-md-6 col-lg-6 text-center col-md-offset-3">
			   					<img class="image-responsibe" src="{{ asset('public/images/logo.png') }}" alt="{{config('app.name')}}" title="{{config('app.name')}}">
			   					<h4>Su número de identificación de casting y toda la información que necesita saber fue enviada a su correo electrónico. Compruébelo y buena suerte. ¡Te esperamos!.</h4>
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
    		url: '/apply/update-aplication-process',
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
   				min: '1.67',
   				value: '1.67'
   			});
   		} else {
   			$("#height").attr({
   				min: '5.5',
   				value: '5.5'
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


});

	 // Close Checkout on page navigation:
	window.addEventListener('popstate', function() {
  		handlerPay.close();
	});

</script>
@endsection()

@section('css')
<style>
	textarea {
		resize: none
	}
</style>
@endsection()
