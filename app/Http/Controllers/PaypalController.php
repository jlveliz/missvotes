<?php

namespace MissVote\Http\Controllers;

use Illuminate\Http\Request;

use MissVote\RepositoryInterface\TicketVoteRepositoryInterface;

use Paypalpayment;

use Session;

use Auth;

class PaypalController extends Controller
{
    
	private $apiContext;

    private $ticketRepo; 


    public function __construct(TicketVoteRepositoryInterface $ticketRepo)
    {
    	$this->apiContext = Paypalpayment::apiContext(config('paypal_payment.Account.ClientId'),config('paypal_payment.Account.ClientSecret'));
    	$config = config('paypal_payment'); // Get all config items as multi dimensional array
    	$flatConfig = array_dot($config); // Flatten the array with dots
    	$this->apiContext->setConfig($flatConfig);
        $this->ticketRepo = $ticketRepo;
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
				$mensaje['payment-message'] = 'Ocurrió un error de conexión con Paypal.';
               return redirect()->route('website.account')->with($mensaje);
                /** echo "Exception: " . $ex->getMessage() . PHP_EOL; **/
                /** $err_data = json_decode($ex->getData(), true); **/
                /** exit; **/
            } else {
               $mensaje['payment-type'] = 'error';
				$mensaje['payment-message'] = 'Ocurrió un error.';
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
        Session::put('ticket',$request->all());
        if(isset($redirectUrl)) {
            /** redirect to paypal **/
            return redirect()->away($redirectUrl);
        }
        $mensaje['payment-type'] = 'error';
		$mensaje['payment-message'] = 'Ocurrió un error de conexión con Paypal.';
       	return redirect()->route('website.account')->with($mensaje);


    }



    public function getPaymentStatus(Request $request)
    {
        

        /** Get the payment ID before session clear **/
        $paymentId = Session::get('paypal_payment_id');
        /** clear the session payment ID **/
        Session::forget('paypal_payment_id');
        if (empty($request->get('PayerID')) || empty($request->get('token'))) {
            $mensaje['payment-type'] = 'error';
            $mensaje['payment-message'] = 'Ocurrió un error en la transacción con Paypal.';
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
            //save a ticket on DB
            $requestTicket = Session::get('ticket');         
            $ticket = $this->ticketRepo->find($requestTicket['paypal_ticket_id']);
            $this->createUserTicket($ticket);

            /** it's all right **/
            /** Here Write your database logic like that insert record or value in database if you want **/
            \Session::put('success','Payment success');
            $mensaje['payment-type'] = 'success';
            $mensaje['payment-message'] = 'Gracias por la compra de un ticket '. $requestTicket['paypal_ticket_name'];
            return redirect()->route('website.account')->with($mensaje);
        }
        $mensaje['payment-type'] = 'error';
        $mensaje['payment-message'] = 'Ocurrió un error en la transacción con Paypal.';
        return redirect()->route('website.account')->with($mensaje);
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
