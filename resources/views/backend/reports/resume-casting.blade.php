@extends('layouts.backend')
@section('content')
<div class="panel panel-default">
  <div class="panel-heading">{{trans('backend.applicant.index.tab_title_'.$casting->key.'')}} 
  	<div class="btn-group">
    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ trans('backend.dashboard.export') }}  <span class="caret"></span></button>
    <ul class="dropdown-menu">
      <li><a target="_blank" href="{{ route('dashboard.export.casting',['casting_id'=>$casting->key]) }}"><i class="fa fa-file-pdf-o"> </i> PDF</a> </li>
      <li><a target="_blank" href="{{ route('dashboard.export.casting',['casting_id'=>$casting->key,'format'=>'xls']) }}"><i class="fa fa-file-excel-o"> </i> EXCEL</a></li>
    </ul>
  </div>
  <a href="{{ route('applicants.index',['country_id'=>null,'casting_id'=>$casting->id]) }}" class="btn btn-primary">{{ trans('backend.dashboard.casting_resume.all') }}</a>
  </div>
  <div class="panel-body">
  	<table id="casting-1-datatable" class="table table-bordered">
  		<thead>
	  		<tr>
	  			<th>N°</th>
	  			<th>{{ trans('backend.dashboard.casting_resume.th_country') }}</th>
	  			<th>{{ trans('backend.dashboard.casting_resume.th_num_applies') }}</th>
	  			<th>{{ trans('backend.dashboard.casting_resume.th_num_preselected') }}</th>
	  			<th>{{ trans('backend.dashboard.casting_resume.th_num_no_preselected') }}</th>
	  			<th>{{ trans('backend.dashboard.casting_resume.th_num_missing') }}</th>
	  			<th>{{ trans('backend.dashboard.casting_resume.th_social_network') }}</th>
	  		</tr>
  		</thead>
  		<tbody>
  				@foreach ($resumeCasting as $index =>  $cast)
		  	 		<tr>
		  	 			<td>{{$index+1}}</td>
		  	 			<td class="country">
		  	 				@if ($cast->counter > 0)
		  	 				<a href="{{ route('applicants.index',['country_id'=>$cast->country_id,'casting_id'=>$cast->casting_id]) }}">{{$cast->country}}</a>
		  	 				@else
		  	 					{{$cast->country}}
		  	 				@endif
		  	 			</td>
		  	 			<td class="counter" align="center">
		  	 				@if ($cast->counter > 0)
		  	 				<a href="{{ route('applicants.index',['country_id'=>$cast->country_id,'casting_id'=>$cast->casting_id]) }}">{{$cast->counter}}</a>
		  	 				@else
		  	 					{{$cast->counter}}
		  	 				@endif
		  	 			</td>
		  	 			<td class="preselected" align="center">
		  	 				@if ($cast->preselected > 0)
		  	 					<a href="{{ route('applicants.index',['country_id'=>$cast->country_id,'casting_id'=>$cast->casting_id,'state'=>MissVote\Models\Miss::PRESELECTED]) }}">{{$cast->preselected}}</a>
		  	 				@else
		  	 					{{$cast->preselected}}
		  	 				@endif
		  	 			</td>
		  	 			<td class="nopreselected" align="center">
		  	 				@if ($cast->nopreselected > 0)
		  	 					<a href="{{ route('applicants.index',['country_id'=>$cast->country_id,'casting_id'=>$cast->casting_id,'state'=>MissVote\Models\Miss::NOPRESELECTED]) }}">{{$cast->nopreselected}}</a>
		  	 				@else
		  	 					{{$cast->nopreselected}}
		  	 				@endif
		  	 			</td>
		  	 			<td class="missing" align="center">
		  	 				@if ($cast->missing > 0)
		  	 					<a href="{{ route('applicants.index',['country_id'=>$cast->country_id,'casting_id'=>$cast->casting_id,'state'=>MissVote\Models\Miss::FORRATING]) }}">{{$cast->missing}}</a>
		  	 				@else
		  	 					{{$cast->missing}}
		  	 				@endif
		  	 			</td>
		  	 			<td class="network" align="center">
		  	 				{{$cast->network}}
		  	 			</td>
		  	 		</tr>
		  		@endforeach
  				<tr>
  					<td></td>
  					<td>Total:</td>
  					<td align="center" id="total_casting_one_counter"></td>
  					<td align="center" id="total_casting_one_preselected"></td>
  					<td align="center" id="total_casting_one_no_preselected"></td>
  					<td align="center" id="total_casting_one_missing"></td>
  					<td align="center" id="total_casting_one_network">{{$socialMoreUsed}}</td>
  				</tr>
  		</tbody>
  	</table>
  </div>
</div>

<div class="panel panel-default col-md-6">
	<div class="panel-heading">{{trans('backend.dashboard.resume_country_casting.panel_heading_count_country_social')}} 
	  	<div class="btn-group">
	    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ trans('backend.dashboard.export') }}  <span class="caret"></span></button>
	    <ul class="dropdown-menu">
	    	<li><a target="_blank" href="{{ route('dashboard.export.agroupedcountries-network-casting',['casting_id'=>$casting->key]) }}"><i class="fa fa-file-pdf-o"> </i> PDF</a></li>
	    	<li><a target="_blank" href="{{ route('dashboard.export.agroupedcountries-network-casting',['casting_id'=>$casting->key,'format'=>'xls']) }}"><i class="fa fa-file-excel-o"> </i> EXCEL</a></li>
	    </ul>
	  </div>
  	</div>
  	<div class="panel-body">
	  	<table id="casting-1-datatable" class="table table-bordered">
	  		<thead>
		  		<tr>
		  			<th>{{trans('backend.dashboard.resume_country_casting.th_social_network')}}</th>
		  			<th>{{trans('backend.dashboard.resume_country_casting.th_count_country')}}</th>
		  		</tr>
	  		</thead>
	  		<tbody>
	  			@if (count($socialMediaMoreUsed))
	  				@foreach ($socialMediaMoreUsed as $social)
			  			<tr>
			  				<td> {{$social->occurrence}} </td>
			  				<td> {{$social->counter}} {{ trans('backend.country.index.panel_title') }} </td>
			  			</tr>
	  				@endforeach
	  			@else
	  				<tr>
	  					<td colspan="2">{{ trans('backend.no-data') }}</td>
	  				</tr>
	  			@endif
	  		</tbody>
	  	</table>
	</div>
