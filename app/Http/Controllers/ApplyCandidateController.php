<?php

namespace MissVote\Http\Controllers;

use Illuminate\Http\Request;

use MissVote\RepositoryInterface\ClientApplyProcessRepositoryInterface;

use MissVote\Http\Requests\PrecandidateRequest;

use MissVote\RepositoryInterface\PrecandidateRepositoryInterface;

use MissVote\Models\Country;

use MissVote\Events\PredidateSubscribed;

use Paypalpayment;

use Stripe\Stripe;

use Stripe\Customer;

use Auth;

use Carbon\Carbon;

use Lang;


class ApplyCandidateController extends Controller
{
    
    private $apply;

    private $apiContext;

    private $precandidate;

    public function __construct(ClientApplyProcessRepositoryInterface $apply, PrecandidateRepositoryInterface $precandidate)
    {
        $this->apply = $apply;
        $this->apiContext = Paypalpayment::apiContext(config('paypal_payment.Account.ClientId'),config('paypal_payment.Account.ClientSecret'));
        $config = config('paypal_payment'); // Get all config items as multi dimensional array
        $flatConfig = array_dot($config); // Flatten the array with dots
        $this->apiContext->setConfig($flatConfig);
        $this->precandidate = $precandidate;
    }

    public function requirements()
    {
    	
        $existApply = $this->apply->find(['client_id' => Auth::user()->id]);

        if ($existApply) {
            return redirect()->action('ApplyCandidateController@aplicationProcess');
        }
        return view('frontend.pages.apply.requirements');
    }

    public function aceptrequirements(Request $request)
    {

        $sessionData['type'] = 'error';
    	$sessionData['message'] = Lang::get('requirement.accept_requirements_message');
    	if ($request->has('acept-terms')) {
    		if ($request->get('acept-terms') == '1') {
    			$dataApply = [
                    'client_id' => Auth::user()->id,
                    'process_status' => 1
                ];
                
                $existApply = $this->apply->save($dataApply);
                if ($existApply) {
                    return redirect()->action('ApplyCandidateController@aplicationProcess');
                }
    		} else {
    			return redirect()->action('ApplyCandidateController@requirements')->with($sessionData);
    		}
    	} else {
    		return redirect()->action('ApplyCandidateController@requirements')->with($sessionData);
    	}

    }

    public function aplicationProcess()
    {
    	$sessionData['type'] = 'error';
    	$sessionData['message'] = Lang::get('requirement.accept_requirements_message');
        
        $existApply = $this->apply->find(['client_id' => Auth::user()->id]);

    	if ($existApply) {
            $countryselected = null;
            $precandidate = null;
            if ($existApply->country_code_selected) {
                $countryselected = Country::select('id')->where('code',$existApply->country_code_selected)->first()->id;
            }
            if ($existApply->process_status >= 3) {
                $precandidate = $this->precandidate->find(['email'=>Auth::user()->email]) ?  $this->precandidate->find(['email'=>Auth::user()->email]) : null;
            }
    		return view('frontend.pages.apply.form-process',compact('existApply','countryselected','precandidate'));
    	} else {
    		return redirect()->action('ApplyCandidateController@requirements')->with($sessionData);
    	}
    }


    public function updateAplicationProcess(Request $request)
    {
        $existApply = $this->apply->find(['client_id' => Auth::user()->id]);
        
        if ($request->has('country_code')) {
            $existApply->country_code_selected = $request->get('country_code');
        }

        if ($request->has('process_status')) {
            $existApply->process_status = $request->get('process_status');
        }

        $existApply->save();
    }



    public function payApplyProcess()
    {
        $payer = Paypalpayment::payer();
        $payer->setPaymentMethod("paypal");

        $item = Paypalpayment::item();
        $item->setName('Pay Apply Process Miss Panamerican In')
                ->setDescription('Pay Apply Process Miss Panamerican In')
                ->setCurrency('USD')
                ->setQuantity(1)
                ->setPrice('60.00');


        $itemList = Paypalpayment::itemList();
        $itemList->setItems(array($item));
        

        $amount = Paypalpayment::amount();
        $amount->setCurrency("USD")->setTotal('60.00');


        $transaction = Paypalpayment::transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription('Pay Apply Process Miss Panamerican In')
            ->setInvoiceNumber(uniqid());

        // ### Redirect urls
        // Set the urls that the buyer must be redirected to after 
        // payment approval/ cancellation.
        // $baseUrl = 'http://misses.dev';
        $redirectUrls = Paypalpayment::redirectUrls();
        $redirectUrls->setReturnUrl(route("pay.paypal.aplication.status"))
            ->setCancelUrl(route("pay.paypal.aplication.status"));


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
               // return redirect()->route('pay.paypal.aplication.status')->with($mensaje);
                return redirect()->away('http://www.misspanamint.com/login/')->with($mensaje);
                /** echo "Exception: " . $ex->getMessage() . PHP_EOL; **/
                /** $err_data = json_decode($ex->getData(), true); **/
                /** exit; **/
            } else {
               $mensaje['payment-type'] = 'error';
                $mensaje['payment-message'] = Lang::get('paypal.general_error');
               // return redirect()->url("pay.paypal.aplication.status")->with($mensaje);
                return redirect()->away('http://www.misspanamint.com/login/')->with($mensaje);
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
        session()->put('paypal_payment_id', $payment->getId());
        session()->put('payed',true);
        if(isset($redirectUrl)) {
            /** redirect to paypal **/
            return redirect()->away($redirectUrl);
        }
        $mensaje['payment-type'] = 'error';
        $mensaje['payment-message'] = Lang::get('paypal.paypal_error_connection');
        return redirect()->url("apply/aplication-process#pay")->with($mensaje);
        return redirect()->url("apply/aplication-process#pay")->with($mensaje);
        return redirect()->url("apply/aplication-process#pay")->with($mensaje);
        
    }


