<?php

namespace MissVote\Http\Controllers;

use Illuminate\Http\Request;
use MissVote\RepositoryInterface\MissRepositoryInterface;
use MissVote\Repository\ConfigRepository;
use MissVote\RepositoryInterface\CountryRepositoryInterface;
use MissVote\RepositoryInterface\ConfigRepositoryInterface;
use Response;
use Redirect;
use PDF;

class PrecandidateController extends Controller
{
    
    public $precandidate;
    public $country;
    

    public function __construct(MissRepositoryInterface $precandidate,CountryRepositoryInterface $country)
    {
        $this->middleware('auth');
        $this->middleware('can:acess-backend');
        $this->precandidate = $precandidate;
        $this->country = $country;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $countries =$this->country->enum();
        $precandidates = $this->precandidate->enum($request);
        return view('backend.precandidate.index',compact('countries','precandidates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(PrecandidateRequest $request)
    {
        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $precandidate = $this->precandidate->find($id);
        return view('backend.precandidate.show',[
            'precandidate'=>$precandidate
            ]);   
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
       #
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(PrecandidateRequest $request, $id)
    {
        $data = $request->all();
        $precandidate = $this->precandidate->edit($id,$data);
        $sessionData = [
            'tipo_mensaje' => 'success',
            'mensaje' => '',
        ];
        if ($precandidate) {

            $sessionData['mensaje'] = trans('backend.precandidate.create-edit.flag_success_updated');

        } elseif(!$precandidate && $request->has('is_precandidate')) {
            $sessionData['mensaje'] = trans('backend.precandidate.create-edit.flag_qualited');
            
        } else {
            $sessionData['tipo_mensaje'] = 'error';
            $sessionData['mensaje'] = trans('backend.precandidate.create-edit.flag_error_updated');
        }

        if ($request->has('is_precandidate')) {
            return Redirect::action('PrecandidateController@index')->with($sessionData);
        } else {
            return Redirect::action('PrecandidateController@show',$precandidate->id)->with($sessionData);
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
        $precandidate = $this->precandidate->remove($id);
        
        $sessionData = [
            'tipo_mensaje' => 'success',
            'mensaje' => '',
        ];
        
        if ($precandidate) {
            $sessionData['mensaje'] = trans('backend.precandidate.create-edit.flag_success_deleted');
        } else {
            $sessionData['tipo_mensaje'] = 'error';
            $sessionData['mensaje'] = trans('backend.precandidate.create-edit.flag_error_deleted');
        }
        
        return Redirect::action('PrecandidateController@index')->with($sessionData);
    }



    
}