</div>
@endsection
@section('js')
<script type="text/javascript">
	$(document).ready(function() {
		//$('#casting-1-datatable').DataTable({
        	{{-- @if (App::isLocale('es')) --}}
        //		"language": {
          //		"url": "../../public/js/datatables/json/es.json",
        	//	},
        	{{-- @endif --}}
        	// "ordering": false,
      	// });

      	// CASTING 1
      var totalCastingOneCounter = 0; 
      var totalCastingOnePreselected = 0;
      var totalCastingOneNoPreselected = 0; 
      var totalCastingOneMissing = 0;
      var totalCastingOneNetwork = 0;


      $("#casting-1-datatable > tbody > tr > td.counter").each(function(index, el) {
         totalCastingOneCounter+=  parseInt($(el).text());
      });

      $("#casting-1-datatable > tbody > tr > td.preselected").each(function(index, el) {
         totalCastingOnePreselected+=  parseInt($(el).text());
      });

      $("#casting-1-datatable > tbody > tr > td.nopreselected").each(function(index, el) {
         totalCastingOneNoPreselected+=  parseInt($(el).text());
      });

      $("#casting-1-datatable > tbody > tr > td.missing").each(function(index, el) {
         totalCastingOneMissing+=  parseInt($(el).text());
      });

      $("#total_casting_one_counter").text(totalCastingOneCounter);
      $("#total_casting_one_preselected").text(totalCastingOnePreselected);
      $("#total_casting_one_no_preselected").text(totalCastingOneNoPreselected);
      $("#total_casting_one_missing").text(totalCastingOneMissing);
      
	});
</script>
@endsection

{{-- <div class="panel panel-default">
  <div class="panel-heading">{{ trans('backend.dashboard.casting_resume.title_two') }}
  <a target="_blank" href="{{ route('dashboard.export.casting',['casting_id'=>'casting_2']) }}"  type="button" class="btn btn-default"><i class="fa fa-file-pdf-o"> </i> PDF</a> </div>
  <div class="panel-body">
  	<table id="casting-2-datatable" class="table table-bordered">
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
  				@foreach ($resumeCastingTwo as $index =>  $casting)
		  	 		<tr>
		  	 			<td>{{$index+1}}</td>
		  	 			<td class="country">
			  	 				@if ($casting->counter > 0)
			  	 				<a href="{{ route('applicants.index',['country_id'=>$casting->country_id,'casting_id'=>$casting->casting_id]) }}">{{$casting->country}}</a>
			  	 				@else
			  	 					{{$casting->country}}
			  	 				@endif
			  	 			</td>
			  	 			<td class="counter" align="center">
			  	 				@if ($casting->counter > 0)
			  	 				<a href="{{ route('applicants.index',['country_id'=>$casting->country_id,'casting_id'=>$casting->casting_id]) }}">{{$casting->counter}}</a>
			  	 				@else
			  	 					{{$casting->counter}}
			  	 				@endif
			  	 			</td>
			  	 			<td class="preselected" align="center">
			  	 				@if ($casting->preselected > 0)
			  	 					<a href="{{ route('applicants.index',['country_id'=>$casting->country_id,'casting_id'=>$casting->casting_id,'state'=>MissVote\Models\Miss::PRESELECTED]) }}">{{$casting->preselected}}</a>
			  	 				@else
			  	 					{{$casting->preselected}}
			  	 				@endif
			  	 			</td>
			  	 			<td class="nopreselected" align="center">
			  	 				@if ($casting->nopreselected > 0)
			  	 					<a href="{{ route('applicants.index',['country_id'=>$casting->country_id,'casting_id'=>$casting->casting_id,'state'=>MissVote\Models\Miss::NOPRESELECTED]) }}">{{$casting->nopreselected}}</a>
			  	 				@else
			  	 					{{$casting->nopreselected}}
			  	 				@endif
			  	 			</td >
			  	 			<td class="missing" align="center">
			  	 				@if ($casting->missing > 0)
			  	 					<a href="{{ route('applicants.index',['country_id'=>$casting->country_id,'casting_id'=>$casting->casting_id,'state'=>MissVote\Models\Miss::FORRATING]) }}">{{$casting->missing}}</a>
			  	 				@else
			  	 					{{$casting->missing}}
			  	 				@endif
			  	 			</td>
		  	 		</tr>
		  		@endforeach
  				<tr>
  					<td></td>
  					<td>Total:</td>
  					<td id="total_casting_two_counter"></td>
  					<td id="total_casting_two_preselected"></td>
  					<td id="total_casting_two_no_preselected"></td>
  					<td id="total_casting_two_missing"></td>
  				</tr>
  		</tbody>
  	</table>
  </div>
</div> --}}

