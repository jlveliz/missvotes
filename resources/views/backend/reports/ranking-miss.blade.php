@extends('layouts.backend')
@section('content')
<div class="panel panel-default">
  <div class="panel-heading">Ranking</div>
  <div class="panel-body">
  	<table id="ranking-datatable" class="table table-bordered">
  		<thead>
	  		<tr>
	  			<th>Candidata</th>
	  			<th>País</th>
	  			<th>Puntaje</th>
	  		</tr>
  		</thead>
  		<tbody>
	  		@foreach ($votes as $index =>  $vote)
	  	 		<tr @if ($index == 0) class="success" @endif>
	  				<td>@if ($index == 0) <b>{{$vote->miss->name}} {{$vote->miss->last_name}}</b> @else {{$vote->miss->name}} {{$vote->miss->last_name}} @endif </td>
	  				<td>@if ($index == 0) <b>{{$vote->miss->country->name}}</b> @else {{$vote->miss->country->name}} @endif</td>
	  				<td>@if ($index == 0) <b>{{$vote->sumatory}} Puntos</b> @else {{$vote->sumatory}} Puntos @endif </td>
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
      // $('#ranking-datatable').DataTable({
      //   "language": {
      //     "url": "../public/js/datatables/json/es.json",
      //   },
      //   "order": [[ 2, "desc" ]],
      //   "ordering": false,
      // });
  });
 </script>
@endsection