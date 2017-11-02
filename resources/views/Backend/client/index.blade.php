@extends('layouts.backend')
@section('content')
<div class="panel panel-default">
  <div class="panel-heading">{{ trans('backend.client.index.panel_title') }}</div>

  <div class="panel-body">
  	   @if (Session::has('mensaje'))
        <div class="alert alert-dismissible @if(Session::get('tipo_mensaje') == 'success') alert-info  @endif @if(Session::get('tipo_mensaje') == 'error') alert-danger  @endif" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
          {{session('mensaje')}}
           </div>
        <div class="clearfix"></div>
       @endif
     	<table id="client-datatable" class="table table-bordered">
     		<caption>{{ trans('backend.client.index.panel_caption') }} <a class="pull-right btn btn-primary" href="{{ route('clients.create') }}" title="{{ trans('backend.client.index.btn_create_client') }}">{{ trans('backend.client.index.btn_create_client') }}</a></caption>
     		<thead>
     			<tr>
            <th>{{ trans('backend.client.index.th_account_type') }}</th>
     				<th>{{ trans('backend.client.index.th_name') }}</th>
     				<th>{{ trans('backend.client.index.th_email') }}</th>
     				<th>{{ trans('backend.client.index.th_address') }}</th>
     				<th>{{ trans('backend.client.index.th_last_access') }}</th>
     				<th>{{ trans('backend.client.index.th_creation_date') }} / {{ trans('backend.client.index.th_upgrade') }}</th>
     				<th>{{ trans('backend.client.index.th_action') }}</th>
     			</tr>
     		</thead>
     		<tbody>
     			@foreach ($clients as $client)
       			<tr  @if(!$client->confirmed) class="warning" @endif>
              <td>{{ $client->current_membership() ? $client->current_membership()->membership->name : 'Free' }}</td>
       				<td>{{$client->name}}  @if(!$client->confirmed) <small><i>({{ trans('backend.client.index.td_without_confirm') }})</i> </small> @endif</td>
       				<td>{{$client->email}}</td>
       				<td>{{$client->address}}</td>
       				<td>@if($client->last_login){{$client->last_login}} @else - @endif</td>
       				<td>{{$client->created_at }} / {{$client->updated_at}}</td>
       				<td class="text-center">
       					<form action="{{ route('clients.destroy',$client->id) }}" method="POST">
       						<a href="{{ route('clients.edit',$client->id) }}" title="{{ trans('backend.client.index.td_edit') }}" class="btn btn-xs btn-warning"> {{ trans('backend.client.index.td_edit') }}</a>
       						@if (Auth::user()->id != $client->id)
         						<input type="hidden" name="_token" value="{{ csrf_token() }}">
         						<input type="hidden" name="_method" value="DELETE">
         						<button type="submit" title="{{ trans('backend.client.index.td_delete') }}" class="btn btn-xs btn-danger delete"> {{ trans('backend.client.index.td_delete') }}</button>
       						@endif
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
      $('#client-datatable').DataTable({
        @if (App::isLocale('es'))
        "language": {
          "url": "../public/js/datatables/json/es.json"
        }
        @endif
      });

      $(".delete").on('click', function(event) {
        event.preventDefault();
        event.stopPropagation();
        var deleteRegister = confirm('Esta usted seguro de eliminar el registro? ');

        if (deleteRegister) {
          $(this).parents('form').submit();
        }
      });
  });
 </script>
@endsection