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
    			return redirect()->action('ApplyCandidateController@aplicationProcess');
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
    	$sessionData['message'] = 'Por favor, acepte los terminos y condiciones de participación';

    	if (session()->has('acept-terms')) {
    		return view('frontend.pages.apply.form-process');
    	} else {
    		return redirect()->action('ApplyCandidateController@requirements')->with($sessionData);
    	}
    }
}
