<div class="panel panel-default">
  <div class="panel-heading">Ranking</div>
  <div class="panel-body">
  	<table id="ticket-datatable" class="table table-bordered">
  		<thead>
	  		<tr>
	  			<th>Cliente</th>
	  			<th>Ticket</th>
	  		</tr>
  		</thead>
  		<tbody>
	  		@foreach ($tickets as $index =>  $ticket)
	  	 		<tr>
	  	 			<td>{{$ticket->client->name}} {{$ticket->client->last_name}}</td>
	  	 			<td>{{$ticket->description}}</td>
	  	 		</tr>
	  		@endforeach
  		</tbody>
  	</table>
  </div>
</div>
