<?php

namespace MissVote\Http\Controllers\Auth;

use MissVote\Models\Client;
use MissVote\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Auth\Events\Registered;
use MissVote\Repository\ClientRepository;
use Illuminate\Http\Request;
use Response;

class RegisterClientController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

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
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:user',
            'address' => 'required',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6'
        ]);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($client = $this->create($request->all())));

        // $this->guard()->login($user);

        return $this->registered($request, $client)
            ?: redirect($this->redirectPath());
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $confirmation_code = str_random(30);

       return Client::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'address' => $data['address'],
            'is_admin' => 0,
            'confirmation_code' => $confirmation_code,
            'password' => bcrypt($data['password']),
        ]);
        
    }

    /**
     * 
     */
    protected function verifyEmail(Request $request){
        $data = $request->only('email');
        $validator =  Validator::make($data,[
            'email' => 'unique:user'
        ],[
            'email.unique' => 'El correo ya pertenece a otro usuario'
        ]);

        if ($validator->fails()) {
            return Response::json($validator->errors()->first('email'),200);
        }
        return Response::json('true',200);
    }


    public function activateAccount($activationCode)
    {
        if (!$activationCode) abort(404);
        $clientRepo = new ClientRepository();
        $client = $clientRepo->find(['activation_code'=>$activationCode]);
        if (!$client) abort(404);
        
        $client->activation_code = null;
        $client->confirmed = 1;

        $sessionData = [];
        if ($client->save()) {
            $sessionData['tipo_mensaje'] = "success";
            $sessionData['mensaje'] = "La cuenta ha sido activada correctamente";
        } else {
            $sessionData['tipo_mensaje'] = "error";
            $sessionData['mensaje'] = "La cuenta ha sido activada correctamente";
        }


        return view('frontend.pages.activation')->with($sessionData);


    }
}
