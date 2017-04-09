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
        ],
        [
            'name.required' => 'El Nombre es requerido',
            'name.max' => 'Por favor ingrese un nombre mas corto',
            'email.required' => 'Por favor ingrese un correo',
            'email.email' => 'Por favor ingrese un correo válido',
            'email.max' => 'Por favor su correo es muy grande',
            'email.unique' => 'El correo ya se encuentra registrado',
            'address.required' => 'Por favor ingrese una dirección',
            'password.required' =>'Por favor ingrese una clave',
            'password.min' => 'Por favor ingrese una clave más larga',
            'password.confirmed' => 'Las claves no coinciden',
            'password_confirmation' => 'Por favor repita la clave',
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
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
             return Response::json(['email'=>$validator->errors("email")->first()],500);
        }

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
            'is_admin' => (new Client())->getInactive(),
            'confirmation_code' => $confirmation_code,
            'password' => bcrypt($data['password']),
        ]);
        
    }

 

   


  
}
