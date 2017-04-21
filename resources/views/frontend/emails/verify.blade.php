<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <img src="{{ asset('public/images/queen-mini.png') }}" alt="{{config('app.name')}}" title="{{config('app.name')}}">
        <h2>{{config('app.name')}}</h2>
        
        <div>
            <p>{{ trans('email.verify.welcome') }}</p>
            <br>
            {{ trans('email.verify.thanks') }}<br> 
            <a href="{{ URL::to('auth/activate/' . $confirmation_code) }}" target="_blank">{{ trans('email.verify.activate_button') }}</a>
            <br/>
            <small>{{ trans('email.verify.if_prefeer') }} <br> 
                {{ URL::to('auth/activate/' . $confirmation_code) }}
            </small>
        </div>

    </body>
</html>