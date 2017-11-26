@extends('layouts.pdf')
@section('body')
<table id="ticket-datatable" class="table table-bordered">
	<caption class="title-report">{{ trans('backend.dashboard.tickets_block.title') }}</caption>
  		<thead>
	  		<tr>
	  			<th>{{ trans('backend.dashboard.tickets_block.th_client') }}</th>
	  			<th>{{ trans('backend.dashboard.tickets_block.th_ticket') }}</th>
	  		</tr>
  		</thead>
  		<tbody>
  			@if (count($tickets) > 0)
		  		@foreach ($tickets as $index =>  $ticket)
		  	 		<tr>
		  	 			<td>{{$ticket->client->name}} {{$ticket->client->last_name}}</td>
		  	 			<td>{{$ticket->description}}</td>
		  	 		</tr>
		  		@endforeach
  			@else
			<tr>
				<td colspan="2"></td>
			</tr>
  			@endif
  		</tbody>
  	</table>
@endsection