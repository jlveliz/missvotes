@extends('layouts.backend')
@section('content')
<div class="panel panel-default">
  <div class="panel-heading">{{ trans('backend.config.index.panel_title') }}</div>
  <div class="panel-body">
  	@if (Session::has('mensaje'))
        <div class="alert alert-dismissible @if(Session::get('tipo_mensaje') == 'success') alert-info  @endif @if(Session::get('tipo_mensaje') == 'error') alert-danger  @endif" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
          {{session('mensaje')}}
           </div>
        <div class="clearfix"></div>
    @endif
	

	<ul class="nav nav-tabs" role="tablist">
	    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">{{trans('backend.config.index.tab_general')}}</a></li>
	    @if (array_key_exists('exist_casting', $gConfig) && $gConfig['exist_casting'] == '1' )
	    <li role="presentation"><a href="#inscriptions" aria-controls="inscriptions" role="tab" data-toggle="tab">{{trans('backend.config.index.tab_castings')}}</a></li>
	    @endif
  	</ul>

  	<div class="tab-content tab-config">
    	
    	<div role="tabpanel" class="tab-pane active" id="home">
    		<form action="{{ route('config.store') }}" method="POST">
    			<input type="hidden" name="_token" value="{{ csrf_token() }}">
	    		<div class="row">
    				<div class="form-group col-md-3 col-sm-3 col-xs-12">
    					<input type="hidden" name="key" value="exist_casting">
    					<label class="control-label">{{ trans('backend.config.tab_general_content.label_casting') }} </label>
    					<select class="form-control" name="payload">
    						<option value="1" @if(array_key_exists('exist_casting', $gConfig) && $gConfig['exist_casting'] == '1') selected @endif>{{ trans('backend.config.tab_general_content.select_casting_yes') }} </option> 
    						<option value="0" @if(!array_key_exists('exist_casting', $gConfig) || ( array_key_exists('exist_casting', $gConfig) && $gConfig['exist_casting'] == "0" )) selected @endif>{{ trans('backend.config.tab_general_content.select_casting_no') }}</option>
    					</select>
    				</div>
	    		</div>

	    		<div class="row">
					<div class="form-group  col-md-12 col-sm-12 col-xs-12">
		                <button type="submit" class="btn btn-success">{{ trans('backend.config.tab_general_content.btn_save') }}</button>
		            </div>
				</div>

    		</form>
    	</div>
		
		@if (array_key_exists('exist_casting', $gConfig) && $gConfig['exist_casting'] == '1')
		<div role="tabpanel" class="tab-pane" id="inscriptions"> 
			<form action="{{ route('config.store') }}" method="POST">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12">
						<p><b>{{ trans('backend.config.tab_casting_content.tab_caption_title') }}
						<button type="button" class="pull-right btn btn-primary" id="create-casting" title="Create">{{ trans('backend.config.tab_casting_content.btn_create_casting') }}</button>
						</b></p>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12">
						<table class="table table-striped">
							<thead>
								<tr>
									<td class="col-md-3 col-sm-3 col-lg-3">{{ trans('backend.config.modal_create_edit_casting.start_date') }} </td>
									<td class="col-md-3 col-sm-3 col-lg-3">{{ trans('backend.config.modal_create_edit_casting.end_date') }} </td>
									<td class="col-md-3 col-sm-3 col-lg-3">{{ trans('backend.config.modal_create_edit_casting.lang') }} </td>
									<td>{{ trans('backend.config.modal_create_edit_casting.action') }} </td>
								</tr>
							</thead>
							<tbody id="castings-selected">
								@if (array_key_exists('castings', $gConfig))
									@foreach ($gConfig['castings'] as $key => $casting)
										<tr class="casting">
											<td class="start_date">
												{{$casting['payload']['start_date']}}
												<input type="hidden" class="casting_countries" value="{{$casting['countries']}}">
											</td>
											<td class="end_date">{{$casting['payload']['end_date']}}</td>
											<td class="lang">{{$casting['payload']['lang']}}</td>
											<td>
												<form action="{{ route('config.destroy',$casting['id']) }}" method="POST">
												<button class="btn btn-warning btn-xs edit-casting" data-casting="{{$key}}"  type="button">Editar</button>
												@if ($key > 2)
														<input type="hidden" name="_token" value="{{ csrf_token() }}">
         												<input type="hidden" name="_method" value="DELETE">
														<button class="btn btn-danger btn-xs" type="submit">Eliminar</button>
												@endif
												</form>
											</td>
										</tr>
									@endforeach
								@else
								<tr>
									<td colspan="4" align="center"><span class="text-muted">Don't exist</span></td>
								</tr>
									
								@endif
							</tbody>
						</table>
					</div>
				</div>
			</form>
		</div>
		@endif

  	</div>

  </div>
