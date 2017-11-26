@extends('layouts.pdf')
@section('body')
<table>
<caption class="title-report">{{ trans('backend.applicant.index.panel_caption') }}</caption>
<thead>
	<tr>
		<th>{{ trans('backend.applicant.index.th_creation_date') }}</th>
        <th>{{ trans('backend.applicant.index.th_code') }}</th>
        <th>{{ trans('backend.applicant.index.th_names') }}</th>
        <th>{{ trans('backend.applicant.index.th_state') }}</th>
        <th>{{ trans('backend.applicant.index.th_how_you_hear') }}</th>
    </tr>
</thead>
<tbody>
	@foreach ($applicants as $applicant)
	<tr>
        <td>{{$applicant->created_at }}</td>
        <td>{{ $applicant->code }}</td>
        <td>{{$applicant->name}} {{$applicant->last_name}}</td>
        <td>@if($applicant->state == 0) <span class="text-danger">  @endif{{$applicant->getFormattedState()}} @if($applicant->state == 0) </span> @endif</td>
        <td>{{$applicant->how_did_you_hear_about_us}}</td>
    </tr>
    @endforeach
</tbody>
	
</table>
@endsection