    public function getPaymentStatus(Request $request)
    {
        /** Get the payment ID before session clear **/
        $paymentId = session()->get('paypal_payment_id');
        /** clear the session payment ID **/
        session()->forget('paypal_payment_id');
        if (empty($request->get('PayerID')) || empty($request->get('token'))) {
            $mensaje['payment-type'] = 'error';
            $mensaje['payment-message'] =  Lang::get('paypal.paypal_error_transaction');
            // return redirect()->to('apply/aplication-process#pay')->with($mensaje);
            return redirect()->away('http://www.misspanamint.com/login/')->with($mensaje);
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
        ///insert payment
        if ($result->getState() == 'approved') {
            $existApply = $this->apply->find(['client_id' => Auth::user()->id]);
            $existApply->process_status = 3;
            $existApply->payed_at = Carbon::now();
            $existApply->save();


             /** it's all right **/
            /** Here Write your database logic like that insert record or value in database if you want **/
            $mensaje['payment-type'] = 'success';
            $mensaje['payment-message'] = Lang::get('paypal.pay_apply');
            // return redirect()->to('apply/aplication-process#aplication')->with($mensaje);
            return redirect()->away('http://www.misspanamint.com/login/')->with($mensaje);
        }

        $mensaje['payment-type'] = 'error';
        $mensaje['payment-message'] = Lang::get('paypal.error_pay_apply');;
        // return redirect()->to('apply/aplication-process#pay')->with($mensaje);
        return redirect()->away('http://www.misspanamint.com/login/')->with($mensaje);

    }


    public function payStripeApplyProcess(StripeController $stripeController, Request $request)
    {
        
        $stripeToken = $request->get('stripeToken');

        if (!$stripeController->isStripeCustomer()) {
            $stripeController->createStripeCustomer($stripeToken);
        }

        $user = Auth::user();

        //make MAGIC!!
        $pay = $user->charge($request->get('amount'),['description'=>$request->get('description')]);

        if ($pay) {
            $existApply = $this->apply->find(['client_id' => Auth::user()->id]);
            $existApply->process_status = 3;
            $existApply->payed_at = Carbon::now();
            $existApply->save();
            /** it's all right **/
            /** Here Write your database logic like that insert record or value in database if you want **/
            $mensaje['payment-type'] = 'success';
            $mensaje['payment-message'] = Lang::get('stripe.pay_apply');
            // return redirect()->to('apply/aplication-process#aplication')->with($mensaje);
            return redirect()->away('http://www.misspanamint.com/login/')->with($mensaje);
        } else {
            $mensaje['payment-type'] = 'error';
            $mensaje['payment-message'] = Lang::get('stripe.error_pay_apply');
            // return redirect()->to('apply/aplication-process#pay')->with($mensaje);
            return redirect()->away('http://www.misspanamint.com/login/')->with($mensaje);
        }
    }


    public function insertPrecandidate(PrecandidateRequest $request)
    {
        $data = $request->all();

        $data['code'] = $this->generateCode($request->get('country_id'));
        
        $precandidate = $this->precandidate->save($data);
        $sessionData = [
            'tipo_mensaje' => 'success',
            'mensaje' => Lang::get('form_process_apply.thanks_subscribe'),
        ];
        if ($precandidate) {
            $existApply = $this->apply->find(['client_id' => Auth::user()->id]);
            $existApply->process_status = 4;
            $existApply->save();
            event(new PredidateSubscribed($precandidate));
            // return redirect()->to('apply/aplication-process#status')->with($sessionData);
            return redirect()->away('http://www.misspanamint.com/login/')->with($mensaje);
        } else {
            $sessionData['tipo_mensaje'] = 'error';
            $sessionData['mensaje'] = Lang::get('form_process_apply.error_subscribe');
            // return redirect()->to('apply/aplication-process#aplication')->with($sessionData);
            return redirect()->away('http://www.misspanamint.com/login/')->with($mensaje);
        }

    }

    private function generateCode($countryId)
    {
        $country = Country::find($countryId);
        $secuencial = $country->secuencial_casting_code+1;
        $country->secuencial_casting_code++;
        $country->save();
        $countryCode = substr($country->code,0,1);
        
        for ($i=0; $i <= count($secuencial) ; $i++) { 
            $secuencial = '0'.$secuencial;
        }

        return $countryCode.$secuencial;


    }
}
