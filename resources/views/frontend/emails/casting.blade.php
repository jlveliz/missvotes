<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
       <img src="{{ asset('public/images/queen-mini.png') }}" alt="{{config('app.name')}}" title="{{config('app.name')}}">
        <h2>{{config('app.name')}}</h2>
        
        <div>
            Hola <b>{{$precandidate->name}} {{$precandidate->last_name}}</b>, Gracias por embarcarse en este nuevo sueño de ser la futura reina <b>{{config('app.name')}}</b>.<br>
            A continuación detallamos sus datos de inscripción.
            <table style="border:none">
                <tbody>
                    <tr>
                        <td><b>Código de Inscripción: </b> {{$precandidate->code}} </td>
                        <td><b>Fecha de casting: </b>  </td>
                        <td><b>Dirección: </b>  </td>
                    </tr>
                </tbody>
            </table>
            <p>Sma</p>
        </div>

    </body>
</html>