@extends('layouts.pdf')
@section('body')
<table id="ranking-datatable" class="table table-bordered">
    <caption class="title-report">{{ trans('backend.dashboard.membership_block.title') }}</caption>
        <table style="width: 500px; margin: 0 auto;">
        <thead>
            <tr>
                <th>{{ trans('backend.dashboard.membership_block.th_membership') }}</th>
                <th>{{ trans('backend.dashboard.membership_block.th_number_user') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($countUserMemberships as $index =>  $userMembership)
                <tr>
                    <td>
                        {{ !$userMembership->membership ? 'Free' : 'Premium' }}
                    </td>
                    <td style="text-align: center">
                        {{$userMembership->counter}}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </table>
@endsection