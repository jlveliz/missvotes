<?php

namespace MissVote\Http\Controllers;

use Illuminate\Http\Request;

use MissVote\Http\Requests\MembershipRequest;

use MissVote\RepositoryInterface\MembershipRepositoryInterface;

use MissVote\Models\Membership;

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
       $durationsMode = (new Membership())->durationsMode;
       return view('backend.membership.create',compact('durationsMode'));
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
            $sessionData['mensaje'] = trans('backend.membership.create-edit.flag_success_saved');
        } else {
            $sessionData['tipo_mensaje'] = 'error';
            $sessionData['mensaje'] = trans('backend.membership.create-edit.flag_error_saved');
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
        $durationsMode = (new Membership())->durationsMode;
        return view('backend.membership.edit',['membership' => $membership , 'durationsMode' =>$durationsMode]);
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
            $sessionData['mensaje'] = trans('backend.membership.create-edit.flag_success_updated');
        } else {
            $sessionData['tipo_mensaje'] = 'error';
            $sessionData['mensaje'] = trans('backend.membership.create-edit.flag_error_updated');
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
            $sessionData['mensaje'] = trans('backend.membership.create-edit.flag_success_deleted');
        } else {
            $sessionData['tipo_mensaje'] = 'error';
            $sessionData['mensaje'] = trans('backend.membership.create-edit.flag_error_deleted');
        }
        
        return Redirect::action('MembershipController@index')->with($sessionData);
            
        
    }
}
