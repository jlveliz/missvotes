<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <img src="{{ asset('public/images/queen-mini.png') }}" alt="{{config('app.name')}}" title="{{config('app.name')}}">
        <h2>{{config('app.name')}}</h2>
        
        <div>
            Gracias por registrarse con nosotros, ahora solo es necesario que active su cuenta para que pueda votar.
            Por favor presione sobre el link para activar su cuenta.<br> 
            <a href="{{ URL::to('auth/activate/' . $confirmation_code) }}" target="_blank">Activar Cuenta</a>
            <br/>
            <small>Si prefiere copie el siguiente enlace y peguelo en su navegador <br> 
                {{ URL::to('auth/activate/' . $confirmation_code) }}
            </small>
        </div>

    </body>
</html>