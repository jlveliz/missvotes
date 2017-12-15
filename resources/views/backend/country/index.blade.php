@extends('layouts.backend')
@section('content')
<div class="panel panel-default">
  <div class="panel-heading">{{ trans('backend.country.index.panel_title') }}</div>

  <div class="panel-body">
  	   @if (Session::has('mensaje'))
        <div class="alert alert-dismissible @if(Session::get('tipo_mensaje') == 'success') alert-info  @endif @if(Session::get('tipo_mensaje') == 'error') alert-danger  @endif" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
          {{session('mensaje')}}
           </div>
        <div class="clearfix"></div>
       @endif
     	<table id="country-datatable" class="table table-bordered">
     		<caption>{{ trans('backend.country.index.panel_caption') }} <a class="pull-right btn btn-primary" href="{{ route('countries.create') }}" title="Crear">{{ trans('backend.country.index.btn_create') }}</a></caption>
     		<thead>
     			<tr>
     				<th>{{ trans('backend.country.index.th_name') }}</th>
     				<th>{{ trans('backend.country.index.th_code') }}</th>
     				<th>{{ trans('backend.country.index.th_action') }}</th>
     			</tr>
     		</thead>
     		<tbody>
     			@foreach ($countries as $country)
       			<tr>
       				<td>{{$country->name}}</td>
              <td>{{$country->code}}</td>
       				<td class="text-center">
       					<form action="{{ route('countries.destroy',$country->id) }}" method="POST">
       						<a href="{{ route('countries.edit',$country->id) }}" title="{{ trans('backend.country.index.panel_caption') }}" class="btn btn-xs btn-warning"> {{ trans('backend.country.index.td_edit') }}</a>
       							<input type="hidden" name="_token" value="{{ csrf_token() }}">
         						<input type="hidden" name="_method" value="DELETE">
         						<button type="submit" title="{{ trans('backend.country.index.td_delete') }}" class="btn btn-xs btn-danger"> {{ trans('backend.country.index.td_delete') }}</button>
       					</form>
       				</td>
       			</tr>
     			@endforeach
     		</tbody>
     	</table>
  </div>
</div>
@endsection


@section('js')
<script type="text/javascript">
  $(document).ready(function(){
      $('#country-datatable').DataTable({
        @if (App::isLocale('es'))
        @if(App::isLocal())
          "language": {
            "url": "../public/js/datatables/json/es.json"
          },
          @else
            "language": {
            "url": "../../public/js/datatables/json/es.json"
          },
          @endif
        @endif
      });
  });
 </script>
@endsection