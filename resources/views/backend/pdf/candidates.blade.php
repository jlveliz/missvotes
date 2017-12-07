@extends($format ? 'layouts.excel'  : 'layouts.pdf')
@section('body')
<table>
<caption class="title-report">{{ trans('backend.candidates.index.panel_caption') }}</caption>
<thead>
	<tr>
		<th>{{ trans('backend.candidates.index.th_creation_date') }}</th>
        <th>{{ trans('backend.candidates.index.th_number') }}</th>
        <th>{{ trans('backend.candidates.index.th_code') }}</th>
        <th>{{ trans('backend.candidates.index.th_names') }}</th>
        <th>{{ trans('backend.candidates.index.th_state') }}</th>
        <th>{{ trans('backend.candidates.index.th_how_you_hear') }}</th>
    </tr>
</thead>
<tbody>
    @if (count($candidates))
    	@for ($i = count($candidates) - 1; $i >= 0; $i--)
        <tr>
            <td align="center">{{$candidates[$i]->created_at }}</td>
            <td align="center">{{$i + 1}}</td>
            <td align="center">{{$candidates[$i]->code }}</td>
            <td align="center">{{$candidates[$i]->name}} {{$candidates[$i]->last_name}}</td>
            <td align="center">@if($candidates[$i]->state == 0) <span class="text-danger">  @endif{{$candidates[$i]->getFormattedState()}} @if($candidates[$i]->state == 0) </span> @endif</td>
            <td align="center">{{$candidates[$i]->getFormattedHowDidYouHearAboutUs()}}</td>
        </tr>
        @endfor
    @else
     <tr>
        <td  colspan="6">{{ trans('backend.no-data') }}</td>
    </tr>
    @endif
</tbody>
	
</table>
@endsection