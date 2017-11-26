<?php

namespace MissVote\Http\Controllers;

use Illuminate\Http\Request;
use MissVote\RepositoryInterface\MissRepositoryInterface;
use MissVote\Repository\ConfigRepository;
use MissVote\Models\Country;
use MissVote\RepositoryInterface\ConfigRepositoryInterface;
use Response;
use Redirect;
use PDF;

class ApplicantController extends Controller
{
    
    public $applicant;
    public $config;


    public function __construct(MissRepositoryInterface $applicant, ConfigRepositoryInterface $config)
    {
        $this->middleware('auth');
        $this->middleware('can:acess-backend');
        $this->applicant = $applicant;
        $this->config = $config;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $currentCasting = null;
        if (!$request->has('casting_id')) {
            $currentCasting = ConfigRepository::getCurrentCasting();
            return redirect()->action('ApplicantController@index',['casting_id'=>$currentCasting->id]);
        } else {
            $currentCasting = $this->config->find($request->get('casting_id'));
        }

        $countries = $currentCasting->countries;

        $applicants = $this->applicant->enumApplicants($request);
        return view('backend.applicant.index',compact('castings','countries','applicants'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $countries = Country::orderby('name')->get();
        return view('backend.applicant.create',compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(PrecandidateRequest $request)
    {
        $data = $request->all();
        $applicant = $this->applicant->save($data);
        $sessionData = [
            'tipo_mensaje' => 'success',
            'mensaje' => '',
        ];
        if ($applicant) {
            $sessionData['mensaje'] = trans('backend.applicant.create-edit.flag_success_saved');
        } else {
            $sessionData['tipo_mensaje'] = 'error';
            $sessionData['mensaje'] = trans('backend.applicant.create-edit.flag_error_saved');
        }
        
        return Redirect::action('PrecandidateController@edit',$applicant->id)->with($sessionData);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $applicant = $this->applicant->find($id);
        return view('backend.applicant.show',[
            'applicant'=>$applicant
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
        dd("entra");
        $data = $request->all();
        $applicant = $this->applicant->edit($id,$data);
        $sessionData = [
            'tipo_mensaje' => 'success',
            'mensaje' => '',
        ];
        if ($applicant) {

            $sessionData['mensaje'] = trans('backend.applicant.create-edit.flag_success_updated');

        } elseif(!$applicant && $request->has('is_applicant')) {
            $sessionData['mensaje'] = trans('backend.applicant.create-edit.flag_qualited');
            
        } else {
            $sessionData['tipo_mensaje'] = 'error';
            $sessionData['mensaje'] = trans('backend.applicant.create-edit.flag_error_updated');
        }

        if ($request->has('is_applicant')) {
            return Redirect::action('PrecandidateController@index')->with($sessionData);
        } else {
            return Redirect::action('PrecandidateController@show',$applicant->id)->with($sessionData);
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
        $applicant = $this->applicant->remove($id);
        
        $sessionData = [
            'tipo_mensaje' => 'success',
            'mensaje' => '',
        ];
        
        if ($applicant) {
            $sessionData['mensaje'] = trans('backend.applicant.create-edit.flag_success_deleted');
        } else {
            $sessionData['tipo_mensaje'] = 'error';
            $sessionData['mensaje'] = trans('backend.applicant.create-edit.flag_error_deleted');
        }
        
        return Redirect::action('PrecandidateController@index')->with($sessionData);
    }


    public function uploadPhoto(Request $request)
    {
        $applicantId = $request->get('applicant_id');
        $photo = $request->file('photos');
        // dd($photo[0]);
        if($applicant = $this->applicant->uploadPhoto($applicantId,$photo[0])){
            return ['applicant'=>$applicant];
        }
    }

    public function deletePhoto(Request $request)
    {
        $key = $request->get('key');
        if ($this->applicant->deletePhoto($key)) {
            return ['success'=>"It's cool"];
        }
    }


    
}
