<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <h2>Verify Your Email Address</h2>

        <div>
            Gracias por registrarse con nosotros, ahora solo es necesario que active su cuenta para que pueda votar.
            Por favor presione sobre el link para activar su cuenta.<br> 
            {{ URL::to('auth/activate/' . $confirmation_code) }}<br/>
        </div>

    </body>
</html>