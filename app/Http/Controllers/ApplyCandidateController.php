<?php

namespace MissVote\Http\Controllers;

use Illuminate\Http\Request;

class ApplyCandidateController extends Controller
{
    public function requirements()
    {
    	return view('frontend.pages.apply.requirements');
    }

    public function aceptrequirements(Request $request)
    {
    	$sessionData['type'] = 'error';
    	$sessionData['message'] = 'Por favor acepte los terminos y condiciones';
    	if ($request->has('acept-terms')) {
    		if ($request->get('acept-terms') == '1') {
    			session()->put('acept-terms',$request->get('acept-terms'));
    			return redirect()->action('ApplyCandidateController@showCountries');
    		} else {
    			return redirect()->action('ApplyCandidateController@requirements')->with($sessionData);
    		}
    	} else {
    		return redirect()->action('ApplyCandidateController@requirements')->with($sessionData);
    	}

    }

    public function showCountries()
    {
    	$sessionData['type'] = 'error';
    	$sessionData['message'] = 'Por favor acepte los terminos y condiciones';

    	if (session()->has('acept-terms')) {
    		return view('frontend.pages.apply.show-countries');
    	} else {
    		return redirect()->action('ApplyCandidateController@requirements')->with($sessionData);
    	}
    }
}
