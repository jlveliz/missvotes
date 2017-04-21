<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
       <img src="{{ asset('public/images/queen-mini.png') }}" alt="{{config('app.name')}}" title="{{config('app.name')}}">
        <h2>{{config('app.name')}}</h2>
        <br>
        <br>
        <div>
            <p>{{ trans('email.casting.hi') }} <b>{{$precandidate->name}} {{$precandidate->last_name}}</b>, {{ trans('email.casting.thanks') }} <b> {{ trans('email.casting.welcome') }}</p>
            <br>
            <br>
            <h2>{{ trans('email.casting.casting_code') }} {{ $precandidate->code }}</h2>
            <br>
            <br>

            <p>{{ trans('email.casting.title_data') }}</p>

            <br>
            <br>

            <p><u>{{ trans('email.casting.place') }}</u></p>
            <p>Moda 2000 <br> 845 N. Euclid St. Anaheim CA 92801</p>

            <br>
            <br>
            <p><u>{{ trans('email.casting.days_hours_casting') }}</u></p>
            
        </div>

    </body>
</html>