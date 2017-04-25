<?php

namespace MissVote\Http\Controllers;

use Illuminate\Http\Request;

use MissVote\Http\Requests\PrecandidateRequest;

use MissVote\RepositoryInterface\PrecandidateRepositoryInterface;

use MissVote\Models\Country;

use Response;

use Redirect;

class PrecandidateController extends Controller
{
    
    public $precandidate;


    public function __construct(PrecandidateRepositoryInterface $precandidate)
    {
        $this->middleware('auth');
        $this->middleware('can:acess-backend');
        $this->precandidate = $precandidate;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $precandidates = $this->precandidate->enum();
        $data = [
            'precandidates' => $precandidates
        ];
        return view('backend.precandidate.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $countries = Country::orderby('name')->get();
        return view('backend.precandidate.create',compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(PrecandidateRequest $request)
    {
        $data = $request->all();
        $precandidate = $this->precandidate->save($data);
        $sessionData = [
            'tipo_mensaje' => 'success',
            'mensaje' => '',
        ];
        if ($precandidate) {
            $sessionData['mensaje'] = 'Precandidata Creado Satisfactoriamente';
        } else {
            $sessionData['tipo_mensaje'] = 'error';
            $sessionData['mensaje'] = 'La precandidata no pudo ser creado, intente nuevamente';
        }
        
        return Redirect::action('PrecandidateController@edit',$precandidate->id)->with($sessionData);
        
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

            $sessionData['mensaje'] = 'Precandidata Editado Satisfactoriamente';

        } elseif(!$precandidate && $request->has('is_precandidate')) {
            $sessionData['mensaje'] = 'La Señorita  ha sido calificada como candidata';
            
        } else {
            $sessionData['tipo_mensaje'] = 'error';
            $sessionData['mensaje'] = 'La Precandidata no pudo ser actualizada, intente nuevamente';
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
            $sessionData['mensaje'] = 'Precandidata Eliminado Satisfactoriamente';
        } else {
            $sessionData['tipo_mensaje'] = 'error';
            $sessionData['mensaje'] = 'La precandidata no pudo ser eliminado, intente nuevamente';
        }
        
        return Redirect::action('PrecandidateController@index')->with($sessionData);
    }


    public function uploadPhoto(Request $request)
    {
        $precandidateId = $request->get('precandidate_id');
        $photo = $request->file('photos');
        // dd($photo[0]);
        if($precandidate = $this->precandidate->uploadPhoto($precandidateId,$photo[0])){
            return ['precandidate'=>$precandidate];
        }
    }

    public function deletePhoto(Request $request)
    {
        $key = $request->get('key');
        if ($this->precandidate->deletePhoto($key)) {
            return ['success'=>"It's cool"];
        }
    }
}
