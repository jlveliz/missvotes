<?php

namespace MissVote\Http\Controllers;

use Illuminate\Http\Request;

use MissVote\Repository\MissRepository;

use MissVote\Repository\ClientRepository;

use MissVote\Repository\MembershipRepository;

use MissVote\Repository\TicketVoteRepository;

use Hash;

use Validator;

use Redirect;

use Auth;

class WebsiteController extends Controller
{
    
    private $missRepo;

    private $clientRepo;

    private $membershipRepo;

	private $ticketVoteRepo;


	public function __construct(MissRepository $missRepo, ClientRepository $clientRepo, MembershipRepository $membershipRepo, TicketVoteRepository $ticketVoteRepo)
	{
        $this->missRepo = $missRepo;
        $this->clientRepo = $clientRepo;
        $this->membershipRepo = $membershipRepo;
		$this->ticketVoteRepo = $ticketVoteRepo;
	}


    /**
     * show home
     */
    public function index()
    {
    	$misses = $this->missRepo->enum(['state' => 1]);
    	return view('frontend.pages.home',['misses'=>$misses]);
    }

    /**
     * Show miss
     */
    public function show($slug)
    {
    	if (!$slug) abort(404);
    	$miss = $this->missRepo->find(['slug' => $slug]);
        $misses = $this->missRepo->enum(['state'=>1]);
    	if (!$miss) abort(404);
        foreach ($misses as $key => $missAr) {
            if ($missAr->id == $miss->id) {
                unset($misses[$key]);
            }
        }
    	return view('frontend.pages.show-miss',compact('miss','misses'));
    }

    /**
     * Profile account
     */
    public function myAccount()
    {
        $memberships = $this->membershipRepo->enum();
        $tickets = $this->ticketVoteRepo->enum();
        return view('frontend.pages.profile',compact('memberships','tickets'));
    }

    /***
    //UPDATE PROFILE
    **/
    public function updateAccount(Request $request)
    {
        $valition = Validator::make($request->all(),
            [
                'password' => 'required|min:6',
                'repeat_password' => 'required|same:password'
            ],
            [
                'password.required' => 'La por favor ingrese una contraseña',
                'password.min' => 'Ingrese una contraseña mas larga por favor',
                'repeat_password.same' => 'La contraseñas no coinciden',
                'repeat_password.required' => 'Por favor ingrese la confirmación de contraseña'
            ]);

        $sessionData = [
            'tipo_mensaje' => 'success',
            'mensaje' => '',
        ];

        if ($valition->fails()) {
            return Redirect::back()->withErrors($valition);
        }

        $client = $this->clientRepo->find(Auth::user()->id);
        
        if (!$client) {
            $sessionData['tipo_mensaje'] = 'error';
            $sessionData['mensaje'] = 'Su contraseña no pudo ser actualizada';
        } else {
            $client->password = Hash::make($request->get('password'));
            if (!$client->update()) {
                $sessionData['tipo_mensaje'] = 'error';
                $sessionData['mensaje'] = 'Su contraseña no pudo ser actualizada';
            } else {
                $sessionData['mensaje'] = 'Su Contraseña fue actualizada';
            }
        }

        
        return Redirect::back()->with($sessionData);
    }
}
