@extends('layouts.pdf')
@section('body')
<table>
<caption class="title-report">{{ trans('backend.applicant.index.panel_caption') }}</caption>
<thead>
	<tr>
		<th>{{ trans('backend.applicant.index.th_creation_date') }}</th>
        <th>{{ trans('backend.applicant.index.th_number') }}</th>
        <th>{{ trans('backend.applicant.index.th_code') }}</th>
        <th>{{ trans('backend.applicant.index.th_names') }}</th>
        <th>{{ trans('backend.applicant.index.th_state') }}</th>
        <th>{{ trans('backend.applicant.index.th_how_you_hear') }}</th>
    </tr>
</thead>
<tbody>
	@for ($i = count($applicants) - 1; $i >= 0; $i--)
    <tr>
        <td align="center">{{$applicants[$i]->created_at }}</td>
        <td align="center">{{$i + 1}}</td>
        <td align="center">{{$applicants[$i]->code }}</td>
        <td align="center">{{$applicants[$i]->name}} {{$applicants[$i]->last_name}}</td>
        <td align="center">@if($applicants[$i]->state == 0) <span class="text-danger">  @endif{{$applicants[$i]->getFormattedState()}} @if($applicants[$i]->state == 0) </span> @endif</td>
        <td align="center">{{$applicants[$i]->getFormattedHowDidYouHearAboutUs()}}</td>
    </tr>
    @endfor
</tbody>
	
</table>
@endsection