@extends('layouts.frontend')
@section('css')
	<link rel="stylesheet" href="{{ asset('/public/css/raffles.css') }}">
@endsection
@section('content')
	<div class="row">
		<h1 class="text-center"> @lang('raffle_ticket.tittle_raffle')</h1>
		<h3 class="text-center"> {{ trans('raffle_ticket.subtitle_raffle') }}</h3>
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
					        <ol class="text-justify">
		        				<li><strong>{{ trans('raffle_ticket.policies.policy_1') }}</strong> </li>
		        				<li>
		        					<strong>{{ trans('raffle_ticket.policies.policy_2') }}</strong> {{ trans('raffle_ticket.policies.policy_2_1') }}
		        					<ul>
		        						<li>{{ trans('raffle_ticket.policies.policy_2_1_1') }}</li>
		        						<li>{{ trans('raffle_ticket.policies.policy_2_1_2') }}</li>
		        						<ul>
		        							<li>{{ trans('raffle_ticket.policies.policy_2_1_2_1') }}</li>
		        						</ul>
		        					</ul>
		        				</li>
		        				<li><strong>{{ trans('raffle_ticket.policies.policy_3') }}</strong> {{ trans('raffle_ticket.policies.policy_3_1') }}</li>
		        				<li>
		        					<strong>{{ trans('raffle_ticket.policies.policy_4') }}</strong>
		        					{{ trans('raffle_ticket.policies.policy_4_1') }}
		        				</li>
		        				<li>
		        					<strong>{{ trans('raffle_ticket.policies.policy_5') }}</strong>
		        					{{ trans('raffle_ticket.policies.policy_5_1') }}
		        					<ul>
		        						<li>{{ trans('raffle_ticket.policies.policy_5_1_1') }}</li>
		        						<li>{{ trans('raffle_ticket.policies.policy_5_1_2') }}</li>
		        						<li>{{ trans('raffle_ticket.policies.policy_5_1_3') }}</li>
		        						<li>{{ trans('raffle_ticket.policies.policy_5_1_4') }}</li>
		        						<li>{{ trans('raffle_ticket.policies.policy_5_1_5') }}</li>
		        						<li>{{ trans('raffle_ticket.policies.policy_5_1_6') }}</li>
		        					</ul>
		        				</li>
		        				<li>
		        					<strong>{{ trans('raffle_ticket.policies.policy_6') }}</strong>
		        					{{ trans('raffle_ticket.policies.policy_6_1') }}
		        				</li>
		        				<li>
		        					<strong>{{ trans('raffle_ticket.policies.policy_7') }}</strong>
		        					{{ trans('raffle_ticket.policies.policy_7_1') }}
		        				</li>
		        				<li>
		        					<strong>{{ trans('raffle_ticket.policies.policy_8') }}</strong>
		        					{{ trans('raffle_ticket.policies.policy_8_1') }}
		        				</li>
		        				<li>
		        					<strong>{{ trans('raffle_ticket.policies.policy_9') }}</strong>
		        					{{ trans('raffle_ticket.policies.policy_9_1') }}
		        				</li>
					        </ol>
					    </div>
					</div>
				</div>
			</div>
		</div>
	</div>

	@if (Session::has('mensaje'))
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="alert alert-dismissible @if(Session::get('tipo_mensaje') == 'success') alert-info  @endif @if(Session::get('tipo_mensaje') == 'error') alert-danger  @endif" role="alert">
		  			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
		  			{{ session('mensaje') }}
		   		</div>
				<div class="clearfix"></div>
			</div>
		</div>
	@endif
	@if (Session::has('payment-message'))
		<div class="row">
			<div class="col-md-12 col-xs-12">
		        <div class="alert alert-dismissible @if(Session::get('payment-type') == 'success') alert-info  @endif @if(Session::get('payment-type') == 'error') alert-danger  @endif" role="alert">
		          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
		          {{session('payment-message')}}
		        </div>
			</div>
		</div>
        <div class="clearfix"></div>
    @endif

	<div class="row">
		{{-- cart --}}
		<div class="col-md-3 col-sm-12 col-xs-12">
			<div class="cart-place" data-spy="affix" data-offset-top="150">
				<ul class="list-inline text-center">
					<li style="display: inline;">
						@if (App::isLocale('en'))
							<img style="width: 25%" src="{{ asset('public/images/trip.jpg') }}" alt="Trip" title="Trip">
						@else
							<img style="width: 25%" src="{{ asset('public/images/trip_es.jpg') }}" alt="Viaje" title="Viaje">
						@endif
					</li>
					<li style="display: inline;">
						<img style="width: 25%" src="{{ asset('public/images/junior.png') }}" alt="Junior Foundation" title="Junior Foundation">
					</li>
					<li style="display: inline;">
						@if (App::isLocale('en'))
							<img style="width: 25%" src="{{ asset('public/images/5points.jpg') }}" alt="5 Points" title="5 Points">
						@else
							<img style="width: 25%" src="{{ asset('public/images/5ptos.jpg') }}" alt="5 Puntos" title="5 Puntos">
						@endif
					</li>
				</ul>
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
								<table class="table">
									@foreach (session()->get('cart') as $key =>  $item) 
										<tr>
											<td>
												<strong>Ticket # {{ $item['raffle_number'] }} </strong>
											</td>
											<td><strong>{{ $item['points'] }} Pnts.</strong></td>
											<td><strong>$ {{ $item['price'] }}<strong></td>
											<td>
												<form action="{{ route('list.buy.ticket.remove') }}" method="POST">
													{{  csrf_field() }}
													<input type="hidden" name="ticket_index" value="{{ $key }}">
													<input type="hidden" name="raffle_number" value="{{ $item['raffle_number'] }}">
													<button type="submit" class="btn btn-link btn-xs btn-remove" alt="{{ trans('raffle_ticket.delete_cart') }}" title="{{ trans('raffle_ticket.delete_cart') }}">
														<span class="glyphicon glyphicon-trash"> </span>
													</button>
												</form>
											</td>
										</tr>
									@endforeach
								</table>
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
									@if (session()->has('cart'))
									<form action="{{ route('website.paypal.buyticket') }}" method="post">
										{{  csrf_field() }}
											@foreach (session()->get('cart') as $key =>  $item) 
												<input type="hidden" name="tickets[{{ $key }}][description]" value="Ticket #{{ $item['raffle_number'] }}">
												<input type="hidden" name="tickets[{{ $key }}][raffle_vote_id]" value="{{ $item['raffle_number'] }}">
											@endforeach
										<input type="hidden" name="amount" value="{{ session()->get('total_sum') }}">
										<button type="submit" class="btn btn-success btn-block" alt="{{ trans('raffle_ticket.buy_ticket_button') }}" title="{{ trans('raffle_ticket.buy_ticket_button') }}">
											<i class="fa fa-paypal" aria-hidden="true"></i> {{ trans('raffle_ticket.buy_ticket_button') }}
										</button>
									</form>
									@endif
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		{{-- tickets --}}
		<div class="col-md-9 col-xs-12">

			{{-- signals --}}
			<ul class="list-unstyled text-center list-inline">
				<li><i class="fa fa-square reserved-color fa-lg""></i> <b> {{ trans('raffle_ticket.signals.reserved') }}</b></li>
				<li><i class="fa fa-square selected-now-color fa-lg"> </i> <b> {{ trans('raffle_ticket.signals.selected') }}</b></li>
				<li><i class="fa fa-square available-color fa-lg"></i> <b> {{ trans('raffle_ticket.signals.available') }}</b></li>
			</ul>
			<hr>
			<div class="col-md-12 col-xs-12 col-sm-6 text-right">
				<form action="{{ route('list.buy.ticket.query') }}" method="GET" class="form-inline">
					<div class="form-group">
						    <label for="exampleInputEmail2">{{ trans('raffle_ticket.search_form.label') }}</label>
						    <input type="text" class="form-control" name="query" id="" placeholder="{{ trans('raffle_ticket.search_form.input') }}" value="@if(isset($query)){{$query}}@endif">
					  </div>
					  <button type="submit" class="btn btn-primary" title="{{ trans('raffle_ticket.search_form.button') }}" alt="{{ trans('raffle_ticket.search_form.button') }}"> <i class="fa fa-search"></i></button>
				</form>
			</div>
			<div class="clearfix"></div>
			@if (isset($message))
				<div class="alert alert-dismissible alert-danger ticket-not-found" role="alert">
		          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
		          {{$message}}
		        </div>
			@endif
			<br>
			@if ($raffles)
				@foreach ($raffles as $key => $raffle)
					<form action="{{ route('list.buy.ticket.add') }}" method="POST">
						{{  csrf_field() }}
						<input type="hidden" name="raffle_number" value="{{ $raffle['raffle_number'] }}">
						<div class="col-md-2 col-xs-6 col-sm-3">
							<div class="panel panel-success tickets">
			  					<div class="panel-body body-ticket @if(existOnCart($raffle['raffle_number']) && !isReserved($raffle['raffle_number'])) selected-now @endif @if(!existOnCart($raffle['raffle_number']) && isReserved($raffle['raffle_number'])) reserved @endif @if(!existOnCart($raffle['raffle_number']) && !isReserved($raffle['raffle_number'])) available @endif">
									<h1 class="text-center"><b>{{ $raffle['raffle_number'] }}</b></h1>
			  					</div>
			  					<div class="panel-footer footer-ticket">
			  						<button class="btn btn-primary btn-block btn-xs text-center btn-add-cart-ticket" 
			  						@if(existOnCart($raffle['raffle_number']) || isReserved($raffle['raffle_number'])) disabled @endif 
			  						@if(!isReserved($raffle['raffle_number']))  title="{{ trans('raffle_ticket.add_cart') }}" alt="{{ trans('raffle_ticket.add_cart') }}" @endif ><i class="fa fa-cart-plus"></i></button>
			  					</div>
							</div>
						</div>
					</form>
				@endforeach
				<div class="clearfix"></div>
				<div class="row text-center">
					<div class="col-md-12 col-xs-12 col-sm-12">
						{{ $raffles->links() }}
					</div>
				</div>
				{{-- expr --}}
			@endif
		</div>
		
	</div>
@endsection