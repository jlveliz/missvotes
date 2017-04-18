@extends('layouts.frontend')
@section('content')
	<div class="row">
		<h1 class="text-center">PROCESO DE APLICACIÓN</h1>
	</div>
	<div class="row">
		<div class="col-md-12 col-xs-12 col-lg-12">
			<!-- Nav tabs -->
			 <ul id="process-tab" class="nav nav-tabs" role="tablist">
			   <li id="country-tab" role="presentation" class="@if($existApply->process_status == 1) active @endif">
			   		<a href="#countries" aria-controls="countries" role="tab" data-toggle="tab">País</a>
			   	</li>
			   <li id="pay-tab" role="presentation" class="@if($existApply->process_status <= 2) disabled @endif  @if($existApply->process_status == 2) active @endif">
			   		<a href="#pay" aria-controls="pay" role="tab" data-toggle="tab">Tasa de solicitud</a>
			   	</li>
			   <li id="subscription-tab" role="presentation" class="@if($existApply->process_status <= 3) disabled @endif @if($existApply->process_status == 3) active @endif">
			   		<a href="#aplication" aria-controls="aplication" role="tab" data-toggle="tab">Aplicación Online</a>
			   	</li>
			   <li id="success-tab" role="presentation" class="@if($existApply->process_status <= 4) disabled @endif @if($existApply->process_status == 4) active @endif">
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
				   				<ul class="list-unstyled list-inline text-center" id="menu-countries">
				   					<li>
				   						<a class="country-audition" href="#" data-code="US" title="Estados Unidos" alt="Estados Unidos"><img class="image-responsive" src="{{ asset('public/images/eu_flag.png') }}"> <br> Estados Unidos</a> 
				   					</li>
				   					<li>
				   						<a class="country-audition" href="#" data-code="MX" title="México" alt="México"><img class="image-responsive" src="{{ asset('public/images/mx_flag.png') }}"> <br> México</a> 
				   					</li>
				   					<li>
				   						<a class="country-audition" href="#" data-code="HN" title="Honduras" alt="Honduras"><img class="image-responsive" src="{{ asset('public/images/ho_flag.png') }}"> <br> Honduras</a> 
				   					</li>
				   					<li>
				   						<a class="country-audition" href="#" data-code="GT" title="Guatemala" alt="Guatemala" title=""><img class="image-responsive" src="{{ asset('public/images/gu_flag.png') }}"> <br> Guatemala</a> 
				   					</li>
				   					<li>
				   						<a class="country-audition" href="#" data-code="SV" title="El Salvador" alt="El Salvador"><img class="image-responsive" src="{{ asset('public/images/sl_flag.png') }}"> <br> El Salvador</a> 
				   					</li>
				   				</ul>
				   			</div>
				   		</div>
			   		</div>
			   </div>
			   {{-- pay --}}
			   <div role="tabpanel" class="tab-pane fade" id="pay">
			   		<div class="process-content">
			   			<p>
			   				<b>2.- Por favor complete nuestra solicitud en línea, la cuota de la solicitud esde $60.00 </b> <br>
			   				<small><b>También puede llenar la solicitud en persona los días del casting, pero le costará $80.00</b></small>
			   			</p>
			   			<div class="row">
				   			<div class="col-md-4 col-lg-4 col-sm-8 col-xs-12 col-md-offset-4 text-center">
				   				<h2 id="price-insciption"><small>$</small> 60.00 <br> <small> USD </small></h2>
				   				<button type="button" class="btn btn-primary btn-lg btn-block pay-button" data-payment="paypal"><i class="fa fa-paypal"> </i> <b>Pagar con Paypal</b></button>
				   				<h3>O</h3>
				   				<button type="button" class="btn btn-default btn-lg btn-block pay-button" data-payment="credit-card"><i class="fa fa-credit-card"> </i> <b>Pagar Con tarjeta de crédito</b></button>
				   			</div>
			   			</div>
			   		</div>
			   </div>
			   {{-- aplication --}}
			   <div role="tabpanel" class="tab-pane fade" id="aplication">
			   		<div class="process-content">
			   			<p><b>3.- Por favor llenar todos los campos requeridos cuidadosamente.</b> </p>
			   			<hr>
			   			<div class="row">
			   				<div class="col-md-7 col-lg-7 col-sm-12 col-xs-12 col-md-offset-2">
				   				<form action="" method="POST" class="form-horizontal">
				   					
				   					<div class="form-group @if($errors->has('name')) has-error @endif">
				   						<label class="control-label col-sm-6 col-md-6 ">Nombre </label>
				   						<div class="col-sm-6 col-md-6">
											<input type="text" class="form-control" name="name" value="{{ old('name') }}" autofocus>
												@if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
				   						</div>
				   					</div>

				   					<div class="form-group  @if($errors->has('last_name')) has-error @endif">
				   						<label class="control-label col-sm-6 col-md-6">Apellido </label>
				   						<div class="col-sm-6 col-md-6">
											<input type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" autofocus>
												@if ($errors->has('last_name')) <p class="help-block">{{ $errors->first('last_name') }}</p> @endif
				   						</div>
				   					</div>

				   					<div class="form-group @if($errors->has('birthdate')) has-error @endif">
				   						<label class="control-label col-sm-6 col-md-6">Fecha de nacimiento </label>
				   						<div class="col-sm-6 col-md-6">
					   						<input type="date" class="form-control"  name="birthdate" value="{{ old('birthdate') }}">
					   						@if ($errors->has('birthdate')) <p class="help-block">{{ $errors->first('birthdate') }}</p> @endif
				   						</div>
				   					</div>

				   					<div class="form-group @if($errors->has('placebirth')) has-error @endif">
					   					<label class="control-label col-sm-6 col-md-6">Lugar de nacimiento </label>
					   					<div class="col-sm-6 col-md-6">
						   					<input type="text" class="form-control" name="placebirth" value="{{ old('placebirth') }}">
						   					@if ($errors->has('placebirth')) <p class="help-block">{{ $errors->first('placebirth') }}</p> @endif
					   					</div>
					   				</div>

					   				<div class="form-group @if($errors->has('email')) has-error @endif">
					   					<label class="control-label col-sm-6 col-md-6" for="email">Email </label>
					   					<div class="col-sm-6 col-md-6">
						   					<input class="form-control" type="email" name="email" id="email" value="{{ old('email') }}">
						   					@if ($errors->has('email')) <p class="help-block">{{ $errors->first('email') }}</p> @endif
					   					</div>
					   				</div>

					   				<div class="form-group @if($errors->has('phone_number')) has-error @endif">
					   					<label class="control-label col-sm-6 col-md-6" for="phone_number">Número teléfonico </label>
					   					<div class="col-sm-6 col-md-6">
						   					<input type="text" class="form-control" name="phone_number" id="phone_number" value="{{ old('phone_number') }}">
						   					@if ($errors->has('phone_number')) <p class="help-block">{{ $errors->first('phone_number') }}</p> @endif
					   					</div>
					   				</div>

					   				<div class="form-group @if($errors->has('how_did_you_hear_about_us')) has-error @endif">
					   					<label class="control-label col-sm-6 col-md-6" for="how_did_you_hear_about_us">Como escuchaste de nosotros? </label>
					   					<div class="col-sm-6 col-md-6">
					   						<select class="form-control" name="how_did_you_hear_about_us" id="how_did_you_hear_about_us">
					   							<option value="null">--Seleccione--</option>
					   							<option value="brochure">Brochure</option>
					   							<option value="facebook">Facebook</option>
					   							<option value="friend">Friend</option>
					   							<option value="former_constentant">Former Constentant</option>
					   							<option value="la_sf_casting">LA/SF Casting</option>
					   							<option value="online_ad">Online AD</option>
					   							<option value="school_teacher">School Teacher/Coach</option>
					   							<option value="website_google">Website / Google Search</option>
					   						</select>
					   						@if ($errors->has('how_did_you_hear_about_us')) <p class="help-block">{{ $errors->first('how_did_you_hear_about_us') }}</p> @endif
					   					</div>
					   				</div>

					   				<div class="form-group @if($errors->has('height')) has-error @endif">
					   					<label class="control-label col-sm-6 col-md-6" for="height">Estatura (Cm) </label>
					   					<div class="col-sm-3 col-md-3">
						   					<input type="number" id="height" step="any" min="0.00" name="height" id="height" class="form-control" value="{{old('height')}}">
							@if ($errors->has('height')) <p class="help-block">{{ $errors->first('height') }}</p> @endif
					   					</div>
					   				</div>

					   				<div class="form-group @if($errors->has('weight')) has-error @endif">
					   					<label class="control-label col-sm-6 col-md-6" for="weight">Peso (Kg) </label>
					   					<div class="col-sm-3 col-md-3">
					   						<input type="number" step="any" min="0.00" name="weight" id="weight" class="form-control" value="{{old('weight')}}">
						@if ($errors->has('weight')) <p class="help-block">{{ $errors->first('weight') }}</p> @endif
					   					</div>
					   				</div>

					   				<div class="form-group @if($errors->has('address')) has-error @endif">
					   					<label class="control-label col-sm-6 col-md-6" for="address">Dirección </label>
					   					<div class="col-sm-6 col-md-6">
						   					<input type="text" id="address" class="form-control" name="address" value="{{ old('address') }}">
						   					@if ($errors->has('address')) <p class="help-block">{{ $errors->first('address') }}</p> @endif
					   					</div>
					   				</div>

					   				<div class="form-group @if($errors->has('city')) has-error @endif">
					   					<label class="control-label col-sm-6 col-md-6" for="city">Ciudad </label>
					   					<div class="col-sm-6 col-md-6">
					   						<input type="text" class="form-control" name="city" value="{{ old('city') }}">
					   						@if ($errors->has('address')) <p class="help-block">{{ $errors->first('city') }}</p> @endif
					   					</div>
					   				</div>

					   				<div class="form-group @if($errors->has('state_province')) has-error @endif">
					   					<label class="control-label col-sm-6 col-md-6" for="state_province">Estado / Provincia  </label>
					   					<div class="col-sm-6 col-md-6">
					   						<input type="text" class="form-control" id="state_province" name="state_province" value="{{ old('state_province') }}">
					   						@if ($errors->has('state_province')) <p class="help-block">{{ $errors->first('state_province') }}</p> @endif
					   					</div>
					   				</div>

					   				<div class="form-group @if($errors->has('bust_measure')) has-error @endif">
					   					<label class="control-label col-sm-6 col-md-6" for="bust_measure">Busto</label>
					   					<div class="col-sm-3 col-md-3">
					   						<input type="number" name="bust_measure" id="bust_measure" class="form-control" value="{{old('bust_measure')}}">
					   						@if ($errors->has('bust_measure')) <p class="help-block">{{ $errors->first('bust_measure') }}</p> @endif
					   					</div>
					   				</div>

					   				<div class="form-group @if($errors->has('waist_measure')) has-error @endif">
					   					<label class="control-label col-sm-6 col-md-6" for="waist_measure">Cintura</label>
					   					<div class="col-sm-3 col-md-3">
					   						<input type="number" name="waist_measure" id="waist_measure" class="form-control" value="{{old('waist_measure')}}">
					   						@if ($errors->has('waist_measure')) <p class="help-block">{{ $errors->first('waist_measure') }}</p> @endif
					   					</div>
					   				</div>

					   				<div class="form-group @if($errors->has('hip_measure')) has-error @endif">
					   					<label class="control-label col-sm-6 col-md-6" for="hip_measure">Cadera</label>
					   					<div class="col-sm-3 col-md-3">
					   						<input type="number" name="hip_measure" id="hip_measure" class="form-control" value="{{old('waist_measure')}}">
					   						@if ($errors->has('hip_measure')) <p class="help-block">{{ $errors->first('waist_measure') }}</p> @endif
					   					</div>
					   				</div>

					   				<div class="form-group @if($errors->has('hair_color')) has-error @endif">
					   					<label class="control-label col-sm-6 col-md-6" for="hair_color">Color de cabello</label>
					   					<div class="col-sm-3 col-md-3">
						   					<input class="form-control" type="text" name="hair_color" id="hair-color"   value="{{ old('hair_color') }}">
						   					@if ($errors->has('hair_color')) <p class="help-block">{{ $errors->first('hair_color') }}</p> @endif				
					   					</div>
					   				</div>

					   				<div class="form-group @if($errors->has('eye_color')) has-error @endif">
					   					<label class="control-label col-sm-6 col-md-6" for="eye_color">Color de ojos</label>
					   					<div class="col-sm-3 col-md-3">
					   						<input class="form-control" type="text" name="eye_color" id="eye-color"   value="{{ old('eye_color') }}">
					   						@if ($errors->has('eye_color')) <p class="help-block">{{ $errors->first('eye_color') }}</p> @endif
					   					</div>
					   				</div>

					   				<div class="form-group @if($errors->has('dairy_philosophy')) has-error @endif">
					   					<label class="col-sm-6 col-md-6 control-label" for="dairy_philosophy">Filosofía Diaria </label>
					   					<div class="col-sm-6 col-md-6">
					   						<input class="form-control" type="text" name="dairy_philosophy" id="dairy_philosophy"   value="{{ old('dairy_philosophy') }}">
					   						@if ($errors->has('dairy_philosophy')) <p class="help-block">{{ $errors->first('dairy_philosophy') }}</p> @endif
					   					</div>
					   				</div>

					   				<div class="form-group @if($errors->has('why_would_you_win')) has-error @endif">
					   					<label class="col-sm-6 col-md-6 control-label" for="why_would_you_win">Porque te gustaría ganar el {{config('app.name')}} ? </label>
					   					<div class="col-sm-6 col-md-6">
					   						<input class="form-control" type="text" name="why_would_you_win" id="why_would_you_win"  value="{{ old('why_would_you_win') }}">
					   						@if ($errors->has('why_would_you_win')) <p class="help-block">{{ $errors->first('why_would_you_win') }}</p> @endif
					   					</div>
					   				</div>

					   				<div class="form-group @if($errors->has('g-recaptcha-response')) has-error @endif" style="margin-left: 25%">
					   					{!! Recaptcha::render() !!}
					   					@if ($errors->has('g-recaptcha-response')) <p class="help-block">{{ $errors->first('g-recaptcha-response') }}</p> @endif
					   				</div>
					   				<hr>
					   				<div class="form-group">
					   					<button id="subscribe" type="submit" class="subscribe-button btn btn-primary btn-lg btn-block" id="save">Inscribirme</button>
					   				</div>
				   				</form>
			   				</div>
			   			</div>
			   		</div>
			   </div>
			   {{-- hola status --}}
			   <div role="tabpanel" class="tab-pane fade" id="status">
			   		<div class="process-content">
			   			<h3>Felicitaciones, su está inscripción completa.</h3>
			   			<div class="row">
			   				<div class="col-md-6 col-lg-6 text-center col-md-offset-3">
			   					<img class="image-responsibe" src="{{ asset('public/images/logo.png') }}" alt="{{config('app.name')}}" title="{{config('app.name')}}">
			   					<h4>Su identificación de número de casting y toda la información que necesita saber fue enviada a su correo electrónico. Compruébelo y buena suerte. Esperaremos por usted.</h4>
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
@endsection


