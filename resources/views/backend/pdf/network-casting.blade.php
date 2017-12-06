@extends($format ? 'layouts.excel' : 'layouts.pdf')
@section('body')
	<table id="ticket-datatable" class="table table-bordered">
  		<thead>
	  		<tr>
	  			<th>Country</th>
	  			<th>Social Network</th>
	  		</tr>
  		</thead>
  		<tbody>
	  		@foreach ($networks as $index =>  $net)
	  	 		<tr>
	  	 			<td>{{$net->country}}</td>
	  	 			<td>{{$net->occurrence}}</td>
	  	 		</tr>
	  		@endforeach
  		</tbody>
  	</table>
@endsection