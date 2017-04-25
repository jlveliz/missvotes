@extends('layouts.frontend')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('public/css/profile.css') }}">
@endsection()

@section('content')
<div class="container-page">

	@if (Session::has('payment-message'))
		<div class="row">
	        <div class="alert alert-dismissible @if(Session::get('payment-type') == 'success') alert-info  @endif @if(Session::get('payment-type') == 'error') alert-danger  @endif" role="alert">
	          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
	          {{session('payment-message')}}
	        </div>
		</div>
        <div class="clearfix"></div>
    @endif

	<h2>{{ Auth::user()->name }} {{ Auth::user()->last_name }}</h2>
	<div class="container-tabs-profile">
		<ul class="nav nav-tabs" role="tablist">
		     <li role="presentation" class="active" >
		    	<a href="#profile" aria-controls="profile" role="tab" data-toggle="tab"> @lang('account_profile.tab_name') </a>
		    </li>
		    @if (!Auth::user()->is_admin)
			    <li role="presentation">
			    	<a href="#membership" aria-controls="membership" role="tab" data-toggle="tab">@lang('account_profile.membership_tab_data') @if(Auth::user()->client && !Auth::user()->client->current_membership()) <small class="upgrade-membership">(Premium!!)</small> @endif</a>
			    </li>
			    {{-- <li role="presentation">
			    	<a href="#tickets" aria-controls="tickets" role="tab" data-toggle="tab">Tickets</a>
			    </li> --}}
			    <li role="presentation">
			    	<a href="#activity" aria-controls="activity" role="tab" data-toggle="tab">@lang('account_profile.activities_tab_data')</a>
			    </li>
		    @endif
  		</ul>

  		<!-- Tab panes -->
		<div class="tab-content">
			<div role="tabpanel" class="tab-pane active" id="profile">
		    	<div class="col-md-3 col-sm-3 col-xs-12">
		    		<a href="#" id="profile-section">
		    			<hr>
		    			<div class="profile-img" style="background-image: url(@if(Auth::user()->client->photo) '{{ config('app.url').'/'. Auth::user()->client->photo}}' @else '{{asset('public/images/account.png')}}'  @endif)" alt="{{Auth::user()->name}}" title="{{Auth::user()->name}} {{Auth::user()->last_name}}">
		    			</div>
		    			<div class="middle">
                        	<div class="text">@lang('account_profile.img_btn_data')</div>
                    	</div>
		    		</a>
		    		<form id="form-update-photo" action="{{ route('website.account.update') }}" enctype="multipart/form-data" method="POST">
		    			{{ csrf_field() }}
		    			<input type="file" id="file-profile-upload" name="photo" type="file" accept="image/*"/ style="display: none">
		    		</form>
		    		<hr>
		    		<div class="row" class="section-profile-buttons">
			    		<div class="text-center">
			    		@if (Auth::user()->is_admin)
			    			<a href="{{ route('dashboard') }}" class="btn btn-primary btn-block btn-lg" alt="@lang('account_profile.admin_btn_data')" title="Ir a Administración"> <i class="fa fa-code"></i>@lang('account_profile.admin_btn_data')</a>
			    		@else
			    			@if (Auth::user()->client->hasApply())
			    				<a href="{{ route('apply.requirements') }}" class="btn btn-apply btn-block btn-lg" alt="@lang('account_profile.be_btn_data')" title="@lang('account_profile.be_btn_data')">@lang('account_profile.status_apply') <br> {{ config('app.name') }}		</a>
			    			@else
			    				<a href="{{ route('apply.requirements') }}" class="btn btn-apply btn-block btn-lg" alt="@lang('account_profile.be_btn_data')" title="@lang('account_profile.be_btn_data')">@lang('account_profile.be_btn_data') <br> {{ config('app.name') }}		</a>
			    			@endif
			    		@endif
			    		</div>
		    		</div>
		    	</div>
		    	<div class="col-md-9 col-sm-9 col-xs-12">
		    		<h4>@lang('account_profile.personal_data')</h4>
		    		<table class="table table-striped ">
		    			<tbody>
		    				<tr>
		    					<td><b>@lang('account_profile.name_data'): </b> {{Auth::user()->name}}</td>
		    				</tr>
		    				<tr>
		    					<td><b>@lang('account_profile.last_name_data'): </b> {{Auth::user()->last_name}}</td>
		    				</tr>
		    				<tr>
		    					<td><b>@lang('account_profile.email_data'): </b> {{Auth::user()->email}}</td>
		    				</tr>
		    				<tr>
		    					<td><b>@lang('account_profile.country_data'): </b> @if(Auth::user()->client->country) {{Auth::user()->client->country->name}} @else - @endif </td>
		    				</tr>
		    				<tr>
		    					<td><b>@lang('account_profile.city_data'): </b> {{Auth::user()->city}}</td>
		    				</tr>
		    				<tr>
		    					<td><b>@lang('account_profile.adress_data'): </b> {{Auth::user()->address}}</td>
		    				</tr>
		    				<tr>
		    					<td><b>@lang('account_profile.last_login_data'): </b> {{Auth::user()->last_login}}</td>
		    				</tr>
		    			</tbody>
		    		</table>
		    		<h4>@lang('account_profile.change_pass_data')</h4>
		    		<form action="{{ route('website.account.update') }}" method="POST">
		    			@if (Session::has('action') && Session::get('action') == 'update-password')
    						<div class="alert alert-dismissible @if(Session::get('tipo_mensaje') == 'success') alert-info  @endif @if(Session::get('tipo_mensaje') == 'error') alert-danger  @endif" role="alert">
      							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
      							{{session('mensaje')}}
       						</div>
    						<div class="clearfix"></div>
   						@endif
		    			{{ csrf_field() }}
		    			<div class="form-group col-md-4 col-sm-4 col-xs-12 @if($errors->has('password')) has-error @endif">
		    				<label class="control-label">@lang('account_profile.new_pass_data') </label>
							<input type="password" class="form-control" placeholder="@lang('account_profile.new_pass_data')" name="password" value="{{ old('password') }}">
							@if ($errors->has('password')) <p class="help-block">{{ $errors->first('password') }}</p> @endif
		    			</div>
		    			<div class="form-group col-md-4 col-sm-4 col-xs-12 @if($errors->has('repeat_password')) has-error @endif">
		    				<label class="control-label">@lang('account_profile.repeat_pass_data') </label>
							<input type="password" class="form-control" placeholder="@lang('account_profile.repeat_pass_data') " name="repeat_password" value="{{ old('repeat_password') }}">
							@if ($errors->has('repeat_password')) <p class="help-block">{{ $errors->first('repeat_password') }}</p> @endif
		    			</div>
		    			<div class="form-group col-md-4 col-sm-4 col-xs-12" style="padding-top: 4px">
		    				<br>
		    				<button type="submit" name="submit" class="btn btn-default">@lang('account_profile.btn_change_pass_data')</button>
		    			</div>
		    		</form>
		    	</div>
			</div>
		@if (!Auth::user()->is_admin)
			    {{-- membershipss --}}
			    <div role="tabpanel" class="tab-pane" id="membership" >
			    	<h4>@lang('account_profile.membership_tab_data')</h4> 
			    	<div class="col-md-12 col-lg-12 col-xs-12">
			    		@include('frontend.partials.membership',$memberships)
			    	</div>
			    </div>

			    {{-- tickets --}}
			   {{--  <div role="tabpanel" class="tab-pane" id="tickets">
			    	<h4>Tickets</h4>
			    	<div class="col-md-12 col-lg-12 col-xs-12">
			    		
			    		<h5><b>Mis tickets</b></h5>
			    		<div class="row">
			    		@if (count(Auth::user()->client->activeTickets()) > 0)
			    			@foreach (Auth::user()->client->activeTickets() as $ticketClient)
			    				<div class="col-xs-4 col-md-2">
			    					<div class="text-center">
				    					 <div class="panel panel-primary">
				    					 	<div class="panel-heading">
				    					 		<h3 class="panel-title"><span class="badge">x{{$ticketClient->counter}}</span> <i class="fa fa-ticket" aria-hidden="true"></i> {{$ticketClient->ticket->name}}</h3>
				    					 	</div>
				    					 	<div class="panel-body">
				    					 		<table class="table">
				    					 			<tbody>
				    					 				<tr>
				    					 					<td><b>Valor: </b> {{$ticketClient->ticket->val_vote}} Puntos</td>
				    					 				</tr>
				    					 			</tbody>
				    					 		</table>
				    					 	</div>
				    					 </div>
			    					</div>
			    				</div>
			    			@endforeach
				    		@else
				    			<p class="text-center text-warning">
									<b>Lamentamos que no tenga tickets para usar, compre uno para poder apoyar a su candidata favorita</b> 
								</p>
				    		@endif
			    		</div>
			    		<div class="row">
				    		@include('frontend.partials.tickets',$tickets)
			    		</div>
			    	</div>
			    </div> --}}
			    {{-- profile --}}
			<div role="tabpanel" class="tab-pane @if(Auth::user()->is_admin) active @endif" id="profile">
		    	<div class="col-md-3 col-sm-3 col-xs-12 hidden-xs">
		    		<a href="#" id="profile-section">
		    			<hr>
		    			<div class="profile-img" style="background-image: url(@if(Auth::user()->client->photo) '{{ config('app.url').'/'. Auth::user()->client->photo}}' @else '{{asset('public/images/account.png')}}'  @endif)" alt="{{Auth::user()->name}}" title="{{Auth::user()->name}} {{Auth::user()->last_name}}">
		    			</div>
		    			<div class="middle">
                        	<div class="text">@lang('account_profile.img_btn_data')</div>
                    	</div>
		    		</a>
		    		<form id="form-update-photo" action="{{ route('website.account.update') }}" enctype="multipart/form-data" method="POST">
		    			{{ csrf_field() }}
		    			<input type="file" id="file-profile-upload" name="photo" type="file" accept="image/*"/ style="display: none">
		    		</form>
		    		<hr>
		    		<div class="row" class="section-profile-buttons">
			    		<div class="text-center">
			    		@if (Auth::user()->is_admin)
			    			<a href="{{ route('dashboard') }}" class="btn btn-primary btn-block btn-lg" alt="@lang('account_profile.admin_btn_data')" title="Ir a Administración"> <i class="fa fa-code"></i>@lang('account_profile.admin_btn_data')</a>
			    		@else
			    			@if (Auth::user()->client->hasApply())
			    				<a href="{{ route('apply.requirements') }}" class="btn btn-apply btn-block btn-lg" alt="@lang('account_profile.be_btn_data')" title="@lang('account_profile.be_btn_data')">@lang('account_profile.status_apply') <br> {{ config('app.name') }}		</a>
			    			@else
			    				<a href="{{ route('apply.requirements') }}" class="btn btn-apply btn-block btn-lg" alt="@lang('account_profile.be_btn_data')" title="@lang('account_profile.be_btn_data')">@lang('account_profile.be_btn_data') <br> {{ config('app.name') }}		</a>
			    			@endif
			    		@endif
			    		</div>
		    		</div>
		    	</div>
		    	<div class="col-md-9 col-sm-9 col-xs-12">
		    		<h4>@lang('account_profile.personal_data')</h4>
		    		<table class="table table-striped ">
		    			<tbody>
		    				<tr>
		    					<td><b>@lang('account_profile.name_data'): </b> {{Auth::user()->name}}</td>
		    				</tr>
		    				<tr>
		    					<td><b>@lang('account_profile.last_name_data'): </b> {{Auth::user()->last_name}}</td>
		    				</tr>
		    				<tr>
		    					<td><b>@lang('account_profile.email_data'): </b> {{Auth::user()->email}}</td>
		    				</tr>
		    				<tr>
		    					<td><b>@lang('account_profile.country_data'): </b> @if(Auth::user()->client->country) {{Auth::user()->client->country->name}} @else - @endif </td>
		    				</tr>
		    				<tr>
		    					<td><b>@lang('account_profile.city_data'): </b> {{Auth::user()->city}}</td>
		    				</tr>
		    				<tr>
		    					<td><b>@lang('account_profile.adress_data'): </b> {{Auth::user()->address}}</td>
		    				</tr>
		    				<tr>
		    					<td><b>@lang('account_profile.last_login_data'): </b> {{Auth::user()->last_login}}</td>
		    				</tr>
		    			</tbody>
		    		</table>
		    		<h4>@lang('account_profile.change_pass_data')</h4>
		    		<form action="{{ route('website.account.update') }}" method="POST">
		    			@if (Session::has('action') && Session::get('action') == 'update-password')
    						<div class="alert alert-dismissible @if(Session::get('tipo_mensaje') == 'success') alert-info  @endif @if(Session::get('tipo_mensaje') == 'error') alert-danger  @endif" role="alert">
      							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
      							{{session('mensaje')}}
       						</div>
    						<div class="clearfix"></div>
   						@endif
		    			{{ csrf_field() }}
		    			<div class="form-group col-md-4 col-sm-4 col-xs-12 @if($errors->has('password')) has-error @endif">
		    				<label class="control-label">@lang('account_profile.new_pass_data') </label>
							<input type="password" class="form-control" placeholder="@lang('account_profile.new_pass_data')" name="password" value="{{ old('password') }}">
							@if ($errors->has('password')) <p class="help-block">{{ $errors->first('password') }}</p> @endif
		    			</div>
		    			<div class="form-group col-md-4 col-sm-4 col-xs-12 @if($errors->has('repeat_password')) has-error @endif">
		    				<label class="control-label">@lang('account_profile.repeat_pass_data') </label>
							<input type="password" class="form-control" placeholder="@lang('account_profile.repeat_pass_data') " name="repeat_password" value="{{ old('repeat_password') }}">
							@if ($errors->has('repeat_password')) <p class="help-block">{{ $errors->first('repeat_password') }}</p> @endif
		    			</div>
		    			<div class="form-group col-md-4 col-sm-4 col-xs-12" style="padding-top: 4px">
		    				<br>
		    				<button type="submit" name="submit" class="btn btn-default">@lang('account_profile.btn_change_pass_data')</button>
		    			</div>
		    		</form>
		    	</div>
		    </div>
			    <div role="tabpanel" class="tab-pane" id="activity">
			    	<h4>@lang('account_profile.activities_tab_data')</h4>
			    	<div class="col-md-12 col-lg-12 col-xs-12">
			    		<table id="activity-datatable" class="table table-bordered" style="width: 100%">
					  		<thead>
						  		<tr>
						  			<th>@lang('account_profile.event_lbl_data')</th>
						  			<th>@lang('account_profile.d_event_lbl_data')</th>
						  		</tr>
					  		</thead>
	  						<tbody>
	  						@foreach ($activities as $activity)
	  						<tr>
	  							<td>{{ trans($activity->name) }}</td>
	  							<td>{{ $activity->created_at }}</td>
	  						</tr>
	  						@endforeach
	  						</tbody>
	  					</table>
			    	</div>
			    </div>
				{{-- expr --}}
			@endif

		
		</div>
		    

	</div>
	<div class="clearfix"></div>
