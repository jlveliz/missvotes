<div class="panel panel-default">
  <div class="panel-heading">
  	{{trans('backend.dashboard.resume_country_casting.panel_heading')}}
  	<a target="_blank" href="{{ route('dashboard.export.countries-network') }}"  type="button" class="btn btn-default"><i class="fa fa-file-pdf-o"> </i> PDF</a>
  </div>
  <div class="panel-body">
  	<table id="ticket-datatable" class="table table-bordered">
  		<thead>
	  		<tr>
	  			<th>{{trans('backend.dashboard.resume_country_casting.th_country')}}</th>
	  			<th>{{trans('backend.dashboard.resume_country_casting.th_social_network')}}</th>
	  		</tr>
  		</thead>
  		<tbody>
	  		@foreach ($casting as $index =>  $cast)
	  	 		<tr>
	  	 			<td>{{$cast->country}}</td>
	  	 			<td>{{$cast->occurrence}}</td>
	  	 		</tr>
	  		@endforeach
  		</tbody>
  	</table>
  </div>
</div>
