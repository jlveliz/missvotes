<div class="panel panel-default">
  <div class="panel-heading">{{ trans('backend.dashboard.membership_block.title') }}
  <a target="_blank" href="{{ route('dashboard.export.memberships') }}"  type="button" class="btn btn-default"><i class="fa fa-file-pdf-o"> </i> PDF</a>
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
  				<td colspan="2">Ningún dato disponible en esta tabla</td>
  			</tr>
  			@endif
  		</tbody>
  	</table>
  </div>
</div>
