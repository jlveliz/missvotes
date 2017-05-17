@extends('layouts.frontend')

@section('css')
<link rel="stylesheet" href="{{ asset('/public/css/wallop/wallop.css') }}">
<link rel="stylesheet" href="{{ asset('/public/css/wallop/wallop--fade.css') }}">
<link rel="stylesheet" href="{{ asset('/public/css/slick/slick.css') }}">
<link rel="stylesheet" href="{{ asset('/public/css/slick/slick-theme.css') }}">
<link rel="stylesheet" href="{{ asset('/public/css/show-misses.css') }}">
<link rel="stylesheet" href="{{ asset('/public/css/selectize/selectize.bootstrap3.css') }}">
@endsection()

@section('js')
<script type="text/javascript" src="{{ asset('/public/js/wallop/Wallop.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/public/js/slick/slick.js') }}"></script>
<script type="text/javascript" src="{{ asset('/public/js/selectize/selectize.js') }}"></script>
<script type="text/javascript" src="{{ asset('/public/js/show-miss-app.js') }}"></script>
@endsection()

@section('content')
{{-- photo gallery --}}
<div class="container-page">
	<h2>{{ $miss->name }} {{ $miss->last_name }}</h2>
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">

			<div class="Wallop Wallop--fade">
			  <div class="Wallop-list">
			  	@foreach ($miss->photos as $photo)
			    	<div class="Wallop-item">
			    		<img class="img-responsive photo-show" src="{{config('app.url') .'/'. $photo->path }}" alt="{{ $miss->name }} {{ $miss->last_name }}" title="{{ $miss->name }} {{ $miss->last_name }}">
			    	</div>
			  	@endforeach

			  	 <div class="Wallop-pagination">
			  	 	@foreach ($miss->photos as $key => $photo) 
	      				<button class="Wallop-dot @if($key == 0) Wallop-dot--current @endif">go to item {{ $key + 1 }}</button>
			  	 	@endforeach
	      		</div>
			  </div>
			  <button class="Wallop-buttonPrevious">Previous</button>
			  <button class="Wallop-buttonNext">Next</button>
			</div>
		</div>
		{{-- description --}}
		<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
			<hr class="visible-xs">
			<p class="description-miss"><b> {{ trans('miss-vote.nationality') }}</b></p>
			<p>{{ $miss->country->name }}</p>
			<p class="description-miss"><b>{{ trans('miss-vote.city') }}</b></p>
			<p>{{ $miss->city }} / {{ $miss->state_province }}</p>
			<p class="description-miss"><b>{{ trans('miss-vote.measure') }}</b></p>
			<p><b>{{ trans('miss-vote.height') }}: </b> {{ $miss->height }} cms  / <b>{{ trans('miss-vote.weight') }}: </b> {{ $miss->weight }}  lb / <b>{{ trans('miss-vote.bust_measure') }}:</b> {{ $miss->bust_measure }} /  <b>{{ trans('miss-vote.waist_measure') }}:</b> {{ $miss->waist_measure }} / <b>{{ trans('miss-vote.hip_measure') }}:</b> {{ $miss->hip_measure }}</p>
			<p><b>{{ trans('miss-vote.dairy_philosophy') }}</b></p>
			<p>{{ $miss->dairy_philosophy }}</p>

			<p><b>{{ trans('miss-vote.why_would_you_win') }}</b></p>
			<p>{{ $miss->why_would_you_win }}</p>
			
			<hr>
			
			@if (Session::get('tipo_mensaje') == 'error')
	    		<div class="alert alert-dismissible @if(Session::get('tipo_mensaje') == 'error') alert-danger  @endif" role="alert">
	      			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
	      			{{session('mensaje')}}
	       		</div>
	    		<div class="clearfix"></div>
	   		@endif
			
			<div class="vote-section text-center @if(Auth::user()) ready-vote @else no-ready-vote  @endif">
				@if (Auth::user())

					@if (!Auth::user()->is_admin)
						@cannot('vote_today', $miss)
							<p class="text-center">
								{!! trans('miss-vote.thanks_vote') !!}
							</p>
						@endcannot
					@else
						@cannot('vote', Auth::user())
							<p class="text-center text-danger">
								<b>{{ trans('miss-vote.you_cant') }}.</b> 
							</p>
						@endcannot
					@endif

					@can('vote',Auth::user())
						@can('vote_today', $miss)
							<form action="{{ route('website.miss.vote.store') }}" method="POST"  style="display: inline"  >
								{{ csrf_field() }}
								<input type="hidden" name="miss_id" value="{{$miss->id}}">
								<input type="hidden" name="client_id" value="{{Auth::user()->id}}">
								<button type="submit" class="btn btn-vote btn-lg" @cannot('vote', Auth::user()) disabled @endcannot>
									<i class="fa fa-heart like-vote" aria-hidden="true"></i> {{ trans('miss-vote.vote') }}
								</button>
							</form>
						@endcan()

						{{-- if tickets --}}
						@if (count(Auth::user()->client->activeTickets()))
							<button type="submit" class="btn btn-vote btn-lg" @cannot('vote', Auth::user()) disabled @endcannot data-toggle="collapse" data-target="#collapseVoteTicket">
								<i class="fa fa-ticket like-vote" aria-hidden="true"></i> {{ trans('miss-vote.ticket') }}
							</button>
							<div class="row vote-ticket-section">
								<div class="col-md-12 col-xs-12 text-left collapse" id="collapseVoteTicket">
									<form action="{{ route('website.miss.vote.store') }}" method="POST">
										{{ csrf_field() }}
										<input type="hidden" name="miss_id" value="{{$miss->id}}">
										<input type="hidden" name="client_id" value="{{Auth::user()->id}}">
										<input type="hidden" name="ticket_id" id="ticket-id" value="">
										<div class="navigate-section">
											<div class="col-md-8 col-xs-8 no-padding">
												<select class="form-control" id="select-tickets">
													<option value=''>--{{ trans('miss-vote.select_miss') }}--</option>
													@foreach (Auth::user()->client->activeTickets() as $ticketClient)
														<option value="{{ $ticketClient->id }}">{{ $ticketClient->description }} <i>({{ $ticketClient->val_vote }} {{ trans('miss-vote.points') }})</i> </option>
													@endforeach
												</select>
											</div>
											<div class="col-md-2 col-xs-4">
												<button id="vote-ticket-submit" type="submit" class="btn btn-vote" disabled><i class="fa fa-heart like-vote" aria-hidden="true" ></i> {{ trans('miss-vote.vote') }}</button>	
											</div>
										</div>
									</form>
								</div>
							</div>
						@endif
					@endcan
				@else 
					{{ trans('miss-vote.for_vote') }}, <a href="{{ route('client.show.login') }}"  title="{{ trans('miss-vote.login') }}"><span>{{ trans('miss-vote.login') }}</span></a> {{ trans('miss-vote.or') }}  <a href="{{ route('client.show.register') }}" title="{{ trans('miss-vote.register') }}"><span>{{ trans('miss-vote.register') }}</span></a>
				@endif
			</div>
			<hr>
		</div>
	</div>
	<hr>
	<div class="row ">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<h5><b>{{ trans('miss-vote.look_others_candidates') }}</b></h5>
		</div>
		<div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
			<div class="carrousel-misses">
				@foreach ($misses as $miss)
					<a class="carrousel-misses-item" href="{{ route('website.miss.show',$miss->slug) }}" title="{{$miss->name}} {{$miss->last_name}}" alt="{{$miss->name}} {{$miss->last_name}}">
						<div style="background-image: url('{{config('app.url') .'/'. $miss->photos()->first()->path }}')">
							<div class="layer">
								<p>{{$miss->name}} <br> {{$miss->last_name}}</p>
							</div>
						</div>
					</a>
				@endforeach
			</div>
		</div>

		<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
			<div class="navigate-section">
				<div class="col-md-10 col-xs-8 no-padding">
					<select class="form-control" name="select_misses" id="select-misses">
						<option value="null">--{{ trans('miss-vote.select_miss') }}--</option>
						@foreach ($misses as $miss)
							<option value="{{ route('website.miss.show',$miss->slug) }}"> {{ $miss->name }} {{ $miss->last_name }} </option>
						@endforeach
					</select>
				</div>
				<div class="col-md-2 col-xs-4">
					<a id="go-miss" href="" class="btn btn-default btn-go">{{ trans('miss-vote.go') }}</a>	
				</div>
			</div>
		</div>
	</div>


	<div class="clearfix"></div>
</div>
<div class="clearfix"></div>

@endsection()