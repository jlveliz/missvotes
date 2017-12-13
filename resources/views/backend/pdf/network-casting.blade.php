@extends($format ? 'layouts.excel' : 'layouts.pdf')
@section('body')
	<table id="ticket-datatable" class="table table-bordered">
		<caption class="title-report">{{trans('backend.dashboard.resume_country_casting.panel_heading')}} </caption>
  		<thead>
	  		<tr>
	  			<th>Country</th>
	  			<th>Social Network</th>
	  		</tr>
  		</thead>
  		<tbody>
  			@if (count($networks))
	  		@foreach ($networks as $index =>  $net)
	  	 		<tr>
	  	 			<td>{{$net->country}}</td>
	  	 			<td>{{$net->occurrence}}</td>
	  	 		</tr>
	  		@endforeach
  			@else
  			<tr>
        		<td  colspan="2">{{ trans('backend.no-data') }}</td>
    		</tr>
  			@endif
  		</tbody>
  	</table>
@endsection