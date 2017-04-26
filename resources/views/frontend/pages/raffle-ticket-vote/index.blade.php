@extends('layouts.frontend')
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
		<div class="col-md-10 col-xs-8">
			@foreach ($paginatedSearchResults as $paginate)
				{{ $paginate }}
			@endforeach
		</div>
		{{-- cart --}}
		<div class="col-md-2 col-xs-4">
			<h1>Hola Cart</h1>		
		</div>
	</div>
@endsection