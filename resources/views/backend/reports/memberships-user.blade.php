<div class="panel panel-default">
  <div class="panel-heading">{{ trans('backend.dashboard.membership_block.title') }}</div>
  <div class="panel-body">
  	<table id="memberships-datatable" class="table table-bordered">
  		<thead>
	  		<tr>
	  			<th>{{ trans('backend.dashboard.membership_block.th_membership') }}</th>
	  			<th>{{ trans('backend.dashboard.membership_block.th_number_user') }}</th>
	  		</tr>
  		</thead>
  		<tbody>
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
  		</tbody>
  	</table>
  </div>
</div>
