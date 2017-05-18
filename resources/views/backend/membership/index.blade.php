@extends('layouts.backend')
@section('content')
<div class="panel panel-default">
  <div class="panel-heading">{{ trans('backend.membership.index.panel_title') }}</div>

  <div class="panel-body">
  	   @if (Session::has('mensaje'))
        <div class="alert alert-dismissible @if(Session::get('tipo_mensaje') == 'success') alert-info  @endif @if(Session::get('tipo_mensaje') == 'error') alert-danger  @endif" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
          {{session('mensaje')}}
           </div>
        <div class="clearfix"></div>
       @endif
     	<table id="membership-datatable" class="table table-bordered">
     		<caption>{{ trans('backend.membership.index.panel_caption') }} {{-- <a class="pull-right btn btn-primary" href="{{ route('memberships.create') }}" title="Crear"Crear Membresia</a>> --}}</caption>
     		<thead>
     			<tr>
     				<th>{{ trans('backend.membership.index.th_name') }}</th>
     				<th>{{ trans('backend.membership.index.th_duration') }}</th>
     				<th>{{ trans('backend.membership.index.th_price') }}</th>
     				<th>{{ trans('backend.membership.index.th_creation_date') }}/{{ trans('backend.membership.index.th_upgrade') }}</th>
     				<th>{{ trans('backend.membership.index.th_action') }}</th>
     			</tr>
     		</thead>
     		<tbody>
     			@foreach ($memberships as $membership)
       			<tr>
       				<td>{{$membership->name}}</td>
              <td>{{$membership->duration_time}} {{$membership->durationsMode[$membership->duration_mode]}}</td>
       				<td>{{$membership->price}}</td>
       				<td>{{$membership->created_at }} / {{$membership->updated_at}}</td>
       				<td class="text-center">
       					<form action="{{ route('memberships.destroy',$membership->id) }}" method="POST">
       						<a href="{{ route('memberships.edit',$membership->id) }}" title="{{ trans('backend.membership.index.panel_caption') }}" class="btn btn-xs btn-warning"> {{ trans('backend.membership.index.td_edit') }}</a>
       							<input type="hidden" name="_token" value="{{ csrf_token() }}">
         						<input type="hidden" name="_method" value="DELETE">
         						<button type="submit" title="{{ trans('backend.membership.index.td_delete') }}" class="btn btn-xs btn-danger"> {{ trans('backend.membership.index.td_delete') }}</button>
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
      $('#membership-datatable').DataTable({
        @if (App::isLocale('es'))
        "language": {
          "url": "../public/js/datatables/json/es.json"
        }
        @endif
      });
  });
 </script>
@endsection