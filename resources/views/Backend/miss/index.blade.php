@extends('layouts.backend')
@section('content')
<div class="panel panel-default">
  <div class="panel-heading">{{ trans('backend.misses.index.panel_title') }}</div>

  <div class="panel-body">
  	   @if (Session::has('mensaje'))
        <div class="alert alert-dismissible @if(Session::get('tipo_mensaje') == 'success') alert-info  @endif @if(Session::get('tipo_mensaje') == 'error') alert-danger  @endif" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
          {{session('mensaje')}}
           </div>
        <div class="clearfix"></div>
       @endif
     	<table id="miss-datatable" class="table table-bordered">
     		<caption>{{ trans('backend.misses.index.panel_caption') }} <a class="pull-right btn btn-primary" href="{{ route('misses.create') }}" title="{{ trans('backend.misses.index.btn_create') }}" alt="{{ trans('backend.misses.index.btn_create') }}">{{ trans('backend.misses.index.btn_create') }} </a></caption>
     		<thead>
     			<tr>
     				<th>{{ trans('backend.misses.index.th_names') }}</th>
            <th>{{ trans('backend.misses.index.th_country') }}</th>
     				<th>{{ trans('backend.misses.index.th_state') }}</th>
     				<th>{{ trans('backend.misses.index.th_creation_date') }}/{{ trans('backend.misses.index.th_upgrade') }}</th>
     				<th>{{ trans('backend.misses.index.th_action') }}</th>
     			</tr>
     		</thead>
     		<tbody>
     			@foreach ($misses as $miss)
       			<tr>
       				<td>{{$miss->name}} {{$miss->last_name}}</td>
       				<td>@if($miss->country) {{$miss->country->name}} @else - @endif</td>
       				<td>@if($miss->state == '1') {{ trans('backend.misses.index.td_state_active') }} @else {{ trans('backend.misses.index.td_state_inactive') }} @endif</td>
       				<td>{{$miss->created_at }} / {{$miss->updated_at}}</td>
       				<td class="text-center">
                <form action="{{ route('misses.destroy',$miss->id) }}" method="POST">
                  
                </form>
       					<form action="{{ route('misses.destroy',$miss->id) }}" method="POST">
       						<a href="{{ route('misses.edit',$miss->id) }}" title="{{ trans('backend.misses.index.td_edit') }}" class="btn btn-xs btn-warning"> {{ trans('backend.misses.index.td_edit') }}</a>
         						<input type="hidden" name="_token" value="{{ csrf_token() }}">
         						<input type="hidden" name="_method" value="DELETE">
         						<button type="submit" title="{{ trans('backend.misses.index.td_delete') }}" class="btn btn-xs btn-danger delete"> {{ trans('backend.misses.index.td_delete') }}</button>
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
      $('#miss-datatable').DataTable({
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