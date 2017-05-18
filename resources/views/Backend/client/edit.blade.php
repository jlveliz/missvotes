@extends('layouts.backend')
@section('content')
<div class="panel panel-default">
	<div class="panel-heading">{{ trans('backend.client.create-edit.panel_title') }}</div>
	<p class="subtitle">{{ trans('backend.client.create-edit.panel_subtitle_edit') }}</p>
	<div class="panel-body">
		@if (Session::has('mensaje'))
        <div class="alert alert-dismissible @if(Session::get('tipo_mensaje') == 'success') alert-info  @endif @if(Session::get('tipo_mensaje') == 'error') alert-danger  @endif" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
          {{session('mensaje')}}
           </div>
        <div class="clearfix"></div>
       @endif
		<form action="{{ route('clients.update',$client->id) }}" method="post">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<input type="hidden" name="_method" value="PUT">
			<input type="hidden" name="key" value="{{$client->id}}">
			<input type="hidden" name="is_admin" value="0">
			<div class="row">
				<div class="form-group col-md-3 col-sm-3 col-xs-12 @if($errors->has('email')) has-error @endif">
					<label class="control-label">{{ trans('backend.client.create-edit.label_email') }} </label>
					<input type="email" class="form-control" name="email" value="{{ $client->email }}">
					@if ($errors->has('email')) <p class="help-block">{{ $errors->first('email') }}</p> @endif
				</div>

				<div class="form-group col-md-3 col-sm-3 col-xs-12 @if($errors->has('name')) has-error @endif">
					<label class="control-label">{{ trans('backend.client.create-edit.label_name') }} </label>
					<input type="text" class="form-control" name="name" value="{{ $client->name }}">
					@if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
				</div>

				<div class="form-group col-md-3 col-sm-3 col-xs-12 @if($errors->has('last_name')) has-error @endif">
					<label class="control-label">{{ trans('backend.client.create-edit.label_lastname') }} </label>
					<input type="text" class="form-control" name="last_name" value="{{ $client->last_name }}">
					@if ($errors->has('last_name')) <p class="help-block">{{ $errors->first('last_name') }}</p> @endif
				</div>

				<div class="form-group col-md-3 col-sm-3 col-xs-12 @if($errors->has('country_id')) has-error @endif">
					<label class="control-label">{{ trans('backend.client.create-edit.label_country') }} </label>
					<select class="form-control" name="country_id" id="country">
						<option value="null">--{{ trans('backend.client.create-edit.label_opt_select') }}--</option>
						@foreach ($countries as $element)
							<option value="{{$element->id}}" @if($client->country_id == $element->id) selected  @endif>{{$element->name}}</option>
						@endforeach
					</select>
					@if ($errors->has('country_id')) <p class="help-block">{{ $errors->first('country_id') }}</p> @endif
				</div>
			</div>
			
			<div class="row">
				<div class="form-group col-md-3 col-sm-3 col-xs-6 @if($errors->has('city')) has-error @endif">
					<label class="control-label">{{ trans('backend.client.create-edit.label_city') }} </label>
					<input type="text" class="form-control" placeholder="Ciudad" name="city" value="{{ $client->city }}">
					@if ($errors->has('city')) <p class="help-block">{{ $errors->first('city') }}</p> @endif
				</div>

				<div class="form-group col-md-6 col-sm-6 col-xs-6 @if($errors->has('address')) has-error @endif">
					<label class="control-label">{{ trans('backend.client.create-edit.label_address') }} </label>
					<input type="text" class="form-control" name="address" value="{{ $client->address }}">
					@if ($errors->has('address')) <p class="help-block">{{ $errors->first('address') }}</p> @endif
				</div>
			</div>

			<div class="row">
				<div class="form-group col-md-3 col-sm-3 col-xs-12 @if($errors->has('password')) has-error @endif">
					<label class="control-label">{{ trans('backend.client.create-edit.label_password') }}  </label>
					<input type="password" class="form-control" placeholder="Clave" name="password" value="">
					@if ($errors->has('password')) <p class="help-block">{{ $errors->first('password') }}</p> @endif
				</div>

				<div class="form-group col-md-3 col-sm-3 col-xs-12 @if($errors->has('password_repeat')) has-error @endif">
					<label class="control-label">{{ trans('backend.client.create-edit.label_repeat_password') }}</label>
					<input type="password" class="form-control" placeholder="Clave" name="password_repeat" value="">
					@if ($errors->has('password_repeat')) <p class="help-block">{{ $errors->first('password_repeat') }}</p> @endif
				</div>
			</div>

			
				<ul class="nav nav-tabs" role="tablist">
					<li role="presentation" class="active">
		    			<a href="#membership" aria-controls="membership" role="tab" data-toggle="tab">{{ trans('backend.client.create-edit.label_membership') }}</a>
		    		</li>
		    		<li role="presentation">
		    			<a href="#tickets" aria-controls="tickets" role="tab" data-toggle="tab">{{ trans('backend.client.create-edit.label_ticket') }}</a>
		    		</li>
				</ul>

				<div class="tab-content">
					<div role="tabpanel" class="tab-pane active" id="membership">
						<h3 class="subtitle">{{ trans('backend.client.create-edit.label_membership') }}</h3> 
						<table class="table table-bordered">
							<tbody>
								<tr>
									<td>
										<b>{{ trans('backend.client.create-edit.label_membership') }}:</b> @if($client->current_membership()) {{$client->current_membership()->membership->name}} @else {{ trans('backend.client.create-edit.td_free') }} @endif
									</td>
									<td>
										<b>{{ trans('backend.client.create-edit.td_price') }}:</b> @if($client->current_membership()) {{$client->current_membership()->membership->price}} @else $ 0.00 @endif
									</td>
									<td>
										<b>{{ trans('backend.client.create-edit.td_duration') }}:</b> @if($client->current_membership()) {{$client->current_membership()->membership->duration_time}}  {{ $client->current_membership()->membership->getDurationMode($client->current_membership()->membership->duration_mode) }} @else N/A @endif
									</td>
									<td>
										<b>{{ trans('backend.client.create-edit.td_points_per_vote') }}:</b> @if($client->current_membership()) {{$client->current_membership()->membership->points_per_vote}} @else 1 @endif
									</td>
								</tr>
							</tbody>
						</table>
					</div>

					<div role="tabpanel" class="tab-pane" id="tickets">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<h3 class="subtitle">{{ trans('backend.client.create-edit.td_ticket') }}</h3>
							<table id="tickets-detail" class="table table-bordered">
								<thead>
									<tr>
										<th>{{ trans('backend.client.create-edit.td_ticket') }}</th>
										<th>{{ trans('backend.client.create-edit.td_pay_type') }}</th>
										<th>{{ trans('backend.client.create-edit.td_state') }}</th>
									</tr>
								</thead>
								<tbody>
								@foreach ($client->tickets as $ticket)
									<tr>
										<td>{{$ticket->ticket->name}}</td>
										<td>{{$ticket->payment_type}}</td>
										<td>@if($ticket->state == $client->getActive()) {{ trans('backend.client.create-edit.td_ticket_active') }} @else {{ trans('backend.client.create-edit.td_ticket_used') }} @endif</td>
									</tr>
								@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			

			<div class="form-group  col-md-12 col-sm-12 col-xs-12">
				<a href="{{ route('clients.index') }}" class="btn btn-primary">{{ trans('backend.client.create-edit.btn_cancel') }}</a>
                <button type="submit" class="btn btn-success">{{ trans('backend.client.create-edit.btn_save') }}</button>
            </div>

		</form>
	</div>

</div>
@endsection

@section('js')
<script type="text/javascript">
  $(document).ready(function(){
      $('#tickets-detail').DataTable({
      	@if (App::isLocale('es'))
        "language": {
          "url": "../../../public/js/datatables/json/es.json"
        }
      	@endif
      });
  });
 </script>
@endsection

@section('css')
<style type="text/css">
	#tickets-detail{
		width: 100%!important;
	}
</style>
@endsection()