@section('js')
<script type="text/javascript">

$(document).ready(function() {

	@if ($existApply->process_status == 1 )
    	window.location.hash = $("#country-tab a").attr('href');
    	$('#process-tab a:last').tab('show')
    @endif

    @if ($existApply->process_status == 2 ) 
    	window.location.hash = $("#pay-tab a").attr('href');
    	$('#process-tab a:last').tab('show')
    @endif

    @if ($existApply->process_status == 3 ) 
    	window.location.hash = $("#subscription-tab a").attr('href');
    	$('#process-tab a:last').tab('show')
    @endif 

    @if ($existApply->process_status == 4 ) 
    	window.location.hash = $("#success-tab a").attr('href');
    	$('#process-tab a:last').tab('show')
    @endif
   	

	var hash = window.location.hash;
  	hash && $('ul.nav a[href="' + hash + '"]').tab('show');

  $('.nav-tabs a').click(function (e) {
    $(this).tab('show');
    var scrollmem = $('body').scrollTop() || $('html').scrollTop();
    window.location.hash = this.hash;
    $('html,body').scrollTop(scrollmem);
  });


    $('a[data-toggle="tab"]').on('click', function(){
        if ($(this).parent('li').hasClass('disabled')) {
            return false;
        }
    });



    $(".country-audition").on('click', function(event) {
    	event.preventDefault();
    	var countryCode = $(this).data('code');
    	if(!countryCode) return false;
    	$('#process-tab li:eq(1) a').tab('show') // Select third tab (0-indexed)
    	$("#pay-tab").removeClass('disabled')
    });

    $(".pay-button").on('click', function(event) {
    	var payment = $(this).data(payment);
    	if(!payment) return false;
    	$('#process-tab li:eq(2) a').tab('show') // Select third tab (0-indexed)
    	$("#subscription-tab").removeClass('disabled');
    });

    $(".subscribe-button").on('click',  function(event) {
    	event.preventDefault();
    	$('#process-tab li:eq(3) a').tab('show') // Select third tab (0-indexed)
    	// $("#subscription-tab").removeClass('disabled');
    });
});

</script>
@endsection()
