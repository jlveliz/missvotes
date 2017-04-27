@extends('layouts.frontend')
@section('css')
	<link rel="stylesheet" href="{{ asset('/public/css/raffles.css') }}">
@endsection
@section('content')
	<div class="row">
		<h1 class="text-center"> @lang('raffle_ticket.tittle_raffle')</h1>
	</div>
	<div class="row">
		<div class="col-md-12 col-xs-12">
			<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
				<div class="panel panel-warning">
					<div class="panel-heading" role="tab" id="headingOne">
				      <h4 class="panel-title">
				        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
				          {{ trans('raffle_ticket.policies.title') }}
				        </a>
				      </h4>
					</div>
					<div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
					    <div class="panel-body">
					        <ul>
		        				<li>{{ trans('raffle_ticket.policies.policy_1') }}</li>
		        				<li>{{ trans('raffle_ticket.policies.policy_2') }}</li>
		        				<li>{{ trans('raffle_ticket.policies.policy_3') }}</li>
		        				<li>{{ trans('raffle_ticket.policies.policy_4') }}</li>
		        				<li>{{ trans('raffle_ticket.policies.policy_5') }}</li>
					        </ul>
					        <p class="text-muted text-justify"><b>{{ trans('raffle_ticket.policies.note') }}</b></p>
					    </div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		{{-- tickets --}}
		<div class="col-md-9 col-xs-8">
			@foreach ($raffles as $raffle)
				<div class="col-md-2 col-xs-2">
					<div class="panel panel-success">
	  					<div class="panel-body ">
							<h1 class="text-center"><b>{{ $raffle }}</b></h1>
	  					</div>
	  					<div class="panel-footer">
	  						<button class="btn btn-primary btn-block btn-xs text-center" title="{{ trans('raffle_ticket.add_cart') }}" alt="{{ trans('raffle_ticket.add_cart') }}"><i class="fa fa-cart-plus"></i></button>
	  					</div>
					</div>
				</div>
			@endforeach
			<div class="clearfix"></div>
			<div class="row text-center">
				{{ $raffles->links() }}
			</div>
		</div>
		{{-- cart --}}
		<div class="col-md-3 col-xs-4 affix">
			<h1>Shopping Cart</h1><hr>
				<table class="table table-striped table-hover table-bordered">
			        <tbody>
			            <tr>
			                <th>Item</th>
			                <th>Total Price</th>
			            </tr>
			            <tr>
			                <td>Ticket 001</td>
			                <td>$249</td>
			            </tr>
			            <tr>
			                <th><span class="pull-right">Sub Total</span></th>
			                <th>$250.00</th>
			            </tr>
			            <tr>
			                <th><span class="pull-right">Total</span></th>
			                <th>$300.00</th>
			            </tr>
			            <tr>
			                <td><a href="#" class="btn btn-primary">Continue Shopping</a></td>
			                <td><a href="#" class="pull-right btn btn-success">Checkout</a></td>
			            </tr>
			        </tbody>
			    </table>          
			      
			<p class="text-muted"><b>{{ trans('raffle_ticket.no_ticket_selected') }}</b></p>
		</div>
	</div>
@endsection