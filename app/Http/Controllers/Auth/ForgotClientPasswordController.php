<?php

namespace MissVote\Http\Controllers\Auth;

use MissVote\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Validator;
use Request;
use Response;

class ForgotClientPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function verifyEmail()
    {
        $data = Request::only('email');
        $validator =  Validator::make($data,[
            'email' => 'exists:user'
        ],[
            'email.exists' => 'El correo no pertenece a ningún usuario'
        ]);

        // dd($validator->errors()->all());
        if ($validator->fails()) {
            return Response::json($validator->errors()->first('email'),200);
        }
        return Response::json('true',200);

    }
}
