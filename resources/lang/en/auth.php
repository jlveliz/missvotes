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
    'login_title' => 'Login',
    'login_fields' => [
        'email' => 'Email',
        'password' => 'Password',
        'remember_me' => 'Remember me'
    ],
    'login_options' => [
        'login_button' => 'Login',
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
        'login' => 'Login'
    ],




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

    
    
    /***
    /
    / ACTIVATION 
    /
    ***/
    'activation_page_title' => 'Activation User',
    'activation_page_description'=> 'The activation code can take up to 30 minutes to arrive. Check in your junk mail box',
    'activation_message' => 'Activation email has been sent. Please check your email and do not forget to check it in your junk mail.',
    'activation_page_fields' =>[
        'email' => 'Email'
    ],
    'activation_page_options' =>[
        'submit' => 'Send Email Activation'
    ],


    /***
    /
    / ACTIVATION 
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



];
