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

     'login_title' => 'Log in / Iniciar Sesión',
    'login_fields' => [
        'email' => 'Email / Correo Electrónico',
        'password' => 'Password / Contraseña',
        'remember_me' => 'Remember me / Recordarme'
    ],
    'login_options' => [
        'login_button' => 'Log in / Ingresar',
        'go_register' => 'Suscribirse',
        'forgot_password' => '¿Olvidó su contraseña?',
        'code_not_recivied' => "¿No recibió el código de activación?",
        'message_close_session'=> 'Si quiere suscribirse con otro correo electrónico, primero debe cerrar su anterior sesión',
        'message_app_session'=> 'Para tener acceso a la aplicación en línea debes suscribirte primero / Si ya eres un usuario ingresa a tu cuenta.',
    ],



    'failed' => 'contraseña o correo incorrecto. Vuelva a intentarlo.',

    'throttle' => 'Ha sobrepasado el máximo número de intengos de ingreso, intente en :seconds segundos.',

    'not_confirmed' => 'Lo sentimos, tu cuenta está inactiva.',









    /***

    /

    / REGISTER

    /

    ***/



        
    'register_title' => 'Subscribe / Suscribirse',
    'register_fields' => [
        'email' => 'Email / Correo Electr&oacute;nico',
        'name' => 'Name / Nombre',
        'last_name' => 'Last Name / Apellido',
        'country-select' => 'Select a Country / Seleccione un Pa&iacute;s',
        'city' => 'City / Ciudad',
        'address' => 'Address / Domicilio',
        'password' => 'Password / Contrase&ntilde;a',
        'confirm_password' => 'Confirm Password / Confirmar Contrase&ntilde;a',
        'gender' => 'Gender / Género',
        'male' => 'Male / Masculino',
        'female' => 'Female / Masculino',
        'accept_terms' => 'I accept the',
        'terms_conditions' => 'terms and conditions',
        'follows' => 'Follow us'
    ],

    'register_options' => [

        'register' => 'Subscribe / Suscribirse',

        'login' => 'Log In / Ingresar'

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

        'accept_terms_conditions.required' => 'Por favor, acepte los terminos y condiciones'

    ],



    'register_success' => 'Registro completo!',

    'register_success_message'=>'Su cuenta se creó correctamente, pero debemos verificar su correo electrónico. Hemos enviado un correo de confirmación a su bandeja de entrada. Simplemente debe hacer clic en el enlace que reciba para activar su cuenta. No olvide buscar también en su bandeja de correos no deseados. ¡Gracias!',

    'register_success_submit' => 'Aceptar',









     /***

    /

    / FORGOT PASSWORD

    /

    ***/





    'forgot_password_title' => 'Olvidó su Contraseña',

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

        'email.confirmed_account' => 'Lo sentimos, su cuenta está inactiva.'

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







    'profile' => [

        'validations'=>[

            'name.required'=>'Su nombre es requerido',

            'last_name.required'=>'Su apellido es requerido',

            'country_id.required' => 'El País es requerido',

            'country_id.exists' =>'El País no existe',

            'city.required'=>'La ciudad es requerida',

            'address.required' => 'La dirección es requerida',

            'password.required_with' => 'Por favor ingrese una contraseña',

            'password.min' => 'Ingrese una contraseña mas larga por favor',

            'repeat_password.same' => 'La contraseñas no coinciden',

            'repeat_password.required_with' => 'Por favor ingrese la confirmación de contraseña',

            'photo.required_with'=> 'Inserte una imagen',

            'photo.image' => 'Inserte una imagen'   

        ],

        'change_password' => [

            'cant_change' => 'Su contraseña no pudo ser actualizada',

            'change_success' => 'Su Contraseña fue actualizada',



        ],

        'update_profile' => 'Perfil Actualizado correctamente',

    ],





];

