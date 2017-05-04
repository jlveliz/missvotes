<div class="panel panel-default">
  <div class="panel-heading">{{ trans('backend.dashboard.ranking_block.title') }}</div>
  <div class="panel-body">
  	<table id="ranking-datatable" class="table table-bordered">
  		<thead>
	  		<tr>
	  			<th>{{ trans('backend.dashboard.ranking_block.th_candidate') }}</th>
	  			<th>{{ trans('backend.dashboard.ranking_block.th_country') }}</th>
	  			<th>{{ trans('backend.dashboard.ranking_block.th_score') }}</th>
	  		</tr>
  		</thead>
  		<tbody>
	  		@foreach ($votes as $index =>  $vote)
	  	 		<tr @if ($index == 0) class="success" @endif>
	  				<td>@if ($index == 0) <b>{{$vote->miss->name}} {{$vote->miss->last_name}}</b> @else {{$vote->miss->name}} {{$vote->miss->last_name}} @endif </td>
	  				<td>@if ($index == 0) <b>{{$vote->miss->country->name}}</b> @else {{$vote->miss->country->name}} @endif</td>
	  				<td>@if ($index == 0) <b>{{$vote->sumatory}} {{ trans('backend.dashboard.ranking_block.points') }}</b> @else {{$vote->sumatory}} {{ trans('backend.dashboard.ranking_block.points') }} @endif </td>
	  			</tr>
	  		@endforeach
  		</tbody>
  	</table>
  </div>
</div>