</div>





{{-- modals --}}
<div class="modal fade" id="createEditCasting" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <form action="{{ route('config.store') }}" method="POST">
    	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel">{{trans('backend.config.modal_create_edit_casting.title')}}</h4>
	      </div>
	      <div class="modal-body">
	        <div class="row">
	        	<div class="col-md-12">
	        		<input type="hidden" id="number_casting" name="key" value="">
	        		<div class="form-group col-md-4 col-sm-4 col-xs-12">
	        			<label class="control-label">{{ trans('backend.config.modal_create_edit_casting.start_date') }} </label>
	        			<input type="text" class="form-control dates-casting" id="start_date" name="payload[start_date]">

	        		</div>
	        		<div class="form-group col-md-4 col-sm-4 col-xs-12">
	        			<label class="control-label">{{ trans('backend.config.modal_create_edit_casting.end_date') }} </label>
	        			<input type="text" class="form-control dates-casting" id="end_date" name="payload[end_date]">
	        		</div>
	        		<div class="form-group col-md-4 col-sm-4 col-xs-12">
	        			<label class="control-label">{{ trans('backend.config.modal_create_edit_casting.lang') }} </label>
	        			<select class="form-control" id="language" name="payload[lang]">
	        				<option value="{{ trans('backend.config.modal_create_edit_casting.option_language_key_es') }}">{{ trans('backend.config.modal_create_edit_casting.option_language_label_es') }}</option>	
	        				<option value="{{ trans('backend.config.modal_create_edit_casting.option_language_key_en') }}">{{ trans('backend.config.modal_create_edit_casting.option_language_label_en') }}</option>	
	        			</select>
	        		</div>
	        	</div>
	        </div>
	        <hr>
	        <div class="row">
	        	<div class="col-md-4">
	        		<div class="form-group col-md-12 col-sm-12 col-xs-12">
		        		<label class="control-label">{{ trans('backend.config.modal_create_edit_casting.available_countries') }} </label>
		        		<select  name="" id="available_countries" class="form-control" style="width: 90%">
		        			@foreach ($availableCountries as $country)
		        			<option value="{{$country->id}}">{{$country->name}}</option>	
		        			@endforeach	
		        		</select>
	        		</div>
	        	</div>
	        	<div class="col-md-4">
	        		<br>
	        		<button type="button" class="btn btn-default" id="btn_insertar_pais">{{ trans('backend.config.modal_create_edit_casting.btn_action_insert') }}</button>
	        	</div>
	        	<div class="col-md-12">
	        		<br>
	        		<table class="table table-striped">
	        			<thead>
	        				<tr>
	        					<th colspan="2">País</th>
	        				</tr>
	        			</thead>
	        			<tbody id="selected_countries">
	        				<tr id="dont-selected">
	        					<td colspan="2" class="text-center"><span class="text-muted">{{ trans('backend.config.modal_create_edit_casting.dont_exist') }}</span></td>
	        				</tr>
	        			</tbody>
	        		</table>
	        	</div>
	        </div>	
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('backend.config.modal_create_edit_casting.btn_cancel') }}</button>
	        <button type="submit" class="btn btn-primary">{{ trans('backend.config.modal_create_edit_casting.btn_save') }}</button>
	      </div>
	    </div>
    </form>
  </div>
</div>
{{-- modals --}}
@endsection

@section('js')
<script type="text/javascript" src="{{ asset('public/js/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}"></script>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('public/js/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css') }}">
@endsection