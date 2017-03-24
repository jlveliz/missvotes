<?php

namespace MissVote\Http\Controllers;

use Illuminate\Http\Request;

use MissVote\Http\Requests\MembershipRequest;

use MissVote\RepositoryInterface\MembershipRepositoryInterface;

use Response;

use Redirect;

class MembershipController extends Controller
{
    
    public $membership;


    public function __construct(MembershipRepositoryInterface $membership)
    {
        $this->middleware('auth');
        $this->middleware('can:acess-backend');
        $this->membership = $membership;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $memberships = $this->membership->enum();
        $data = [
            'memberships' => $memberships
        ];
        return view('backend.membership.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
       return view('backend.membership.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(MembershipRequest $request)
    {
        $data = $request->all();
        $membership = $this->membership->save($data);
        $sessionData = [
            'tipo_mensaje' => 'success',
            'mensaje' => '',
        ];
        if ($membership) {
            $sessionData['mensaje'] = 'Membresia Creado Satisfactoriamente';
        } else {
            $sessionData['tipo_mensaje'] = 'error';
            $sessionData['mensaje'] = 'La Membresia no pudo ser creado, intente nuevamente';
        }
        
        return Redirect::action('MembershipController@edit',$membership->id)->with($sessionData);
        
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
        $membership = $this->membership->find($id);
        return view('backend.membership.edit',compact('membership'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(MembershipRequest $request, $id)
    {
        $data = $request->all();
        $membership = $this->membership->edit($id,$data);
        $sessionData = [
            'tipo_mensaje' => 'success',
            'mensaje' => '',
        ];
        if ($membership) {
            $sessionData['mensaje'] = 'Membresia editada Satisfactoriamente';
        } else {
            $sessionData['tipo_mensaje'] = 'error';
            $sessionData['mensaje'] = 'La Membresia no pudo ser editada, intente nuevamente';
        }
        
        return Redirect::action('MembershipController@edit',$membership->id)->with($sessionData);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        
        $membership = $this->membership->remove($id);
        
        $sessionData = [
            'tipo_mensaje' => 'success',
            'mensaje' => '',
        ];
        
        if ($membership) {
            $sessionData['mensaje'] = 'La Membresia ha sido eliminada satisfactoriamente';
        } else {
            $sessionData['tipo_mensaje'] = 'error';
            $sessionData['mensaje'] = 'La Membresia no pudo ser eliminada, intente nuevamente';
        }
        
        return Redirect::action('MembershipController@index')->with($sessionData);
            
        
    }
}
