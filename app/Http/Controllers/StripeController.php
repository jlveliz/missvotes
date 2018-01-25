<?php

namespace MissVote\Http\Controllers;

use Illuminate\Http\Request;

use MissVote\RepositoryInterface\MembershipRepositoryInterface;

use MissVote\RepositoryInterface\TicketVoteClientRepositoryInterface;

use MissVote\Models\User;

use MissVote\Events\ClientActivity;

use Stripe\Stripe;

use Stripe\Customer;

use Carbon\Carbon;

use Redirect;

use Lang;

use Auth;

class StripeController extends Controller
{
    

	private $membershipRepo; 

	private $ticketRepo; 


	public function __construct(MembershipRepositoryInterface  $membershipRepo, TicketVoteClientRepositoryInterface $ticketRepo)
	{
		$this->membershipRepo = $membershipRepo;
		$this->ticketRepo = $ticketRepo;
	}

	/**
	 * create a subscription on system and proccess a parge on stripe
	 */

	public function subscribe(Request $request)
	{
		$stripeToken = $request->get('stripeToken');

		$user = Auth::user();

		$plan = $this->membershipRepo->find($request->get('membership_id'));

		if (!$this->isStripeCustomer()) {
			$this->createStripeCustomer($stripeToken);
		} 


		//make MAGIC!!
		$subscribed = $user->charge($request->get('amount'),['description'=>Lang::get('stripe.pay_membership').' '.$plan->name]);

		$mensaje = [
			'payment-type' => 'success',
			'payment-message' => ''
		];

		if ($subscribed) {

			$this->createOrUpdateMembershipTable($plan);

			//insert activity
            event(new ClientActivity(Auth::user()->id,'activity.membership.bought');

			$mensaje['payment-message'] = Lang::get('stripe.thanks_buy_membership').' '. $plan->name;
		} else {
			$mensaje['payment-type'] = 'error';
			$mensaje['payment-message'] = Lang::get('stripe.error_buy_membership');
		}
		

		// return redirect()->route('website.account')->with($mensaje);
		if (config('app.env') == 'local') {
                    return redirect()->route('website.account')->with($mensaje);
        } else {
                    return redirect()->away('https://www.misspanamericaninternational.com/login/')->with($mensaje);
        }

	}


	/**
	 * buy a ticket 
	 */

	public function buyTicket(Request $request)
	{
		$stripeToken = $request->get('stripeToken');

		$user = Auth::user();

		$ticket = $this->ticketRepo->find($request->get('ticket_id'));

		if (!$this->isStripeCustomer()) {
			$this->createStripeCustomer($stripeToken);
		} 
		
		//make MAGIC!!
		$subscribed = $user->charge($request->get('amount'),['description'=>"pago de ticket ".$ticket->name.""]);

		$mensaje = [
			'payment-type' => 'success',
			'payment-message' => ''
		];

		if ($subscribed) {

			$this->createUserTicket($ticket);

			//insert activity
            event(new ClientActivity(Auth::user()->id, 'activity.ticket.bought'));

			$mensaje['payment-message'] = 'Gracias por la compra de un ticket '. $ticket->name;
		} else {
			$mensaje['payment-type'] = 'Error';
			$mensaje['payment-message'] = 'Ocurrió un problema al procesar el pago, intente nuevamente.';
		}
		

		// return redirect()->route('website.account')->with($mensaje);
		if (config('app.env') == 'local') {
		 	return redirect()->route('website.account')->with($mensaje);
		} else {
			return redirect()->away('https://www.misspanamericaninternational.com/login/')->with($mensaje);
		}
	}



	 /**
    * Create a new Stripe customer for a given user.
    *
    * @var Stripe\Customer $customer
    * @param string $token
    * @return Stripe\Customer $customer
    */
    public function createStripeCustomer($token)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $customer = Customer::create(array(
        	"email" => Auth::user()->email,
            "description" => Auth::user()->name .' '. Auth::user()->last_name,
            "source" => $token
        ));

        Auth::user()->stripe_id = $customer->id;
        Auth::user()->save();

        return $customer;
    }


    /**
    * Check if the Stripe customer exists.
    *
    * @return boolean
    */
    public function isStripeCustomer()
    {
        return Auth::user() && User::where('id', Auth::user()->id)->whereNotNull('stripe_id')->first();
    }


    /**
     * create or update membership table
     */

    public function createOrUpdateMembershipTable($membership)
    {
    	

    	if (!Auth::user()->client->current_membership()) {

    		$now = Carbon::now();
    		$duration = $membership->duration_time;
    		$endsAt = $membership->duration_mode == 1 ? $now->addMonths($duration) : $now->addYears($duration);

    		Auth::user()->client->memberships()->create([
    			'membership_id' => $membership->id,
    			'ends_at' => $endsAt
    		]);
    	} else {
    		Auth::user()->client->current_membership()->membership_id = $membership->id;
    		Auth::user()->client->current_membership()->save();
    	}
    }

    /**
    	create tickets for a client
    **/
    public function createUserTicket($ticket)
    {
    	Auth::user()->client->tickets()->create([
    		'raffle_vote_id' => $ticket->id,
    		'payment_type' => 'credit_card',
    		'state' => 1
    	]);
    }


}
