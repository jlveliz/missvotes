<?php

namespace MissVote\Http\Controllers;

use Illuminate\Http\Request;

use MissVote\RepositoryInterface\TicketVoteRepositoryInterface;

use MissVote\RepositoryInterface\MembershipRepositoryInterface;

use MissVote\RepositoryInterface\ClientApplyProcessRepositoryInterface;

use MissVote\Events\ClientActivity;

use Paypalpayment;

use Session;

use Carbon\Carbon;

use Auth;

use Lang;

class PaypalController extends Controller
{
    
	private $apiContext;

    private $ticketRepo;

    private $membershipRepo;


    public function __construct(TicketVoteRepositoryInterface $ticketRepo, MembershipRepositoryInterface $membershipRepo)
    {
    	$this->apiContext = Paypalpayment::apiContext(config('paypal_payment.Account.ClientId'),config('paypal_payment.Account.ClientSecret'));
    	$config = config('paypal_payment'); // Get all config items as multi dimensional array
    	$flatConfig = array_dot($config); // Flatten the array with dots
    	$this->apiContext->setConfig($flatConfig);
        $this->ticketRepo = $ticketRepo;
        $this->membershipRepo = $membershipRepo;
    }


    public function subscribe(Request $request)
    {
        $payer = Paypalpayment::payer();
        $payer->setPaymentMethod("paypal");

        $item = Paypalpayment::item();
        $item->setName($request->get('paypal_membership_name'))
                ->setDescription($request->get('paypal_membership_description'))
                ->setCurrency('USD')
                ->setQuantity(1)
                ->setPrice($request->get('paypal_membership_amount'));


        $itemList = Paypalpayment::itemList();
        $itemList->setItems(array($item));
        

        $amount = Paypalpayment::amount();
        $amount->setCurrency("USD")->setTotal($request->get('paypal_membership_amount'));


        $transaction = Paypalpayment::transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription($request->get('paypal_membership_description'))
            ->setInvoiceNumber(uniqid());

        // ### Redirect urls
        // Set the urls that the buyer must be redirected to after 
        // payment approval/ cancellation.
        // $baseUrl = 'http://misses.dev';
        $redirectUrls = Paypalpayment::redirectUrls();
        $redirectUrls->setReturnUrl(route("website.paypal.status"))
            ->setCancelUrl(route("website.paypal.status"));


        // ### Payment
        // A Payment Resource; create one using
        // the above types and intent set to 'sale'
        $payment = Paypalpayment::payment();
        $payment->setIntent("Sale")
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions(array($transaction));


        // ### Create Payment
        // Create a payment by calling the 'create' method
        // passing it a valid apiContext.
        // (See bootstrap.php for more on `ApiContext`)
        // The return object contains the state and the
        // url to which the buyer must be redirected to
        // for payment approval
        try {
            $payment->create($this->apiContext);
        } catch (\PayPal\Exception\PPConnectionException $ex) {
            if (config('app.debug')) {
                $mensaje['payment-type'] = 'error';
                $mensaje['payment-message'] = Lang::get('paypal.paypal_error_connection');
               return redirect()->route('website.account')->with($mensaje);
                /** echo "Exception: " . $ex->getMessage() . PHP_EOL; **/
                /** $err_data = json_decode($ex->getData(), true); **/
                /** exit; **/
            } else {
               $mensaje['payment-type'] = 'error';
                $mensaje['payment-message'] = Lang::get('paypal.general_error');
               return redirect()->route('website.account')->with($mensaje);
                /** die('Some error occur, sorry for inconvenient'); **/
            }
        }

        foreach($payment->getLinks() as $link) {
            if($link->getRel() == 'approval_url') {
                $redirectUrl = $link->getHref();
                break;
            }
        }
        /** add payment ID to session **/
        Session::put('paypal_payment_id', $payment->getId());
        Session::put('membership',$request->all());
        if(isset($redirectUrl)) {
            /** redirect to paypal **/
            return redirect()->away($redirectUrl);
        }
        $mensaje['payment-type'] = 'error';
        $mensaje['payment-message'] = Lang::get('paypal.paypal_error_connection');
        return redirect()->route('website.account')->with($mensaje);



    }