</div>
@endsection()

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('public/js/datatables/jquery.dataTables.min.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('public/js/datatables/buttons.bootstrap.min.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('public/js/datatables/fixedHeader.bootstrap.min.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('public/js/datatables/scroller.bootstrap.min.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('public/js/datatables/responsive.bootstrap.min.css') }}" />
@endsection()

@section('js')
 <script src="{{ asset('public/js/moment/moment.js') }}"></script>
 <script src="{{ asset('public/js/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('public/js/datatables/dataTables.bootstrap.js') }}"></script>
<script src="{{ asset('public/js/datatables/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('public/js/datatables/buttons.bootstrap.min.js') }}"></script>
<script src="{{ asset('public/js/datatables/jszip.min.js') }}"></script>
<script src="{{ asset('public/js/datatables/pdfmake.min.js') }}"></script>
<script src="{{ asset('public/js/datatables/vfs_fonts.js') }}"></script>
<script src="{{ asset('public/js/datatables/buttons.html5.min.js') }}"></script>
<script src="{{ asset('public/js/datatables/buttons.print.min.js') }}"></script>
<script src="{{ asset('public/js/datatables/dataTables.fixedHeader.min.js') }}"></script>
<script src="{{ asset('public/js/datatables/dataTables.keyTable.min.js') }}"></script>
<script src="{{ asset('public/js/datatables/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('public/js/datatables/responsive.bootstrap.min.js') }}"></script>
<script src="{{ asset('public/js/datatables/dataTables.scroller.min.js') }}"></script>
<script src="{{ asset('public/js/datetime-moment.js') }}"></script>
<script src="https://checkout.stripe.com/checkout.js"></script>
<script type="text/javascript">

	var handlerMembership = StripeCheckout.configure({
	  key: '{{ config('services.stripe.key') }}',
	  image: '{{ asset('public/images/queen-mini.png') }}',
	  locale: 'auto',
	  name: '{{ config('app.name') }}',
	  token : function(token){
	  	$("#stripe-token").val(token.id);
	  	//submit the magic form :3
	  	$("#membeship-form").submit();
	  }
	});


	var handlerTicket = StripeCheckout.configure({
	  key: '{{ config('services.stripe.key') }}',
	  image: '{{ asset('public/images/queen-mini.png') }}',
	  locale: 'auto',
	  name: '{{ config('app.name') }}',
	  token : function(token){
	  	$("#stripe-ticket-token").val(token.id);
	  	//submit the magic form :3
	  	$("#ticket-form").submit();
	  }
	});

  $(document).ready(function(){


  	// Javascript to enable link to tab
  	var url = document.location.toString();
  	if (url.match('#')) {
  	    $('.nav-tabs a[href="#' + url.split('#')[1] + '-tab"]').tab('show');
  	} //add a suffix

  	// Change hash for page-reload
  	$('.nav-tabs a').on('shown.bs.tab', function (e) {
  	    window.location.hash = e.target.hash;
  	})

  	$.fn.dataTable.moment( 'dddd, MMMM Do, YYYY' );

      $('#activity-datatable').DataTable({
      	@if(App::isLocale('es'))
        "language": {
          "url": "../public/js/datatables/json/es.json"
        },
        @else
        "language": {
          "url": "../public/js/datatables/json/en.json"
        },
        @endif
        "order": [[ 1, "desc" ]],
      });



      // CHECKOUT MEMBERSHIP
      $(".pay-membership-with-stripe").on('click', function(event) {
      	var _this = $(this);

      	//reset magic form
      	$("#membership-id").val('');
      	$("#stripe-token").val('');
      	$("#amount").val('');

      	//set membership on magic form
		$("#membership-id").val(_this.data('membership'));
      	$("#amount").val(_this.data('amount'));

      	handlerMembership.open({
    		description: _this.data('description'),
    		amount: _this.data('amount'),
    		email: _this.data('email')
  		});
      });


      // CHECKOUT TICKET
      $(".pay-ticket-with-stripe").on('click', function(event) {
      	var _this = $(this);

      	//reset magic form
      	$("#ticket-id").val('');
      	$("#stripe-ticket-token").val('');
      	$("#amount-ticket").val('');

      	//set membership on magic form
		$("#ticket-id").val(_this.data('ticket'));
      	$("#amount-ticket").val(_this.data('amount'));

      	handlerTicket.open({
    		description: _this.data('description'),
    		amount: _this.data('amount'),
    		email: _this.data('email')
  		});
      });

  });

  // Close Checkout on page navigation:
	window.addEventListener('popstate', function() {
  		handlerMembership.close();
  		handlerTicket.close();
	});
 </script>
@endsection