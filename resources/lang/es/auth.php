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

    'validations_register' => [
        'name.required' => 'Por favor, Ingrese su nombre',
        'name.max' => 'Por favor, ingrese un nombre mas corto',
        'last_name.required' => 'Por favor, Ingrese su apellido',
        "country_id.required" => 'Por favor, ingrese un País',
        "country_id.exists" => 'El País no existe',
        "city.required" => 'La Ciudad es requerida',
        'email.required' => 'Por favor ingrese un correo',
        'email.email' => 'Por favor ingrese un correo válido',
        'email.max' => 'Por favor su correo es muy grande',
        'email.unique' => 'El correo ya se encuentra registrado',
        'address.required' => 'Por favor ingrese una dirección',
        'password.required' =>'Por favor ingrese una contraseña',
        'password.min' => 'Por favor ingrese una contraseña más larga',
        'password.confirmed' => 'Las contraseñas no coinciden',
        'password_confirmation.required' => 'Por favor repita la contraseña',
    ],

    'register_success' => 'Registro completo!',
    'register_success_message'=>'Su cuenta se creó correctamente, pero debemos verificar su correo electrónico. Hemos enviado un correo de confirmación a su bandeja de entrada. Simplemente debe hacer clic en el enlace que reciba para activar su cuenta. No olvide buscar también en su bandeja de correos no deseados. ¡Gracias!',
    'register_success_submit' => 'Aceptar',




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
    'forgot_password_validations' => [
        'email.required' => 'Por favor, ingrese un correo',
        'email.exists' => 'El correo no pertenece a ningún usuario',
        'email.confirmed_account' => 'Su cuenta no está activa'
    ],

    
    /***
    /
    / ACTIVATION
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
    'validations_activation' => [
        'email.required' => 'Por favor ingrese un Correo Electrónico',
        'email.exists' => 'El correo Electrónico ya pertenece a Usuario',
        'email.is_confirmed_account' => 'Su cuenta ya ha sido confirmada',
    ],
    'activation_success_message' => 'La cuenta ha sido activada correctamente.',
    'activation_error_message' => 'La cuenta no pudo ser activada.',
    'activation_loading' => 'Cargando...',

  /***
    /
    / RESET 
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
    'reset_password_validations' => [
        'email.token' => 'El token es inválido',
        'email.required' => 'Por favor, ingrese un Correo Electrónico',
        'email.email' => 'Por favor, ingrese un correo válido',
        'password.required' => 'Por favor, ingrese una nueva contraseña',
        'password.confirmed' => 'Las contraseñas no coinciden',
        'password.min' => 'Por favor ingrese una contraseña de al menos 6 caracteres',
    ],






];
