<?php

namespace MissVote\Http\Controllers;

use Illuminate\Http\Request;

// use MissVote\Http\Requests\PrecandidateRequest;

use MissVote\RepositoryInterface\MissRepositoryInterface;

use MissVote\Models\Country;

use Response;

use Redirect;

class ApplicantController extends Controller
{
    
    public $applicant;


    public function __construct(MissRepositoryInterface $applicant)
    {
        $this->middleware('auth');
        $this->middleware('can:acess-backend');
        $this->applicant = $applicant;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $applicants = $this->applicant->enum();
        $data = [
            'applicants' => $applicants
        ];
        return view('backend.applicant.index',$data);
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
