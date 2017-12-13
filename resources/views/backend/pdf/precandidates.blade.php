@extends($format ? 'layouts.excel' : 'layouts.pdf')
@section('body')
<table>
<caption class="title-report">{{ trans('backend.precandidate.index.panel_caption') }}</caption>
<thead>
	<tr>
		<th>{{ trans('backend.applicant.index.th_creation_date') }}</th>
        <th>{{ trans('backend.applicant.index.th_number') }}</th>
        <th>Email</th>
        <th>{{ trans('backend.applicant.index.th_code') }}</th>
        <th>{{ trans('backend.applicant.index.th_names') }}</th>
        <th>{{ trans('backend.applicant.index.th_state') }}</th>
        <th>{{ trans('backend.applicant.index.th_how_you_hear') }}</th>
    </tr>
</thead>
<tbody>
    @if (count($precandidates))
	@for ($i = count($precandidates) - 1; $i >= 0; $i--)
    <tr>
        <td align="center">{{$precandidates[$i]->created_at }}</td>
        <td align="center">{{$i + 1}}</td>
        <td align="center">{{$precandidates[$i]->email }}</td>
        <td align="center">{{$precandidates[$i]->code }}</td>
        <td align="center">{{$precandidates[$i]->name}} {{$precandidates[$i]->last_name}}</td>
        <td align="center">@if($precandidates[$i]->state == 0) <span class="text-danger">  @endif{{$precandidates[$i]->getFormattedState()}} @if($precandidates[$i]->state == 0) </span> @endif</td>
        <td align="center">{{$precandidates[$i]->getFormattedHowDidYouHearAboutUs()}}</td>
    </tr>
    @endfor
    @else
     <tr>
        <td  colspan="7">{{ trans('backend.no-data') }}</td>
    </tr>
    @endif
</tbody>
	
</table>
@endsection