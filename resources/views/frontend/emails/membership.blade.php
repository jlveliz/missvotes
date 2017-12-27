<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

    <style type="text/css" rel="stylesheet" media="all">
        /* Media Queries */
        @media only screen and (max-width: 500px) {
            .button {
                width: 100% !important;
            }
        }
    </style>
</head>

<?php

$style = [
    /* Layout ------------------------------ */

    'body' => 'margin: 0; padding: 0; width: 100%; background-color: #F2F4F6;color:#000',
    'email-wrapper' => 'width: 100%; margin: 0; padding: 0; background-color: #F2F4F6;',

    /* Masthead ----------------------- */

    'email-masthead' => 'padding: 25px 0; text-align: center;',
    'email-masthead_name' => 'font-size: 16px; font-weight: bold; color: #2F3133; text-decoration: none; text-shadow: 0 1px 0 white;',

    'email-body' => 'width: 100%; margin: 0; padding: 0; border-top: 1px solid #EDEFF2; border-bottom: 1px solid #EDEFF2; background-color: #FFF;',
    'email-body_inner' => 'width: auto; max-width: 570px; margin: 0 auto; padding: 0;',
    'email-body_cell' => 'padding: 35px;',

    'email-footer' => 'width: auto; max-width: 570px; margin: 0 auto; padding: 0; text-align: center;',
    'email-footer_cell' => 'color: #AEAEAE; padding: 35px; text-align: center;',

    /* Body ------------------------------ */

    'body_action' => 'width: 100%; margin: 30px auto; padding: 0; text-align: center;border:1px solid #cdcdcd',
    'body_sub' => 'margin-top: 25px; padding-top: 25px; border-top: 1px solid #EDEFF2;',

    /* Type ------------------------------ */

    'anchor' => 'color: #3869D4;',
    'header-1' => 'margin-top: 0; color: #2F3133; font-size: 19px; font-weight: bold; text-align: left;',
    'paragraph' => 'margin-top: 0; color: #74787E; font-size: 16px; line-height: 1.5em;',
    'paragraph-sub' => 'margin-top: 0; color: #74787E; font-size: 12px; line-height: 1.5em;',
    'paragraph-center' => 'text-align: center;',

    /* Buttons ------------------------------ */

    'button' => 'display: block; display: inline-block; width: 200px; min-height: 20px; padding: 10px;
                 background-color: #3869D4; border-radius: 3px; color: #ffffff; font-size: 15px; line-height: 25px;
                 text-align: center; text-decoration: none; -webkit-text-size-adjust: none;',

    'button--green' => 'background-color: #22BC66;',
    'button--red' => 'background-color: #dc4d2f;',
    'button--blue' => 'background-color: #3869D4;',
];
?>

<?php $fontFamily = 'font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif;'; ?>

<body style="{{ $style['body'] }}">
    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td style="{{ $style['email-wrapper'] }}" align="center">
                <table width="100%" cellpadding="0" cellspacing="0">
                    <!-- Logo -->
                    <tr>
                        <td style="{{ $style['email-masthead'] }}">
                            <a style="{{ $fontFamily }} {{ $style['email-masthead_name'] }}" href="{{ url('/') }}" target="_blank">
                                <img src="{{ asset('public/images/logo_square.png') }}" alt="{{ config('app.name') }}" title="{{ config('app.name') }}">
                            </a>
                        </td>
                    </tr>

                    <!-- Email Body -->
                    <tr>
                        <td style="{{ $style['email-body'] }}" width="100%">
                            <table style="{{ $style['email-body_inner'] }}" align="center" width="570" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td style="{{ $fontFamily }} {{ $style['email-body_cell'] }}">
                                        <!-- Greeting -->
                                        <h1 style="{{ $style['header-1'] }}">
                                           {{ trans('email.buy_membership.greeting') }}
                                        </h1>

                                        <!-- Intro -->
                                        <p style="{{ $style['paragraph'] }} ; text-align: justify;color:#444">
                                            {{ trans('email.buy_membership.line_1') }} <b>{{ trans('email.buy_membership.line_1_2') }}</b>
                                        </p>
                                        <ul style="text-align:justify;padding: 0px">
                                            <li><b>{{ trans('email.buy_membership.list_header') }}</b> {{ trans('email.buy_membership.list_body') }}</li>
                                            <li><b>{{ trans('email.buy_membership.list_header_2') }}</b> {{ trans('email.buy_membership.list_body_2') }}</li>
                                            <li><b>{{ trans('email.buy_membership.list_header_3') }}</b> {{ trans('email.buy_membership.list_body_3') }}</li>
                                            <li><b>{{ trans('email.buy_membership.list_header_4') }}</b> {{ trans('email.buy_membership.list_body_4') }}</li>
                                        </ul>
                                        
                                        <!-- Action Button -->
                                        <table style="{{ $style['body_action'] }}" align="center" width="100%" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td align="center">
                                                  {{ trans('email.buy_membership.name') }}
                                                </td>
                                                <td align="center">{{ trans('email.buy_membership.duration') }}</td>
                                                <td align="center">{{ trans('email.buy_membership.price') }}</td>
                                                <td align="center">{{ trans('email.buy_membership.points') }}</td>
                                            </tr>
                                          
                                            <tr>
                                                <td>{{ $membership->name }}</td>
                                                <td>{{$membership->duration_time}} @if($membership->duration_mode == 1) {{ trans('email.buy_membership.duration_month') }} @else {{ trans('email.buy_membership.duration_year') }} @endif</td>
                                                <td>{{$membership->price}}</td>
                                                <td>{{$membership->points_per_vote}}</td>
                                            </tr>
                                                
                                          
                                        </table>

                                        <!-- Salutation -->
                                        <p style="{{ $style['paragraph'] }}">
                                            {{ trans('email.buy_membership.last_message')}}
                                        </p>

                                        <p style="{{ $style['paragraph'] }}">
                                            {{ trans('email.buy_membership.dont_forget')}}
                                        </p>

                                        <ul style="list-style: none;padding: 0px">
                                            <li>Facebook: <a target="_blank" href="https://www.facebook.com/MissPanamericanInternational/">https://www.facebook.com/MissPanamericanInternational/</a></li>
                                            <li>Instagram: <a target="_blank" href="https://www.instagram.com/misspanamericaninternational/">https://www.instagram.com/misspanamericaninternational/</a></li>
                                            <li>Twitter: <a target="_blank" href="https://twitter.com/misspanamerican">https://twitter.com/misspanamerican</a></li>
                                        </ul>


                                        <p style="{{ $style['paragraph'] }}">
                                            Atte. <br> {{ config('app.name') }}
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td>
                            <table style="{{ $style['email-footer'] }}" align="center" width="570" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td style="{{ $fontFamily }} {{ $style['email-footer_cell'] }}">
                                        <p style="{{ $style['paragraph-sub'] }}">
                                            &copy; {{ date('Y') }}
                                            <a style="{{ $style['anchor'] }}" href="{{ url('/') }}" target="_blank">{{ config('app.name') }}</a>.
                                            {{ trans('email.right_reserved')}}.
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
