@extends($format ? 'layouts.excel' : 'layouts.pdf')
@section('body')
<table id="ticket-datatable" class="table table-bordered" width="50%">
	<caption class="title-report">{{ trans('backend.dashboard.tickets_block.title') }}</caption>
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
  	  	 			<td>{{$ticket->purchased}}</td>
  	  	 			<td>{{$ticket->availables}}</td>
  	  	 		</tr>
  	  		@endforeach
        @else
          <tr>
            <td colspan="2">{{ trans('backend.no-date') }}</td>
          </tr>
        @endif
  		</tbody>
  	</table>
@endsection