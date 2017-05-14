@extends('layouts.frontend')
@section('css')
	<link rel="stylesheet" href="{{ asset('/public/css/raffles.css') }}">
	<link rel="stylesheet" href="{{ asset('/public/css/scrollbar/jquery.scrollbar.css') }}">
@endsection
@section('js')
<script type="text/javascript" src="{{ asset('public/js/scrollbar/jquery.scrollbar.min.js') }}"></script>
<script type="text/javascript">
	$(document).ready(function() {
		
		var nav = $('.cart-place');

		jQuery(".cart-body").scrollbar();

	   $(window).scroll(function () {
	       if (!$("#collapseOne").hasClass('in')) {
	           nav.addClass("fixed");
	           // nav.css('top','60%');
	       } else {
	           nav.removeClass("fixed");
	       }
	   });

	   	//TODO 
	    // $('#collapseOne').bind('scroll',function(e){
	    // 	var elem = $(e.currentTarget);
    	// 	if (elem[0].scrollHeight - elem.scrollTop() == elem.outerHeight())
    	// 	{
     //    		console.log("bottom");
    	// 	}
	    // });


	   $("#check_accept_rules").on('click',function(event) {
	   		if( $(this).is(':checked') ){
	   			$("#accept_rules").val(1);
	   			$("#btn-buy-ticket").removeAttr('disabled',true)
	   		} else {
	   			$("#accept_rules").val(0)
	   			$("#btn-buy-ticket").attr('disabled',true)
	   		}
	   });

	   $("#accordion").on('show.bs.collapse', function(event) {
	   		nav.removeClass("fixed");
	   });

	   $("#accordion").on('hide.bs.collapse', function(event) {
	   		nav.addClass("fixed");
	   });


	   $(".btn-add-cart-ticket").on('click', function(event) {
		   	event.preventDefault();
		   	var _this = $(this);
		   	_this.children().removeClass('fa-cart-plus');
		   	_this.children().addClass('fa-spinner fa-spin');
		   	var raffleNumber = _this.data('raffle');
		   	if(raffleNumber) {
		   		$.ajax({
		   			url: '{{ route('list.buy.ticket.add') }}',
		   			type: 'POST',
		   			data: {raffle_number: raffleNumber},
		   		})
		   		.done(function(data) {
		   			_this.attr('disabled', 'true');
		   			var panelFooter = _this.parent();
		   			panelFooter.prev().removeClass('available').addClass('selected-now');
		   			if(!$("#table-cart").is(':visible')) {
		   				$("#no-table-cart").css('display', 'none');
		   				$("#table-cart").removeAttr('style');
		   			}

		   			$("#form-pay >input[type=hidden]").remove();

		   			var acceptRulesHtml = "<input type='hidden' name='accept_rules' id='accept_rules' value='1'>";
	   				$("#form-pay").append(acceptRulesHtml)


	   				for (var i = 0; i < data.cart.length; i++) {
	   					var html = "<input type='hidden' class='params' id='ticket_raffle_description' name='tickets["+i+"][description]' value='Ticket # "+data.cart[i].raffle_number+"'><input class='params' type='hidden' id='ticket_raffle_vote_id' name='tickets["+i+"][raffle_vote_id]' value='"+data.cart[i].raffle_number+"'>";
	   					$("#form-pay").append(html)
	   				}

	   				if(data.total_sum) {
	   					var htmlTotalSum = "<input type='hidden' name='amount' value='"+data.total_sum+"'>";
	   					$("#form-pay").append(htmlTotalSum)
	   				}

		   			if(!$("#form-pay").is(':visible')) {
		   				$("#form-pay").css('display','block');
		   			}
		   			
		   			$("#table-cart").append(data.itemHtml);
		   			$("#total-sum").text('$ '+data.total_sum);
		   		})
		   		.fail(function(error) {
		   			$("#mensaje-raffle").css('display', 'block');
		   			$("#text-mensaje-raffle").text(error.responseJSON.mensaje)
		   		})
		   		.always(function() {
		   			_this.children().removeClass('fa-spinner fa-spin');
		   			_this.children().addClass('fa-cart-plus');
		   		});
		   	} else {
		   		return false;
		   	}
	   });

	   $("#table-cart >tbody ").on('click', '.btn-remove-raffle' ,function(event) {
	   		event.preventDefault();
	   		event.stopPropagation();
	   		$(this).children().addClass('fa fa-spinner fa-spin');
	   		$(this).children().removeClass('glyphicon glyphicon-trash');
	   		var _this = $(this);
	   		$.ajax({
	   			url: '{{ route('list.buy.ticket.remove') }}',
	   			type: 'POST',
	   			data: {raffle_number: _this.data('raffle')},
	   		})
	   		.done(function(data) {
	   			$("#total-sum").text('$ '+data.total_sum);
	   			_this.parent().parent().parent().remove();

	   			$("#raffle_"+_this.data('raffle')).removeClass('selected-now')
	   			$("#raffle_"+_this.data('raffle')).addClass('available ')
	   			$("#raffle_"+_this.data('raffle')).next('.panel-footer').children().removeAttr('disabled',true);

	   			if(data.cart) {

	   				$("#form-pay >input[type=hidden]").remove();

	   				var acceptRulesHtml = "<input type='hidden' name='accept_rules' id='accept_rules' value='1'>";
	   				$("#form-pay").append(acceptRulesHtml)

	   				if(data.total_sum) {
	   					var htmlTotalSum = "<input type='hidden' name='amount' value='"+data.total_sum+"'>";
	   					$("#form-pay").append(htmlTotalSum)
	   				}

	   				var html = "";
		   			for (var i = 0; i < data.cart.length; i++) {
		   				html+= "<input type='hidden' id='ticket_raffle_description' name='tickets["+i+"][description]' value='Ticket # "+data.cart[i].raffle_number+"'><input type='hidden' id='ticket_raffle_vote_id' name='tickets["+i+"][raffle_vote_id]'' value='"+data.cart[i].raffle_number+"'>";
			   		}
	   				$("#form-pay").append(html)
	   				

	   			}
	   			if($("#table-cart >tbody >tr").length == 0) {
	   				$("#table-cart").css('display', 'none');
	   				$("#no-table-cart").css('display', 'block');
	   				$("#form-pay").css('display', 'none');
	   			}
	   		});
	   		
	   });

	  


	});
