<div class="panel panel-default">
  <div class="panel-heading">
  	{{trans('backend.dashboard.resume_country_casting.panel_heading')}}
    <div class="btn-group">
    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ trans('backend.dashboard.export') }}  <span class="caret"></span></button>
    <ul class="dropdown-menu">
      <li><a target="_blank" href="{{ route('dashboard.export.countries-network') }}"><i class="fa fa-file-pdf-o"> </i> PDF</a></li>
      <li><a target="_blank" href="{{ route('dashboard.export.countries-network',['format'=>'xls']) }}"><i class="fa fa-file-excel-o"> </i> EXCEL</a></li>
    </ul>
  </div>
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
