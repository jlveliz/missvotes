@extends('layouts.backend')
@section('content')
<div class="panel panel-default">
  <div class="panel-heading">{{ trans('backend.applicant.index.panel_title') }}</div>

  <div class="panel-body">
  	   @if (Session::has('mensaje'))
        <div class="alert alert-disapplicantible @if(Session::get('tipo_mensaje') == 'success') alert-info  @endif @if(Session::get('tipo_mensaje') == 'error') alert-danger  @endif" role="alert">
          <button type="button" class="close" data-disapplicant="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
          {{session('mensaje')}}
           </div>
        <div class="clearfix"></div>
       @endif
     	<table id="applicant-datatable" class="table table-bordered">
     		<caption>{{ trans('backend.applicant.index.panel_caption') }}</caption>
     		<thead>
     			<tr>
            <th>{{ trans('backend.applicant.index.th_names') }}</th>
     				<th>{{ trans('backend.applicant.index.th_code') }}</th>
            <th>{{ trans('backend.applicant.index.th_country') }}</th>
     				<th>{{ trans('backend.applicant.index.th_state') }}</th>
     				<th>{{ trans('backend.applicant.index.th_creation_date') }} / {{ trans('backend.applicant.index.th_upgrade') }}</th>
     				<th>{{ trans('backend.applicant.index.th_action') }}</th>
     			</tr>
     		</thead>
     		<tbody>
     			@foreach ($applicants as $applicant)
       			<tr>
       				<td>{{$applicant->name}} {{$applicant->last_name}}</td>
              <td>{{ $applicant->code }}</td>
       				<td>@if($applicant->country) {{$applicant->country->name}} @else - @endif</td>
       				<td>@if($applicant->state == '1') {{ trans('backend.applicant.index.td_for_evaluate') }} @else {{ trans('backend.applicant.index.td_disqualified') }} @endif</td>
       				<td>{{$applicant->created_at }} / {{$applicant->updated_at}}</td>
       				<td class="text-center">
                <form action="{{ route('applicants.destroy',$applicant->id) }}" method="POST">
                    <a href="{{ route('applicants.show',$applicant->id) }}" title="{{ trans('backend.applicant.index.td_show') }}" class="btn btn-xs btn-warning"> {{ trans('backend.applicant.index.td_show') }}</a>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" title="{{ trans('backend.applicant.index.td_delete') }}" class="btn btn-xs btn-danger delete"> {{ trans('backend.applicant.index.td_delete') }}</button>
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
      $('#applicant-datatable').DataTable({
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