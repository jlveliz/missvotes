<?php

namespace MissVote\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

class PaymentController extends Controller
{
    

	public function subscribe(Request $request)
	{
		$stripeToken = $request->get('stripeToken');

		$user = Auth::user();

		$plan = 'premium';

		$user->newSubscription('premium',$plan)->create($stripeToken);

		return "hecho";
	}

}
