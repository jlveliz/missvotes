@extends('layouts.frontend')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('public/css/profile.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('public/css/raffles.css') }}">
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
			    	<a href="#tickets" aria-controls="tickets" role="tab" data-toggle="tab">{{ trans('raffle_ticket.tab_name') }} @if (count(Auth::user()->client->tickets) > 0) <strong> ({{count(Auth::user()->client->tickets)}}) </strong> @endif</a>
			    </li> --}}
			    @if ($existCasting)
				    <li role="presentation">
				    	<a href="#activity" aria-controls="activity" role="tab" data-toggle="tab">@lang('account_profile.activities_tab_data')</a>
				    </li>
			    @endif
		    @endif
  		</ul>

  		<!-- Tab panes -->
		<div class="tab-content">
			<div role="tabpanel" class="tab-pane active" id="profile">
		    	<div class="col-md-4 col-sm-6 col-xs-12">
		    		<a href="#" id="profile-section">
		    			<hr>
		    			<div class="profile-img center-block" style="background-image: url(@if(Auth::user()->client->photo) '{{ config('app.url').'/'. Auth::user()->client->photo}}' @else '{{asset('public/images/account.png')}}'  @endif)" alt="{{Auth::user()->name}} {{Auth::user()->last_name}}" title="{{Auth::user()->name}} {{Auth::user()->last_name}}">
		    			</div>
		    			<div class="middle">
                        	<div class="text">@lang('account_profile.img_btn_data')</div>
                    	</div>
		    		</a>
		    		<form id="form-update-photo" action="{{ route('website.account.update') }}" enctype="multipart/form-data" method="POST">
		    			{{ csrf_field() }}
		    			<input type="file" id="file-profile-upload" name="photo" type="file" accept="image/*"/ style="display: none">
		    		</form>

		    		@if(Auth::user()->is_admin || Auth::user()->can('postulate'))
		    			<hr>
		    		@endif
		    		
		    		<div class="row" class="section-profile-buttons">
			    		<div class="text-center">
			    		@if (Auth::user()->is_admin)
			    			<a href="{{ route('dashboard') }}" class="btn btn-primary btn-block btn-lg" alt="@lang('account_profile.admin_btn_data')" title="Ir a Administración"> <i class="fa fa-code"></i>@lang('account_profile.admin_btn_data')</a>
			    		@elseif($existCasting)
			    			@can('postulate',Auth::user())
				    			@if (Auth::user()->client->hasApply())
				    				@if (Auth::user()->client->hasApply())
				    					<a href="{{ route('apply.aplicationProcess') }}" class="btn btn-apply btn-block btn-lg" alt="@lang('account_profile.be_btn_data')" title="@lang('account_profile.be_btn_data')">@lang('account_profile.status_apply') <br> {{ config('app.name') }}		</a>
				    				@else
				    					<a href="{{ route('apply.requirements') }}" class="btn btn-apply btn-block btn-lg" alt="@lang('account_profile.be_btn_data')" title="@lang('account_profile.be_btn_data')">@lang('account_profile.status_apply') <br> {{ config('app.name') }}		</a>
				    				@endif
				    			@else
				    				<a href="{{ route('apply.requirements') }}" class="btn btn-apply btn-block btn-lg" alt="@lang('account_profile.be_btn_data') {{ config('app.name') }} !" title="@lang('account_profile.be_btn_data') {{ config('app.name') }} !">@lang('account_profile.be_btn_data') <br> {{ config('app.name') }} !		</a>
				    			@endif
			    			@endcan
			    		@endif
			    		</div>
		    		</div>
		    	</div>
		    	<div class="col-md-8 col-sm-6 col-xs-12">
		    		<h4>
		    			@lang('account_profile.personal_data')
		    			@if (session()->get('edit-account'))
		    				<a href="{{ route('website.account.edit') }}" title="{{ trans('account_profile.cancel_edit_profile') }}" alt="{{ trans('account_profile.cancel_edit_profile') }}" class="btn btn-danger pull-right btn-xs"><i class="fa fa-ban"></i> {{ trans('account_profile.cancel_edit_profile') }}</a>
		    			@else
		    				<div class="btn-group col-md-offset-8" role="group">
		    					<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-bars" aria-hidden="true"></i> <span class="caret"></span>
		    					</button>
		    					<ul class="dropdown-menu">
		    						<li>
		    							<a href="{{ route('website.account.edit') }}" title="{{ trans('account_profile.edit_profile') }}" alt="{{ trans('account_profile.edit_profile') }}"><i class="fa fa-pencil"></i> {{ trans('account_profile.edit_profile') }}</a>
		    						</li>
		    						@if (!Auth::user()->is_admin)
		    						<li>
		    							<a href="{{ route('website.account.delete') }}" title="{{ trans('account_profile.unsubscribe') }}" alt="{{ trans('account_profile.unsubscribe') }}"><i class="fa fa-trash"></i> {{ trans('account_profile.unsubscribe') }}</a>
		    						</li>
		    						@endif
		    					</ul>
		    				</div>

		    				{{-- <a href="{{ route('website.account.edit') }}" title="{{ trans('account_profile.edit_profile') }}" class="btn btn-primary btn-xs" alt="{{ trans('account_profile.edit_profile') }}"><i class="fa fa-pencil"></i> {{ trans('account_profile.edit_profile') }}</a> --}}

		    				{{-- <a href="{{ route('website.account.delete') }}" title="{{ trans('account_profile.unsubscribe') }}" class="btn btn-primary btn-xs" alt="{{ trans('account_profile.unsubscribe') }}"><i class="fa fa-trash-o"></i> {{ trans('account_profile.unsubscribe') }}</a> --}}
		    			@endif 
		    		</h4>
		    		@if (Session::has('action'))
						<div class="alert alert-dismissible @if(Session::get('tipo_mensaje') == 'success') alert-info  @endif @if(Session::get('tipo_mensaje') == 'error') alert-danger  @endif" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
								{{session('mensaje')}}
							</div>
						<div class="clearfix"></div>
	   				@endif
			    		
		    		@if (!session()->get('edit-account'))
			    		<table class="table table-striped table-responsive">
			    			<tbody>
			    				<tr>
			    					<td><b>@lang('account_profile.name_data'): </b> {{Auth::user()->name}}</td>
			    				</tr>
			    				<tr>
			    					<td><b>@lang('account_profile.last_name_data'): </b> {{Auth::user()->last_name}}</td>
			    				</tr><tr>
			    					<td><b>@lang('account_profile.gender_data'): </b> {{ Auth::user()->gender == 'male' ? trans('account_profile.male_gender') :  trans('account_profile.female_gender')}}</td>
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
		    		@else
		    			<form class="form-horizontal" action="{{ route('website.account.update') }}" method="POST">
		    				{{ csrf_field() }}
			    		<div class="form-group @if($errors->has('name')) has-error @endif">
			    			<label for="name" id="name" class="col-sm-2 control-label text-left"><b>@lang('account_profile.name_data'): </b></label>
			    			<div class="col-sm-6">
			    				<input type="text" name="name" id="name" class="form-control" value="{{Auth::user()->name}}">
			    				@if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
			    			</div>
			    		</div>

			    		<div class="form-group @if($errors->has('last_name')) has-error @endif">
			    			<label for="last_name" class="col-sm-2 control-label text-left"><b>@lang('account_profile.last_name_data'): </b></label>
			    			<div class="col-sm-6">
			    				<input type="text" name="last_name" id="last_name" class="form-control" value="{{Auth::user()->last_name}}">
			    				@if ($errors->has('last_name')) <p class="help-block">{{ $errors->first('last_name') }}</p> @endif
			    			</div>
			    		</div>

			    		<div class="form-group @if($errors->has('gender')) has-error @endif">
			    			<label for="last_name" class="col-sm-2 control-label text-left"><b>@lang('account_profile.gender_data'): </b></label>
			    			<div class="col-sm-6">
			    				<select class="form-control" name="gender" id="gender">
			    					<option value="male" @if(Auth::user()->gender == 'male') selected @endif>{{ trans('auth.register_fields.male') }}</option>
            						<option value="female" @if(Auth::user()->gender == 'female') selected @endif>{{ trans('auth.register_fields.female') }}</option>
          						</select>
			    				@if ($errors->has('gender')) <p class="help-block">{{ $errors->first('gender') }}</p> @endif
			    			</div>
			    		</div>

			    		<div class="form-group @if($errors->has('country_id')) has-error @endif">
			    			<label for="country_id" class="col-sm-2 control-label text-left"><b>@lang('account_profile.country_data'): </b></label>
			    			<div class="col-sm-6">
			    				<select name="country_id" id="country_id" class="form-control">
			    					@foreach ($countries as $country)
			    						<option value="{{ $country->id }}" @if($country->id == Auth::user()->country_id) selected @endif>{{ $country->name }}</option>	
			    					@endforeach
			    				</select>
			    				@if ($errors->has('country_id')) <p class="help-block">{{ $errors->first('country_id') }}</p> @endif
			    			</div>
			    		</div>

			    		<div class="form-group @if($errors->has('city')) has-error @endif">
			    			<label for="city" class="col-sm-2 control-label text-left"><b>@lang('account_profile.city_data'): </b></label>
			    			<div class="col-sm-6">
			    				<input type="text" name="city" id="city" class="form-control" value="{{Auth::user()->city}}">
			    				@if ($errors->has('city')) <p class="help-block">{{ $errors->first('city') }}</p> @endif
			    			</div>
			    		</div>

			    		<div class="form-group @if($errors->has('address')) has-error @endif">
			    			<label for="address" class="col-sm-2 control-label text-left"><b>@lang('account_profile.adress_data'): </b></label>
			    			<div class="col-sm-6">
			    				<input type="text" name="address" id="address" class="form-control" value="{{Auth::user()->address}}">
			    				@if ($errors->has('address')) <p class="help-block">{{ $errors->first('address') }}</p> @endif
			    			</div>
			    		</div>
			    		<h4>@lang('account_profile.change_pass_data')</h4>
			    			<div class="form-group col-md-4 col-sm-4 col-xs-12 @if($errors->has('password')) has-error @endif" style="margin-right: 15px!important">
			    				<label class="control-label">@lang('account_profile.new_pass_data') </label>
								<input type="password" class="form-control" placeholder="@lang('account_profile.new_pass_data')" name="password" value="{{ old('password') }}">
								@if ($errors->has('password')) <p class="help-block">{{ $errors->first('password') }}</p> @endif
			    			</div>
			    			<div class="form-group col-md-4 col-sm-4 col-xs-12 @if($errors->has('repeat_password')) has-error @endif" style="margin-right: 15px!important">
			    				<label class="control-label">@lang('account_profile.repeat_pass_data') </label>
								<input type="password" class="form-control" placeholder="@lang('account_profile.repeat_pass_data') " name="repeat_password" value="{{ old('repeat_password') }}">
								@if ($errors->has('repeat_password')) <p class="help-block">{{ $errors->first('repeat_password') }}</p> @endif
			    			</div>
			    			<div class="form-group col-md-12 col-xs-12 text-left">
			    				<br>
			    				<button type="submit" name="submit" class="btn btn-primary"> @lang('account_profile.btn_save_data')</button>
			    			</div>
			    		</form>
		    		@endif
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
			    <div role="tabpanel" class="tab-pane" id="tickets">
			    	<h4>Tickets</h4>
			    	<p class="col-md-12 col-sm-12 col-xs-12">
			    		<b>{{ trans('my_tickets.total_raffle_numbers')}}: </b> {{count(Auth::user()->client->tickets)}} |
			    		<b>{{ trans('my_tickets.total_amount_points')}}: </b> {{$availableTickets}}
			    	</p>
			    	<div class="col-md-12 col-sm-12 col-xs-12">
			    		<p class="">
			    			{!! trans('my_tickets.message_favorite')!!} : {{count(Auth::user()->client->tickets)}} 
			    		</p>
			    		<p class="">
			    			{!! trans('my_tickets.each_vote_raffle')!!}
			    		</p>
			    	</div>
			    	<p class="col-md-7 text-center col-md-offset-3">{{ trans('my_tickets.thanks') }}</p>
			    	<p class="col-md-7 text-center col-md-offset-3">{{ trans('my_tickets.junior_foundation') }}</p>

			    	<div class="col-md-12 col-lg-12 col-xs-12">
			    		
			    		<h5><b>{{ trans('raffle_ticket.my_tickets') }}</b></h5>
			    		<div class="col-md-12 col-sm-12 col-xs-12 text-center">
			    			<hr>
			    		</div>
			    		<div class="row">
			    		@if (count(Auth::user()->client->tickets) > 0)
			    			@foreach (Auth::user()->client->tickets as $ticketClient)
			    				<div class="col-md-2 col-xs-6 col-sm-3">
									<div class="panel panel-success">
					  					<div class="panel-body body-ticket my-ticket">
											<h1 class="text-center"><b>{{ $ticketClient->raffle_vote_id }}</b></h1>
					  					</div>
					  					<div class="panel-footer footer-ticket @if($ticketClient->state == 1) footer-my-available-tickets  @else footer-my-used-tickets @endif">
					  						<p><strong>@if($ticketClient->state == 1) {{ trans('my_tickets.signals.available') }} @else {{ trans('my_tickets.signals.used') }} @endif</strong></p>
					  					</div>
									</div>
			    				</div>
			    			@endforeach
				    		@else
				    			<p class="text-center text-warning">
				    				<b>{{ trans('my_tickets.tickets_not_found') }}</b>
								</p>
				    		@endif
			    		</div>
			    		<div class="col-md-12 col-sm-12 col-xs-12 text-center">
			    			<a href="{{ route('website.miss.index') }}" class="btn btn-primary">{{ trans('my_tickets.give_my_points') }}</a>
			    		</div>
			    		<div class="col-md-12 col-sm-12 col-xs-12 text-center">
			    			<hr>
			    		</div>
			    		<br>
			    		<p class="col-md-12 col-sm-12"><strong>{{ trans('my_tickets.remember') }}: </strong> {{ trans('my_tickets.text_remember') }} </p>
			    		<br>
			    		<div class="clearfix"></div>
			    		
			    		
			    	</div>
			    </div>
			    {{-- profile --}}
				<div role="tabpanel" class="tab-pane @if(Auth::user()->is_admin) active @endif" id="profile">
			    	<div class="col-md-4 col-sm-3 col-xs-12 hidden-xs">
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
				    				@if (Auth::user()->client->hasApply())
				    					<a href="{{ route('apply.aplicationProcess') }}" class="btn btn-apply btn-block btn-lg" alt="@lang('account_profile.be_btn_data')" title="@lang('account_profile.be_btn_data')">@lang('account_profile.status_apply') <br> {{ config('app.name') }}		</a>
				    				@else
				    					<a href="{{ route('apply.requirements') }}" class="btn btn-apply btn-block btn-lg" alt="@lang('account_profile.be_btn_data')" title="@lang('account_profile.be_btn_data')">@lang('account_profile.status_apply') <br> {{ config('app.name') }}		</a>
				    				@endif
				    			@else
				    				<a href="{{ route('apply.requirements') }}" class="btn btn-apply btn-block btn-lg" alt="@lang('account_profile.be_btn_data')" title="@lang('account_profile.be_btn_data')">@lang('account_profile.be_btn_data') <br> {{ config('app.name') }}	!	</a>
				    			@endif
				    		@endif
				    		</div>
			    		</div>
			    	</div>
			    	<div class="col-md-8 col-sm-9 col-xs-12">
			    		<h4>@lang('account_profile.personal_data')</h4>
			    		<table class="table table-striped table-responsive">
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
			    	<div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
			    		<table id="activity-datatable" class="table table-bordered table-responsive" style="width: 100%">
					  		<thead>
						  		<tr>
						  			<th>@lang('account_profile.event_lbl_data')</th>
						  			<th>@lang('account_profile.d_event_lbl_data')</th>
						  		</tr>
					  		</thead>
	  						<tbody>
	  						@foreach ($activities as $activity)
	  						<tr>
	  							<td> {!! trans('activity.you')!!} {!! trans('activity.have')!!} @if($activity->params)  {!! trans($activity->name,$activity->params)!!} @else {!! trans($activity->name)!!}  @endif </td>
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