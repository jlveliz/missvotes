<?php

namespace MissVote\Http\Controllers;



use Illuminate\Http\Request;
use MissVote\RepositoryInterface\MissRepositoryInterface;
use MissVote\RepositoryInterface\ClientRepositoryInterface;
use MissVote\RepositoryInterface\MembershipRepositoryInterface;
use MissVote\RepositoryInterface\ClientActivityRepositoryInterface;
use MissVote\Events\ClientActivity;
use MissVote\Events\ClientUnsubscribed;
use MissVote\Models\Country;
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
	private $clientActRepo;


	public function __construct(MissRepositoryInterface $missRepo, ClientRepositoryInterface $clientRepo, MembershipRepositoryInterface $membershipRepo,ClientActivityRepositoryInterface $clientActRepo)

	{

        $this->missRepo = $missRepo;

        $this->clientRepo = $clientRepo;

        $this->membershipRepo = $membershipRepo;

		$this->clientActRepo = $clientActRepo;

	}





    /**

     * show home

     */

    public function index()

    {

    	// return redirect()->route('website.account');
        $misses = $this->missRepo->paginate();

        return view('frontend.pages.home',['misses'=>$misses]);

    }


    public function showMisses()
    {
        $misses = $this->missRepo->paginate();

        return view('frontend.pages.home',['misses'=>$misses]);
    }



    /**

     * Show miss

     */

    public function show($slug)

    {

    	if (!$slug) abort(404);

    	$miss = $this->missRepo->find(['slug' => $slug]);

        $misses = $this->missRepo->enumWithPhotos(['state'=>1]);

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

        $activities = $this->clientActRepo->enum(['client_id'=>Auth::user()->id]);

        $countries = Country::orderby('name')->get();

        $availableTickets = 0;
        $totalTickets = 0;

        foreach (Auth::user()->client->tickets()->get() as $key => $ticket) {
            if ($ticket->state == 1) {
                $availableTickets+=$ticket->val_vote;
            }
            $totalTickets+=$ticket->val_vote;
        }

        return view('frontend.pages.profile',compact('memberships','tickets','activities','countries','availableTickets','totalTickets'));

    }





    public function editAccount()

    {

        if (session()->has('edit-account')) {

            session()->forget('edit-account');

        } else {

            session()->put('edit-account',true);

        }

        return redirect()->route('website.account');

    }



    /***

    //UPDATE PROFILE

    **/

    public function updateAccount(Request $request)

    {
      
        $valition = Validator::make($request->all(),

            [

                'name' => 'required_with:name',

                'last_name'=>'required_with:last_name',

                'country_id' => 'required_with:country_id|exists:country,id',

                'city' => 'required_with:city',

                'address' => 'required_with:address',

                'password' => 'required_with:password|min:6',

                'repeat_password' => 'required_with:repeat_password|same:password',

                'photo'=> 'required_with'

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



        session()->forget('edit-account');

        $client = $this->clientRepo->find(Auth::user()->id);

        $data = $request->all();

        if (!$client) {

            $sessionData['tipo_mensaje'] = 'error';

            $sessionData['mensaje'] = Lang::get('auth.profile.change_password.cant_change');

        } else {



            $sessionData['mensaje'] = Lang::get('auth.profile.update_profile');

            $sessionData['action'] = 'update';

            

            if ($request->has('password')) {


                $data['password'] = Hash::make($request->get('password'));

                // $sessionData['mensaje'] = Lang::get('auth.profile.change_password.change_success');

                //event(new ClientActivity(Auth::user()->id,'activity.auth.change_password'));



            } else {
                unset($data['password']);
                event(new ClientActivity(Auth::user()->id,'activity.auth.update_profile'));

            }


            $client->fill($data);



            if ($request->hasFile('photo')) {

                $uploadPhoto = $this->clientRepo->uploadPhoto(Auth::user()->id,$request->file('photo'));
                $client->photo = $uploadPhoto;

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

    public function deleteAccount()
    {
        return view('frontend.pages.unsuscribe');
    }

    public function postDeleteAccount(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|is_same_password_database',
        ],
        [
           'password.required' => Lang::get('account_profile.password_required'),
           'password.is_same_password_database' => Lang::get('account_profile.dont_match_password'),
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $client = $this->clientRepo->find(Auth::id());
        if ($client) {
            Auth::logout();
            $clientSendMail = $client;
            if ($client->delete()) {
                event(new ClientUnsubscribed($clientSendMail));
                return back();
            }
        }
        
    }

}

