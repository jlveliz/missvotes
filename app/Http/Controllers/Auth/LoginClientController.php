<?php

namespace MissVote\Http\Controllers\Auth;

use MissVote\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Validator;
use Auth;
use Lang;

class LoginClientController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/account';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('frontend.pages.auth.login');
    }

  
    public function login(Request $request)
    {
       
        $validate = $this->validateLogin($request);
        if ($request->ajax()) {
            if ($validate->fails()) {
                return response()->json([$this->username() => $validate->errors()->first()],500);
            }
        } else {
            if ($validate->fails()) {
            // If the login attempt was unsuccessful we will increment the number of attempts
            // to login and redirect the user back to the login form. Of course, when this
            // user surpasses their maximum number of attempts they will get locked out.
            $this->incrementLoginAttempts($request);

            // If the class is using the ThrottlesLogins trait, we can automatically throttle
            // the login attempts for this application. We'll key this by the username and
            // the IP address of the client making these requests into this application.
            if ($this->hasTooManyLoginAttempts($request)) {
                $this->fireLockoutEvent($request);

                return $this->sendLockoutResponse($request);
            }


            return redirect()->back()
                ->withInput($request->only($this->username(), 'remember'))
                ->withErrors([
                    $this->username() => $validate->errors()->all(),
                ]);
            }
        }

       
        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }


    }


    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function validateLogin(Request $request)
    {
        return Validator::make($request->all(), [
            $this->username() => 'required|confirmed_account|exists:user', 'password' => 'required',
        ],
        [
            $this->username().'.confirmed_account' => Lang::get('auth.not_confirmed'),
            $this->username().'.exists' => Lang::get('auth.failed'),
        ]);

    }

     /**
     * Attempt to log the user into the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function attemptLogin(Request $request)
    {
        $attempt = $this->guard()->attempt(
            $this->credentials($request), $request->has('remember')
        );

        if ($attempt) {
            //si existe usuario y si esta confirmado y no tiene codigo de confirmacion
            if (Auth::user() && (Auth::user()->confirmed  && !Auth::user()->confirmation_code) ) {
                return true;
            }

            Auth::logout();
            return false;
        }

        return false;
    }


     /**
     * Get the failed login response instance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        
        if ($request->ajax()) {
            return response()->json([$this->username() => Lang::get('auth.failed')],500);
        } else {
            return redirect()->back()
            ->withInput($request->only($this->username(), 'remember'))
            ->withErrors([
                $this->username() => Lang::get('auth.failed'),
            ]);
        }

    }


     /**
     * Send the response after the user was authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);


        if ($request->ajax()) {
            // return $this->authenticated($request, $this->guard()->user())
            return response()->json(['success' => 'echo'],200);
        } else {
            return $this->authenticated($request, $this->guard()->user())
                    ?: redirect()->intended($this->redirectPath()); 
        }

    }


    /**
     * Log the user out of the application.
     *
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        return redirect()->route('client.login');
    }




}
