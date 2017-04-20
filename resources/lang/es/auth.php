<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during authentication for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */
    'login_title' => 'Ingresar',
    'login_fields' => [
        'email' => 'Correo Electrónico',
        'password' => 'Contraseña',
        'remember_me' => 'Recordarme'
    ],
    'login_options' => [
        'login_button' => 'Ingresar',
        'go_register' => 'Subscribirse',
        'forgot_password' => 'Olvidó Su contraseña?',
        'code_not_recivied' => "No recibió el código de Activación?"
    ],

    'failed' => 'Las credenciales no coinciden con nuestros registros.',
    'throttle' => 'Ha sobrepasado el máximo número de intengos de ingreso, intente en :seconds segundos.',



    /***
    /
    / REGISTER
    /
    ***/

    'register_title' => 'Subscribirse',
    'register_fields' => [
        'email' => 'Correo Electrónico',
        'name' => 'Nombre',
        'last_name' => 'Apellido',
        'country-select' => 'Seleccione un País',
        'city' => 'Ciudad',
        'address' => 'Dirección',
        'password' => 'Contraseña',
        'confirm_password' => 'Confirmar Contraseña'
    ],
    'register_options' => [
        'register' => 'Subscribirse',
        'login' => 'Ingresar'
    ],




     /***
    /
    / FORGOT PASSWORD
    /
    ***/


    'forgot_password_title' => 'Perdió su Contraseña',
    'forgot_password_fields' => [
        'email' => 'Email'
    ],
    'forgot_password_options' => [
        'reset_password' => 'Resetear Contraseña'
    ],
    'forgot_password_message' => 'Se ha enviado el correo para poder cambiar su contraseña, no olvide de revisar en su bandeja de correo no deseado. Por favor reviselo y siga las instrucciones.',

    
    /***
    /
    / FORGOT PASSWORD
    /
    ***/
    'activation_page_title' => 'Activación de Usuario',
    'activation_page_description' => 'El código de activación puede demorar hasta 30 minutos en llegar. Revise en su bandeja de correo no deseados.',
    'activation_page_message' => 'Se ha enviado el correo de activación. Por favor revise su correo y no olvide de revisar en su bandeja de correo no deseado. ',
    'activation_page_fields' =>[
        'email' => 'Correo Electrónico'
    ],
    'activation_page_options' =>[
        'submit' => 'Enviar email de confirmación'
    ],

  /***
    /
    / ACTIVATION 
    /
    ***/
    'reset_password_title' => 'Cambiar Contraseña',
    'reset_password_fields' => [
        'email' =>'Correo Electrónico',
        'password' => 'Contraseña',
        'confirm_password' =>'Confirmar Contraseña'
    ],
    'reset_password_options' => [
        'submit' => 'Cambiar Contraseña'
    ],







];
