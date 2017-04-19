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
    protected $redirectTo = '/auth/register-success';

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
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        return view('frontend.pages.auth.register');
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
            'last_name' => 'required',
            'country_id' => 'required|exists:country,id',
            'city' => 'required',
            'email' => 'required|email|max:255|unique:user',
            'address' => 'required',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6'
        ],
        [
            'name.required' => 'El Nombre es requerido',
            'name.max' => 'Por favor ingrese un nombre mas corto',
            'last_name.required' => 'El Apellido es requerido',
            "country_id.required" => 'El País es requerido',
            "country_id.exists" => 'El País no existe',
            "city.required" => 'La Ciudad es requerida',
            'email.required' => 'Por favor ingrese un correo',
            'email.email' => 'Por favor ingrese un correo válido',
            'email.max' => 'Por favor su correo es muy grande',
            'email.unique' => 'El correo ya se encuentra registrado',
            'address.required' => 'Por favor ingrese una dirección',
            'password.required' =>'Por favor ingrese una clave',
            'password.min' => 'Por favor ingrese una clave más larga',
            'password.confirmed' => 'Las claves no coinciden',
            'password_confirmation.required' => 'Por favor repita la clave',
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

        if ($request->ajax()) {
            $validator = $this->validator($request->all());
            if ($validator->fails()) {
                 return Response::json(['email'=>$validator->errors("email")->first()],500);
            }
        } else {
             $this->validator($request->all())->validate();
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
            'last_name' => $data['last_name'],
            'country_id' => $data['country_id'],
            'city' => $data['city'],
            'email' => $data['email'],
            'address' => $data['address'],
            'is_admin' => (new Client())->getInactive(),
            'confirmation_code' => $confirmation_code,
            'password' => bcrypt($data['password']),
        ]);
        
    }

    public function registerSuccess()
    {
        return view('frontend.pages.auth.register-success');
    }

 

   


  
}
