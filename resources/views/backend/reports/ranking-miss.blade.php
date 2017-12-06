<div class="panel panel-default">
  <div class="panel-heading">
  {{ trans('backend.dashboard.ranking_block.title') }}
  <div class="btn-group">
    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ trans('backend.dashboard.export') }}  <span class="caret"></span></button>
    <ul class="dropdown-menu">
      <li><a target="_blank" href="{{ route('dashboard.export.tickets') }}"><i class="fa fa-file-pdf-o"> </i> PDF</a></li>
      <li><a target="_blank" href="{{ route('dashboard.export.tickets',['format'=>'xls']) }}"><i class="fa fa-file-excel-o"> </i> EXCEL</a></li>
    </ul>
  </div>
</div>
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
  			@if (count($votes))
		  		@foreach ($votes as $index =>  $vote)
		  	 		<tr @if ($index == 0) class="success" @endif>
		  				<td>@if ($index == 0) <b>{{$vote->miss->name}} {{$vote->miss->last_name}}</b> @else {{$vote->miss->name}} {{$vote->miss->last_name}} @endif </td>
		  				<td>@if ($index == 0) <b>{{$vote->miss->country->name}}</b> @else {{$vote->miss->country->name}} @endif</td>
		  				<td>@if ($index == 0) <b>{{$vote->sumatory}} {{ trans('backend.dashboard.ranking_block.td_points') }}</b> @else {{$vote->sumatory}} {{ trans('backend.dashboard.ranking_block.td_points') }} @endif </td>
		  			</tr>
		  		@endforeach
  			@else
  				<tr>
  					<td colspan="3">
  						Ningún dato disponible en esta tabla
  					</td>
  				</tr>
  			@endif
  		</tbody>
  	</table>
  </div>
</div>
