@extends('layouts.backend')
@section('content')
<div class="panel panel-default">
  <div class="panel-heading">{{ trans('backend.precandidate.index.panel_title') }}</div>

  <div class="panel-body">
  	   @if (Session::has('mensaje'))
        <div class="alert alert-disprecandidateible @if(Session::get('tipo_mensaje') == 'success') alert-info  @endif @if(Session::get('tipo_mensaje') == 'error') alert-danger  @endif" role="alert">
          <button type="button" class="close" data-disprecandidate="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
          {{session('mensaje')}}
           </div>
        <div class="clearfix"></div>
       @endif
     	<table id="precandidate-datatable" class="table table-bordered">
     		<caption>{{ trans('backend.precandidate.index.panel_caption') }}</caption>
     		<thead>
     			<tr>
            <th>{{ trans('backend.precandidate.index.th_names') }}</th>
     				<th>{{ trans('backend.precandidate.index.th_code') }}</th>
            <th>{{ trans('backend.precandidate.index.th_country') }}</th>
     				<th>{{ trans('backend.precandidate.index.th_state') }}</th>
     				<th>{{ trans('backend.precandidate.index.th_creation_date') }} / {{ trans('backend.precandidate.index.th_upgrade') }}</th>
     				<th>{{ trans('backend.precandidate.index.th_action') }}</th>
     			</tr>
     		</thead>
     		<tbody>
     			@foreach ($precandidates as $precandidate)
       			<tr>
       				<td>{{$precandidate->name}} {{$precandidate->last_name}}</td>
              <td>{{ $precandidate->code }}</td>
       				<td>@if($precandidate->country) {{$precandidate->country->name}} @else - @endif</td>
       				<td>@if($precandidate->state == '1') {{ trans('backend.precandidate.index.td_for_evaluate') }} @else {{ trans('backend.precandidate.index.td_disqualified') }} @endif</td>
       				<td>{{$precandidate->created_at }} / {{$precandidate->updated_at}}</td>
       				<td class="text-center">
                <form action="{{ route('precandidates.destroy',$precandidate->id) }}" method="POST">
                    <a href="{{ route('precandidates.show',$precandidate->id) }}" title="{{ trans('backend.precandidate.index.td_show') }}" class="btn btn-xs btn-warning"> {{ trans('backend.precandidate.index.td_show') }}</a>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" title="{{ trans('backend.precandidate.index.td_delete') }}" class="btn btn-xs btn-danger delete"> {{ trans('backend.precandidate.index.td_delete') }}</button>
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
      $('#precandidate-datatable').DataTable({
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