<?php

namespace MissVote\Http\Controllers;

use Illuminate\Http\Request;

use Paypalpayment;

use Session;

class PaypalController extends Controller
{
    
	private $apiContext;


    public function __construct()
    {
    	$this->apiContext = Paypalpayment::apiContext(config('paypal_payment.Account.ClientId'),config('paypal_payment.Account.ClientSecret'));
    	$config = config('paypal_payment'); // Get all config items as multi dimensional array
    	$flatConfig = array_dot($config); // Flatten the array with dots
    	$this->apiContext->setConfig($flatConfig);
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
        $amount->setCurrency("USD")
            ->setTotal($request->get('paypal_ticket_amount'));


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
        $redirectUrls->setReturnUrl(route("website.account"))
            ->setCancelUrl(route("website.account"));


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
            	$mensaje['payment-type'] = 'Error';
				$mensaje['payment-message'] = 'Ocurrió un error de conexión con Paypal.';
               return redirect()->route('website.account')->with($mensaje);
                /** echo "Exception: " . $ex->getMessage() . PHP_EOL; **/
                /** $err_data = json_decode($ex->getData(), true); **/
                /** exit; **/
            } else {
               $mensaje['payment-type'] = 'Error';
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
        if(isset($redirectUrl)) {
            /** redirect to paypal **/
            return redirect()->away($redirectUrl);
        }
        $mensaje['payment-type'] = 'Error';
		$mensaje['payment-message'] = 'Ocurrió un error de conexión con Paypal.';
       	return redirect()->route('website.account')->with($mensaje);

         // ### Get redirect url
        // The API response provides the url that you must redirect
        // the buyer to. Retrieve the url from the $payment->getApprovalLink()
        // method
        // $approvalUrl = $payment->getApprovalLink();
        // echo "Created Payment Using PayPal. Please visit the URL to Approve.Payment <a href={$approvalUrl}>{$approvalUrl}</a>";

    }
}
