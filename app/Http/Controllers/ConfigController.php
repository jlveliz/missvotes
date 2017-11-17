<?php

namespace MissVote\Http\Controllers;

use Illuminate\Http\Request;

use MissVote\Http\Requests\ConfigRequest;

use MissVote\RepositoryInterface\ConfigRepositoryInterface;

use MissVote\RepositoryInterface\CountryRepositoryInterface;

use Response;

use Redirect;

class ConfigController extends Controller
{
    
    public $config;

    public $country;


    public function __construct(configRepositoryInterface $config, CountryRepositoryInterface $country)
    {
        $this->middleware('auth');
        $this->middleware('can:acess-backend');
        $this->config = $config;
        $this->country = $country;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $gConfig = [];

        //casting
        $configs = $this->config->enum();

        $countries = $this->country->enum(['with_flags'=> true]);
        
        foreach ($configs as $key => $config) {
            $gConfig[$config->key] = $config->payload;
        }        
        return view('backend.config.index',compact('gConfig','countries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.config.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $configs = $this->config->save($data);
        $sessionData = [
            'tipo_mensaje' => 'success',
            'mensaje' => '',
        ];
        if ($configs) {
            $sessionData['mensaje'] = trans('backend.config.index.flag_message_success');
        } else {
            $sessionData['tipo_mensaje'] = 'error';
            $sessionData['mensaje'] = trans('backend.config.index.flag_message_error');
        }
        
        $gConfig = [];

        //casting
        $configs = $this->config->enum();
        
        foreach ($configs as $key => $config) {
            $gConfig[$config->key] = $config->payload;
        } 

        return redirect()->action('ConfigController@index',compact('gConfig'))->with($sessionData);
        
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
        $config = $this->config->find($id);
        return view('backend.config.edit',['config' => $config]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(configRequest $request, $id)
    {
        $data = $request->all();
        $config = $this->config->edit($id,$data);
        $sessionData = [
            'tipo_mensaje' => 'success',
            'mensaje' => '',
        ];
        if ($config) {
            $sessionData['mensaje'] = trans('backend.config.create-edit.flag_success_updated');
        } else {
            $sessionData['tipo_mensaje'] = 'error';
            $sessionData['mensaje'] = trans('backend.config.create-edit.flag_error_updated');
        }
        
        return Redirect::action('ConfigController@edit',$config->id)->with($sessionData);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        
        $config = $this->config->remove($id);
        
        $sessionData = [
            'tipo_mensaje' => 'success',
            'mensaje' => '',
        ];
        
        if ($config) {
            $sessionData['mensaje'] = trans('backend.config.create-edit.flag_success_deleted');
        } else {
            $sessionData['tipo_mensaje'] = 'error';
            $sessionData['mensaje'] = trans('backend.config.create-edit.flag_error_deleted');
        }
        
        return Redirect::action('ConfigController@index')->with($sessionData);
            
        
    }
}
