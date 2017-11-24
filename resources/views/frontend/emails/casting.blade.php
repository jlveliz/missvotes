<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
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

    'body' => 'margin: 0; padding: 0; width: 100%; background-color: #F2F4F6;',
    'email-wrapper' => 'width: 100%; margin: 0; padding: 0; background-color: #F2F4F6;',

    /* Masthead ----------------------- */

    'email-masthead' => 'padding: 25px 0; text-align: center;',
    'email-masthead_name' => 'font-size: 16px; font-weight: bold; color: #2F3133; text-decoration: none; text-shadow: 0 1px 0 white;',

    'email-body' => 'width: 100%; margin: 0; padding: 0; border-top: 1px solid #EDEFF2; border-bottom: 1px solid #EDEFF2; background-color: #FFF;',
    'email-body_inner' => 'width: auto;margin: 0 auto; padding: 0;',
    'email-body_cell' => 'padding: 35px;',

    'email-footer' => 'width: auto;margin: 0 auto; padding: 0; text-align: center;',
    'email-footer_cell' => 'color: #AEAEAE; padding: 35px; text-align: center;',

    /* Body ------------------------------ */

    'body_action' => 'width: 100%; margin: 30px auto; padding: 0; text-align: center;',
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
        <table  width="100%" cellpadding="0" cellspacing="0">
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

                        {{-- BODY --}}
                        <tr>
                            <td style="{{ $style['email-body'] }}" width="100%">
                                <table style="{{ $style['email-body_inner'] }}"  width="100%">
                                    <tr>
                                        <td style="width: 50%">
                                            <p>{{trans('email.casting.hi')}} <b>{{$applicant->name}} {{$applicant->last_name}}</b> {{trans('email.casting.thanks')}} {{trans('email.casting.welcome')}}</p>
                                            <h2><b>{{ trans('email.casting.casting_code') }}</b> <b style="color: red">{{ $applicant->code }}</b></h2>
                                            <p>{{trans('email.casting.paragraph_1')}}</p>
                                            <p>{{trans('email.casting.paragraph_2_part_1')}} <a href="http://google.com" target="_blank"> {{trans('email.casting.paragraph_2_part_1_rules')}} </a> 
                                            {{trans('email.casting.paragraph_2_part_2')}} </p>
                                            <p>{{trans('email.casting.paragraph_3',
                                                ['month'=>$currentMonth,
                                                'minDayMonth'=>$minDayCurrentMonth,
                                                'maxDayMonth'=>$maxDayCurrentMonth,
                                                'dayMax'=>5,
                                                'nMonth'=>$nextMonth]
                                            )}}</p>
                                            <br>
                                            <p><b>{{trans('email.casting.lucky')}}</b></p>
                                            <p>{{trans('email.casting.questions')}}</p>
                                        </td>
                                        <td style="width: 50%">
                                            <img src="{{ asset('public/images/email_art.png') }}" alt="{{config('app.name')}}" title="{{config('app.name')}}">
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
                                            <p style="{{ $style['paragraph-sub'] }}"> &copy; {{ date('Y') }}
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