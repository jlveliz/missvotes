@extends('layouts.backend')
@section('content')
<div class="panel panel-default">
  <div class="panel-heading">{{ trans('backend.activity.index.panel_title') }}</div>
  <div class="panel-body">
  	<caption>{{ trans('backend.activity.index.panel_caption') }} </caption>
  	<table id="activity-datatable" class="table table-bordered">
  		<thead>
	  		<tr>
	  			<th>{{ trans('backend.activity.index.th_activity') }}</th>
	  			<th>{{ trans('backend.activity.index.th_date') }}</th>
	  		</tr>
  		</thead>
  		<tbody>
  			@foreach ($activities as $activity)
  				<tr>
  					<td>
              {{ $activity->client->name }} {!! trans('activity.has')!!} @if($activity->params)  {!! trans($activity->name,$activity->params)!!} @else {!! trans($activity->name)!!}  @endif 
            </td>
  					<td>{{ $activity->created_at }}</td>
  				</tr>
  			@endforeach
  		</tbody>
  		
  	</table>
  </div>
</div>
@endsection()

@section('js')
<script type="text/javascript">
  $(document).ready(function(){
      $('#activity-datatable').DataTable({
        @if (App::isLocale('es'))
        "language": {
          "url": "../public/js/datatables/json/es.json"
        },
        @endif
         "order": [[ 1, "desc" ]],
      });
  });
 </script>
@endsection