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
    					<label class="control-label">{{ trans('backend.config.tab_general_content.label_casting') }} </label>
    					<select class="form-control" name="exist_casting">
    						<option value="1" @if(array_key_exists('exist_casting', $gConfig) && $gConfig['exist_casting'] == "1" ) selected @endif>{{ trans('backend.config.tab_general_content.select_casting_yes') }} </option> 
    						<option value="0" @if(array_key_exists('exist_casting', $gConfig) && $gConfig['exist_casting'] == "0"  ) selected @endif>{{ trans('backend.config.tab_general_content.select_casting_no') }}</option>
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
						<p><b>{{ trans('backend.config.tab_casting_content.tab_caption_title') }} <a class="pull-right btn btn-primary" href="{{ route('countries.create') }}" title="Create">{{ trans('backend.config.tab_casting_content.btn_create_casting') }}</a></b></p>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12">
						<table class="table table-striped">
							<thead>
								<tr>
									<td class="col-md-3 col-sm-3 col-lg-3">Fecha Inicio</td>
									<td class="col-md-3 col-sm-3 col-lg-3">Fecha Fin</td>
									<td>Acción</td>
								</tr>
							</thead>
							<tbody>
								@if (array_key_exists('castings', $gConfig))
									@foreach ($gConfig['castings'] as $casting)
										{{var_dump($casting)}}
									@endforeach
								@else

								<tr>
									<td colspan="3" align="center"><span class="text-muted">Don't exist</span></td>
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
@endsection