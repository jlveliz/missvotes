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
	    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Etapas</a></li>
  	</ul>

  	<div class="tab-content">
    	<div role="tabpanel" class="tab-pane active" id="home">
    		<table class="table">
    			<thead>
	    			<tr>
	    				<th>Nombre</th>
	    				<th>Fechas</th>
	    				<th></th>
	    			</tr>
    			</thead>
				<tbody>
					<tr>
						<td>
							<td></td>
						</td>
					</tr>
				</tbody>
    		</table>
    	</div>
  	</div>

  </div>
</div>
@endsection