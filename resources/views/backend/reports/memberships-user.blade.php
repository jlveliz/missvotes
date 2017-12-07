<div class="panel panel-default">
  <div class="panel-heading">{{ trans('backend.dashboard.membership_block.title') }}
  <div class="btn-group">
    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ trans('backend.dashboard.export') }}  <span class="caret"></span></button>
    <ul class="dropdown-menu">
      <li><a target="_blank" href="{{ route('dashboard.export.memberships') }}"><i class="fa fa-file-pdf-o"> </i> PDF</a></li>
      <li><a target="_blank" href="{{ route('dashboard.export.memberships',['format'=>'xls']) }}"><i class="fa fa-file-excel-o"> </i> EXCEL</a></li>
    </ul>
  </div>
  
</div>
  <div class="panel-body">
  	<table id="memberships-datatable" class="table table-bordered">
  		<thead>
	  		<tr>
	  			<th>{{ trans('backend.dashboard.membership_block.th_membership') }}</th>
	  			<th>{{ trans('backend.dashboard.membership_block.th_number_user') }}</th>
	  		</tr>
  		</thead>
  		<tbody>
  			@if (count($countUserMemberships) > 0)
	  		@foreach ($countUserMemberships as $index =>  $userMembership)
	  	 		<tr>
	  	 			<td>
	  	 				{{ !$userMembership->membership ? 'Free' : 'Premium' }}
	  	 			</td>
	  	 			<td>
	  	 				{{$userMembership->counter}}
	  	 			</td>
	  	 		</tr>
	  		@endforeach
  			@else
  			<tr>
              <td colspan="2">{{ trans('backend.no-data') }}</td>
            </tr>
  			@endif
  		</tbody>
  	</table>
  </div>
</div>
