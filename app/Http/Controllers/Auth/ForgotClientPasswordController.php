<?php

namespace MissVote\Http\Controllers\Auth;

use MissVote\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
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


     /**
     * Send a reset link to the given user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendResetLinkEmail(Request $request)
    {
        $this->verifyEmail($request);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $response = $this->broker()->sendResetLink(
            $request->only('email')
        );

        return $response == Password::RESET_LINK_SENT
                    ? $this->sendResetLinkResponse($response)
                    : $this->sendResetLinkFailedResponse($request, $response);
    }

    public function verifyEmail(Request $request)
    {
        $data = $request->only('email');
        $validator =  Validator::make($data,[
            'email' => 'required|email|exists:user|confirmed_account'
        ],[
            'email.required' => 'El correo debe ser ingresado',
            'email.email' => 'Debe ser un correo válido',
            'email.exists' => 'El correo no pertenece a ningún usuario',
            'email.confirmed_account' => 'Su cuenta no está activa'
        ]);

        if ($validator->fails()) {
            return response()->json(['email'=>$validator->errors()->first('email')],422);
        }
        return Response::json('true',200);

    }
}
