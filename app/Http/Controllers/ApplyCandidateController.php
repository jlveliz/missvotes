<?php

namespace MissVote\Http\Controllers;

use Illuminate\Http\Request;

use MissVote\RepositoryInterface\ClientApplyProcessRepositoryInterface;

use Auth;


class ApplyCandidateController extends Controller
{
    
    private $apply;

    public function __construct(ClientApplyProcessRepositoryInterface $apply)
    {
        $this->apply = $apply;
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
    	$sessionData['message'] = 'Por favor acepte los terminos y condiciones';
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
    	$sessionData['message'] = 'Por favor, acepte los terminos y condiciones de participación';
        
        $existApply = $this->apply->find(['client_id' => Auth::user()->id]);

    	if ($existApply) {
    		return view('frontend.pages.apply.form-process',compact('existApply'));
    	} else {
    		return redirect()->action('ApplyCandidateController@requirements')->with($sessionData);
    	}
    }
}
