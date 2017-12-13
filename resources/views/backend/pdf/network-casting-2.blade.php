@extends($format ? 'layouts.excel' : 'layouts.pdf')
@section('body')
<caption class="title-report">{{trans('backend.dashboard.resume_country_casting.panel_heading_count_country_social')}} </caption>
	<table id="ticket-datatable" class="table table-bordered">
  		<thead>
	  		<tr>
	  			<th>{{trans('backend.dashboard.resume_country_casting.th_social_network')}}</th>
           <th>{{trans('backend.dashboard.resume_country_casting.th_count')}}</th>
	  		</tr>
  		</thead>
  		<tbody>
  			@if (count($socialMediaMoreUsed))
	  		@foreach ($socialMediaMoreUsed as $index =>  $net)
	  	 		<tr>
            <td>{{$net->occurrence}}</td>
            <td>{{$net->counter}} </td>
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