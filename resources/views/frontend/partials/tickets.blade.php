<h5><b>Compre tickets para votar!!</b></h5>
@foreach ($tickets as $ticket)
	<div class="col-xs-12 col-md-3">
		 <div class="panel panel-success">
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
		 	<div class="panel-footer panel-footer-payments">
                    <button type="button" class="btn btn-sm btn-success pay-ticket-with-stripe" data-email="{{Auth::user()->email}}" data-amount="{{ (int) $ticket->price.'00'}}" data-ticket="{{$ticket->id}}" data-description="Pago de ticket {{$ticket->name}}" role="button"> <i class="fa fa-credit-card"></i> Usar Tarjeta</button>
                    <form action="{{ route('website.paypal.buyticket') }}" method="POST" style="display: inline;">
                    	{{ csrf_field() }}
                    	<input type="hidden" name="paypal_email" value="{{ Auth::user()->email }}">
                    	<input type="hidden" name="paypal_ticket_id" value="{{ $ticket->id }}">
                    	<input type="hidden" name="paypal_ticket_name" value="{{ $ticket->name }}">
                    	<input type="hidden" name="paypal_ticket_description" value="Pago de ticket {{ $ticket->name }}">
                    	<input type="hidden" name="paypal_ticket_amount" value="{{ $ticket->price }}">
                    	<button type="submit" class="btn  btn-sm btn-success" role="button" title=""><i class="fa fa-paypal"></i> Usar Paypal</button>
                    </form>
                </div>
		 </div>
	</div>
@endforeach

{{-- the magic form --}}
<form id="ticket-form" action="{{ route('website.stripe.buyticket') }}" method="POST" style="visibility: hidden;">
    {{ csrf_field() }}
    <input type="hidden" id="ticket-id" name="ticket_id" value="">
    <input type="hidden" id="amount-ticket" name="amount" value="">
    <input type="hidden" id="stripe-ticket-token" name="stripeToken" value="">
</form>