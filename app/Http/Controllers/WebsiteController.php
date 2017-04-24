<?php

namespace MissVote\Http\Controllers;

use Illuminate\Http\Request;

use MissVote\RepositoryInterface\MissRepositoryInterface;

use MissVote\RepositoryInterface\ClientRepositoryInterface;

use MissVote\RepositoryInterface\MembershipRepositoryInterface;

use MissVote\RepositoryInterface\TicketVoteRepositoryInterface;

use MissVote\RepositoryInterface\ClientActivityRepositoryInterface;

use MissVote\Events\ClientActivity;

use App;

use Hash;

use Validator;

use Redirect;

use Auth;

use Lang;

class WebsiteController extends Controller
{
    
    private $missRepo;

    private $clientRepo;

    private $membershipRepo;

    private $ticketVoteRepo;

	private $clientActRepo;


	public function __construct(MissRepositoryInterface $missRepo, ClientRepositoryInterface $clientRepo, MembershipRepositoryInterface $membershipRepo, TicketVoteRepositoryInterface $ticketVoteRepo, ClientActivityRepositoryInterface $clientActRepo)
	{
        $this->missRepo = $missRepo;
        $this->clientRepo = $clientRepo;
        $this->membershipRepo = $membershipRepo;
        $this->ticketVoteRepo = $ticketVoteRepo;
		$this->clientActRepo = $clientActRepo;
	}


    /**
     * show home
     */
    public function index()
    {
    	return redirect()->route('website.account');
        $misses = $this->missRepo->paginate();
    	return view('frontend.pages.home',['misses'=>$misses]);
    }

    /**
     * Show miss
     */
    public function show($slug)
    {
    	return redirect()->route('website.account');
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
        $activities = $this->clientActRepo->enum(['client_id'=>Auth::user()->id]);
        return view('frontend.pages.profile',compact('memberships','tickets','activities'));
    }

    /***
    //UPDATE PROFILE
    **/
    public function updateAccount(Request $request)
    {
        $valition = Validator::make($request->all(),
            [
                'password' => 'required_with:password|min:6',
                'repeat_password' => 'required_with:repeat_password|same:password',
                'photo'=> 'required_with|image'
            ],
            Lang::get('auth.profile.validations'));

        $sessionData = [
            'tipo_mensaje' => 'success',
            'mensaje' => '',
            'action' => '',
        ];

        if ($valition->fails()) {
            return Redirect::back()->withErrors($valition);
        }

        $client = $this->clientRepo->find(Auth::user()->id);
        
        if (!$client) {
            $sessionData['tipo_mensaje'] = 'error';
            $sessionData['mensaje'] = Lang::get('auth.profile.change_password.cant_change');
        } else {
            if ($request->has('password')) {
                $client->password = Hash::make($request->get('password'));
                $sessionData['mensaje'] = Lang::get('auth.profile.change_password.change_success');
                $sessionData['action'] = 'update-password';
                 event(new ClientActivity(Auth::user()->id,'Have changed your password'));

            }

            if ($request->hasFile('photo')) {
                $uploadPhoto = $this->clientRepo->uploadPhoto(Auth::user()->id,$request->file('photo'));
                $sessionData['action'] = 'update-photo-profile';
                if ($uploadPhoto) {
                    $client->photo = $uploadPhoto;
                    $sessionData['mensaje'] = 'Foto de perfil actualizada';
                } else {
                    $sessionData['mensaje'] = 'Su Foto de perfil no pudo actualizada';
                }
            }

            if (!$client->update()) {
                $sessionData['tipo_mensaje'] = 'error';
                if ($request->has('photo')) {
                    $sessionData['mensaje'] = 'Su Foto de perfil no pudo actualizada';
                }

                if ($request->has('password')) {
                    $sessionData['mensaje'] = 'Su contraseña no pudo ser actualizada';
                }
            }
        }

        
        return Redirect::back()->with($sessionData);
    }


    public function setLocale(Request $request)
    {
        $rules = [
            'language' => 'in:es,en' //list of supported languages of your application.
        ];

        $language = $request->get('lang'); //lang is name of form select field.

        $validator = Validator::make(compact($language),$rules);

        if($validator->passes())
        {
            session()->put('locale',$language);
            app()->setLocale($language);
            return redirect()->back();
        }
    }
}
