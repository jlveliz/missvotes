<?php

namespace MissVote\Http\Controllers;

use Illuminate\Http\Request;
use MissVote\Http\Requests\MissRequest;
use MissVote\RepositoryInterface\MissRepositoryInterface;
use MissVote\RepositoryInterface\CountryRepositoryInterface;
use Response;
use Redirect;

class CandidateController extends Controller
{
    
    public $candidate;
    public $country;

    public function __construct(MissRepositoryInterface $candidate,CountryRepositoryInterface $country)
    {
        $this->middleware('auth');
        $this->middleware('can:acess-backend');
        $this->candidate = $candidate;
        $this->country = $country;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $countries = $this->country->enum(['with_flags'=>true]);
        $candidates = $this->candidate->enumCandidates($request);
        return view('backend.candidate.index',compact("candidates","countries"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $countries = $this->country->enum(['with_flags'=>true]);
        return view('backend.candidate.create',compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(MissRequest $request)
    {
        $data = $request->all();
        $candidate = $this->candidate->save($data);
        $sessionData = [
            'tipo_mensaje' => 'success',
            'mensaje' => '',
        ];
        if ($candidate) {
            $sessionData['mensaje'] = trans('backend.candidates.create-edit.flag_success_saved');
        } else {
            $sessionData['tipo_mensaje'] = 'error';
            $sessionData['mensaje'] = trans('backend.candidates.create-edit.flag_error_saved');
        }
        
        return Redirect::action('CandidateController@edit',$candidate->id)->with($sessionData);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $countries = $this->country->enum(['with_flags'=>true]);
        $candidate = $this->candidate->find($id);
        return view('backend.candidate.edit',compact('candidate','countries'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(MissRequest $request, $id)
    {
        $data = $request->all();
        $candidate = $this->candidate->edit($id,$data);
        $sessionData = [
            'tipo_mensaje' => 'success',
            'mensaje' => '',
        ];
        if ($candidate) {
            $sessionData['mensaje'] = trans('backend.candidates.create-edit.flag_success_updated');
           
        }elseif (!$candidate && $request->has('is_precandidate')) {
            $sessionData['mensaje'] =  trans('backend.candidates.create-edit.flag_disqualited');
        } else {
            $sessionData['tipo_mensaje'] = 'error';
            $sessionData['mensaje'] =  trans('backend.candidates.create-edit.flag_error_updated');
        }

        if ($request->has('is_precandidate')) {
            return Redirect::action('CandidateController@index')->with($sessionData);
        } else {
            return Redirect::action('CandidateController@edit',$candidate->id)->with($sessionData);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        
        $candidate = $this->candidate->remove($id);
        
        $sessionData = [
            'tipo_mensaje' => 'success',
            'mensaje' => '',
        ];
        
        if ($candidate) {
            $sessionData['mensaje'] = trans('backend.candidates.create-edit.flag_success_deleted');
        } else {
            $sessionData['tipo_mensaje'] = 'error';
            $sessionData['mensaje'] = trans('backend.candidates.create-edit.flag_error_deleted');
        }
        
        return Redirect::action('CandidateController@index')->with($sessionData);
            
        
    }


    public function uploadPhoto(Request $request)
    {
        $missId = $request->get('miss_id');
        $photo = $request->file('photos');
        // dd($photo[0]);
        if($candidate = $this->candidate->uploadPhoto($missId,$photo[0])){
            return ['candidate'=>$candidate];
        }
    }

    public function deletePhoto(Request $request)
    {
        $key = $request->get('key');
        if ($this->candidate->deletePhoto($key)) {
            return ['success'=>"It's cool"];
        }
    }
}
