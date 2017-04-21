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
    'login_title' => 'Log in',
    'login_fields' => [
        'email' => 'Email',
        'password' => 'Password',
        'remember_me' => 'Remember me'
    ],
    'login_options' => [
        'login_button' => 'Log in',
        'go_register' => 'Subscribe',
        'forgot_password' => 'Forgot your password?',
        'code_not_recivied' => "Didn't recieve the activation code?"
    ],

    'failed' => 'These credentials do not match our records.',
    'throttle' => 'Too many login attempts. Please try again in :seconds seconds.',



    /***
    /
    / REGISTER
    /
    ***/

    'register_title' => 'Subscribe',
    'register_fields' => [
        'email' => 'Email',
        'name' => 'Name',
        'last_name' => 'Last Name',
        'country-select' => 'Select a Country',
        'city' => 'City',
        'address' => 'Address',
        'password' => 'Password',
        'confirm_password' => 'Confirm Password'
    ],
    'register_options' => [
        'register' => 'Subscribe',
        'login' => 'Log in'
    ],

    'validations_register' => [
        'name.required' => 'Please, insert your name',
        'name.max' => 'Please, insert a better name',
        'last_name.required' => 'Please, Insert your last name',
        "country_id.required" => 'Please, insert a country',
        "country_id.exists" => 'Please, insert a existing name',
        "city.required" => 'Please, insert a city',
        'email.required' => 'Please, insert a email',
        'email.email' => 'Please, insert a valid email',
        'email.max' => 'Please, insert a valid email',
        'email.unique' => 'The :attribute has already been taken.',
        'address.required' => 'Please, insert a address',
        'password.required' =>'Please, insert a password',
        'password.min' => 'The :attribute must be at least :min.',
        'password.confirmed' => 'The :attribute confirmation does not match.',
        'password_confirmation.required' => 'The :attribute confirmation does not match.',
    ],

     'register_success' => 'Register successful!',
    'register_success_message'=>'Your account was created successfully but we need to verify your email address. We have sent a confirmation email to your inbox. Simply click on the link you receive in the mail to activate your account. Do not forget to look also in your Spam inbox. Thank you!',
    'register_success_submit' => 'Ok',




     /***
    /
    / FORGOT PASSWORD
    /
    ***/


    'forgot_password_title' => 'Forgot Password',
    'forgot_password_fields' => [
        'email' => 'Email'
    ],
    'forgot_password_options' => [
        'reset_password' => 'Reset Password'
    ],
    'forgot_password_message' => 'Your email has been sent in order to change your password, do not forget to check it in your junk mail. Please check it and follow the instructions.',
    'forgot_password_validations' => [
        'email.required' => 'Please, insert a email',
        'email.exists' => 'The selected :attribute is invalid.',
        'email.confirmed_account' => "Your account isn't confirmed"
    ],

    
    
    /***
    /
    / ACTIVATION 
    /
    ***/
    'activation_page_title' => 'Activation User',
    'activation_page_description'=> 'The activation code can take up to 30 minutes to arrive. Check in your junk mail box',
    'activation_page_message' => 'Activation email has been sent. Please check your email and do not forget to check it in your junk mail.',
    'activation_page_fields' =>[
        'email' => 'Email'
    ],
    'activation_page_options' =>[
        'submit' => 'Send Email Activation'
    ],
    'validations_activation' => [
        'email.required' => 'Please, insert a email',
        'email.exists' => 'The selected :attribute is invalid.',
        'email.is_confirmed_account' => 'Your account is confirmed',
    ],
    'activation_success_message' => 'The account has been successfully activated.',
    'activation_error_message' => 'Account could not be activated.',
    'activation_loading' => 'Loading...',


    /***
    /
    / RESET 
    /
    ***/
    'reset_password_title' => 'Change Password',
    'reset_password_fields' => [
        'email' =>'Email',
        'password' => 'Password',
        'confirm_password' =>'Confirm Password'
    ],
    'reset_password_options' => [
        'submit' => 'Change Password'
    ],
    'reset_password_validations' => [
        'email.token' => 'The token es invalid',
        'email.required' => 'Please, insert a email',
        'email.email' => 'Please, insert a valid email',
        'password.required' =>'Please, insert a password',
        'password.min' => 'The :attribute must be at least :min.',
        'password.confirmed' => 'The :attribute confirmation does not match.',
        'password_confirmation.required' => 'The :attribute confirmation does not match.',
    ]



];
