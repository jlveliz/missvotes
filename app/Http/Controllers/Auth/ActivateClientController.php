<?php

namespace MissVote\Http\Controllers\auth;

use Illuminate\Http\Request;
use MissVote\Http\Controllers\Controller;
use MissVote\Repository\ClientRepository;
use Illuminate\Auth\Events\Registered;
use Validator;
use Response;

class ActivateClientController extends Controller
{
   
    /**
    * 
    */
    protected function verifyEmail(Request $request){
        $data = $request->only('email');
        return Validator::make($data,[
            'email' => 'required|exists:user|is_confirmed_account'
        ],[
            'email.required' => 'Por favor ingrese un correo',
            'email.exists' => 'No existe una cuenta con el correo ingresado',
            'email.is_confirmed_account' => 'Su cuenta ya ha sido confirmada',
        ]);

        return true;
    }


    public function activateAccount($activationCode)
    {
        if (!$activationCode) abort(404);
        $clientRepo = new ClientRepository();
        $client = $clientRepo->find(['confirmation_code'=>$activationCode]);
        if (!$client) abort(404);
        
        $client->confirmation_code = null;
        $client->confirmed = 1;

        $flagData = [];
        if ($client->save()) {
            $flagData['tipo_mensaje'] = "success";
            $flagData['mensaje'] = "La cuenta ha sido activada correctamente";
        } else {
            $flagData['tipo_mensaje'] = "error";
            $flagData['mensaje'] = "La cuenta ha sido activada correctamente";
        }

        return view('frontend.pages.activation',['flagData'=>$flagData]);
    }


     public function reSendactivationCode(Request $request)
    {
        $validator =  $this->verifyEmail($request);

        if ($validator->fails()) {
            return Response::json($validator->errors()->first('email'),500);
        }


        $clientRepo = new ClientRepository();
        $client = $clientRepo->find($request->only('email'));
        if ($client) {
            $client->confirmation_code = str_random(30);
            $client->confirmed = 0;
            $client->save();
            event(new Registered($client));
        }
    }


}
