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
				<form action="{{ route('list.buy.ticket.add') }}" method="POST">
					{{  csrf_field() }}
					<input type="hidden" name="raffle_number" value="{{ $raffle }}">
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
				</form>
			@endforeach
			<div class="clearfix"></div>
			<div class="row text-center">
				{{ $raffles->links() }}
			</div>
		</div>
		{{-- cart --}}
		<div class="col-md-3 col-xs-4">
			<div class="cart-place">
				<div class="panel panel-info">
					<div class="panel-heading">
						<div class="panel-title">
							<div class="row">
								<div class="col-xs-12">
									<h5><span class="glyphicon glyphicon-shopping-cart"></span> {{ trans('raffle_ticket.shopping_cart_title') }}</h5>
								</div>
							</div>
						</div>
					</div>
					<div class="panel-body">
						@if (session()->has('cart'))
							<div class="row">
								@foreach (session()->get('cart') as $item) 
									<div class="col-xs-4">
										<h6 class="product-name"><strong>Ticket # {{ $item['raffle_number'] }} </strong></h6>
									</div>
									<div class="col-xs-3">
										<h6><strong>{{ $item['points'] }} Pnts.</h6>
									</div>
									<div class="col-xs-2">
										<h6><strong>$ {{ $item['price'] }}</h6>
									</div>
									<div class="col-xs-2">
										<button type="button" class="btn btn-link btn-xs">
											<span class="glyphicon glyphicon-trash"> </span>
										</button>
									</div>
								@endforeach
							</div>
							<hr>
						@else
							<p class="text-muted"><b>{{ trans('raffle_ticket.no_ticket_selected') }}</b></p>
							<hr>
						@endif
					</div>
					<div class="panel-footer">
						<div class="row text-center">
							<div class="col-xs-6">
								<h4 class="text-right">Total <strong>$ {{ session()->has('total_sum') ?  session()->get('total_sum') : "0.00" }}   </strong></h4>
							</div>
							<div class="col-xs-6">
								<button type="button" class="btn btn-success btn-block">
									<i class="fa fa-shopping-cart" aria-hidden="true"></i> {{ trans('raffle_ticket.buy_ticket_button') }}
								</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection