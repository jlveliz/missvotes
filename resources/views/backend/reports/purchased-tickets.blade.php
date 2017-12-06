<div class="panel panel-default">
  <div class="panel-heading">
  	{{ trans('backend.dashboard.tickets_block.title') }}
    <div class="btn-group">
    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ trans('backend.dashboard.export') }}  <span class="caret"></span></button>
    <ul class="dropdown-menu">
      <li><a target="_blank" href="{{ route('dashboard.export.clientTickets') }}"><i class="fa fa-file-pdf-o"> </i> PDF</a></li>
      <li><a target="_blank" href="{{ route('dashboard.export.clientTickets',['format'=>'xls']) }}"><i class="fa fa-file-excel-o"> </i> EXCEL</a></li>
    </ul>
  </div>
  </div>
  <div class="panel-body">
  	<table id="ticket-datatable" class="table table-bordered">
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
            <td colspan="2">Ningún dato disponible en esta tabla</td>
          </tr>
        @endif
  		</tbody>
  	</table>
  </div>
</div>
