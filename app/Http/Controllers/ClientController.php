<?php

namespace MissVote\Http\Controllers;

use Illuminate\Http\Request;

use MissVote\Http\Requests\ClientRequest;

use MissVote\RepositoryInterface\ClientRepositoryInterface;

// use MissVote\RepositoryInterface\RoleRepositoryInterface;

use MissVote\Models\Country;

use Response;

use Redirect;

class ClientController extends Controller
{
    
    public $client;

    // public $role;

    public function __construct(ClientRepositoryInterface $client)
    {
        $this->client = $client;
        $this->middleware('auth');
        $this->middleware('can:acess-backend');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $clients = $this->client->enum();
        $data = [
            'clients' => $clients
        ];
        return view('backend.client.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $countries = Country::orderby('name')->get();
        return view('backend.client.create',compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(ClientRequest $request)
    {
        $data = $request->all();
        $client = $this->client->save($data);
        $sessionData = [
            'tipo_mensaje' => 'success',
            'mensaje' => '',
        ];
        if ($client) {
            $sessionData['mensaje'] = trans('backend.client.create-edit.flag_success_saved');
        } else {
            $sessionData['tipo_mensaje'] = 'error';
            $sessionData['mensaje'] = trans('backend.client.create-edit.flag_error_saved');
        }
        
        return Redirect::action('ClientController@edit',$client->id)->with($sessionData);
        
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
        $client = $this->client->find($id);
        $countries = Country::orderby('name')->get();
        // $roles = $this->role->enum();

        // foreach ($roles as $key => $role) {
        //     foreach ($client->roles as $key => $rolClient) {
        //         if ($rolClient->id == $role->id) {
        //             $role->checked = true;
        //         } 
        //     }
        // }

        return view('backend.client.edit',[
            'client'=>$client,
            'countries' => $countries
            // 'roles'=>$roles
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(ClientRequest $request, $id)
    {
        $data = $request->all();
        $client = $this->client->edit($id,$data);
        $sessionData = [
            'tipo_mensaje' => 'success',
            'mensaje' => '',
        ];
        if ($client) {
            $sessionData['mensaje'] = trans('backend.client.create-edit.flag_success_updated');
        } else {
            $sessionData['tipo_mensaje'] = 'error';
            $sessionData['mensaje'] = trans('backend.client.create-edit.flag_error_updated');
        }
        
        return Redirect::action('ClientController@edit',$client->id)->with($sessionData);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        
        $client = $this->client->remove($id);
        
        $sessionData = [
            'tipo_mensaje' => 'success',
            'mensaje' => '',
        ];
        
        if ($client) {
            $sessionData['mensaje'] = trans('backend.client.create-edit.flag_success_deleted');
        } else {
            $sessionData['tipo_mensaje'] = 'error';
            $sessionData['mensaje'] = trans('backend.client.create-edit.flag_error_deleted');
        }
        
        return Redirect::action('ClientController@index')->with($sessionData);
            
        
    }
}
