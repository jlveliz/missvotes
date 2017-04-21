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
            <h2>{{ trans('email.casting.casting_code') }} {{ $precandidate->code }}</h2>
            <br>
            
            <p>{{ trans('email.casting.title_data') }}</p>

            <br>

            <p><u>{{ trans('email.casting.place') }}</u></p>
            <p>Moda 2000 <br> 845 N. Euclid St. Anaheim CA 92801</p>
            <p>845 N. Euclid St. Anaheim CA 92801</p>

            <br>
            <p><u>{{ trans('email.casting.days_hours_casting') }}</u></p>
            <p>{{ trans('email.casting.weekend_day_a') }}</p>
            <p>{{ trans('email.casting.weekend_day_b') }}</p>
            <br>
            <p>{{ trans('email.casting.weekend_day_c') }}</p>
            <p>{{ trans('email.casting.weekend_day_d') }}</p>
            <br>
            <p>{{ trans('email.casting.weekend_day_e') }}</p>
            <p>{{ trans('email.casting.weekend_day_f') }}</p>
            <br>
            <p>{{ trans('email.casting.weekend_day_g') }}</p>
            <p>{{ trans('email.casting.weekend_day_h') }}</p>
            <br>
            <p><u>{{ trans('email.casting.costume') }}</u></p>
            <p>{{ trans('email.casting.costume_1') }}</p>
            <p>{{ trans('email.casting.costume_2') }}</p>
            <p>{{ trans('email.casting.costume_3') }}</p>
            <br>
            <p>{{ trans('email.casting.costume_obs_1') }}</p>
            <p>{{ trans('email.casting.costume_obs_2') }}</p>
            <br>
            <p>{{ trans('email.casting.questions') }}</p>
            
        </div>

    </body>
</html>