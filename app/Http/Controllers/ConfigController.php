<?php

namespace MissVote\Http\Controllers;

use Illuminate\Http\Request;

use MissVote\Http\Requests\ConfigRequest;

use MissVote\RepositoryInterface\ConfigRepositoryInterface;

use Response;

use Redirect;

class ConfigController extends Controller
{
    
    public $config;


    public function __construct(configRepositoryInterface $config)
    {
        $this->middleware('auth');
        $this->middleware('can:acess-backend');
        $this->config = $config;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $configs = $this->config->enum();
        $data = [
            'configs' => $configs
        ];
        return view('backend.config.index',$data);
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
    public function store(configRequest $request)
    {
        $data = $request->all();
        $config = $this->config->save($data);
        $sessionData = [
            'tipo_mensaje' => 'success',
            'mensaje' => '',
        ];
        if ($config) {
            $sessionData['mensaje'] = trans('backend.config.create-edit.flag_success_saved');
        } else {
            $sessionData['tipo_mensaje'] = 'error';
            $sessionData['mensaje'] = trans('backend.config.create-edit.flag_error_saved');
        }
        
        return Redirect::action('ConfigController@edit',$config->id)->with($sessionData);
        
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
