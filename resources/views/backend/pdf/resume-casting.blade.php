@extends('layouts.pdf')
@section('body')
<table id="casting-1-datatable" class="table table-bordered">
	
	<caption class="title-report">{{ trans('backend.dashboard.tickets_block.title') }}</caption>
  		<thead>
	  		<tr>
	  			<th>N°</th>
	  			<th>{{ trans('backend.dashboard.casting_resume.th_country') }}</th>
	  			<th>{{ trans('backend.dashboard.casting_resume.th_num_applies') }}</th>
	  			<th>{{ trans('backend.dashboard.casting_resume.th_num_preselected') }}</th>
	  			<th>{{ trans('backend.dashboard.casting_resume.th_num_no_preselected') }}</th>
	  			<th>{{ trans('backend.dashboard.casting_resume.th_num_missing') }}</th>
	  		</tr>
  		</thead>
  		<tbody>
  				@foreach ($resumeCasting as $index =>  $casting)
		  	 		<tr>
		  	 			<td>{{$index+1}}</td>
		  	 			<td class="country">
		  	 				{{$casting->country}}
		  	 			</td>
		  	 			<td class="counter" style="text-align: center">
		  	 				{{$casting->counter}}
		  	 			</td>
		  	 			<td class="preselected" style="text-align: center">
		  	 				{{$casting->preselected}}
		  	 			</td>
		  	 			<td class="nopreselected" style="text-align: center">
		  	 				{{$casting->nopreselected}}
		  	 			</td>
		  	 			<td style="text-align: center">
		  	 				{{$casting->missing}}
		  	 			</td>
		  	 		</tr>
		  		@endforeach
  				<tr>
  					<td></td>
  					<td>Total:</td>
  					<td style="text-align:center">{{$totalNumApplies}}</td>
  					<td style="text-align:center">{{$totalNumPreselected}}</td>
  					<td style="text-align:center">{{$totalNumNoPreselected}}</td>
  					<td style="text-align:center">{{$totalNumMissing}}</td>
  				</tr>
  		</tbody>
  	</table>
@endsection