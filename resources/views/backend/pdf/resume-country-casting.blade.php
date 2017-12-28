<div class="panel panel-default">
  <div class="panel-heading">
  	{{ trans('backend.dashboard.tickets_block.title') }}
  	<a target="_blank" href="{{ route('dashboard.export.clientTickets') }}"  type="button" class="btn btn-default"><i class="fa fa-file-pdf-o"> </i> PDF</a>
  </div>
  <div class="panel-body">
  	<table id="casting-1-datatable" class="table table-bordered">
  		<thead>
	  		<tr>
	  			<th>{{ trans('backend.dashboard.tickets_block.th_client') }}</th>
	  			<th>{{ trans('backend.dashboard.tickets_block.th_ticket') }}</th>
	  		</tr>
  		</thead>
  		<tbody>
        @if (count($tickets))
  	  		@foreach ($tickets as $index =>  $ticket)
  	  	 		<tr>
  	  	 			<td>{{$ticket->client->name}} {{$ticket->client->last_name}}</td>
  	  	 			<td>{{$ticket->description}}</td>
  	  	 		</tr>
  	  		@endforeach
        @else
         <tr>
          <td  colspan="2">{{ trans('backend.no-data') }}</td>
        </tr>
        @endif
  		</tbody>
  	</table>
  </div>
</div>
