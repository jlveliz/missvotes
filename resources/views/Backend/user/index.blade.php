@extends('layouts.backend')
@section('content')
<div class="panel panel-default">
  <div class="panel-heading">{{ trans('backend.user.index.panel_title') }}</div>

  <div class="panel-body">
  	   @if (Session::has('mensaje'))
        <div class="alert alert-dismissible @if(Session::get('tipo_mensaje') == 'success') alert-info  @endif @if(Session::get('tipo_mensaje') == 'error') alert-danger  @endif" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
          {{session('mensaje')}}
           </div>
        <div class="clearfix"></div>
       @endif
     	<table id="user-datatable" class="table table-bordered">
     		<caption>{{ trans('backend.user.index.panel_caption') }} <a class="pull-right btn btn-primary" href="{{ route('users.create') }}" title="{{ trans('backend.user.index.btn_create') }}">{{ trans('backend.user.index.btn_create') }}</a></caption>
     		<thead>
     			<tr>
     				<th>{{ trans('backend.user.index.th_name') }}</th>
     				<th>{{ trans('backend.user.index.th_email') }}</th>
     				<th>{{ trans('backend.user.index.th_address') }}</th>
     				<th>{{ trans('backend.user.index.th_last_access') }}</th>
     				<th>{{ trans('backend.user.index.th_creation_date') }} / {{ trans('backend.user.index.th_upgrade') }}</th>
     				<th>{{ trans('backend.user.index.th_action') }}</th>
     			</tr>
     		</thead>
     		<tbody>
     			@foreach ($users as $user)
       			<tr>
       				<td>{{$user->name}}</td>
       				<td>{{$user->email}}</td>
       				<td>{{$user->address}}</td>
       				<td>@if($user->last_login){{$user->last_login}} @else - @endif</td>
       				<td>{{$user->created_at }} / {{$user->updated_at}}</td>
       				<td class="text-center">
       					<form action="{{ route('users.destroy',$user->id) }}" method="POST">
       						<a href="{{ route('users.edit',$user->id) }}" title="{{ trans('backend.user.index.td_edit') }}" class="btn btn-xs btn-warning"> {{ trans('backend.user.index.td_edit') }}</a>
       						@if (Auth::user()->id != $user->id)
         						<input type="hidden" name="_token" value="{{ csrf_token() }}">
         						<input type="hidden" name="_method" value="DELETE">
         						<button type="submit" title="{{ trans('backend.user.index.td_delete') }}" class="btn btn-xs btn-danger delete"> {{ trans('backend.user.index.td_delete') }}</button>
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
      $('#user-datatable').DataTable({
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