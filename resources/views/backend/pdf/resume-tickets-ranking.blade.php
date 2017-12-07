@extends($format ? 'layouts.excel' : 'layouts.pdf')

@section('body')
<table id="ranking-datatable" class="table table-bordered">
    <caption class="title-report">{{ trans('backend.dashboard.ranking_block.title') }}</caption>
        <thead>
            <tr>
                <th>{{ trans('backend.dashboard.ranking_block.th_candidate') }}</th>
                <th>{{ trans('backend.dashboard.ranking_block.th_country') }}</th>
                <th>{{ trans('backend.dashboard.ranking_block.th_score') }}</th>
            </tr>
        </thead>
        <tbody>
            @if (count($votes) > 0)
            @foreach ($votes as $index =>  $vote)
                <tr @if ($index == 0) class="success" @endif>
                    <td>@if ($index == 0) <b>{{$vote->miss->name}} {{$vote->miss->last_name}}</b> @else {{$vote->miss->name}} {{$vote->miss->last_name}} @endif </td>
                    <td>@if ($index == 0) <b>{{$vote->miss->country->name}}</b> @else {{$vote->miss->country->name}} @endif</td>
                    <td>@if ($index == 0) <b>{{$vote->sumatory}} {{ trans('backend.dashboard.ranking_block.td_points') }}</b> @else {{$vote->sumatory}} {{ trans('backend.dashboard.ranking_block.td_points') }} @endif </td>
                </tr>
            @endforeach
            @else
               <tr>
                   <td colspan="3">{{ trans('backend.no-data') }}</td>
               </tr>
            @endif
        </tbody>
    </table>
@endsection