</script>
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

	{{-- js --}}
	<div class="row" id="mensaje-raffle" style="display: none">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="alert alert-dismissible alert-danger" role="alert">
	  			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
	  			<p id="text-mensaje-raffle"></p>
	   		</div>
			<div class="clearfix"></div>
		</div>
	</div>
	{{-- php --}}
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
			<div class="cart-place">
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
					<div class="panel-body cart-body">
						@if (session()->has('cart'))
							<table id="table-cart" class="table scrollbar-dynamic">
								@foreach (session()->get('cart') as $key =>  $item) 
									<tr>
										<td>
											<strong>Ticket # {{ $item['raffle_number'] }} </strong>
										</td>
										<td><strong>{{ $item['points'] }} Pnts.</strong></td>
										<td><strong>$ {{ $item['price'] }}<strong></td>
										<td>
											<form action="{{ route('list.buy.ticket.remove') }}" method="POST" class='form-remove-raffle'>
												{{  csrf_field() }}
												<input type="hidden" name="raffle_number" value="{{ $item['raffle_number'] }}">
												<button type="button" data-raffle="{{ $item['raffle_number'] }}" class="btn btn-link btn-xs btn-remove-raffle" alt="{{ trans('raffle_ticket.delete_cart') }}" title="{{ trans('raffle_ticket.delete_cart') }}">
													<span class="glyphicon glyphicon-trash"> </span>
												</button>
											</form>
										</td>
									</tr>
								@endforeach
							</table>
							<p id="no-table-cart" class="text-muted message-no-cart" style="display: none;"><b>{{ trans('raffle_ticket.no_ticket_selected') }}</b></p>
							<hr>
						@else
							{{-- js --}}
							<p id="no-table-cart" class="text-muted message-no-cart" style="display: block;"><b>{{ trans('raffle_ticket.no_ticket_selected') }}</b></p>
							<table id="table-cart" class="table scrollbar-dynamic" style="display: none">
								<tbody></tbody>
							</table>
							<hr>
						@endif


						<div class="checkbox text-center">
						    <label>
						      <input type="checkbox" id="check_accept_rules" checked> <strong> {{ trans('raffle_ticket.accept_official_rules') }} </strong>
						    </label>
  						</div>
					</div>
					<div class="panel-footer">
						<div class="row text-center">
							<div class="col-xs-6">
								<h4 class="text-right">Total <strong id="total-sum">$ {{ session()->has('total_sum') ?  session()->get('total_sum') : "0.00" }}   </strong></h4>
							</div>
							<div class="col-xs-6">
									@if (session()->has('cart'))
									<form id="form-pay" action="{{ route('website.paypal.buyticket') }}" method="post">
										{{  csrf_field() }}
											@foreach (session()->get('cart') as $key =>  $item) 
												<input type="hidden" name="tickets[{{ $key }}][description]" value="Ticket #{{ $item['raffle_number'] }}">
												<input type="hidden" name="tickets[{{ $key }}][raffle_vote_id]" value="{{ $item['raffle_number'] }}">
											@endforeach
										<input type="hidden" name="amount" value="{{ session()->get('total_sum') }}">
										<button type="submit" id="btn-buy-ticket" class="btn btn-success btn-block" alt="{{ trans('raffle_ticket.buy_ticket_button') }}" title="{{ trans('raffle_ticket.buy_ticket_button') }}">
											<i class="fa fa-paypal" aria-hidden="true"></i> {{ trans('raffle_ticket.buy_ticket_button') }}
										</button>
										<input type="hidden" name="accept_rules" id="accept_rules" value="1">
									</form>
									@else
										<form id="form-pay" style="display: none" action="{{ route('website.paypal.buyticket') }}" method="post">
										{{  csrf_field() }}
										<button type="submit" id="btn-buy-ticket" class="btn btn-success btn-block" alt="{{ trans('raffle_ticket.buy_ticket_button') }}" title="{{ trans('raffle_ticket.buy_ticket_button') }}">
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
			  					<div id="raffle_{{ $raffle['raffle_number'] }}" class="panel-body body-ticket @if(existOnCart($raffle['raffle_number']) && !isReserved($raffle['raffle_number'])) selected-now @endif @if(!existOnCart($raffle['raffle_number']) && isReserved($raffle['raffle_number'])) reserved @endif @if(!existOnCart($raffle['raffle_number']) && !isReserved($raffle['raffle_number'])) available @endif">
									<h1 class="text-center"><b>{{ $raffle['raffle_number'] }}</b></h1>
			  					</div>
			  					<div class="panel-footer footer-ticket">
			  						<button class="btn btn-primary btn-block btn-xs text-center btn-add-cart-ticket" 
			  						@if(existOnCart($raffle['raffle_number']) || isReserved($raffle['raffle_number'])) disabled @endif 
			  						@if(!isReserved($raffle['raffle_number']))  title="{{ trans('raffle_ticket.add_cart') }}" alt="{{ trans('raffle_ticket.add_cart') }}" @endif data-raffle="{{ $raffle['raffle_number'] }}"><i class="fa fa-cart-plus"></i></button>
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