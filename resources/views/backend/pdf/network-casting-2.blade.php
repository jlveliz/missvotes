@extends($format ? 'layouts.excel' : 'layouts.pdf')
@section('body')
	<table id="ticket-datatable" class="table table-bordered">
  		<thead>
	  		<tr>
	  			<th>{{trans('backend.dashboard.resume_country_casting.th_social_network')}}</th>
	  		</tr>
  		</thead>
  		<tbody>
  			@if (count($socialMediaMoreUsed))
	  		@foreach ($socialMediaMoreUsed as $index =>  $net)
	  	 		<tr>
	  	 			<td>{{$net->occurrence}}</td>
	  	 		</tr>
	  		@endforeach
  			@else
  			<tr>
        		<td>{{ trans('backend.no-data') }}</td>
    		</tr>
  			@endif
  		</tbody>
  	</table>
@endsection