<h5><b>Compre tickets para votar!!</b></h5>
@foreach ($tickets as $ticket)
	<div class="col-xs-12 col-md-3">
		 <div class="panel panel-primary">
		 	<div class="panel-heading">
		 		<h3 class="panel-title"> <i class="fa fa-ticket" aria-hidden="true"></i> {{$ticket->name}}</h3>
		 	</div>
		 	<div class="panel-body">
		 		<table class="table">
		 			<tbody>
		 				<tr>
		 					<td><b>Valor: </b> {{$ticket->val_vote}} Puntos</td>
		 				</tr>
		 			</tbody>
		 		</table>
		 	</div>
		 	<div class="panel-footer">
				<a href="#" class="btn btn-success" role="button"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Comprar</a>
			</div>
		 </div>
	</div>
@endforeach