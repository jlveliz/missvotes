@extends('layouts.backend')
@section('content')
<div class="panel panel-default">
  <div class="panel-heading">Candidatas</div>
  <div class="panel-body">
  	<caption>Listado de actividades de clientes </caption>
  	<table id="activity-datatable" class="table table-bordered">
  		<thead>
	  		<tr>
	  			<th>Evento</th>
	  			<th>Fecha de evento</th>
	  		</tr>
  		</thead>
  		<tbody>
  			@foreach ($activities as $activity)
  				<tr>
  					<td>{{ $activity->client->name }} {{ $activity->name }}</td>
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
        "language": {
          "url": "../public/js/datatables/json/es.json"
        },
         "order": [[ 1, "desc" ]],
      });
  });
 </script>
@endsection