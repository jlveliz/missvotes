<div class="panel panel-default">
  <div class="panel-heading">Membresias</div>
  <div class="panel-body">
  	<table id="memberships-datatable" class="table table-bordered">
  		<thead>
	  		<tr>
	  			<th>Membresia</th>
	  			<th>Número de Usuarios</th>
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