    public function buyTicket(Request $request)
    {

    	$payer = Paypalpayment::payer();
    	$payer->setPaymentMethod("paypal");

    	$item = Paypalpayment::item();
        $item->setName($request->get('paypal_ticket_name'))
                ->setDescription($request->get('paypal_ticket_description'))
                ->setCurrency('USD')
                ->setQuantity(1)
                ->setPrice($request->get('paypal_ticket_amount'));


        $itemList = Paypalpayment::itemList();
        $itemList->setItems(array($item));
    	

        $amount = Paypalpayment::amount();
        $amount->setCurrency("USD")->setTotal($request->get('paypal_ticket_amount'));


        $transaction = Paypalpayment::transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription($request->get('paypal_ticket_description'))
            ->setInvoiceNumber(uniqid());

        // ### Redirect urls
        // Set the urls that the buyer must be redirected to after 
        // payment approval/ cancellation.
        // $baseUrl = 'http://misses.dev';
        $redirectUrls = Paypalpayment::redirectUrls();
        $redirectUrls->setReturnUrl("http://www.misspanamericaninternational.com/login/")
            ->setCancelUrl("http://www.misspanamericaninternational.com/login/");


        // ### Payment
        // A Payment Resource; create one using
        // the above types and intent set to 'sale'
        $payment = Paypalpayment::payment();
        $payment->setIntent("Sale")
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions(array($transaction));


        // ### Create Payment
        // Create a payment by calling the 'create' method
        // passing it a valid apiContext.
        // (See bootstrap.php for more on `ApiContext`)
        // The return object contains the state and the
        // url to which the buyer must be redirected to
        // for payment approval
        try {
            $payment->create($this->apiContext);
        } catch (\PayPal\Exception\PPConnectionException $ex) {
            if (config('app.debug')) {
            	$mensaje['payment-type'] = 'error';
				$mensaje['payment-message'] = Lang::get('paypal.paypal_error_connection');
               // return redirect()->route('website.account')->with($mensaje);
                return redirect()->away('http://www.misspanamericaninternational.com/login/')->with($mensaje);
                /** echo "Exception: " . $ex->getMessage() . PHP_EOL; **/
                /** $err_data = json_decode($ex->getData(), true); **/
                /** exit; **/
            } else {
               $mensaje['payment-type'] = 'error';
				$mensaje['payment-message'] = Lang::get('paypal.general_error');
               // return redirect()->route('website.account')->with($mensaje);
                return redirect()->away('http://www.misspanamericaninternational.com/login/')->with($mensaje);
                /** die('Some error occur, sorry for inconvenient'); **/
            }
        }

        foreach($payment->getLinks() as $link) {
            if($link->getRel() == 'approval_url') {
                $redirectUrl = $link->getHref();
                break;
            }
        }
        /** add payment ID to session **/
        Session::put('paypal_payment_id', $payment->getId());
        Session::put('ticket',$request->all());
        if(isset($redirectUrl)) {
            /** redirect to paypal **/
            return redirect()->away($redirectUrl);
        }
        $mensaje['payment-type'] = 'error';
		$mensaje['payment-message'] = Lang::get('paypal.paypal_error_connection');
       	// return redirect()->route('website.account')->with($mensaje);
        return redirect()->away('http://www.misspanamericaninternational.com/login/')->with($mensaje);


    }



    public function getPaymentStatus(Request $request)
    {
        

        /** Get the payment ID before session clear **/
        $paymentId = Session::get('paypal_payment_id');
        /** clear the session payment ID **/
        Session::forget('paypal_payment_id');
        if (empty($request->get('PayerID')) || empty($request->get('token'))) {
            $mensaje['payment-type'] = 'error';
            $mensaje['payment-message'] = Lang::get('paypal.paypal_error_transaction');
            return redirect()->route('website.account')->with($mensaje);
        }
        $payer = Paypalpayment::payer();

        $payment = Paypalpayment::getById($paymentId, $this->apiContext);
        /** PaymentExecution object includes information necessary **/
        /** to execute a PayPal account payment. **/
        /** The payer_id is added to the request query parameters **/
        /** when the user is redirected from paypal back to your site **/
        $execution = Paypalpayment::PaymentExecution();
        $execution->setPayerId($request->get('PayerID'));
        /**Execute the payment **/
        $result = $payment->execute($execution, $this->apiContext);
        /** dd($result);exit; /** DEBUG RESULT, remove it later **/
        if ($result->getState() == 'approved') {

            if (session()->has('ticket')) {
                //save a ticket on DB
                $requestTicket = Session::get('ticket');
                session()->forget('ticket');
                $ticket = $this->ticketRepo->find($requestTicket['paypal_ticket_id']);
                $this->createUserTicket($ticket);
                //insert activity
                event(new ClientActivity(Auth::user()->id, 'Has bought a ' .$ticket->name));
                $mensaje['payment-message'] = 'Gracias por la compra de un ticket '. $ticket->name;
            } 

            if (session()->has('membership')) {
                //save a ticket on DB
                $requestMembership = Session::get('membership');
                session()->forget('membership');         
                $membership = $this->membershipRepo->find($requestMembership['paypal_membership_id']);
                $this->createOrUpdateMembershipTable($membership);
                //insert activity
                $mensaje['payment-message'] = Lang::get('paypal.thanks_buy_membership') .' '.$membership->name;
                event(new ClientActivity(Auth::user()->id, Lang::get('paypal.thanks_buy_membership').' '.$membership->name));
            }

            /** it's all right **/
            /** Here Write your database logic like that insert record or value in database if you want **/
            $mensaje['payment-type'] = 'success';
            return redirect()->away('http://www.misspanamericaninternational.com/login/')->with($mensaje);
            // return redirect()->route('website.account')->with($mensaje);
        }
        $mensaje['payment-type'] = 'error';
        $mensaje['payment-message'] = Lang::get('paypal.paypal_error_transaction');
        // return redirect()->route('website.account')->with($mensaje);
        return redirect()->away('http://www.misspanamericaninternational.com/login/')->with($mensaje);
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
            'ticket_vote_id' => $ticket->id,
            'payment_type' => 'paypal',
            'state' => 1
        ]);
    }




}
